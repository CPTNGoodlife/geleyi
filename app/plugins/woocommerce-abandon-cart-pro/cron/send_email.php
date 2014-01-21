<?php 

//define('ABSPATH',dirname(__FILE__).'/');
require_once(ABSPATH . 'wp-load.php');

//if (is_woocommerce_active()) 
{

	/**
	 * woocommerce_abandon_cart_cron class
	 **/
	if (!class_exists('woocommerce_abandon_cart_cron')) {
	
		class woocommerce_abandon_cart_cron {
			
			var $cart_settings_cron;
			var $cart_abandon_cut_off_time_cron;
			
			public function __construct() {
				
				$this->cart_settings_cron = json_decode(get_option('woocommerce_ac_settings'));
				
				$this->cart_abandon_cut_off_time_cron = ($this->cart_settings_cron[0]->cart_time) * 60;
				
			}
			
			/*-----------------------------------------------------------------------------------*/
			/* Class Functions */
			/*-----------------------------------------------------------------------------------*/
			
			/**
			 * Function to send emails
			 */
			function woocommerce_ac_send_email() {
				//$cart_settings = json_decode(get_option('woocommerce_ac_settings'));
				
				//$cart_abandon_cut_off_time_cron = ($cart_settings[0]->cart_time) * 60;
				
				if( $this->cart_settings_cron[0]->enable_cart_notification == 'on' )
				{
				
				global $wpdb, $woocommerce;
			
				//Grab the cart abandoned cut-off time from database.
				$cart_settings = json_decode(get_option('woocommerce_ac_settings'));
			
				$cart_abandon_cut_off_time = ($cart_settings[0]->cart_time) * 60;
			
				//Fetch all active templates present in the system
				$query = "SELECT wpet . *
				FROM `".$wpdb->prefix."ac_email_templates` AS wpet
				WHERE wpet.is_active = '1'
				ORDER BY `day_or_hour` DESC, `frequency` ASC ";
				$results = $wpdb->get_results( $query );
				
				$minute_seconds = 60;
				$hour_seconds = 3600; // 60 * 60
				$day_seconds = 86400; // 24 * 60 * 60
				
				foreach ($results as $key => $value)
				{
					if ($value->day_or_hour == 'Minutes')
					{
						$time_to_send_template_after = $value->frequency * $minute_seconds;
					}
					elseif ($value->day_or_hour == 'Days')
					{
						$time_to_send_template_after = $value->frequency * $day_seconds;
					}
					elseif ($value->day_or_hour == 'Hours')
					{
						$time_to_send_template_after = $value->frequency * $hour_seconds;
					}
			
					$carts = $this->get_carts($time_to_send_template_after, $cart_abandon_cut_off_time);
			
					$email_frequency = $value->frequency;
					$email_body_template = $value->body;
			
					$email_subject = $value->subject;
					$headers[] = "From: ".$value->from_name." <".$value->from_email.">";
					$headers[] = "Content-Type: text/html";
					$headers[] = "Reply-To: ".$value->reply_email." ";
			
					$template_id = $value->id;
					
					$coupon_id = $value->coupon_code;
					$coupon_to_apply = get_post($coupon_id,ARRAY_A);
					$coupon_code = $coupon_to_apply['post_name'];
				/*	echo "<pre>";
					print_r($carts);
					echo "</pre>";
					exit;*/
					foreach ($carts as $key => $value )
					{
						if ($value->user_type == "GUEST")
						{
							$value->user_login = "";
							$query_guest = "SELECT billing_first_name, billing_last_name, email_id 
											FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
											WHERE id = '".$value->user_id."'";
							$results_guest = $wpdb->get_results($query_guest);
							$value->user_email = $results_guest[0]->email_id;		
						}
						$cart_info_db_field = json_decode($value->abandoned_cart_info);
						if (count($cart_info_db_field->cart) > 0 )
						{
							$cart_update_time = $value->abandoned_cart_time;
			
							$new_user = $this->check_sent_history($value->user_id, $cart_update_time, $template_id, $value->id );
							if ( $new_user == true)
							{
								$cart_info_db = $value->abandoned_cart_info;
			
								$email_body = $email_body_template;
								$email_body .= '{{email_open_tracker}}';
								if ($value->user_type == "GUEST")
								{
									$email_body = str_replace("{{customer.firstname}}", $results_guest[0]->billing_first_name, $email_body);
									$email_body = str_replace("{{customer.lastname}}", $results_guest[0]->billing_last_name, $email_body);
									$email_body = str_replace("{{customer.fullname}}", $results_guest[0]->billing_first_name." ".$results_guest[0]->billing_last_name, $email_body);
								}
								else
								{
									$email_body = str_replace("{{customer.firstname}}", get_user_meta($value->user_id, 'first_name', true), $email_body);
									$email_body = str_replace("{{customer.lastname}}", get_user_meta($value->user_id, 'last_name', true), $email_body);
									$email_body = str_replace("{{customer.fullname}}", get_user_meta($value->user_id, 'first_name', true)." ".get_user_meta($value->user_id, 'last_name', true), $email_body);
								}
								$email_body = str_replace("{{customer.email}}", $value->user_email, $email_body);
			
								$order_date = "";
			
								if ($cart_update_time != "" && $cart_update_time != 0)
								{
									$order_date = date('d M, Y h:i A', $cart_update_time);
								}
			
								$email_body = str_replace("{{coupon.code}}", $coupon_code, $email_body);
			
								$email_body = str_replace("{{cart.abandoned_date}}", $order_date, $email_body);
			
								$email_body = str_replace("{{shop.name}}", get_option('blogname'), $email_body);
								$email_body = str_replace("{{shop.url}}", get_option('siteurl'), $email_body);
			
								$var = '';
								if(preg_match("{{products.cart}}",$email_body,$matched))
								{
									$var = '
									<h3> Your Shopping Cart </h3>
									<table border="0" cellpadding="10" cellspacing="0" class="templateDataTable">
									<tr>
									<th> Item </th>
									<th> Name </th>
									<th> Quantity </th>
									<th> Price </th>
									<th> Line Subtotal </th>
									</tr>';
										
									//$cart_info = get_user_meta($value->user_id, '_woocommerce_persistent_cart');
									$cart_details = $cart_info_db_field->cart;

									$cart_total = "";
									foreach ($cart_details as $k => $v)
									{
										$quantity_total = $v->quantity;
										$product_id = $v->product_id;
										$prod_name = get_post($product_id);
										$product_name = $prod_name->post_title;
											
									//	$prod_details = new WC_PRODUCT ( $product_id);
										$item_total = $v->line_subtotal / $quantity_total;
										$product = get_product($product_id);
										$prod_image = $product->get_image();

										$var .='<tr>
										<td> '.$prod_image.'</td>
										<td> '.$product_name.'</td>
										<td> '.$quantity_total.'</td>
										<td> '.get_woocommerce_currency_symbol()." ".$item_total.'</td>
										<td> '.get_woocommerce_currency_symbol()." ".$v->line_total.'</td>
										</tr>';
										$cart_total += $v->line_total;
									}
									
									$var .= '<tr>
									<td> </td>
									<td> </td>
									<td> </td>
									<td> Cart Total : </td>
									<td> '.get_woocommerce_currency_symbol()." ".$cart_total.'</td>
									</tr>';
			
									$var .= '</table>
									';
									$email_body = str_replace("{{products.cart}}", $var, $email_body);
								}

								$checkout_page_link = $woocommerce->cart->get_checkout_url();
			
								$cart_page_link = $woocommerce->cart->get_cart_url();
			
								$query_sent = "INSERT INTO `".$wpdb->prefix."ac_sent_history` (template_id, abandoned_order_id, sent_time, sent_email_id)
								VALUES ('".$template_id."', '".$value->id."', '".current_time('mysql')."', '".$value->user_email."' )";
			
								$wpdb->query($query_sent);
			
								$query_id = "SELECT * FROM `".$wpdb->prefix."ac_sent_history` WHERE template_id='".$template_id."' AND abandoned_order_id='".$value->id."'
								ORDER BY id DESC
								LIMIT 1 ";
			
								$results_sent = $wpdb->get_results( $query_id );
			
								$email_sent_id = $results_sent[0]->id;
			
								$checkout_link_track = get_option('siteurl').'/wp-content/plugins/woocommerce-abandon-cart-pro/track_links.php?email_sent_id='.$email_sent_id.'&user_id='.$value->user_id.'&url='.urlencode($checkout_page_link);
			
								$email_body = str_replace("{{checkout.link}}", $checkout_link_track, $email_body);
			
								$cart_link_track = get_option('siteurl').'/wp-content/plugins/woocommerce-abandon-cart-pro/track_links.php?email_sent_id='.$email_sent_id.'&user_id='.$value->user_id.'&url='.urlencode($cart_page_link);
			
								$email_body = str_replace("{{cart.link}}", $cart_link_track, $email_body);
								
								$unsubscribe_link_track = get_option('siteurl').'/wp-content/plugins/woocommerce-abandon-cart-pro/track_unsubscribe.php?email_sent_id='.$email_sent_id.'&user_id='.$value->user_id;
									
								$email_body = str_replace("{{cart.unsubscribe}}", $unsubscribe_link_track, $email_body);
								
								$hidden_image = '<img style="border:0px;" height="1" width="1" alt="" src="'.get_option('siteurl').'/wp-content/plugins/woocommerce-abandon-cart-pro/track_opens.php?email_sent_id='.$email_sent_id.'" >';
			
								$email_body = str_replace("{{email_open_tracker}}", $hidden_image, $email_body);
			
								$user_email = $value->user_email;
			
								//echo $email_body."<hr>";
								wp_mail( $user_email, $email_subject, $email_body, $headers );
			
							}
			
						}
					}
			
				}
				}
			}
			
			/**
			 * get all carts which have the creation time earlier than the one that is passed
			 *
			 */
			function get_carts($template_to_send_after_time, $cart_abandon_cut_off_time) {
				
				global $wpdb;
			
				$cart_time = current_time('timestamp') - $template_to_send_after_time - $cart_abandon_cut_off_time;
			
				$query = "SELECT wpac . * , wpu.user_login, wpu.user_email
				FROM `".$wpdb->prefix."ac_abandoned_cart_history` AS wpac
				LEFT JOIN ".$wpdb->prefix."users AS wpu ON wpac.user_id = wpu.id
				WHERE cart_ignored = '0' AND unsubscribe_link = '0'
				AND abandoned_cart_time < $cart_time
				ORDER BY `id` ASC ";
			
				$results = $wpdb->get_results( $query );
			
				return $results;
			
				exit;
			}
			
			function check_sent_history($user_id, $cart_update_time, $template_id, $id) {
				
				global $wpdb;
				$query = "SELECT wpcs . * , wpac . abandoned_cart_time , wpac . user_id
				FROM `".$wpdb->prefix."ac_sent_history` AS wpcs
				LEFT JOIN ".$wpdb->prefix."ac_abandoned_cart_history AS wpac ON wpcs.abandoned_order_id =  wpac.id
				WHERE
				template_id='".$template_id."'
				AND
				wpcs.abandoned_order_id = '".$id."'
				ORDER BY 'id' DESC
				LIMIT 1 ";
			
				$results = $wpdb->get_results( $query );
			
				if (count($results) == 0)
				{
					return true;
				}
				elseif ($results[0]->abandoned_cart_time < $cart_update_time)
				{
					return true;
				}
				else
				{
					return false;
				}
			
			}
			
			function delete_ac_carts($value, $cart_update_time) {
				
				global $wpdb;
				$delete_ac_after_days = json_decode(get_option('woocommerce_ac_settings'));
				$delete_ac_after_days_time = $delete_ac_after_days[0]->delete_order_days * 86400;
				$current_time = current_time('timestamp');
				$check_time = $current_time - $cart_update_time;

				if( $check_time > $delete_ac_after_days_time && $delete_ac_after_days_time != 0 && $delete_ac_after_days_time != "" )
				{
					$user_id = $value->user_id;
						
					$query = "DELETE FROM `".$wpdb->prefix."ac_abandoned_cart_history`
					WHERE
					user_id = '$user_id'
					AND
					abandoned_cart_time = '$cart_update_time'
					AND
					cart_ignored = '0' ";
					$results2 = $wpdb->get_results( $query );
					
					$query_delete_cart = "DELETE FROM `".$wpdb->prefix."usermeta`
					WHERE
					user_id = '$user_id'
					AND
					meta_key = '_woocommerce_persistent_cart' ";
					$results_delete = $wpdb->get_results( $query_delete_cart );
					
					if ($user_id >= '63000000')
					{
						$guest_query = "DELETE FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
										WHERE id = '".$user_id."'";
						
						$results_guest = $wpdb->get_results($guest_query);
					}
				}
			}
			
		}
		
	}
	
	$woocommerce_abandon_cart_cron = new woocommerce_abandon_cart_cron();
	
	global $wpdb;
	
	$query = "SELECT wpet . *
	FROM `".$wpdb->prefix."ac_email_templates` AS wpet
	WHERE wpet.is_active = '1'
	ORDER BY `day_or_hour` DESC, `frequency` ASC ";
	$results = $wpdb->get_results( $query );
	$minute_seconds = 60;
	$hour_seconds = 3600; // 60 * 60
	$day_seconds = 86400; // 24 * 60 * 60
	foreach ($results as $key => $value)
	{
		if ($value->day_or_hour == 'Minutes')
		{
			$time_to_send_template_after = $value->frequency * $minute_seconds;
		}
		elseif ($value->day_or_hour == 'Days')
		{
			$time_to_send_template_after = $value->frequency * $day_seconds;
		}
		elseif ($value->day_or_hour == 'Hours')
		{
			$time_to_send_template_after = $value->frequency * $hour_seconds;
		}
	
		$carts = $woocommerce_abandon_cart_cron->get_carts($time_to_send_template_after, $woocommerce_abandon_cart_cron->cart_abandon_cut_off_time_cron);
		
		foreach($carts as $cart_key => $cart_value)
		{
			$cart_update_time = $cart_value->abandoned_cart_time;
			$woocommerce_abandon_cart_cron->delete_ac_carts($cart_value, $cart_update_time);
		}
	}
	
	$woocommerce_abandon_cart_cron->woocommerce_ac_send_email();
	
}

?>