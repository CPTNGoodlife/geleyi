<?php 
/*
Plugin Name: WooCommerce Abandon Cart Plugin
Plugin URI: http://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro
Description: This plugin captures abandoned carts by logged-in users and guest users. It allows to create multiple email templates to be sent at fixed intervals. Thereby reminding customers about their abandoned orders & resulting in increased sales by completing those orders. Go to <strong>WooCommerce -> <a href="admin.php?page=woocommerce_ac_page">Abandoned Carts</a> </strong>to get started.
Version: 2.3
Author: Ashok Rane
Author URI: http://www.tychesoftwares.com/
*/

require 'plugin-updates/plugin-update-checker.php';
$ACUpdateChecker = new PluginUpdateChecker(
	'http://www.96down.com/api/update/woocommerce-abandon-cart-pro/123.json',
	__FILE__
);

session_start();
include_once ("woocommerce_guest_ac.class.php");
// Deletion Settings
register_uninstall_hook( __FILE__, 'woocommerce_ac_delete');

// Add a new interval of 5 minutes
add_filter( 'cron_schedules', 'woocommerce_ac_add_cron_schedule');
function woocommerce_ac_add_cron_schedule( $schedules )
{
	$schedules['5_minutes'] = array(

			'interval' => 300, // 5 minutes in seconds

			'display'  => __( 'Once Every Five Minutes' ),

	);
	return $schedules;
	
}

// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'woocommerce_ac_send_email_action' ) ) {
	wp_schedule_event( time(), '5_minutes', 'woocommerce_ac_send_email_action' );
}

// Hook into that action that'll fire every 5 minutes
add_action( 'woocommerce_ac_send_email_action', 'woocommerce_ac_send_email_cron');
function woocommerce_ac_send_email_cron()
{
//	define('ABSPATH',dirname(__FILE__).'/');
	require_once (ABSPATH.'wp-content/plugins/woocommerce-abandon-cart-pro/cron/send_email.php');
}

function woocommerce_ac_delete(){
	
	global $wpdb;
	$table_name_ac_abandoned_cart_history = $wpdb->prefix . "ac_abandoned_cart_history";
	$sql_ac_abandoned_cart_history = "DROP TABLE " . $table_name_ac_abandoned_cart_history ;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->get_results($sql_ac_abandoned_cart_history);

	$table_name_ac_email_templates = $wpdb->prefix . "ac_email_templates";
	$sql_ac_email_templates = "DROP TABLE " . $table_name_ac_email_templates ;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->get_results($sql_ac_email_templates);

	$table_name_ac_sent_history = $wpdb->prefix . "ac_sent_history";
	$sql_ac_sent_history = "DROP TABLE " . $table_name_ac_sent_history ;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->get_results($sql_ac_sent_history);

	$table_name_ac_opened_emails = $wpdb->prefix . "ac_opened_emails";
	$sql_ac_opened_emails = "DROP TABLE " . $table_name_ac_opened_emails ;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->get_results($sql_ac_opened_emails);

	$table_name_ac_link_clicked_email = $wpdb->prefix . "ac_link_clicked_email";
	$sql_ac_link_clicked_email = "DROP TABLE " . $table_name_ac_link_clicked_email ;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->get_results($sql_ac_link_clicked_email);
	
	$table_name_ac_guest_abandoned_cart_history = $wpdb->prefix . "ac_guest_abandoned_cart_history";
	$sql_ac_abandoned_cart_history = "DROP TABLE " . $table_name_ac_guest_abandoned_cart_history ;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$wpdb->get_results($sql_ac_guest_abandoned_cart_history);
	
}
//include_once("lang.php");

//if (is_woocommerce_active())
{
	/**
	 * Localisation
	 **/
	load_plugin_textdomain('woocommerce-ac', false, dirname( plugin_basename( __FILE__ ) ) . '/');

	/**
	 * woocommerce_abandon_cart class
	 **/
	if (!class_exists('woocommerce_abandon_cart')) {
	
		class woocommerce_abandon_cart {
			
			var $one_hour;
			var $three_hours;
			var $six_hours;
			var $twelve_hours;
			var $one_day;
			var $one_week;
			
			var $duration_range_select = array();
			var $start_end_dates = array();
			
			public function __construct() {
				
				$this->one_hour = 60 * 60;
				$this->three_hours = 3 * $this->one_hour;
				$this->six_hours = 6 * $this->one_hour;
				$this->twelve_hours = 12 * $this->one_hour;
				$this->one_day = 24 * $this->one_hour;
				$this->one_week = 7 * $this->one_day;
				
				$this->duration_range_select = array('yesterday' => 'Yesterday',
						'today' => 'Today',
						'last_seven' => 'Last 7 days',
						'last_fifteen' => 'Last 15 days',
						'last_thirty' => 'Last 30 days',
						'last_ninety' => 'Last 90 days',
						'last_year_days' => 'Last 365');
				
				$this->start_end_dates = array('yesterday' => array( 'start_date' => date("d M Y", (current_time('timestamp') - 24*60*60)),
						'end_date' => date("d M Y", (current_time('timestamp') - 7*24*60*60))),
						'today' => array( 'start_date' => date("d M Y", (current_time('timestamp'))),
								'end_date' => date("d M Y", (current_time('timestamp')))),
						'last_seven' => array( 'start_date' => date("d M Y", (current_time('timestamp') - 7*24*60*60)),
								'end_date' => date("d M Y", (current_time('timestamp')))),
						'last_fifteen' => array( 'start_date' => date("d M Y", (current_time('timestamp') - 15*24*60*60)),
								'end_date' => date("d M Y", (current_time('timestamp')))),
						'last_thirty' => array( 'start_date' => date("d M Y", (current_time('timestamp') - 30*24*60*60)),
								'end_date' => date("d M Y", (current_time('timestamp')))),
						'last_ninety' => array( 'start_date' => date("d M Y", (current_time('timestamp') - 90*24*60*60)),
								'end_date' => date("d M Y", (current_time('timestamp')))),
						'last_year_days' => array( 'start_date' => date("d M Y", (current_time('timestamp') - 365*24*60*60)),
								'end_date' => date("d M Y", (current_time('timestamp')))));
				
				
				// Initialize settings
				register_activation_hook( __FILE__, array(&$this, 'woocommerce_ac_activate'));
				add_action( 'plugins_loaded', array(&$this, 'abandon_cart_update_db_check'));
				
				// WordPress Administration Menu 
				add_action('admin_menu', array(&$this, 'woocommerce_ac_admin_menu'));
				
				//add_filter('tiny_mce_before_init', array(&$this, 'myformatTinyMCE_ac' ));
				
				// Actions to be done on cart update
				add_action('woocommerce_cart_updated', array(&$this, 'woocommerce_ac_store_cart_timestamp'));
				
				// delete added temp fields after order is placed 
				add_filter('woocommerce_order_details_after_order_table', array(&$this, 'action_after_delivery_session'));
				
				// tracking coupons
				$ac_settings_saved = json_decode(get_option('woocommerce_ac_settings'));
				if (isset($ac_settings_saved[0]->track_coupons)) $display_tracked_coupons = $ac_settings_saved[0]->track_coupons;
				else $display_tracked_coupons = "";
				if( $display_tracked_coupons == 'on' )
				{
					add_action('woocommerce_coupon_error', array(&$this, 'coupon_ac_test_new'), 15, 2);
					add_action('woocommerce_applied_coupon', array(&$this, 'coupon_ac_test'), 15, 2);
				}
				
				add_action( 'admin_init', array(&$this, 'action_admin_init' ));
				
				add_action( 'admin_enqueue_scripts', array(&$this, 'my_enqueue_scripts_js' ));
				add_action( 'admin_enqueue_scripts', array(&$this, 'my_enqueue_scripts_css' ));
				
				if( is_admin() )
				{
					
					//add_filter('woocommerce_email_after_order_table', array(&$this, 'send_admin_email_on_order_recovery'));
					if (isset($_GET['page']) && $_GET['page'] == "woocommerce_ac_page")
					{
						add_action('admin_head', array(&$this, 'tinyMCE_ac'));	
					}
					
					// Load "admin-only" scripts here
					add_action('admin_head', array(&$this, 'my_action_javascript'));
					add_action('wp_ajax_remove_cart_data', array(&$this, 'remove_cart_data'));
					
					add_action('admin_head', array(&$this, 'my_action_send_preview'));
					add_action('wp_ajax_preview_email_sent', array(&$this, 'preview_email_sent'));
					
					add_action('admin_head', array(&$this, 'my_action_coupon_autocomplete'));
					add_action('wp_ajax_ac_enter_coupon', array(&$this, 'enter_coupon_autocomplete'));
					add_action('wp_ajax_woocommerce_json_find_coupons', array(&$this, 'woocommerce_json_find_coupons'));
				}
				
				add_action('wp_ajax_woocommerce_json_search_coupons', array(&$this, 'woocommerce_json_search_coupons'));
				
				// Send Email on order recovery
				add_action('woocommerce_order_status_pending_to_processing_notification', array(&$this, 'ac_email_admin_recovery'));
				add_action('woocommerce_order_status_pending_to_completed_notification', array(&$this, 'ac_email_admin_recovery'));
				add_action('woocommerce_order_status_pending_to_on-hold_notification', array(&$this, 'ac_email_admin_recovery'));
				add_action('woocommerce_order_status_failed_to_processing_notification', array(&$this, 'ac_email_admin_recovery'));
				add_action('woocommerce_order_status_failed_to_completed_notification', array(&$this, 'ac_email_admin_recovery'));
				
			}
			
			/*-----------------------------------------------------------------------------------*/
			/* Class Functions */
			/*-----------------------------------------------------------------------------------*/
			
			
			
			function myformatTinyMCE_ac($in)
			{
				add_editor_style();
				$in['force_root_block']=false;
				$in['valid_children']='+body[style]';
				$in['remove_linebreaks']=false;
				$in['gecko_spellcheck']=false;
				$in['keep_styles']=true;
				$in['accessibility_focus']=true;
				$in['tabfocus_elements']='major-publishing-actions';
				$in['media_strict']=false;
				$in['paste_remove_styles']=false;
				$in['paste_remove_spans']=false;
				$in['paste_strip_class_attributes']='none';
				$in['paste_text_use_dialog']=true;
				$in['wpeditimage_disable_captions']=true;
				//$in['plugins']='inlinepopups,tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
				//$in['content_css']=get_template_directory_uri() . "/editor-style.css";
				$in['wpautop']=true;
				$in['apply_source_formatting']=false;
				//$in['theme_advanced_buttons1']='formatselect,forecolor,|,bold,italic,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,wp_fullscreen,wp_adv';
				//$in['theme_advanced_buttons2']='pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo';
				//$in['theme_advanced_buttons3']='';
				//$in['theme_advanced_buttons4']='';
				return $in;
			}
			
			function ac_email_admin_recovery ($order_id) {
				
				$user_id = get_current_user_id();
				$cart_ac_settings = json_decode(get_option('woocommerce_ac_settings'));
				if( $cart_ac_settings[0]->email_admin == 'on' )
				{
					if ( get_user_meta($user_id, '_woocommerce_ac_modified_cart', true) == md5("yes") || get_user_meta($user_id, '_woocommerce_ac_modified_cart', true) == md5("no") ) // indicates cart is abandoned
					{
						$order = new WC_Order( $order_id );
						
						$email_heading = __('New Customer Order - Recovered', 'woocommerce');
				
						$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
				
						$email_subject = "New Customer Order - Recovered";
				
						$user_email = get_option('admin_email');
						$headers[] = "From: Admin <".$user_email.">";
						$headers[] = "Content-Type: text/html";
						
						// Buffer
						ob_start();
				
						// Get mail template
						woocommerce_get_template('emails/admin-new-order.php', array(
							'order' => $order,
							'email_heading' => $email_heading
						));
				
						// Get contents
						$email_body = ob_get_clean();
				
						//$email_body .= "Recovered Order";
						woocommerce_mail( $user_email, $email_subject, $email_body, $headers );
					}
				}
				
			}
			function abandon_cart_update_db_check() {
				global $woocommerce_ac_plugin_version, $ACUpdateChecker;
			
				$woocommerce_ac_plugin_version = $ACUpdateChecker->getInstalledVersion();
			
				if ($woocommerce_ac_plugin_version == "2.3") {
					$this->woocommerce_ac_activate();
				}
			}
			
			function woocommerce_ac_activate() {
			
				global $wpdb;
			
				$table_name = $wpdb->prefix . "ac_email_templates";
			
				$sql = "CREATE TABLE IF NOT EXISTS $table_name (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`from_email` text COLLATE utf8_unicode_ci NOT NULL,
				`subject` text COLLATE utf8_unicode_ci NOT NULL,
				`body` mediumtext COLLATE utf8_unicode_ci NOT NULL,
				`is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
				`frequency` int(11) NOT NULL,
				`day_or_hour` enum('Minutes','Days','Hours') COLLATE utf8_unicode_ci NOT NULL,
				`coupon_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
				`template_name` text COLLATE utf8_unicode_ci NOT NULL,
				`from_name` text COLLATE utf8_unicode_ci NOT NULL,
  				`reply_email` text COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ";
			
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
			
				update_option('woocommerce_ac_db_version','2.3');
				
				$check_table_query = "SHOW COLUMNS FROM $table_name WHERE Field = 'day_or_hour'";
				$result = $wpdb->get_results($check_table_query);
				
				$options = json_decode(str_replace(
						array("enum(", ")", "'"),
						array("[", "]", '"'),
						$result[0]->Type
				));
			
				if (!in_array("Minutes", $options))
				{
					$alter_table_query = "ALTER TABLE $table_name
											MODIFY `day_or_hour` enum('Minutes','Days','Hours') COLLATE utf8_unicode_ci NOT NULL";
					$wpdb->get_results ( $alter_table_query );
				}
				
				$sent_table_name = $wpdb->prefix . "ac_sent_history";
			
				$sql_query = "CREATE TABLE IF NOT EXISTS $sent_table_name (
				`id` int(11) NOT NULL auto_increment,
				`template_id` varchar(40) collate utf8_unicode_ci NOT NULL,
				`abandoned_order_id` int(11) NOT NULL,
				`sent_time` datetime NOT NULL,
				`sent_email_id` text COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY  (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ";
				 
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql_query);
				 
				$opened_table_name = $wpdb->prefix . "ac_opened_emails";
			
				$opened_query = "CREATE TABLE IF NOT EXISTS $opened_table_name (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`email_sent_id` int(11) NOT NULL,
				`time_opened` datetime NOT NULL,
				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='store the primary key id of opened email template' AUTO_INCREMENT=1 ";
				 
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($opened_query);
				 
				$clicked_link_table_name = $wpdb->prefix . "ac_link_clicked_email";
			
				$clicked_query = "CREATE TABLE IF NOT EXISTS $clicked_link_table_name (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`email_sent_id` int(11) NOT NULL,
				`link_clicked` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
				`time_clicked` datetime NOT NULL,
				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='store the link clicked in sent email template' AUTO_INCREMENT=1 ";
			
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($clicked_query);
						 
				$ac_history_table_name = $wpdb->prefix . "ac_abandoned_cart_history";
				 
				$history_query = "CREATE TABLE IF NOT EXISTS $ac_history_table_name (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) NOT NULL,
				`abandoned_cart_info` text COLLATE utf8_unicode_ci NOT NULL,
				`abandoned_cart_time` int(11) NOT NULL,
				`cart_ignored` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
				`recovered_cart` int(11) NOT NULL,
				`unsubscribe_link` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
				`user_type` text,
				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
						 
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($history_query);
			
				$check_table_query = "SHOW COLUMNS FROM $ac_history_table_name LIKE 'user_type'";
				
				$results = $wpdb->get_results ( $check_table_query );
				if (count($results) == 0)
				{
					$alter_table_query = "ALTER TABLE $ac_history_table_name
											ADD `user_type` text AFTER  `unsubscribe_link`";
					$wpdb->get_results ( $alter_table_query );
				}
				
				$ac_guest_history_table_name = $wpdb->prefix . "ac_guest_abandoned_cart_history";
					
				$ac_guest_history_query = "CREATE TABLE IF NOT EXISTS $ac_guest_history_table_name (
				`id` int(15) NOT NULL AUTO_INCREMENT,
				`billing_first_name` text, 
				`billing_last_name` text,
				`billing_company_name` text,
				`billing_address_1` text,
				`billing_address_2` text,
				`billing_city` text,
				`billing_county` text,
				`billing_zipcode` text,
				`email_id` text,
				`phone` text,
				`ship_to_billing` text,
				`order_notes` text,
				`shipping_first_name` text, 
				`shipping_last_name` text,
				`shipping_company_name` text,
				`shipping_address_1` text,
				`shipping_address_2` text,
				`shipping_city` text,
				`shipping_county` text,
				`shipping_zipcode` text,
				PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63000000";
					
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($ac_guest_history_query);
			}
			
			function woocommerce_ac_admin_menu(){
			
				$page = add_submenu_page('woocommerce', __( 'Abandoned Carts', 'woocommerce-ac' ), __( 'Abandoned Carts', 'woocommerce-ac' ), 'manage_woocommerce', 'woocommerce_ac_page', array(&$this, 'woocommerce_ac_page' ));
			
			}
			
			function woocommerce_ac_store_cart_timestamp() {
				
				global $wpdb, $woocommerce;
				
				$current_time = current_time('timestamp');
				$cut_off_time = json_decode(get_option('woocommerce_ac_settings'));
				$cart_cut_off_time = $cut_off_time[0]->cart_time * 60;
				$compare_time = $current_time - $cart_cut_off_time;
				
				if ( is_user_logged_in() )
				{
			
					$user_id = get_current_user_id();
				
					$query = "SELECT * FROM `".$wpdb->prefix."ac_abandoned_cart_history`
								WHERE user_id = '".$user_id."'
								AND cart_ignored = '0'
								AND recovered_cart = '0'";
					$results = $wpdb->get_results( $query );
					if ( count($results) == 0 )
					{
						$cart_info = json_encode(get_user_meta($user_id, '_woocommerce_persistent_cart', true));
						$insert_query = "INSERT INTO `".$wpdb->prefix."ac_abandoned_cart_history`
						(user_id, abandoned_cart_info, abandoned_cart_time, cart_ignored, user_type)
						VALUES ('".$user_id."', '".$cart_info."', '".$current_time."', '0', 'REGISTERED')";
						$wpdb->query($insert_query);
					}
					elseif ( $compare_time > $results[0]->abandoned_cart_time )
					{
						$updated_cart_info = json_encode(get_user_meta($user_id, '_woocommerce_persistent_cart', true));
						if (! $this->compare_carts( $user_id, $results[0]->abandoned_cart_info) )
						{
							$query_ignored = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
							SET cart_ignored = '1'
							WHERE user_id='".$user_id."'";
							$wpdb->query($query_ignored);
							$query_update = "INSERT INTO `".$wpdb->prefix."ac_abandoned_cart_history`
							(user_id, abandoned_cart_info, abandoned_cart_time, cart_ignored)
							VALUES ('".$user_id."', '".$updated_cart_info."', '".$current_time."', '0')";
							$wpdb->query($query_update);
							update_user_meta($user_id, '_woocommerce_ac_modified_cart', md5("yes"));
						}
						else
						{
							update_user_meta($user_id, '_woocommerce_ac_modified_cart', md5("no"));
						}
					}
					else
					{
						$updated_cart_info = json_encode(get_user_meta($user_id, '_woocommerce_persistent_cart', true));
						$query_update = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
						SET abandoned_cart_info = '".$updated_cart_info."',
						abandoned_cart_time = '".$current_time."'
						WHERE user_id='".$user_id."' AND cart_ignored='0' ";
						$wpdb->query($query_update);
					}
				}
				else
				{
					if (isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
					else $user_id = "";
					$query = "SELECT * FROM `".$wpdb->prefix."ac_abandoned_cart_history`
								WHERE user_id = '".$user_id."'
								AND cart_ignored = '0'
								AND recovered_cart = '0'";
					$results = $wpdb->get_results( $query );
					
					$cart = array();
						
					foreach ($woocommerce->cart->cart_contents as $cart_id => $value)
					{
						$cart['cart'][$cart_id] = array();
						foreach ($value as $k=>$v)
						{
							$cart['cart'][$cart_id][$k] = $v;
							if ($k == "quantity")
							{
								$price = get_post_meta( $cart['cart'][$cart_id]['product_id'], '_price', true);
								$cart['cart'][$cart_id]['line_total'] = $cart['cart'][$cart_id]['quantity'] * $price;
								$cart['cart'][$cart_id]['line_tax'] = '0';
								$cart['cart'][$cart_id]['line_subtotal'] = $cart['cart'][$cart_id]['line_total'];
								$cart['cart'][$cart_id]['line_subtotal_tax'] = $cart['cart'][$cart_id]['line_tax'];
								break;
							}
						}
					}
					$updated_cart_info = json_encode($cart);
					
					if ($results)
					{
						if ( $compare_time > $results[0]->abandoned_cart_time )
						{
						
							if ($updated_cart_info != $results[0]->abandoned_cart_info)
							{
								$query_ignored = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
													SET cart_ignored = '1'
													WHERE user_id='".$user_id."'";
								
								$wpdb->query($query_ignored);
								
								$query_update = "INSERT INTO `".$wpdb->prefix."ac_abandoned_cart_history`
													(user_id, abandoned_cart_info, abandoned_cart_time, cart_ignored, user_type)
													VALUES ('".$user_id."', '".$updated_cart_info."', '".$current_time."', '0', 'GUEST')";
								$wpdb->query($query_update);
								
								update_user_meta($user_id, '_woocommerce_ac_modified_cart', md5("yes"));
							}
							else
							{
								update_user_meta($user_id, '_woocommerce_ac_modified_cart', md5("no"));
							}
						}
						else
						{
							$query_update = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
												SET abandoned_cart_info = '".$updated_cart_info."',
												abandoned_cart_time = '".$current_time."'
												WHERE user_id='".$user_id."' AND cart_ignored='0' ";
							$wpdb->query($query_update);
						}
					}
				}
			}
			
			function compare_carts($user_id, $last_abandoned_cart)
			{
				$current_woo_cart = get_user_meta($user_id, '_woocommerce_persistent_cart', true);
				$abandoned_cart_arr = json_decode($last_abandoned_cart,true);
			
				$temp_variable = "";
				if ( count($current_woo_cart['cart']) >= count($abandoned_cart_arr['cart']) )
				{
					//do nothing
				}
				else
				{
					$temp_variable = $current_woo_cart;
					$current_woo_cart = $abandoned_cart_arr;
					$abandoned_cart_arr = $temp_variable;
				}
				foreach ($current_woo_cart as $key => $value)
				{
					foreach ($value as $item_key => $item_value)
					{
						$current_cart_product_id = $item_value['product_id'];
						$current_cart_variation_id = $item_value['variation_id'];
						$current_cart_quantity = $item_value['quantity'];
			
						if (isset($abandoned_cart_arr[$key][$item_key]['product_id'])) $abandoned_cart_product_id = $abandoned_cart_arr[$key][$item_key]['product_id'];
						else $abandoned_cart_product_id = "";
						if (isset($abandoned_cart_arr[$key][$item_key]['variation_id'])) $abandoned_cart_variation_id = $abandoned_cart_arr[$key][$item_key]['variation_id'];
						else $abandoned_cart_variation_id = "";
						if (isset($abandoned_cart_arr[$key][$item_key]['quantity'])) $abandoned_cart_quantity = $abandoned_cart_arr[$key][$item_key]['quantity'];
						else $abandoned_cart_quantity = "";
			
						if (($current_cart_product_id != $abandoned_cart_product_id) ||
								($current_cart_variation_id != $abandoned_cart_variation_id) ||
								($current_cart_quantity != $abandoned_cart_quantity) )
						{
							return false;
						}
					}
				}
				return true;
			}
			
			function send_admin_email_on_order_recovery( ) {
				
				$user_id = get_current_user_id();
				$current_time = current_time('timestamp');
				$cut_off_time = json_decode(get_option('woocommerce_ac_settings'));
				$cart_cut_off_time = $cut_off_time[0]->cart_time * 60;
				$compare_time = $current_time - $cart_cut_off_time;
			
				$cart_ac_settings = json_decode(get_option('woocommerce_ac_settings'));
				if( $cart_ac_settings[0]->email_admin == 'on' )
				{
					
				}
			
			}
			
			function action_after_delivery_session( $order ) {
				
				global $wpdb;
				$user_id = get_current_user_id();
				
				if ($user_id == "")
				{
					$user_id = $_SESSION['user_id'];
				//	Set the session variables to blanks
					$_SESSION['guest_first_name'] = $_SESSION['guest_last_name'] = $_SESSION['guest_email'] = $_SESSION['user_id'] = "";
				}
				delete_user_meta($user_id, '_woocommerce_ac_persistent_cart_time');
				delete_user_meta($user_id, '_woocommerce_ac_persistent_cart_temp_time');
				
				// get all latest abandoned carts that were modified
				$query = "SELECT * FROM `".$wpdb->prefix."ac_abandoned_cart_history`
				WHERE user_id = '".$user_id."'
				AND cart_ignored = '0'
				AND recovered_cart = '0'
				ORDER BY id DESC
				LIMIT 1";
				$results = $wpdb->get_results( $query );
				
				if ($results)
				{
					if ( get_user_meta($user_id, '_woocommerce_ac_modified_cart', true) == md5("yes") || 
							get_user_meta($user_id, '_woocommerce_ac_modified_cart', true) == md5("no") )
					{
			
						$order_id = $order->id;
						$query_order = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
						SET recovered_cart= '".$order_id."',
						cart_ignored = '1'
						WHERE id='".$results[0]->id."' ";
						$wpdb->query($query_order);
						delete_user_meta($user_id, '_woocommerce_ac_modified_cart');
					}
					else
					{
						if (isset($results[0]->user_type) && $results[0]->user_type == "GUEST")
						{
							$delete_guest = "DELETE FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
											WHERE id = '".$user_id."'";
							$wpdb->query($delete_guest);
						}
						if (isset($results[0]->id))
						{
							$delete_query = "DELETE FROM `".$wpdb->prefix."ac_abandoned_cart_history`
												WHERE
												id='".$results[0]->id."' ";
							$wpdb->query( $delete_query );
						}
					}
				
					if (isset($ac_settings_saved[0]->track_coupons)) $display_tracked_coupons = $ac_settings_saved[0]->track_coupons;
					else $display_tracked_coupons = "";
					if( $display_tracked_coupons == 'on' )
					{
						delete_user_meta( $user_id, '_woocommerce_ac_coupon');
					}
				}
				else
				{
					$email_id = $order->order_custom_fields['_billing_email'][0];
					$query = "SELECT * FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
								WHERE email_id = '".$email_id."'";
					$results_id = $wpdb->get_results($query);
					
					if ($results_id)
					{
						$record_status = "SELECT * FROM `".$wpdb->prefix."ac_abandoned_cart_history`
											WHERE user_id = '".$results_id[0]->id."'
											AND recovered_cart = '0'";
						$results_status = $wpdb->get_results($record_status);
						
						$check_user_query = "SELECT * FROM `".$wpdb->prefix."usermeta`
												WHERE meta_key = 'billing_email'
												AND meta_value = '".$results_id[0]->email_id."'";
						$results_user = $wpdb->get_results($check_user_query);
						
						if ($results_user)
						{
							if ( get_user_meta($results_id[0]->id, '_woocommerce_ac_modified_cart', true) == md5("yes") ||
									get_user_meta($results_id[0]->id, '_woocommerce_ac_modified_cart', true) == md5("no") )
							{
									
								$order_id = $order->id;
								$query_order = "UPDATE `".$wpdb->prefix."ac_abandoned_cart_history`
												SET recovered_cart= '".$order_id."',
													cart_ignored = '1'
													WHERE id='".$results_status[0]->id."' ";
								$wpdb->query($query_order);
								delete_user_meta($results_id[0]->id, '_woocommerce_ac_modified_cart');
							}
							else
							{
								$delete_guest = "DELETE FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
													WHERE id = '".$results_id[0]->id."'";
								$wpdb->query($delete_guest);
								
								$delete_query = "DELETE FROM `".$wpdb->prefix."ac_abandoned_cart_history`
													WHERE user_id='".$results_id[0]->id."' ";
								$wpdb->query( $delete_query );
							}
						}		
					}
				}
			}
			
			function coupon_ac_test($valid) {
				
				$user_id = get_current_user_id();
				$coupon_code = $_POST['coupon_code'];
				if( $valid != '')
				{
					$existing_coupon = (get_user_meta( $user_id, '_woocommerce_ac_coupon', true));
						
					if ( count($existing_coupon) > 0 && gettype($existing_coupon) == "array" )
					{
						foreach ( $existing_coupon as $key => $value )
						{
							if( $existing_coupon[$key]['coupon_code'] != $coupon_code)
							{
								$existing_coupon[] = array ('coupon_code' => $coupon_code,
										'coupon_message' => 'Discount code applied successfully.');
								update_user_meta( $user_id, '_woocommerce_ac_coupon', $existing_coupon);
								return $valid;
							}
						}
			
					}
					else
					{
						$coupon_details[] = array ('coupon_code' => $coupon_code,
								'coupon_message' => 'Discount code applied successfully.');
						update_user_meta( $user_id, '_woocommerce_ac_coupon', $coupon_details);
						return $valid;
					}
				}
				return $valid;
			}
			
			function coupon_ac_test_new($valid,$new) {
				
				$user_id = get_current_user_id();
				$coupon_code = $_POST['coupon_code'];
				$existing_coupon = get_user_meta( $user_id, '_woocommerce_ac_coupon', true);
				$existing_coupon[] = array ('coupon_code' => $coupon_code,
						'coupon_message' => $valid);
				update_user_meta( $user_id, '_woocommerce_ac_coupon', $existing_coupon);
				return $valid;
			}
			
			function action_admin_init() {
				// only hook up these filters if we're in the admin panel, and the current user has permission
				// to edit posts and pages
				//echo "hii";
				if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
					add_filter( 'mce_buttons', array(&$this, 'filter_mce_button' ));
					add_filter( 'mce_external_plugins', array(&$this, 'filter_mce_plugin' ));
				}
			}
			
			function filter_mce_button( $buttons ) {
				// add a separation before our button, here our button's id is &quot;mygallery_button&quot;
				array_unshift( $buttons, 'abandoncart_email_variables', '|' );
				return $buttons;
			}
			
			function filter_mce_plugin( $plugins ) {
				// this plugin file will work the magic of our button
				$plugins['abandoncart'] = plugin_dir_url( __FILE__ ) . 'js/abandoncart_plugin_button.js';
				return $plugins;
			}
			
			function display_tabs() {
			
				if (isset($_GET['action'])) $action = $_GET['action'];
				else $action = "";
				
				$active_listcart = "";
				$active_emailtemplates = "";
				$active_settings = "";
				$active_stats = "";
			
				if (($action == 'listcart' || $action == 'orderdetails') || $action == '')
				{
					$active_listcart = "nav-tab-active";
				}
			
				if ($action == 'emailtemplates')
				{
					$active_emailtemplates = "nav-tab-active";
				}
			
				if ($action == 'emailsettings')
				{
					$active_settings = "nav-tab-active";
				}
			
				if ($action == 'stats')
				{
					$active_stats = "nav-tab-active";
				}
			
				if ($action == 'emailstats')
				{
					$active_emailstats = "nav-tab-active";
				}
			
				?>
				
				<div style="background-image: url('<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/ac_tab_icon.png') !important;" class="icon32"><br></div>
				<!--<span class="mce_abandoncart_email_variables"><br></span>-->
				
				<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				<a href="admin.php?page=woocommerce_ac_page&action=listcart" class="nav-tab <?php echo $active_listcart; ?>"> <?php _e( 'Abandoned Orders', 'woocommerce-ac' );?> </a>
				<a href="admin.php?page=woocommerce_ac_page&action=emailtemplates" class="nav-tab <?php echo $active_emailtemplates; ?>"> <?php _e( 'Email Templates', 'woocommerce-ac' );?> </a>
				<a href="admin.php?page=woocommerce_ac_page&action=emailsettings" class="nav-tab <?php echo $active_settings; ?>"> <?php _e( 'Settings', 'woocommerce-ac' );?> </a>
				<a href="admin.php?page=woocommerce_ac_page&action=stats" class="nav-tab <?php echo $active_stats; ?>"> <?php _e( 'Recovered Orders', 'woocommerce-ac' );?> </a>
				<a href="admin.php?page=woocommerce_ac_page&action=emailstats" class="nav-tab <?php echo $active_emailstats; ?>"> <?php _e( 'Sent Emails', 'woocommerce-ac' );?> </a>
				</h2>
				
				<?php
			}
			
			function my_enqueue_scripts_js( $hook ) {
				
				if ( $hook != 'woocommerce_page_woocommerce_ac_page' )
				{
					return;
				}
				else
				{
					wp_enqueue_script( 'jquery' );
					//wp_enqueue_script( 'jquery-ui-datepicker' );
					wp_enqueue_script(
							'jquery-ui-min',
							'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',
							'',
							'',
							false
					);
					wp_enqueue_script(
							'jquery-tip',
							plugins_url('/js/jquery.tipTip.minified.js', __FILE__),
							'',
							'',
							false
					);
						
					//wp_enqueue_script('suggest');
				
					// scripts included for woocommerce auto-complete coupons
					wp_register_script( 'woocommerce_admin', plugins_url() . '/woocommerce/assets/js/admin/woocommerce_admin.js', array('jquery', 'jquery-ui-widget', 'jquery-ui-core'));
					wp_register_script( 'jquery-ui-datepicker',  plugins_url() . '/woocommerce/assets/js/admin/ui-datepicker.js');
					wp_register_script( 'woocommerce_writepanel', plugins_url() . '/woocommerce/assets/js/admin/write-panels.js', array('jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable') );
					wp_register_script( 'ajax-chosen', plugins_url() . '/woocommerce/assets/js/chosen/ajax-chosen.jquery.js', array('jquery', 'chosen'));
					wp_register_script( 'chosen', plugins_url() . '/woocommerce/assets/js/chosen/chosen.jquery.js', array('jquery'));
				
					wp_enqueue_script( 'woocommerce_writepanel' );
					wp_enqueue_script( 'jquery-ui-datepicker' );
					wp_enqueue_script( 'ajax-chosen' );
					wp_enqueue_script( 'chosen' );
					wp_enqueue_script( 'woocommerce_admin' );
					wp_enqueue_script( 'jquery-ui-sortable' );
					
					$woocommerce_witepanel_params = array(
							'search_products_nonce' 		=> wp_create_nonce("search-products"),
							'plugin_url' 					=> plugins_url(),
							'ajax_url' 						=> admin_url('admin-ajax.php')
					);
					wp_localize_script( 'woocommerce_writepanel', 'woocommerce_writepanel_params', $woocommerce_witepanel_params );
					// scripts ended for woocommerce auto-complete coupons
					
					////////////////////////////////////////////////////////////////
					
					?>
					<script type="text/javascript" >
					function delete_email_template( id )
					{
						var y=confirm('Are you sure you want to delete this Email Template');
						if(y==true)
						{
							location.href='admin.php?page=woocommerce_ac_page&action=emailtemplates&mode=removetemplate&id='+id;
					    }
					}
				    </script>
				    
				    <!-- /////////////////////////////////////////////////////////////// -->
				    
				    <?php
				    wp_enqueue_script('tinyMCE_ac', plugins_url() . '/woocommerce-abandon-cart-pro/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
				    wp_enqueue_script('ac_email_variables', plugins_url() . '/woocommerce-abandon-cart-pro/js/abandoncart_plugin_button.js');
				    
				    ?>
				    
				    
				    
				    <?php
				}
			
			}
			
			function tinyMCE_ac(){
				
				?>
				<script language="javascript" type="text/javascript">
				tinyMCE.init({
					theme : "advanced",
					mode: "exact",
					elements : "woocommerce_ac_email_body",
					theme_advanced_toolbar_location : "top",
					theme_advanced_buttons1 : "abandoncart_email_variables,separator,code,separator,preview,separator,bold,italic,underline,strikethrough,separator,"
					+ "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
					+ "bullist,numlist,outdent,indent,separator,"
					+ "cut,copy,paste,separator,sub,sup,charmap",
					theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,styleselect,forecolor,backcolor,forecolorpicker,backcolorpicker,separator,link,unlink,anchor,image,separator,"
					+"undo,redo,cleanup"
					+"image", 
					height:"500px",
					width:"1000px",
					apply_source_formatting : true,
					cleanup: true,
					plugins : "advhr,emotions,fullpage,fullscreen,iespell,media,paste,nonbreaking,pagebreak,preview,print,spellchecker,visualchars,searchreplace,insertdatetime,table,directionality,layer,style,xhtmlxtras,abandoncart",
			        theme_advanced_buttons4 : "advhr,emotions,fullpage,fullscreen,iespell,media,nonbreaking,pagebreak,print,spellchecker,visualchars,searchreplace,insertdatetime,directionality,layer,style,xhtmlxtras,insertlayer,moveforward,movebackward,absolute,cite,ins,del,abbr,acronym,attribs,help,hr,removeformat",
			        theme_advanced_buttons3 : "tablecontrols,search,replace,pastetext,pasteword,selectall,styleprops,ltr,rtl,visualaid,newdocument,blockquote",
			        extended_valid_elements : "hr[class|width|size|noshade]",
			        fullpage_fontsizes : '13px,14px,15px,18pt,xx-large',
			        fullpage_default_xml_pi : false,
			        fullpage_default_langcode : 'en',
			        fullpage_default_title : "My document title",
			        table_styles : "Header 1=header1;Header 2=header2;Header 3=header3",
			        table_cell_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Cell=tableCel1",
			        table_row_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1",
			        table_cell_limit : 100,
			        table_row_limit : 5,
			        table_col_limit : 5
				});
					
				</script>
				<?php
			}
			
			function my_enqueue_scripts_css($hook) {
				
				if ( $hook != 'woocommerce_page_woocommerce_ac_page' )
				{
					return;
				}
				else
				{
					wp_enqueue_style( 'jquery-ui', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" , '', '', false);
					
					wp_enqueue_style( 'woocommerce_admin_styles', plugins_url() . '/woocommerce/assets/css/admin.css' );
					wp_enqueue_style( 'jquery-ui-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
					?>
						
					<style>
					span.mce_abandoncart_email_variables 
					{
					    background-image: url("<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/ac_editor_icon.png") !important;
					    background-position: center center !important;
					    background-repeat: no-repeat !important;
					}
					</style>
					
					<?php
				} 
			}
				
			/**
			 * Abandon Cart Settings Page
			 */
			function woocommerce_ac_page()
			{
				if ( is_user_logged_in() )
				{
				global $wpdb;
					
				// Check the user capabilities
				if ( !current_user_can( 'manage_woocommerce' ) )
				{
					wp_die( __( 'You do not have sufficient permissions to access this page.', 'woocommerce-ac' ) );
				}
			
				?>
			
					<div class="wrap">
						<div class="icon32" style="background-image: url('<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/abandoned_cart_small.png') !important;">
							<br />
						</div>
							<h2><?php _e( 'WooCommerce - Abandon Cart', 'woocommerce-ac' ); ?></h2>
					<?php 
					
					if (isset($_GET['action'])) $action = $_GET['action'];
					else $action = "";
					
					if (isset($_GET['mode'])) $mode = $_GET['mode'];
					else $mode = "";
					
					$this->display_tabs();
					
					if ($action == 'emailsettings')
					{
						// Save the field values
						if ( isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'save' )
						{
							$ac_settings = new stdClass();
							if (isset($_POST['enable_cart_notifications'])) $ac_settings->enable_cart_notification = $_POST['enable_cart_notifications'];
							$ac_settings->cart_time = $_POST['cart_abandonment_time'];
							$ac_settings->delete_order_days = $_POST['delete_abandoned_orders_days'];
							if (isset($_POST['email_admin_on_conversion'])) $ac_settings->email_admin = $_POST['email_admin_on_conversion'];
							if (isset($_POST['track_coupons'])) $ac_settings->track_coupons = $_POST['track_coupons'];
							//$ac_settings->conver_email = $_POST['conversion_emails_sendto'];
							//$ac_settings->conver_link = $_POST['stop_on_conversion_link'];
							//$ac_settings->conver_order = $_POST['stop_on_conversion_order'];
							$woo_ac_settings[] = $ac_settings;
							$woocommerce_ac_settings = json_encode($woo_ac_settings);
							
							update_option('woocommerce_ac_settings',$woocommerce_ac_settings);
							//exit;
						}
						?>
			
							<?php if ( isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'save' ) { ?>
							<div id="message" class="updated fade"><p><strong><?php _e( 'Your settings have been saved.', 'woocommerce-ac' ); ?></strong></p></div>
							<?php } ?>
							
							<?php
								//$enable_email_sett = array();
								$enable_email_sett = json_decode(get_option('woocommerce_ac_settings'));
								?>
							<p><?php _e( 'Change settings for sending email notifications to Customers, to Admin, Tracking Coupons etc.', 'woocommerce-ac' ); ?></p>
							<div id="content">
							  <form method="post" action="" id="ac_settings">
								  <input type="hidden" name="ac_settings_frm" value="save">
								  <div id="poststuff">
										<div class="postbox">
											<h3 class="hndle"><?php _e( 'Settings', 'woocommerce-ac' ); ?></h3>
											<div>
											  <table class="form-table">
			
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Enable abandoned cart notifications', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
														$noti = "";
													    if (isset($enable_email_sett[0]->enable_cart_notification) && $enable_email_sett[0]->enable_cart_notification == 'on')
														{$noti = "checked";
														}
				    									print'<input type="checkbox" name="enable_cart_notifications" id="enable_cart_notifications" '.$noti.'>';?>
				    									<img class="help_tip" width="16" height="16" data-tip="<?php _e( 'Yes, enable the abandoned cart notifications', 'woocommerce-ac') ?>" src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p> 
				    									<!--  <span class="description"><?php
				    										_e( 'Yes, enable the abandoned cart notifications', 'woocommerce-ac' );
				    									?></span> --> 
				    									</td>
				    							</tr>
			
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Cart abandoned cut-off time', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
														<?php
														$cart_time = "";
														if ( isset($enable_email_sett[0]->cart_time) && ($enable_email_sett[0]->cart_time != '' || $enable_email_sett[0]->cart_time != 'null'))
														{
															$cart_time = $enable_email_sett[0]->cart_time;
														}
				    									print'<input type="text" name="cart_abandonment_time" id="cart_abandonment_time" size="5" value="'.$cart_time.'"> minutes
				    									';?>
				    									<img class="help_tip" width="16" height="16" data-tip='<?php _e( 'Consider cart abandoned after X minutes of item being added to cart & order not placed', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
				    									<!-- <span class="description"><?php
				    										_e( 'Consider cart abandoned after X minutes of item being added to cart & order not placed', 'woocommerce-ac' );
				    									?></span> -->
				    								</td>
				    							</tr>
			
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Automatically Delete Abandoned Orders after', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$delete_order_days = "";
													if ( isset($enable_email_sett[0]->delete_order_days) && ($enable_email_sett[0]->delete_order_days != '' || $enable_email_sett[0]->delete_order_days != 'null'))
													{
														$delete_order_days = $enable_email_sett[0]->delete_order_days;
													}
				    									print'<input type="text" name="delete_abandoned_orders_days" id="delete_abandoned_orders_days" size="5" value="'.$delete_order_days.'"> days
				    									';?>
				    									<img class="help_tip" width="16" height="16" data-tip='<?php _e( 'Automatically delete abandoned cart orders after X days', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
				    									<!-- <span class="description"><?php
				    										_e( 'Automatically delete abandoned cart orders after X days', 'woocommerce-ac' );
				    									?></span> -->
				    								</td>
				    							</tr>
			
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Email admin on order recovery', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$email_admin = "";
													if (isset($enable_email_sett[0]->email_admin) && $enable_email_sett[0]->email_admin == 'on')
													{
														$email_admin = "checked";
													}
				    									print'<input type="checkbox" name="email_admin_on_conversion" '.$email_admin.'>&nbsp;';?>
				    									<img class="help_tip" width="16" height="16" data-tip='<?php _e( 'Sends email to Admin if an Abandoned Cart Order is recoverd', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
				    									<!--<span id="email_on_conversion">--> 
														
														<?php
														/* $conversation_email = "";
														if ( $enable_email_sett[0]->conver_email != '' || $enable_email_sett[0]->conver_email != 'null')
														{
															$conversation_email = $enable_email_sett[0]->conver_email;
														}
														print'<input type="text" name="conversion_emails_sendto" id="conversion_emails_sendto" size="30" value="'.$conversation_email.'"></span>
				    									<br />'; */?>
				    									<!-- <span class="description"><?php
				    										//_e( 'Email me when an abandoned cart is saved & results in an order', 'woocommerce-ac' );
				    									?></span> -->
				    								</td>
				    							</tr>
			
			
				    							<!-- <tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Stop sending emails', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$stop_conversation_email = "";
													if ( $enable_email_sett[0]->conver_link == 'on')
													{
														$stop_conversation_email = "checked";
													}
				    									print'<input type="checkbox" name="stop_on_conversion_link" id="stop_on_conversion_link"'.$stop_conversation_email.'>&nbsp;';?>
				    									<img class="help_tip" data-tip='<?php _e( 'Sends email to Admin if an Abandoned Cart Order is recoverd', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
				    									<span><?php _e('Stop sending when the shopper clicks the \"Complete Order\" link in the email', 'woocommerce-ac'); ?>&nbsp; 
				    									</span>
				    									<br />
				    									
														<?php
														$stop_conversation_onorder = "";
														if ($enable_email_sett[0]->conver_order == 'on')
														{
															$stop_conversation_onorder = "checked";
														}
				    									print'<input type="checkbox" name="stop_on_conversion_order" id="stop_on_conversion_order" '.$stop_conversation_onorder.'>&nbsp;';?>
				    									<span><?php _e('Stop sending when the shopper completes their order', 'woocommerce-ac'); ?>&nbsp; 
				    									</span>
				    									<span class="description"><?php
				    										//echo _e( 'Email me when an abandoned cart is saved & results in an order', 'woocommerce-ac' );
				    									?></span>
				    								</td>
				    							</tr> -->
				    							
				    							
												<!--<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Email Frequency:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
				    								
				    									<select name="woocommerce_ac_email_frequency">
				    									
				    									<?php 
				    									
				    									foreach ($intervals_arr as $seconds => $value)
				    									{
															printf( "<option %s value='%s'>%s</option>\n",
																selected( $seconds, get_option('woocommerce_ac_email_frequency'), false ),
																esc_attr( $seconds ),
																$value
															);
				    									}
				    									
				    									?>
				    										
				    									</select>
				    									<br />
				    									<span class="description"><?php
				    										echo __( 'Set email frequency (since cart was abandoned).', 'woocommerce-ac' );
				    									?></span>
				    								</td>
				    							</tr>-->
				    							
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_track_coupons"><b><?php _e( 'Track Coupons', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
														$coupon_track = "";
													    if (isset($enable_email_sett[0]->track_coupons) && $enable_email_sett[0]->track_coupons == 'on')
														{
															$coupon_track = "checked";
														}
				    									print'<input type="checkbox" name="track_coupons" id="track_coupons" '.$coupon_track.'>';?>
				    									<img class="help_tip" width="16" height="16" data-tip='<?php _e( 'Tracks all coupons that were applied to abandoned carts', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
				    									<!-- <span class="description"><?php
				    										_e( 'Tracks all coupons that were applied to abandoned carts', 'woocommerce-ac' );
				    									?></span> -->
				    								</td>
				    							</tr>
				    							
												</table>
											</div>
										</div>
									</div>
							  <p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'woocommerce-ac' ); ?>" />
							  </p>
						    </form>
						  </div>
						<?php 
					}
					elseif ($action == 'listcart' || $action == '')
					{
						?>
						
			<p> <?php _e('The list below shows all Abandoned Carts which have remained in cart for a time higher than the "Cart abandoned cut-off time" setting.', 'woocommerce-ac');?> </p>
			
			<?php
			//echo plugins_url();
			include_once(  "pagination.class.php");
			 
			/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */
			$wpdb->get_results("SELECT wpac . * , wpu.user_login, wpu.user_email 
					  FROM `".$wpdb->prefix."ac_abandoned_cart_history` AS wpac 
					  LEFT JOIN ".$wpdb->prefix."users AS wpu ON wpac.user_id = wpu.id
					  WHERE recovered_cart='0' AND unsubscribe_link='0' ");
			$count = $wpdb->num_rows;
			if($count > 0) {
				$p = new pagination;
				$p->items($count);
				$p->limit(10); // Limit entries per page
				$p->target("admin.php?page=woocommerce_ac_page&action=listcart");
				if (isset($p->paging))
				{
					if (isset($_GET[$p->paging])) $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
				}
				$p->calculate(); // Calculates what to show
				$p->parameterName('paging');
				$p->adjacents(1); //No. of page away from the current page
				$p->showCounter(true);
				 
				if(!isset($_GET['paging'])) {
					$p->page = 1;
				} else {
					$p->page = $_GET['paging'];
				}
				 
				//Query for limit paging
				$limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
				 
			} 
			else $limit = "";
			?>
			  
			<div class="tablenav">
			    <div class='tablenav-pages'>
			    	<?php if ($count > 0) echo $p->show();  // Echo out the list of paging. ?>
			    </div>
			</div>
			
			<?php 
			
			$order = "";
			if (isset($_GET['order'])) $order = $_GET['order'];
			if ( $order == "" )
			{
				$order = "desc";
				$order_next = "asc";
			}
			elseif ( $order == "asc" )
			{
				$order_next = "desc";
			}
			elseif ( $order == "desc" )
			{
				$order_next = "asc";
			}
			
			$order_by = "";
			if (isset($_GET['orderby'])) $order_by = $_GET['orderby'];
			if ( $order_by == "" )
			{
				$order_by = "abandoned_cart_time";
			}
			/* Now we use the LIMIT clause to grab a range of rows */
			$query = "SELECT wpac . * , wpu.user_login, wpu.user_email 
					  FROM `".$wpdb->prefix."ac_abandoned_cart_history` AS wpac 
					  LEFT JOIN ".$wpdb->prefix."users AS wpu ON wpac.user_id = wpu.id
					  WHERE recovered_cart='0' AND unsubscribe_link='0' 
					  ORDER BY `$order_by` $order 
					  $limit";
					  //echo $query;
					  $results = $wpdb->get_results( $query );
			
			/* echo "<pre>";
			print_r($results);
			echo "</pre>"; */
			//exit;
			 
			/* From here you can do whatever you want with the data from the $result link. */
			
			$ac_cutoff_time = json_decode(get_option('woocommerce_ac_settings'));
			
			if (isset($ac_cutoff_time[0]->track_coupons)) $display_tracked_coupons = $ac_cutoff_time[0]->track_coupons;
			else $display_tracked_coupons = "";
			?> 
			
			
			            <table class='wp-list-table widefat fixed posts' cellspacing='0' id='cart_data'>
						<tr>
							<th> <?php _e( 'Customer', 'woocommerce-ac' ); ?> </th>
							<th> <?php _e( 'Order Total', 'woocommerce-ac' ); ?> </th>
							<th> <?php _e( 'Quantity', 'woocommerce-ac' ); ?> </th>
							<th scope="col" id="date_ac" class="manage-column column-date_ac sorted <?php echo $order;?>" style="">
								<a href="admin.php?page=woocommerce_ac_page&action=listcart&orderby=abandoned_cart_time&order=<?php echo $order_next;?>">
									<span> <?php _e( 'Date', 'woocommerce-ac' ); ?> </span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<?php 
							if ( $display_tracked_coupons == 'on' )
							{?>
							<th> <?php _e( 'Coupon Code Used', 'woocommerce-ac' ); ?> </th>
							<th> <?php _e( 'Coupon Status', 'woocommerce-ac' ); ?> </th>
							<?php }?>
							<th scope="col" id="status_ac" class="manage-column column-status_ac sorted <?php echo $order;?>" style="">
								<a href="admin.php?page=woocommerce_ac_page&action=listcart&orderby=cart_ignored&order=<?php echo $order_next;?>">
									<span> <?php _e( 'Status', 'woocommerce-ac' ); ?> </span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th> <?php _e( 'Actions', 'woocommerce-ac' ); ?> </th>
						</tr>
			
				<?php 
						foreach ($results as $key => $value)
						{
							if ($value->user_type == "GUEST")
							{
								$query_guest = "SELECT * from `". $wpdb->prefix."ac_guest_abandoned_cart_history`
												WHERE id = '".$value->user_id."'";
								$results_guest = $wpdb->get_results($query_guest);
							/*	echo "<pre>";
								print_r($results_guest);
								echo "</pre>";*/
							}
							$abandoned_order_id = $value->id;
							$user_id = $value->user_id;
							$user_login = $value->user_login;
							if ($value->user_type == "GUEST") 
							{
								if (isset($results_guest[0]->email_id)) $user_email = $results_guest[0]->email_id;
								if (isset($results_guest[0]->billing_first_name)) $user_first_name = $results_guest[0]->billing_first_name;
								else $user_first_name = "";
								if (isset($results_guest[0]->billing_last_name)) $user_last_name = $results_guest[0]->billing_last_name;
								else $user_last_name = "";
							//	echo $user_first_name . " " . $user_last_name;
							} 
							else 
							{
								$user_email = $value->user_email;
								$user_first_name_temp = get_user_meta($value->user_id, 'first_name');
								if (isset($user_first_name_temp[0])) $user_first_name = $user_first_name_temp[0];
								else $user_first_name = "";
								$user_last_name_temp = get_user_meta($value->user_id, 'last_name');
								if (isset($user_last_name_temp[0])) $user_last_name = $user_last_name_temp[0];
								else $user_last_name = "";
							//	echo $user_first_name . " " . $user_last_name;
							}
							
							$cart_info = json_decode($value->abandoned_cart_info);
							
							$order_date = "";
							$cart_update_time = $value->abandoned_cart_time;
							if ($cart_update_time != "" && $cart_update_time != 0)
							{
								$order_date = date('d M, Y h:i A', $cart_update_time);
							}
							
							$ac_cutoff_time = json_decode(get_option('woocommerce_ac_settings'));
							$cut_off_time = $ac_cutoff_time[0]->cart_time * 60;
							$current_time = current_time('timestamp');
							
							$compare_time = $current_time - $cart_update_time;
							
							if (isset($ac_cutoff_time[0]->track_coupons)) $display_tracked_coupons = $ac_cutoff_time[0]->track_coupons;
							/*echo $display_tracked_coupons."</br>";
							echo $cut_off_time." <pre>";
							print_r($ac_cutoff_time);
							echo "</pre>";
							exit;*/
			
							$cart_details = $cart_info->cart;
							
							$line_total = 0;
							if (count($cart_details) > 0)
							{
								foreach ($cart_details as $k => $v)
								{
									$line_total = $line_total + $v->line_total;
								}
							}
							$quantity_total = 0;
							if (count($cart_details) > 0)
							{
								foreach ($cart_details as $k => $v)
								{
									$quantity_total = $quantity_total + $v->quantity;
								}
							}
							if ($quantity_total == 1)
							{
								$item_disp = "item";
							}
							else
							{
								$item_disp = "items";
							}
							$coupon_details = get_user_meta($value->user_id, '_woocommerce_ac_coupon', true);
							
							if( $value->cart_ignored == 0 && $value->recovered_cart == 0 )
							{
								$ac_status = "Abandoned";
							}
							elseif( $value->cart_ignored == 1 && $value->recovered_cart == 0 )
							{
								$ac_status = "Abandoned but new </br>cart created after this";
							}
							else
							{
								$ac_status = "";
							}
							
							?>
							
							<?php 
							if ($compare_time > $cut_off_time && $ac_status != "" )
							{
								if($quantity_total > 0)
								{
							?>
							<tr id="row_<?php echo $abandoned_order_id; ?>">
								<td><strong><a href="admin.php?page=woocommerce_ac_page&action=orderdetails&id=<?php echo $value->id;?>"><?php echo "Abandoned Order #".$abandoned_order_id;?></a></strong><?php echo "</br>Name: ".$user_first_name." ".$user_last_name."<br><a href='mailto:$user_email'>".$user_email."</a>"; ?></td>
								<td><?php echo get_woocommerce_currency_symbol()." ".$line_total; ?></td>
								<td><a href="admin.php?page=woocommerce_ac_page&action=orderdetails&id=<?php echo $value->id;?>"><?php echo $quantity_total." ".$item_disp; ?></a></td>
								<td><?php echo $order_date; ?></td>
								<?php
								if ( $display_tracked_coupons == 'on' )
								{?> 
								<td><?php 	if( $coupon_details != '' )
											{
												foreach ($coupon_details as $key => $value)
												{
													echo $coupon_details[$key]['coupon_code']."</br>";
												}
											}?> 
								</td>
								<td><?php 	if( $coupon_details != '' )
											{
												foreach ($coupon_details as $key => $value)
												{
													echo $coupon_details[$key]['coupon_message']."</br>";
												}
											}?>
								</td>
								<?php }?>
								
								<td><?php echo $ac_status; ?>
								<td id="<?php echo $abandoned_order_id; ?>">
								<?php echo "<a href='#' id='$abandoned_order_id-$user_id' class='remove_cart'> <img src='".plugins_url()."/woocommerce-abandon-cart-pro/images/delete.png' alt='Remove Cart Data' title='Remove Cart Data'></a>"; ?>
								&nbsp;
								<br><?php //echo "<a href='#' id='$abandoned_order_id-$user_id' class='contact_customer'> Contact Customer </a>"; ?></td>
								
							</tr>
							
							<?php
								} 
							}
						}
						echo "</table>";
					}
					elseif ($action == 'emailtemplates' && ($mode != 'edittemplate' && $mode != 'addnewtemplate' && $mode != 'copytemplate') )
					{
							?>
							
							<p> <?php _e('Add email templates at different intervals to maximize the possibility of recovering your abandoned carts.', 'woocommerce-ac');?> </p>
							
							<?php 
							// Save the field values
							if ( isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'save' )
							{
								if (isset($_POST['coupon_ids'][0])) $coupon_code_id = $_POST['coupon_ids'][0];
								else $coupon_code_id = "";
								$active_post = (empty($_POST['is_active'])) ? '0' : '1';
								if ( $active_post == 1 )
								{
									$check_query = "SELECT * FROM `".$wpdb->prefix."ac_email_templates` 
													WHERE is_active='1' AND frequency='".$_POST['email_frequency']."' AND day_or_hour='".$_POST['day_or_hour']."' ";
									$check_results = $wpdb->get_results($check_query);
									if (count($check_results) == 0 )
									{
										$query = "INSERT INTO `".$wpdb->prefix."ac_email_templates` 
										(from_email, subject, body, is_active, frequency, day_or_hour, coupon_code, template_name, from_name, reply_email)
										VALUES ('".$_POST['woocommerce_ac_email_from']."', 
												'".$_POST['woocommerce_ac_email_subject']."', 
												'".$_POST['woocommerce_ac_email_body']."', 
												'".$active_post."', 
												'".$_POST['email_frequency']."', 
												'".$_POST['day_or_hour']."', 
												'".$coupon_code_id."', 
												'".$_POST['woocommerce_ac_template_name']."',
												'".$_POST['woocommerce_ac_from_name']."',
												'".$_POST['woocommerce_ac_email_reply']."' )";
										//echo $query;
										$wpdb->query($query);
									}
									else 
									{
										$query_update = "UPDATE `".$wpdb->prefix."ac_email_templates`
										SET
										is_active='0'
										WHERE frequency='".$_POST['email_frequency']."' AND day_or_hour='".$_POST['day_or_hour']."' ";
										//echo $query_update;
										$wpdb->query($query_update);
										
										$query_insert_new = "INSERT INTO `".$wpdb->prefix."ac_email_templates` 
										(from_email, subject, body, is_active, frequency, day_or_hour, coupon_code, template_name, from_name, reply_email)
										VALUES ('".$_POST['woocommerce_ac_email_from']."', 
												'".$_POST['woocommerce_ac_email_subject']."', 
												'".$_POST['woocommerce_ac_email_body']."', 
												'".$active_post."', 
												'".$_POST['email_frequency']."', 
												'".$_POST['day_or_hour']."', 
												'".$coupon_code_id."', 
												'".$_POST['woocommerce_ac_template_name']."',
												'".$_POST['woocommerce_ac_from_name']."',
												'".$_POST['woocommerce_ac_email_reply']."' )";
										//echo $query;
										$wpdb->query($query_insert_new);
									}
								}
								else
								{
									$query = "INSERT INTO `".$wpdb->prefix."ac_email_templates`
									(from_email, subject, body, is_active, frequency, day_or_hour, coupon_code, template_name, from_name, reply_email)
									VALUES ('".$_POST[woocommerce_ac_email_from]."',
											'".$_POST[woocommerce_ac_email_subject]."',
											'".$_POST[woocommerce_ac_email_body]."',
											'".$active_post."',
											'".$_POST[email_frequency]."',
											'".$_POST[day_or_hour]."',
											'".$coupon_code_id."',
											'".$_POST[woocommerce_ac_template_name]."',
											'".$_POST[woocommerce_ac_from_name]."',
											'".$_POST[woocommerce_ac_email_reply]."' )";
									//echo $query;
									$wpdb->query($query);
								}
							}
							
							if ( isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'update' )
							{
								/* echo "<pre>";
								print_r($_POST);
								echo "</pre>"; */
								
								if ( isset( $_POST['coupon_ids']) )
								{
									$coupon_code_id = $_POST['coupon_ids'][0];
									if ($coupon_code_id == "" && $_POST['existing_coupon_id'] != "" )
									{
										$coupon_code_id = $_POST['existing_coupon_id'];
									}
								}
								else 
								{
									if (isset($_POST['coupon_ids'][0])) $coupon_code_id = $_POST['coupon_ids'][0];
									else $coupon_code_id = "";
								}
								$active = (empty($_POST['is_active'])) ? '0' : '1';
								
								if ( $active == 1 )
								{
									$check_query = "SELECT * FROM `".$wpdb->prefix."ac_email_templates`
									WHERE is_active='1' AND frequency='".$_POST['email_frequency']."' AND day_or_hour='".$_POST['day_or_hour']."' ";
									$check_results = $wpdb->get_results($check_query);
									if (count($check_results) == 0 )
									{
										$query_update = "UPDATE `".$wpdb->prefix."ac_email_templates`
										SET
										from_email='".$_POST['woocommerce_ac_email_from']."',
										subject='".$_POST['woocommerce_ac_email_subject']."',
										body='".$_POST['woocommerce_ac_email_body']."',
										is_active='".$active."', frequency='".$_POST['email_frequency']."',
										day_or_hour='".$_POST['day_or_hour']."',
										coupon_code='".$coupon_code_id."',
										template_name='".$_POST['woocommerce_ac_template_name']."',
										from_name='".$_POST['woocommerce_ac_from_name']."',
										reply_email='".$_POST['woocommerce_ac_email_reply']."'
										WHERE id='".$_POST['id']."' ";
										//echo $query_update;
										$wpdb->query($query_update);
									}
									else 
									{
										$query_update_new = "UPDATE `".$wpdb->prefix."ac_email_templates`
										SET
										is_active='0'
										WHERE frequency='".$_POST['email_frequency']."' AND day_or_hour='".$_POST['day_or_hour']."' ";
										//echo $query_update;
										$wpdb->query($query_update_new);
										
										$query_update_latest = "UPDATE `".$wpdb->prefix."ac_email_templates`
										SET
										from_email='".$_POST['woocommerce_ac_email_from']."',
										subject='".$_POST['woocommerce_ac_email_subject']."',
										body='".$_POST['woocommerce_ac_email_body']."',
										is_active='".$active."', frequency='".$_POST['email_frequency']."',
										day_or_hour='".$_POST['day_or_hour']."',
										coupon_code='".$coupon_code_id."',
										template_name='".$_POST['woocommerce_ac_template_name']."',
										from_name='".$_POST['woocommerce_ac_from_name']."',
										reply_email='".$_POST['woocommerce_ac_email_reply']."'
										WHERE id='".$_POST['id']."' ";
										//echo $query_update;
										$wpdb->query($query_update_latest);
									}
								}
								else
								{
									$query_update = "UPDATE `".$wpdb->prefix."ac_email_templates`
									SET
									from_email='".$_POST[woocommerce_ac_email_from]."',
									subject='".$_POST[woocommerce_ac_email_subject]."',
									body='".$_POST[woocommerce_ac_email_body]."',
									is_active='".$active."', frequency='".$_POST[email_frequency]."',
									day_or_hour='".$_POST[day_or_hour]."',
									coupon_code='".$coupon_code_id."',
									template_name='".$_POST[woocommerce_ac_template_name]."',
									from_name='".$_POST[woocommerce_ac_from_name]."',
									reply_email='".$_POST[woocommerce_ac_email_reply]."'
									WHERE id='".$_POST[id]."' ";
									//echo $query_update;
									$wpdb->query($query_update);
								}
							}
							
							if ( $action == 'emailtemplates' && $mode == 'removetemplate' )
							{
								$id_remove = $_GET['id'];
								$query_remove = "DELETE FROM `".$wpdb->prefix."ac_email_templates` WHERE id='".$id_remove."' ";
								//echo $query_remove;
								$wpdb->query($query_remove);
							}
							
							if ( isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'save' ) { ?>
							<div id="message" class="updated fade"><p><strong><?php _e( 'The Email Template has been successfully added.', 'woocommerce-ac' ); ?></strong></p></div>
							<?php } 
							if ( isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'update' ) { ?>
							<div id="message" class="updated fade"><p><strong><?php _e( 'The Email Template has been successfully updated.', 'woocommerce-ac' ); ?></strong></p></div>
							<?php }?>
							
							<div class="tablenav">
							<p style="float:left;">
							<input type="button" value="+ Add New Template" id="add_new_template" onclick="location.href='admin.php?page=woocommerce_ac_page&action=emailtemplates&mode=addnewtemplate';" style="font-weight: bold; color: green; font-size: 18px; cursor: pointer;">
							<!--<a href="admin.php?page=woocommerce_ac_page&action=emailtemplates&mode=addnewtemplate">Add New Template</a>-->
							</p>
							
				<?php
				include_once(  "pagination.class.php"); 
				 
				/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */
				$wpdb->get_results("SELECT wpet . *   
										FROM `".$wpdb->prefix."ac_email_templates` AS wpet  
										"); 
				$count = $wpdb->num_rows;
				if($count > 0) {
					$p = new pagination;
					$p->items($count);
					$p->limit(10); // Limit entries per page
					$p->target("admin.php?page=woocommerce_ac_page&action=emailtemplates");
					if (isset($p->paging))
					{
						if (isset($_GET[$p->paging])) $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
					}
					$p->calculate(); // Calculates what to show
					$p->parameterName('paging');
					$p->adjacents(1); //No. of page away from the current page
					$p->showCounter(true);
						
					if(!isset($_GET['paging'])) {
						$p->page = 1;
					} else {
						$p->page = $_GET['paging'];
					}
						
					//Query for limit paging
					$limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
						
				} 
				else $limit = "";	
				?>
							  
				    <div class='tablenav-pages'>
				    	<?php if ($count>0) echo $p->show();  // Echo out the list of paging. ?>
				    </div>
				</div>
				
				<?php 

				$order = "";
				if (isset($_GET['order'])) $order = $_GET['order'];
				if ( $order == "" )
				{
					$order = "desc";
					$order_next = "asc";
				}
				elseif ( $order == "asc" )
				{
					$order_next = "desc";
				}
				elseif ( $order == "desc" )
				{
					$order_next = "asc";
				}

				$order_by_2 = "";
				$order_by = "";
				if (isset($_GET['orderby'])) $order_by = $_GET['orderby'];
				if ( $order_by == "" || $order_by == "frequencyday_or_hour" )
				{
					$order_by = "day_or_hour";
					$order_by_2 = ",frequency $order_next";
				}
				
				$query = "SELECT wpet . *   
						  FROM `".$wpdb->prefix."ac_email_templates` AS wpet 
						  ORDER BY $order_by $order
						  $order_by_2 
						  $limit";
				$results = $wpdb->get_results( $query );
				 
				/* From here you can do whatever you want with the data from the $result link. */
				?> 
		
			            <table class='wp-list-table widefat fixed posts' cellspacing='0' id='email_templates'>
						<tr>
							<th> <?php _e( 'Sr', 'woocommerce-ac' ); ?> </th>
							<th scope="col" id="temp_name" class="manage-column column-temp_name sorted <?php echo $order;?>" style="">
								<a href="admin.php?page=woocommerce_ac_page&action=emailtemplates&orderby=template_name&order=<?php echo $order_next;?>">
									<span> <?php _e( 'Template Name', 'woocommerce-ac' ); ?> </span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th scope="col" id="sent" class="manage-column column-sent sorted <?php echo $order_next;?>" style="">
								<a href="admin.php?page=woocommerce_ac_page&action=emailtemplates&orderby=frequencyday_or_hour&order=<?php echo $order_next;?>">
									<span> <?php _e( 'Sent', 'woocommerce-ac' ); ?> </span>
									<span class="sorting-indicator"></span>
								</a>
							</th>
							<th> <?php _e( 'Active ?', 'woocommerce-ac' ); ?> </th>
							<th> <?php _e( 'Emails Sent', 'woocommerce-ac' ); ?> </th>
							<th> <?php _e( 'Actions', 'woocommerce-ac' ); ?> </th>
						</tr>
							
							<?php 
							if (isset($_GET['pageno'])) $add_var = ($_GET['pageno'] - 1) * $limit; 
							else $add_var = "";
							$i = 1 + $add_var;
						foreach ($results as $key => $value)
						{
								$id = $value->id;
								
								$query_no_emails = "SELECT * FROM " . $wpdb->prefix . "ac_sent_history
									 	  			WHERE template_id='".$id."' ";
								$number_emails = $wpdb->get_results( $query_no_emails );
								
								$from = $value->from_email;
								$subject = $value->subject;
								$body = $value->body;
								$is_active = $value->is_active;
								if ( $is_active == '1' )
								{
									$active = "Yes";
								}
								else
								{
									$active = "No";
								}
								$frequency = $value->frequency;
								$day_or_hour = $value->day_or_hour;
								?>
			
								<tr id="row_<?php echo $id; ?>">
								<td><?php echo $i; ?></td>
								<td><?php echo $value->template_name; ?></td>
								<td><?php echo $frequency." ".$day_or_hour." After Abandonment";?></td>
								<td><?php echo $active; ?></td>
								<td><?php echo count($number_emails); ?></td>
								
								<td>
									<a href="admin.php?page=woocommerce_ac_page&action=emailtemplates&mode=copytemplate&id=<?php echo $id;?>"> <img src="<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/copy.png" alt="Copy as a new template" title="Copy as a new template" width="20" height="20"> </a>&nbsp;
									<a href="admin.php?page=woocommerce_ac_page&action=emailtemplates&mode=edittemplate&id=<?php echo $id; ?>"> <img src="<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/edit.png" alt="Edit Template" title="Edit Template" width="20" height="20"> </a>&nbsp;
									<a href="#" onclick="delete_email_template( <?php echo $id; ?> )" > <img src="<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/delete.png" alt="Delete Template" title="Delete Template" width="20" height="20"> </a>&nbsp;
								</td>
			
								
							</tr>
			
							<?php 
							$i++;
						}
						echo "</table>";
						//echo "</p>";
			
					}
					elseif ($action == 'stats' || $action == '')
					{
						
						?>
						<p>
						<script language='javascript'>
						jQuery(document).ready(function()
						{
						jQuery('#duration_select').change(function()
						{
						var group_name = jQuery('#duration_select').val();
						var today = new Date();
						var start_date = "";
						var end_date = "";
						if ( group_name == "yesterday")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
						}
						else if ( group_name == "today")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_seven")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_fifteen")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 15);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_thirty")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 30);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_ninety")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 90);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_year_days")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 365);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}

						var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun",
						                   "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
						               
						var start_date_value = start_date.getDate() + " " + monthNames[start_date.getMonth()] + " " + start_date.getFullYear();
						var end_date_value = end_date.getDate() + " " + monthNames[end_date.getMonth()] + " " + end_date.getFullYear();

						jQuery('#start_date').val(start_date_value);
						jQuery('#end_date').val(end_date_value);
						//location.href= 'admin.php?page=woocommerce_ac_page&action=stats&durationselect='+group_name;
						});
						});
						</script>
						<?php
						
						if (isset($_POST['duration_select'])) $duration_range = $_POST['duration_select'];
						else $duration_range = "";
						if ($duration_range == "")
						{
							if (isset($_GET['duration_select'])) $duration_range = $_GET['duration_select'];
						}
						if ($duration_range == "") $duration_range = "last_seven";
						else $duration_range = "";
						//global $this->duration_range_select,$this->start_end_dates;
						
						?>
						<p> The Report below shows how many Abandoned Carts we were able to recover for you by sending automatic emails to encourage shoppers.</p>
						<div id="recovered_stats_date" class="postbox" style="display:block">
						
							<div class="inside">
							<form method="post" action="admin.php?page=woocommerce_ac_page&action=stats" id="ac_stats">
							
							<select id="duration_select" name="duration_select" >
							<?php
							foreach ( $this->duration_range_select as $key => $value )
							{
								$sel = "";
								if ($key == $duration_range)
								{
									$sel = " selected ";
								} 
								echo"<option value='$key' $sel> $value </option>";
							}
							
							$date_sett = $this->start_end_dates[$duration_range];
							
							?>
							</select>
							
							<script type="text/javascript">
							jQuery(document).ready(function()
							{
							var formats = ["d.m.y", "d M yy","MM d, yy"];
							jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ "en-GB" ] );
							jQuery("#start_date").datepicker({dateFormat: formats[1]});
							});
			
							jQuery(document).ready(function()
							{
							var formats = ["d.m.y", "d M yy","MM d, yy"];
							jQuery("#end_date").datepicker({dateFormat: formats[1]});
							});
							</script>
							
							
							<?php 
			
							if (isset($_POST['start_date'])) $start_date_range = $_POST['start_date'];
							else $start_date_range = "";
							if ($start_date_range == "")
							{
								$start_date_range = $date_sett['start_date'];
							}
							if (isset($_POST['end_date'])) $end_date_range = $_POST['end_date'];
							else $end_date_range = "";
							if ($end_date_range == "")
							{
								$end_date_range = $date_sett['end_date'];
							}
							
							?>
							
							<label class="start_label" for="start_day"> <?php _e( 'Start Date:', 'woocommerce-ac' ); ?> </label>
							<input type="text" id="start_date" name="start_date" readonly="readonly" value="<?php echo $start_date_range; ?>"/>
							 
							<label class="end_label" for="end_day"> <?php _e( 'End Date:', 'woocommerce-ac' ); ?> </label>
							<input type="text" id="end_date" name="end_date" readonly="readonly" value="<?php echo $end_date_range; ?>"/>
							
							<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Go', 'woocommerce-ac' ); ?>"  />
							</form>
							</div>
						</div>
						<?php 
						
						global $wpdb;
						$start_date = strtotime($start_date_range." 00:01:01");
						$end_date = strtotime($end_date_range." 23:59:59");
						
						include_once(  "pagination.class.php");
						
						/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */
						$wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "ac_abandoned_cart_history
								 WHERE abandoned_cart_time >= " . $start_date . "
								 AND abandoned_cart_time <= " . $end_date . "
								 AND recovered_cart > '0' 
								 ");
						$count = $wpdb->num_rows;
						if($count > 0) {
							$p = new pagination;
							$p->items($count);
							$p->limit(10); // Limit entries per page
							$p->target("admin.php?page=woocommerce_ac_page&action=stats&duration_select=$duration_range");
							if (isset($p->paging))
							{
								if (isset($_GET[$p->paging])) $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
							}
							$p->calculate(); // Calculates what to show
							$p->parameterName('paging');
							$p->adjacents(1); //No. of page away from the current page
							$p->showCounter(true);
						
							if(!isset($_GET['paging'])) {
								$p->page = 1;
							} else {
								$p->page = $_GET['paging'];
							}
						
							//Query for limit paging
							$limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
						
						}
						else
							$limit = "";
							
						?>
															  
						<div class="tablenav">
						    <div class='tablenav-pages'>
						    	<?php if ($count>0) echo $p->show();  // Echo out the list of paging. ?>
						    </div>
						</div>
						
						<?php 
						
						$order = "";
						if (isset($_GET['order'])) $order = $_GET['order'];
						if ( $order == "" )
						{
							$order = "desc";
							$order_next = "asc";
						}
						elseif ( $order == "asc" )
						{
							$order_next = "desc";
						}
						elseif ( $order == "desc" )
						{
							$order_next = "asc";
						}
						
						$order_by = "";
						if (isset($_GET['orderby'])) $order_by = $_GET['orderby'];
						if ( $order_by == "" )
						{
							$order_by = "recovered_cart";
						}
						
						$query_ac = "SELECT * FROM " . $wpdb->prefix . "ac_abandoned_cart_history  
									 WHERE abandoned_cart_time >= " . $start_date . "
									 AND abandoned_cart_time <= " . $end_date . "
									 AND recovered_cart > 0 
									 ORDER BY $order_by $order $limit";
						/* echo "<br>".date("d M Y H:i:s", $start_date);
						echo "<br>".date("d M Y H:i:s", $end_date);
						echo $query_ac; */
						$ac_results = $wpdb->get_results( $query_ac );
						
						$query_ac_carts = "SELECT * FROM " . $wpdb->prefix . "ac_abandoned_cart_history
										   WHERE abandoned_cart_time >= " . $start_date . "
									 	   AND abandoned_cart_time <= " . $end_date;
						$ac_carts_results = $wpdb->get_results( $query_ac_carts );
						
						$recovered_item = $recovered_total = $count_carts = $total_value = $order_total = 0;
						foreach ( $ac_carts_results as $key => $value)
						{
							// 
							//if( $value->recovered_cart == 0 )
							{
								$count_carts += 1;
									
								$cart_detail = json_decode($value->abandoned_cart_info);
								$product_details = $cart_detail->cart;
								
								$line_total = 0;
								foreach ($product_details as $k => $v)
								{
									$line_total = $line_total + $v->line_total;
								}
								
								$total_value += $line_total;
							}
						}
						$table_data = "";
						foreach ( $ac_results as $key => $value)
						{	
							if( $value->recovered_cart != 0 )
							{
								$recovered_id = $value->recovered_cart;
								$rec_order = get_post_meta( $recovered_id );
								/* echo "<pre>";
								//print_r($rec_order);
								print_r(unserialize($rec_order['_order_items'][0]));
								echo "</pre>"; */
								$woo_order = new WC_Order($recovered_id);
								$recovered_date = strtotime($woo_order->order_date);
								$recovered_date_new = date('d M, Y h:i A', $recovered_date);
								$recovered_item += 1;
								
							/*	$order_items = unserialize($rec_order['_order_items'][0]);
								foreach ( $order_items as $order_key => $order_value)
								{
									$order_total += $order_items[$order_key]['line_total'];
								} */
								$recovered_total += $rec_order['_order_total'][0];
								$abandoned_date = date('d M, Y h:i A', $value->abandoned_cart_time);
								
								$abandoned_order_id = $value->id;
								$is_email_sent_for_this_order = $this->check_email_sent_for_order($abandoned_order_id) ? 'Yes' : 'No';
								
								$table_data .="<tr>
											  <td>Name: ".$rec_order['_billing_first_name'][0]." ".$rec_order['_billing_last_name'][0]."</br><a href='mailto:'".$rec_order['_billing_email'][0]."'>".$rec_order['_billing_email'][0]."</td>
											  <td>".$abandoned_date."</td>
											  <td>$is_email_sent_for_this_order</td>
											  <td>".$recovered_date_new."</td>
											  <td>".get_woocommerce_currency_symbol()." ".$rec_order['_order_total'][0]."</td>
											  <td> <a href=\"post.php?post=". $recovered_id."&action=edit\">View Details</td>";
							}
						}
						
						?>
						<div id="recovered_stats" class="postbox" style="display:block">
						<div class="inside" >
						<p style="font-size: 15px"> During the selected range <strong><?php echo $count_carts; ?> </strong> carts totaling <strong><?php echo get_woocommerce_currency_symbol()." ".$total_value; ?></strong> were abandoned. We were able to recover <strong><?php echo $recovered_item; ?></strong> of them, which led to an extra <strong><?php echo get_woocommerce_currency_symbol()." ".$recovered_total; ?></strong> in sales</p>
						</div>
						</div>
						
						<table class='wp-list-table widefat fixed posts' cellspacing='0' id='cart_data'>
												<tr>
												<th> <?php _e( 'Customer', 'woocommerce-ac' ); ?> </th>
												<th scope="col" id="created_date" class="manage-column column-created_date sorted <?php echo $order;?>" style="">
													<a href="admin.php?page=woocommerce_ac_page&action=stats&orderby=abandoned_cart_time&order=<?php echo $order_next;?>&durationselect=<?php echo $duration_range;?>">
														<span> <?php _e( 'Created On', 'woocommerce-ac' ); ?> </span>
														<span class="sorting-indicator"></span>
													</a>
												</th>
												<th> <?php _e( 'Email Sent', 'woocommerce-ac' ); ?> </th>
												<th scope="col" id="rec_order" class="manage-column column-rec_order sorted <?php echo $order;?>" style="">
													<a href="admin.php?page=woocommerce_ac_page&action=stats&orderby=recovered_cart&order=<?php echo $order_next;?>&durationselect=<?php echo $duration_range;?>">
														<span> <?php _e( 'Recovered Date', 'woocommerce-ac' ); ?> </span>
														<span class="sorting-indicator"></span>
													</a>
												</th>
												<th> <?php _e( 'Order Total', 'woocommerce-ac' ); ?> </th>
												<th></th>
												</tr>
						<?php
						echo $table_data;
						print('</table>');
					}
					
					elseif ( $action == 'emailstats' )
					{
						?>
						
						<p>
						<script language='javascript'>
						jQuery(document).ready(function()
						{
						jQuery('#duration_select_email').change(function()
						{
						var group_name = jQuery('#duration_select_email').val();
						var today = new Date();
						var start_date = "";
						var end_date = "";
						if ( group_name == "yesterday")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
						}
						else if ( group_name == "today")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_seven")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_fifteen")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 15);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_thirty")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 30);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_ninety")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 90);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}
						else if ( group_name == "last_year_days")
						{
							start_date = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 365);
							end_date = new Date(today.getFullYear(), today.getMonth(), today.getDate());
						}

						var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun",
						                   "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
						               
						var start_date_value = start_date.getDate() + " " + monthNames[start_date.getMonth()] + " " + start_date.getFullYear();
						var end_date_value = end_date.getDate() + " " + monthNames[end_date.getMonth()] + " " + end_date.getFullYear();

						jQuery('#start_date_email').val(start_date_value);
						jQuery('#end_date_email').val(end_date_value);
						//location.href= 'admin.php?page=woocommerce_ac_page&action=emailstats&durationselect='+group_name;
						});
						});
						</script>
						
						<?php
						 
						if (isset($_POST['duration_select_email'])) $duration_range = $_POST['duration_select_email'];
						else $duration_range = "";
						if ($duration_range == "")
						{
							if (isset($_GET['duration_select_email'])) $duration_range = $_GET['duration_select_email'];
						}
						if ($duration_range == "") $duration_range = "last_seven";
						//global $this->duration_range_select,$this->start_end_dates;
						
						?>
						
						<p> <?php _e('The Report below shows emails sent, emails opened and other related stats for the selected date range', 'woocommerce-ac');?> </p>
						
						<div id="email_stats" class="postbox" style="display:block">
							
						<div class="inside">
						
						<form method="post" action="admin.php?page=woocommerce_ac_page&action=emailstats" id="ac_email_stats">
						<select id="duration_select_email" name="duration_select_email" >
						
						<?php
						
						foreach ( $this->duration_range_select as $key => $value )
						{
							$sel = "";
							if ($key == $duration_range)
							{
								$sel = " selected ";
							}
							echo"<option value='$key' $sel> $value </option>";
						}
						
						$date_sett = $this->start_end_dates[$duration_range];
						?>
						</select>
						
						<script type="text/javascript">
						jQuery(document).ready(function()
						{
							var formats = ["d.m.y", "d M yy","MM d, yy"];
							jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ "en-GB" ] );
							jQuery("#start_date_email").datepicker({
								dateFormat: formats[1]});
						});
						
						jQuery(document).ready(function()
						{
							var formats = ["d.m.y", "d M yy","MM d, yy"];
							jQuery("#end_date_email").datepicker({
								dateFormat: formats[1]});
						});
						</script>
						
						
						<?php
						
						if (isset($_POST['start_date_email'])) $start_date_range = $_POST['start_date_email'];
						else $start_date_range = "";
						if ($start_date_range == "")
						{
							$start_date_range = $date_sett['start_date'];
						}
						if (isset($_POST['end_date_email'])) $end_date_range = $_POST['end_date_email'];
						else $end_date_range = "";
						if ($end_date_range == "")
						{
							$end_date_range = $date_sett['end_date'];
						}
						
						?>
										
							<label class="start_label" for="start_day"> <?php _e( 'Start Date:', 'woocommerce-ac' ); ?> </label>
							<input type="text" id="start_date_email" name="start_date_email" readonly="readonly" value="<?php echo $start_date_range; ?>"/>
							 
							<label class="end_label" for="end_day"> <?php _e( 'End Date:', 'woocommerce-ac' ); ?> </label>
							<input type="text" id="end_date_email" name="end_date_email" readonly="readonly" value="<?php echo $end_date_range; ?>"/>
							
							<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Go', 'woocommerce-ac' ); ?>"  />
							</form>
							</div>
						</div>
						<?php 
						
						global $wpdb, $woocommerce;
						$start_date = strtotime($start_date_range." 00:01:01");
						$start_date_db = date('Y-m-d H:i:s', $start_date);
						$end_date = strtotime($end_date_range." 23:59:59");
						$end_date_db = date('Y-m-d H:i:s', $end_date);
						
						include_once(  "pagination.class.php");
						
						/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */
						$wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "ac_sent_history
									 	  WHERE sent_time >= '" . $start_date_db . "'
									 	  AND sent_time <= '" . $end_date_db . "'
								");
						$count = $wpdb->num_rows;
						if($count > 0) {
							$p = new pagination;
							$p->items($count);
							$p->limit(10); // Limit entries per page
							$p->target("admin.php?page=woocommerce_ac_page&action=emailstats&duration_select_email=$duration_range");
							if (isset($p->paging))
							{
								if (isset($_GET[$p->paging])) $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
							}
							$p->calculate(); // Calculates what to show
							$p->parameterName('paging');
							$p->adjacents(1); //No. of page away from the current page
							$p->showCounter(true);
								
							if(!isset($_GET['paging'])) {
								$p->page = 1;
							} else {
								$p->page = $_GET['paging'];
							}
								
							//Query for limit paging
							$limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
								
						}
						else $limit = "";
						?>
									  
						<div class="tablenav">
						    <div class='tablenav-pages'>
						    	<?php if ($count>0) echo $p->show();  // Echo out the list of paging. ?>
						    </div>
						</div>
						
						<?php 
						/* Now we use the LIMIT clause to grab a range of rows */
						
						$query_ac_sent = "SELECT * FROM " . $wpdb->prefix . "ac_sent_history
									 	  WHERE sent_time >= '" . $start_date_db . "'
									 	  AND sent_time <= '" . $end_date_db . "'
										  ORDER BY `id` DESC
										  $limit";
						//echo $query;
						$ac_results_sent = $wpdb->get_results( $query_ac_sent );
						
						$query_ac_clicked = "SELECT DISTINCT email_sent_id FROM " . $wpdb->prefix . "ac_link_clicked_email
											 WHERE time_clicked >= '" . $start_date_db . "'
											 AND time_clicked <= '" . $end_date_db . "'
											 ORDER BY id DESC ";
						$ac_results_clicked = $wpdb->get_results( $query_ac_clicked, ARRAY_A );
						
						$query_ac_opened = "SELECT DISTINCT email_sent_id FROM " . $wpdb->prefix . "ac_opened_emails
										  	WHERE time_opened >= '" . $start_date_db . "'
										  	AND time_opened <= '" . $end_date_db . "'
											ORDER BY id DESC ";
						$ac_results_opened = $wpdb->get_results( $query_ac_opened, ARRAY_A );
						
						
						?>
						
						<div id="email_sent_stats" class="postbox" style="display:block">
						<table class='wp-list-table widefat fixed posts' cellspacing='0' id='cart_data_sent' style="font-size : 15px">
						<tr>
						<td> <p style="font-size : 15px"> <?php _e( 'Emails Sent :', 'woocommerce-ac' ); ?> <?php echo $count; ?> </p> </td>
						<td> <p style="font-size : 15px"> <?php _e( 'Emails Opened :', 'woocommerce-ac' ); ?> <?php echo count($ac_results_opened); ?> </p> </td>
						<td> <p style="font-size : 15px"> <?php _e( 'Links Clicked :', 'woocommerce-ac' ); ?> <?php echo count($ac_results_clicked); ?> </p> </td>
						</tr>
						</table>
						</div>
						
						<div id="email_sent_stats_table" class="postbox" style="display:block">
						<table class='wp-list-table widefat fixed posts' cellspacing='0' id='cart_data_sent'>
						<tr>
						<th> <?php _e( 'Sent Time', 'woocommerce-ac' ); ?> </th>
						<th> <?php _e( 'Email Address', 'woocommerce-ac' ); ?> </th>
						<th> <?php _e( 'Date/Time Opened', 'woocommerce-ac' ); ?> </th>
						<th> <?php _e( 'Link Clicked', 'woocommerce-ac' ); ?> </th>
						<th> <?php _e( 'Email Template', 'woocommerce-ac' ); ?> </th>
						<th> <?php _e( 'View Order', 'woocommerce-ac' ); ?> </th>
						</tr>
						
						
						<?php
			
						foreach ( $ac_results_sent as $key => $value )
						{
							$sent_tmstmp = strtotime($value->sent_time);
							$sent_date = date('d M Y h:i A', $sent_tmstmp);
							
							$query_template_name = "SELECT template_name FROM " . $wpdb->prefix . "ac_email_templates
													WHERE id='".$value->template_id."' ";
							$ac_results_template_name = $wpdb->get_results( $query_template_name );
							
							$link_clicked = "";
							if (isset($ac_results_template_name[0]->template_name)) $ac_email_template_name = $ac_results_template_name[0]->template_name;
							else $ac_email_template_name = "";
							foreach( $ac_results_clicked as $clicked_key => $clicked_value )
							{
								if ( $clicked_value['email_sent_id'] == $value->id )
								{
									$query_links = "SELECT * FROM " . $wpdb->prefix . "ac_link_clicked_email
													WHERE email_sent_id='".$value->id."'
													ORDER BY `id` DESC
													LIMIT 1";
									
									$results_links = $wpdb->get_results($query_links);
									/* echo "<pre>";
									print_r($results_links);
									echo "</pre>"; */
									
									$checkout_page_id = get_option('woocommerce_checkout_page_id');
									$checkout_page = get_post( $checkout_page_id );
									$checkout_page_link = $checkout_page->guid;
									//echo "checkout ".$checkout_page_link."</br>";
									
									$cart_page_id = get_option('woocommerce_cart_page_id');
									$cart_page = get_post( $cart_page_id );
									$cart_page_link = $cart_page->guid;
									
									if($results_links[0]->link_clicked == $checkout_page_link)
									{
										$link_clicked = "Checkout Page";
									}
									elseif($results_links[0]->link_clicked == $cart_page_link )
									{
										$link_clicked = "Cart Page";
									}
								}
							}
							
							$email_opened = "";
							
							foreach( $ac_results_opened as $opened_key => $opened_value )
							{
								if ( $opened_value['email_sent_id'] == $value->id )
								{
									$query_opens = "SELECT * FROM " . $wpdb->prefix . "ac_opened_emails
													WHERE email_sent_id='".$value->id."'
													ORDER BY `id` DESC
													LIMIT 1";
									$results_opens = $wpdb->get_results($query_opens);
									/* echo "<pre>";
									print_r($results_opens);
									echo "</pre>"; */
									
									$opened_tmstmp = strtotime($results_opens[0]->time_opened);
									$email_opened = date('d M Y h:i A', $opened_tmstmp);
								}
							}
							
							$view_order_query = "SELECT * FROM " . $wpdb->prefix . "ac_abandoned_cart_history
												 WHERE id='".$value->abandoned_order_id."'";
							$view_order_results = $wpdb->get_results($view_order_query);
							
							if( $view_order_results[0]->recovered_cart == 0 )
							{
								$view_link = "admin.php?page=woocommerce_ac_page&action=orderdetails&id=".$value->abandoned_order_id;
								$view_name = "Abandoned Order";
							}
							else
							{
								$view_link = "post.php?post=".$view_order_results[0]->recovered_cart."&action=edit";
								$view_name = "Recovered Order";
							}
							?>
							
							<tr>
							<td> <p> <?php echo $sent_date; ?> </p> </td>
							<td> <p> <?php echo $value->sent_email_id; ?> </p> </td>
							<td> <p> <?php echo $email_opened; ?> </p> </td>
							<td> <p> <?php echo $link_clicked; ?> </p> </td>
							<td> <p> <?php echo $ac_email_template_name; ?> </p> </td>
							<td> <p> <a href="<?php echo $view_link;?>"> <?php echo $view_name;?> </a> </p> </td>
			 				</tr>
							
							
							<?php 
						}
						
						print('</table>
						</div>');
						
					}
					elseif ( $action == 'orderdetails' )
					{
							$ac_order_id = $_GET['id'];
							?>
							
									<p> </p>
									<div id="ac_order_details" class="postbox" style="display:block">
									<h3> <p> <?php _e( "Abandoned Order #$ac_order_id Details", "woocommerce-ac" ); ?> </p> </h3>
										<div class="inside">
											<table cellpadding="0" cellspacing="0" class="wp-list-table widefat fixed posts">
											<tr>
											<th> <?php _e( 'Item', 'woocommerce-ac' ); ?> </th>
											<th> <?php _e( 'Id', 'woocommerce-ac' ); ?> </th>
											<th> <?php _e( 'Name', 'woocommerce-ac' ); ?> </th>
											<th> <?php _e( 'Quantity', 'woocommerce-ac' ); ?> </th>
											<th> <?php _e( 'Line Subtotal', 'woocommerce-ac' ); ?> </th>
											<th> <?php _e( 'Line Total', 'woocommerce-ac' ); ?> </th>
											</tr>
											
							<?php 
							$query = "SELECT *  
					  				FROM `".$wpdb->prefix."ac_abandoned_cart_history`  
					  				WHERE id = '".$_GET['id']."' ";
							//echo $query;
							$results = $wpdb->get_results( $query );
							/* echo "<pre>";
							print_r($results);
							echo "</pre>"; */
							//exit;
							if ($results[0]->user_type == "GUEST")
							{
								$query_guest = "SELECT * FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
												WHERE id = '".$results[0]->user_id."'";
								
								$results_guest = $wpdb->get_results($query_guest);
								$user_email = $results_guest[0]->email_id;
								$user_first_name = $results_guest[0]->billing_first_name;
								$user_last_name = $results_guest[0]->billing_last_name;
								$user_billing_company = $user_billing_address_1 = $user_billing_address_2 = $user_billing_city = $user_billing_postcode = $user_billing_state = $user_billing_country = $user_billing_phone = "";
								$user_shipping_company = $user_shipping_address_1 = $user_shipping_address_2 = $user_shipping_city = $user_shipping_postcode = $user_shipping_state = $user_shipping_country = "";  
							}
							else
							{
								$user_id = $results[0]->user_id;
								
								if (isset($results[0]->user_login)) $user_login = $results[0]->user_login;
								$user_email = get_user_meta($results[0]->user_id, 'billing_email', true);
								
								$user_first_name_temp = get_user_meta($results[0]->user_id, 'first_name');
								if (isset($user_first_name_temp[0])) $user_first_name = $user_first_name_temp[0];
								else $user_first_name = "";
								
								$user_last_name_temp = get_user_meta($results[0]->user_id, 'last_name');
								if (isset($user_last_name_temp[0])) $user_last_name = $user_last_name_temp[0];
								else $user_last_name = "";
								
								$user_billing_first_name = get_user_meta($results[0]->user_id, 'billing_first_name');
								$user_billing_last_name = get_user_meta($results[0]->user_id, 'billing_last_name');
								
								$user_billing_company_temp = get_user_meta($results[0]->user_id, 'billing_company');
								if (isset($user_billing_company_temp[0])) $user_billing_company = $user_billing_company_temp[0];
								else $user_billing_company = "";
								
								$user_billing_address_1_temp = get_user_meta($results[0]->user_id, 'billing_address_1');
								if (isset($user_billing_address_1_temp[0])) $user_billing_address_1 = $user_billing_address_1_temp[0];
								else $user_billing_address_1 = "";
								
								$user_billing_address_2_temp = get_user_meta($results[0]->user_id, 'billing_address_2');
								if (isset($user_billing_address_2_temp[0])) $user_billing_address_2 = $user_billing_address_2_temp[0];
								else $user_billing_address_2 = "";
								
								$user_billing_city_temp = get_user_meta($results[0]->user_id, 'billing_city');
								if (isset($user_billing_city_temp[0])) $user_billing_city = $user_billing_city_temp[0];
								else $user_billing_city = "";
								
								$user_billing_postcode_temp = get_user_meta($results[0]->user_id, 'billing_postcode');
								if (isset($user_billing_postcode_temp[0])) $user_billing_postcode = $user_billing_postcode_temp[0];
								else $user_billing_postcode = "";
								
								$user_billing_state_temp = get_user_meta($results[0]->user_id, 'billing_state');
								if (isset($user_billing_state_temp[0])) $user_billing_state = $user_billing_state_temp[0];
								else $user_billing_state = "";
								
								$user_billing_country_temp = get_user_meta($results[0]->user_id, 'billing_country');
								if (isset($user_billing_country_temp[0])) $user_billing_country = $user_billing_country_temp[0];
								else $user_billing_country = "";
								
								$user_billing_phone_temp = get_user_meta($results[0]->user_id, 'billing_phone');
								if (isset($user_billing_phone_temp[0])) $user_billing_phone = $user_billing_phone_temp[0];
								else $user_billing_phone = "";
								
								$user_shipping_first_name = get_user_meta($results[0]->user_id, 'shipping_first_name');
								$user_shipping_last_name = get_user_meta($results[0]->user_id, 'shipping_last_name');
								
								$user_shipping_company_temp = get_user_meta($results[0]->user_id, 'shipping_company');
								if (isset($user_shipping_company_temp[0])) $user_shipping_company = $user_shipping_company_temp[0];
								else $user_shipping_company = "";
								
								$user_shipping_address_1_temp = get_user_meta($results[0]->user_id, 'shipping_address_1');
								if (isset($user_shipping_address_1_temp[0])) $user_shipping_address_1 = $user_shipping_address_1_temp[0];
								else $user_shipping_address_1 = "";
								
								$user_shipping_address_2_temp = get_user_meta($results[0]->user_id, 'shipping_address_2');
								if (isset($user_shipping_address_2_temp[0])) $user_shipping_address_2 = $user_shipping_address_2_temp[0];
								else $user_shipping_address_2 = "";
								
								$user_shipping_city_temp = get_user_meta($results[0]->user_id, 'shipping_city');
								if (isset($user_shipping_city_temp[0])) $user_shipping_city = $user_shipping_city_temp[0];
								else $user_shipping_city = "";
								
								$user_shipping_postcode_temp = get_user_meta($results[0]->user_id, 'shipping_postcode');
								if (isset($user_shipping_postcode_temp[0])) $user_shipping_postcode = $user_shipping_postcode_temp[0];
								else $user_shipping_postcode = "";
								
								$user_shipping_state_temp = get_user_meta($results[0]->user_id, 'shipping_state');
								if (isset($user_shipping_state_temp[0])) $user_shipping_state = $user_shipping_state_temp[0];
								else $user_shipping_state = "";
								
								$user_shipping_country_temp = get_user_meta($results[0]->user_id, 'shipping_country');
								if (isset($user_shipping_country_temp[0])) $user_shipping_country = $user_shipping_country_temp[0];
								else $user_shipping_country = "";
							}
							//echo $user_id."</br>";
							$cart_info = json_decode($results[0]->abandoned_cart_info);
							$cart_details = $cart_info->cart;
							
							foreach ($cart_details as $k => $v)
							{
								$quantity_total = $v->quantity;
								$product_id = $v->product_id;
								//echo $product_id."</br>";
								$prod_name = get_post($product_id);
								$product_name = $prod_name->post_title;
								
							//	$prod_details = new WC_PRODUCT ( $product_id);
								$item_total = $v->line_total / $quantity_total;
								$product = get_product($product_id);
								$prod_image = $product->get_image();
							?>
											
								<tr>
								<td> <?php echo $prod_image; ?></td>
								<td> <?php echo $product->id; ?> </td>
								<td> <?php echo $product_name; ?></td>
								<td> <?php echo $quantity_total; ?></td>
								<td> <?php echo get_woocommerce_currency_symbol()." ".$item_total; ?></td>
								<td> <?php echo get_woocommerce_currency_symbol()." ".$v->line_total; ?></td>
								</tr>
									
						<?php 
							}
							  ?>
							  
							  </table>
										
										</div>
									</div>
								
									<div id="ac_order_customer_details" class="postbox" style="display:block">
									<h3> <p> <?php _e( 'Customer Details', 'woocommerce-ac' ); ?> </p> </h3>
										<div class="inside" style="height: 300px;" >
											
										 <div id="order_data" class="panel">
												<div style="width:500px;float:left">
												<h3> <p> <?php _e( 'Billing Details', 'woocommerce-ac' ); ?> </p> </h3>
											<p> <strong> <?php _e( 'Name:', 'woocommerce-ac' ); ?> </strong>
											<?php echo $user_first_name." ".$user_last_name;?>
											</p>
											 
											<p> <strong> <?php _e( 'Address:', 'woocommerce-ac' ); ?> </strong>
											<?php echo $user_billing_company."</br>".
													   $user_billing_address_1."</br>".
													   $user_billing_address_2."</br>".
													   $user_billing_city."</br>".
													   $user_billing_postcode."</br>".
													   $user_billing_state."</br>".
													   $user_billing_country."</br>";
													   ?> 
											</p>
											
											<p> <strong> <?php _e( 'Email:', 'woocommerce-ac' ); ?> </strong>
											<a href='mailto:$user_email'><?php echo $user_email;?> </a>
											</p>
											
											<p> <strong> <?php _e( 'Phone:', 'woocommerce-ac' ); ?> </strong>
											<?php echo $user_billing_phone;?>
											</p>
												</div>
																						
												<div style="width:500px;float:right">
												<h3> <p> <?php _e( 'Shipping Details', 'woocommerce-ac' ); ?> </p> </h3>
											<!--  <p> <strong>Name:</strong>
											<?php echo $user_first_name[0]." ".$user_last_name[0];?>
											</p> -->
											
											<p> <strong> <?php _e( 'Address:', 'woocommerce-ac' ); ?> </strong>
											
											<?php 
						if ( $user_shipping_company == '' &&
								 $user_shipping_address_1 == '' &&
								 $user_shipping_address_2 == '' &&
								 $user_shipping_city == '' &&
								 $user_shipping_postcode == '' &&
								 $user_shipping_state == '' &&
								 $user_shipping_country == '')
							{echo "Shipping Address same as Billing Address";}
							else{?>
											
											<?php echo $user_shipping_company."</br>".
													   $user_shipping_address_1."</br>".
													   $user_shipping_address_2."</br>".
													   $user_shipping_city."</br>".
													   $user_shipping_postcode."</br>".
													   $user_shipping_state."</br>".
													   $user_shipping_country."</br>";
													   ?> 
											</p>
							<?php }?>				
											<!--  <p> <strong>Email:</strong>
											<a href='mailto:$user_email'><?php echo $user_email;?> </a>
											</p>
											
											<p> <strong>Phone:</strong>
											<?php echo $user_shipping_phone[0];?>
											</p>-->
												</div>
											</div>
										</div>
										</div>
									
				<?php }
							
				if (isset($_GET['action'])) $action = $_GET['action'];
				if (isset($_GET['mode'])) $mode = $_GET['mode'];
				
				if ( $action == 'emailtemplates' && ($mode == 'addnewtemplate' || $mode == 'edittemplate' || $mode == 'copytemplate'))
				{
					if($mode=='edittemplate')
					{
					$edit_id=$_GET['id'];
					$query="SELECT wpet . *  FROM `".$wpdb->prefix."ac_email_templates` AS wpet WHERE id='".$edit_id."'";
					//echo $query;
					$results = $wpdb->get_results( $query );
					}
					
					if($mode=='copytemplate')
					{
						$copy_id = $_GET['id'];
						$query_copy = "SELECT wpet . *  FROM `".$wpdb->prefix."ac_email_templates` AS wpet WHERE id='".$copy_id."'";
						//echo $query;
						$results_copy = $wpdb->get_results( $query_copy );
					}
					$active_post = (empty($_POST['is_active'])) ? '0' : '1';
						
						/*if ( (isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'save') ||  (isset( $_POST['ac_settings_frm'] ) && $_POST['ac_settings_frm'] == 'update') ) { ?>
							<div id="message" class="updated fade"><p><strong><?php _e( 'Your settings have been saved.', 'woocommerce-ac' ); ?></strong></p></div>
							<?php } */?>
			
							<div id="content">
							  <form method="post" action="admin.php?page=woocommerce_ac_page&action=emailtemplates" id="ac_settings">
							  
							  <input type="hidden" name="mode" value="<?php echo $mode;?>" />
							  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
							  
							  <?php
								$button_mode = "save";
								$display_message = "Add Email Template";
								if ( $mode == 'edittemplate' )
								{
									$button_mode = "update";
									$display_message = "Edit Email Template";
								}
								  print'<input type="hidden" name="ac_settings_frm" value="'.$button_mode.'">';?>
								  <div id="poststuff">
										<div class="postbox">
											<h3 class="hndle"><?php _e( $display_message, 'woocommerce-ac' ); ?></h3>
											<div>
											  <table class="form-table" id="addedit_template">
												
												<tr>
													<th>
														<label for="woocommerce_ac_template_name"><b><?php _e( 'Template Name:', 'woocommerce-ac ');?></b></label>
													</th>
													<td>
													<?php
													$template_name = "";
													if( $mode == 'edittemplate' )
													{
														$template_name = $results[0]->template_name;
													}
													if( $mode == 'copytemplate' )
													{
														$template_name = "Copy of ".$results_copy[0]->template_name;
													}
													print'<input type="text" name="woocommerce_ac_template_name" id="woocommerce_ac_template_name" class="regular-text" value="'.$template_name.'">';?>
													<img class="help_tip" width="16" height="16" data-tip='<?php _e('Enter a template name for reference', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
													</tr>
												
											    <tr>
											       <th>
				    									<label for="woocommerce_ac_from_name"><b><?php _e( 'Send From This Name:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$from_name="Admin";
													if ( $mode == 'edittemplate')
													{
														$from_name=$results[0]->from_name;
													}
													if ( $mode == 'copytemplate')
													{
														$from_name=$results_copy[0]->from_name;
													}
													print'<input type="text" name="woocommerce_ac_from_name" id="woocommerce_ac_from_name" class="regular-text" value="'.$from_name.'">';?>
													<img class="help_tip" width="16" height="16" data-tip='<?php _e('Enter the name that should appear in the email sent', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
													<?php //echo stripslashes(get_option( 'woocommerce_ac_email_body' )); ?></textarea>
												</tr>
												
												<tr>
											       <th>
				    									<label for="woocommerce_ac_email_from"><b><?php _e( 'Send From This Email Address:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$from_edit=get_option('admin_email');
													if ( $mode == 'edittemplate')
													{
														$from_edit=$results[0]->from_email;
													}
													if ( $mode == 'copytemplate')
													{
														$from_edit=$results_copy[0]->from_email;
													}
													print'<input type="text" name="woocommerce_ac_email_from" id="woocommerce_ac_email_from" class="regular-text" value="'.$from_edit.'">';?>
													<img class="help_tip" width="16" height="16" data-tip='<?php _e('Which email address should be shown in the "From Email" field for this email?', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
													<?php //echo stripslashes(get_option( 'woocommerce_ac_email_body' )); ?></textarea>
												</tr>
												
												<tr>
											       <th>
				    									<label for="woocommerce_ac_email_reply"><b><?php _e( 'Send Reply Emails to:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$reply_edit=get_option('admin_email');
													if ( $mode == 'edittemplate')
													{
														$reply_edit=$results[0]->reply_email;
													}
													if ( $mode == 'copytemplate')
													{
														$reply_edit=$results_copy[0]->reply_email;
													}
													print'<input type="text" name="woocommerce_ac_email_reply" id="woocommerce_ac_email_reply" class="regular-text" value="'.$reply_edit.'">';?>
													<img class="help_tip" width="16" height="16" data-tip='<?php _e('When a contact receives your email and clicks reply, which email address should that reply be sent to?', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
													<?php //echo stripslashes(get_option( 'woocommerce_ac_email_body' )); ?></textarea>
												</tr>
			
												<tr>
											       <th>
				    									<label for="woocommerce_ac_email_subject"><b><?php _e( 'Subject:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
													<?php
													$subject_edit="";
													if ( $mode == 'edittemplate')
													{
														$subject_edit=$results[0]->subject;
													}
													if ( $mode == 'copytemplate')
													{
														$subject_edit=$results_copy[0]->subject;
													}
													print'<input type="text" name="woocommerce_ac_email_subject" id="woocommerce_ac_email_subject" class="regular-text" value="'.$subject_edit.'">';?>
													<img class="help_tip" width="16" height="16" data-tip='<?php _e('Enter the subject that should appear in the email sent', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
													<?php //echo stripslashes(get_option( 'woocommerce_ac_email_body' )); ?></textarea>
												</tr>
			
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_body"><b><?php _e( 'Email Body:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
			
													<?php
													$initial_data = "";//stripslashes(get_option( 'woocommerce_ac_email_body' ));
													if ( $mode == 'edittemplate')
													{
														$initial_data = $results[0]->body;
													}
													if ( $mode == 'copytemplate')
													{
														$initial_data = $results_copy[0]->body;
													}
													/* $settings = array(
													'quicktags' => array('buttons' => 'em,strong,link',),
													'text_area_name'=>'woocommerce_ac_email_body',//name you want for the textarea
													'quicktags' => true,
													'class' => 'tinymce',
													'tinymce' => true
													);
													//echo "<textarea id='editortest'> </textarea>";
													$id = 'woocommerce_ac_email_body';//has to be lower case
													wp_editor(stripslashes($initial_data),$id,$settings); */
													
													echo "<textarea id='woocommerce_ac_email_body' name='woocommerce_ac_email_body' rows='15'' cols='80'>".$initial_data."</textarea>";
													?>
				    								
				    									<!--<textarea name="woocommerce_ac_email_body" cols="45" rows="3" class="regular-text"><?php echo stripslashes(get_option( 'woocommerce_ac_email_body' )); ?></textarea><br />-->
				    									<span class="description"><?php
				    										echo __( 'Message to be sent in the reminder email.', 'woocommerce-ac' );
				    									?></span>
				    								</td>
				    							</tr>
			
												<tr>
												    <th>
														<label for="is_active"><b><?php _e( 'Active:', 'woocommerce-ac' );?></b></label>
													</th>
													<td>
													<?php
													$is_active_edit="";
													if ( $mode == 'edittemplate')
													{
														$active_edit=$results[0]->is_active;
														if($active_edit=='1')
														{
															$is_active_edit="checked";
														}
														else
														{
															$is_active_edit="";
														}
													}
													if ( $mode == 'copytemplate')
													{
														$active_edit=$results_copy[0]->is_active;
														if($active_edit=='1')
														{
															$is_active_edit="checked";
														}
														else
														{
															$is_active_edit="";
														}
													}
														print'<input type="checkbox" name="is_active" id="is_active" '.$is_active_edit.'>  </input>';?>
														<img class="help_tip" width="16" height="16" data-tip='<?php _e('Yes, This email should be sent to shoppers with abandoned carts', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" /></p>
														</td>
												</tr>
			
				    							<tr>
				    								<th>
				    									<label for="woocommerce_ac_email_frequency"><b><?php _e( 'Send this email:', 'woocommerce-ac' ); ?></b></label>
				    								</th>
				    								<td>
				    								
				    									<select name="email_frequency" id="email_frequency">
				    									
				    									<?php
															$frequency_edit="";
															if(	$mode == 'edittemplate')
															{
																$frequency_edit=$results[0]->frequency;
															}
															if(	$mode == 'copytemplate')
															{
																$frequency_edit=$results_copy[0]->frequency;
															}
				    									
				    										for ($i=1;$i<60;$i++)
				    										{
																printf( "<option %s value='%s'>%s</option>\n",
																	selected( $i, $frequency_edit, false ),
																	esc_attr( $i ),
																	$i
																);
				    										}
				    									
				    									?>
				    										
				    									</select>
			
														<select name="day_or_hour" id="day_or_hour">
			
														<?php
														$days_or_hours_edit = "";
														if ( $mode == 'edittemplate')
														{
															$days_or_hours_edit=$results[0]->day_or_hour;
														}
														if ( $mode == 'copytemplate')
														{
															$days_or_hours_edit=$results_copy[0]->day_or_hour;
														}
														$days_or_hours=array(
																		   'Minutes' => 'Minute(s)',
																		   'Days' => 'Day(s)',
																		   'Hours' => 'Hour(s)');
														foreach($days_or_hours as $k => $v)
														{
															printf( "<option %s value='%s'>%s</option>\n",
																selected( $k, $days_or_hours_edit, false ),
																esc_attr( $k ),
																$v
															);
				    									}
														?>
			
														<!--<select name="day_or_hour" id="day_or_hour">
														<option value="Days" <?php echo $day_serl; ?>> Days </option>
														<option value="Hours" <?php echo $hours_serl; ?>> Hours </option>-->
														</select>
			
				    									
				    									<span class="description"><?php
				    									echo __( 'after cart is abandoned.', 'woocommerce-ac' );
				    									?></span>
				    								</td>
				    							</tr>
				    							

				    							
				    							<?php 
				    							$entered_coupon = "";
												if ( $mode == 'edittemplate')
												{
													$entered_coupon = $results[0]->coupon_code;
												}
												if ( $mode == 'copytemplate')
												{
													$entered_coupon = $results_copy[0]->coupon_code;
												}?>
												<input type="hidden" name="existing_coupon_id" value="<?php echo $entered_coupon;?>" />
				    							<tr>
				    							<th>
				    								<label for="woocommerce_ac_coupon_auto_complete"><b><?php _e( 'Enter a coupon code to add into email:', 'woocommerce-ac'); ?></b></label>
				    							</th>
				    								<td>
				    								
				    									<!-- code started for woocommerce auto-complete coupons field -->
														<div id="coupon_options" class="panel woocommerce_options_panel">
												    	
														<div class="options_group">
											
														<p class="form-field" style="padding-left:0px;">
														<select id="coupon_ids" name="coupon_ids[]" class="ajax_chosen_select_coupons" multiple="multiple" data-placeholder="<?php _e('Search for a coupon&hellip;', 'woocommerce'); ?>">
															<?php
															if ( $mode == 'edittemplate' )
															{
																$coupon_code_id = $results[0]->coupon_code;
															}
															if ( $mode == 'copytemplate' )
															{
																$coupon_code_id = $results_copy[0]->coupon_code;
															}
															if ($coupon_code_id > 0)
															{
																$title 	= get_the_title($coupon_code_id);
																$sku 	= get_post_meta($coupon_code_id, '_sku', true);
											
																if (isset($sku) && $sku) $sku = ' (SKU: ' . $sku . ')';
											
																echo '<option value="'.$product_id.'" selected="selected">'. $title . $sku .'</option>';
															}
											
															?>
														</select>
														<img class="help_tip" width="16" height="16" data-tip='<?php _e('Search & select one coupon code that customers should use to get a discount.', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" />
														</p>
														</div></div>
														
														<!-- code ended for woocommerce auto-complete coupons field -->
				    								 
				    									<!--<input type="text" id="enter_coupon" name="enter_coupon" class="regular-text" value="<?php echo $entered_coupon; ?>"/>-->
				    								</td>
				    							</tr>
				    							
				    							<tr>
				    							<th>
				    								<label for="woocommerce_ac_email_preview"><b><?php _e( 'Send a test email to:', 'woocommerce-ac' ); ?></b></label>
				    							</th>
				    							<td> 
				    							
				    							<input type="text" id="send_test_email" name="send_test_email" class="regular-text" >
				    							<input type="button" value="Send a test email" id="preview_email" onclick="javascript:void(0);">
				    							<img class="help_tip" width="16" height="16" data-tip='<?php _e('Enter the email id to which the test email needs to be sent.', 'woocommerce') ?>' src="<?php echo plugins_url(); ?>/woocommerce/assets/images/help.png" />
				    							<div id="preview_email_sent_msg" style="display:none;"></div>
				    							</p>
				    							
				    							</td>
				    							</tr>

				    							
												</table>
											</div>
										</div>
									</div>
							  <p class="submit">
								<?php
									$button_value = "Save Changes";
									if ( $mode == 'edittemplate' )
									{
										$button_value = "Update Changes";
									}?>
								<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( $button_value, 'woocommerce-ac' ); ?>"  />
							  </p>
						    </form>
						  </div>
						<?php 
						}
						
						
						
				}
				
			}
				
				
				////////////////////////////////////////////////////////////////
				
				function my_action_javascript()
				{
					?>
						<script type="text/javascript" >
						jQuery(document).ready(function($)
						{
							$("table#cart_data a.remove_cart").click(function()
							{
								//alert('hello there');
								var y=confirm('Are you sure you want to delete this Abandoned Order');
								if(y==true)
								{
									var passed_id = this.id;
									var arr = passed_id.split('-');
									var abandoned_order_id = arr[0];
									var user_id = arr[1];
									var data = {
										abandoned_order_id: abandoned_order_id,
										user_id: user_id,
										action: 'remove_cart_data'
										};
							
								// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
								$.post(ajaxurl, data, function(response)
								{
									//alert('Got this from the server: ' + response);
									$("#row_" + abandoned_order_id).hide();
								});
								}
							});
						});
						</script>
						<?php
						
					}
				
					function remove_cart_data() {
						
						global $wpdb; // this is how you get access to the database
					
						$abandoned_order_id = $_POST['abandoned_order_id'];
						$user_id = $_POST['user_id'];
						$action = $_POST['action'];
						
						$query = "DELETE FROM `".$wpdb->prefix."ac_abandoned_cart_history` 
									WHERE 
									id = '$abandoned_order_id' ";
						//echo $query;
						$results = $wpdb->get_results( $query );
						
						if ($user_id >= '63000000')
						{
							$guest_query = "DELETE FROM `".$wpdb->prefix."ac_guest_abandoned_cart_history`
											WHERE id = '".$user_id."'";
							$results_guest = $wpdb->get_results($guest_query);
						}
						die();
					}
					
					//////////////////////////////////////////////////////////////
					
					function my_action_send_preview()
					{
						?>
							<script type="text/javascript" >
							
							jQuery(document).ready(function($)
							{
								jQuery("table#addedit_template input#preview_email").click(function()
								{
									//alert('hello there');
									var from_name_preview = $('#woocommerce_ac_from_name').val();
									var from_email_preview = $('#woocommerce_ac_email_from').val();
									var subject_email_preview = $('#woocommerce_ac_email_subject').val();
									var body_email_preview = tinyMCE.activeEditor.getContent();
									var send_email_id = $('#send_test_email').val();
									var reply_name_preview = $('#woocommerce_ac_email_reply').val();
									
									//alert(tinyMCE.activeEditor.getContent());
									var data = {
										from_name_preview: from_name_preview,
										from_email_preview: from_email_preview,
										subject_email_preview: subject_email_preview,
										body_email_preview: body_email_preview,
										send_email_id: send_email_id,
										reply_name_preview: reply_name_preview,
										action: 'preview_email_sent'
									};
									//var data = $('#ac_settings').serialize();
									
									// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
									$.post(ajaxurl, data, function(response)
									{
										$("#preview_email_sent_msg").html("<img src='<?php echo plugins_url(); ?>/woocommerce-abandon-cart-pro/images/check.jpg'>&nbsp;Email has been sent successfully.");
										$("#preview_email_sent_msg").fadeIn();
										setTimeout(function(){$("#preview_email_sent_msg").fadeOut();},3000);
										//alert('Got this from the server: ' + response);
									});
								});
							});
							</script>
							<?php
					}
					
					function preview_email_sent() {
						
						$from_email_name = $_POST['from_name_preview'];
						$from_email_preview = $_POST['from_email_preview'];
						$subject_email_preview = $_POST['subject_email_preview'];
						$body_email_preview = $_POST['body_email_preview'];
						$to_email_preview = $_POST['send_email_id'];
						$reply_name_preview = $_POST['reply_name_preview'];
						
						$headers[] = "From: ".$from_email_name." <".$from_email_preview.">";
						$headers[] = "Content-Type: text/html";
						$headers[] = "Reply-To:  ".$reply_name_preview." ";
						
						wp_mail( $to_email_preview, $subject_email_preview, stripslashes($body_email_preview), $headers );
				
						echo "email sent";
						
						die();
					}
					
					/////////////////////////////////////////////////////////////////////////////////
					
					function my_action_coupon_autocomplete()
					{
						if (isset($_GET['page'])) $current_page = $_GET['page'];
						else $current_page = "";
						if ( $current_page == 'woocommerce_ac_page')
						{
						?>
							<script type="text/javascript" >
							
							jQuery(function($) 
							{
								jQuery("select.ajax_chosen_select_coupons").ajaxChosen({
								    method: 	'GET',
								    url: 		woocommerce_writepanel_params.ajax_url,
								    dataType: 	'json',
								    afterTypeDelay: 100,
								    data:		{
								    	action: 		'woocommerce_json_find_coupons',
										security: 		woocommerce_writepanel_params.search_products_nonce
								    }
								}, function (data) {
							
									var terms = {};
							
								    $.each(data, function (i, val) {
								        terms[i] = val;
								    });
							
								    return terms;
								});
							});
							</script>
						<?php
						} 
					}
					
					function woocommerce_json_find_coupons( $x = '', $post_types = array('shop_coupon') ) {
					
						check_ajax_referer( 'search-products', 'security' );
					
						$term = (string) urldecode(stripslashes(strip_tags($_GET['term'])));
					
						if (empty($term)) die();
					
						if ( is_numeric( $term ) ) {
					
							$args = array(
									'post_type'			=> $post_types,
									'post_status'	 	=> 'publish',
									'posts_per_page' 	=> -1,
									'post__in' 			=> array(0, $term),
									'fields'			=> 'ids'
							);
					
							$args2 = array(
									'post_type'			=> $post_types,
									'post_status'	 	=> 'publish',
									'posts_per_page' 	=> -1,
									'post_parent' 		=> $term,
									'fields'			=> 'ids'
							);
					
							$args3 = array(
									'post_type'			=> $post_types,
									'post_status' 		=> 'publish',
									'posts_per_page' 	=> -1,
									'meta_query' 		=> array(
											array(
													'key' 	=> '_sku',
													'value' => $term,
													'compare' => 'LIKE'
											)
									),
									'fields'			=> 'ids'
							);
					
							$posts = array_unique(array_merge( get_posts( $args ), get_posts( $args2 ), get_posts( $args3 ) ));
					
						} else {
					
							$args = array(
									'post_type'			=> $post_types,
									'post_status' 		=> 'publish',
									'posts_per_page' 	=> -1,
									's' 				=> $term,
									'fields'			=> 'ids'
							);
					
							$args2 = array(
									'post_type'			=> $post_types,
									'post_status' 		=> 'publish',
									'posts_per_page' 	=> -1,
									'meta_query' 		=> array(
											array(
													'key' 	=> '_sku',
													'value' => $term,
													'compare' => 'LIKE'
											)
									),
									'fields'			=> 'ids'
							);
					
							$posts = array_unique(array_merge( get_posts( $args ), get_posts( $args2 ) ));
					
						}
					
						$found_products = array();
					
						if ($posts) foreach ($posts as $post) {
					
							$SKU = get_post_meta($post, '_sku', true);
					
							if (isset($SKU) && $SKU) $SKU = ' (SKU: ' . $SKU . ')';
					
							$found_products[$post] = get_the_title( $post ) . ' &ndash; #' . $post . $SKU;
					
						}
					
						echo json_encode( $found_products );
					
						die();
					}
					
					function woocommerce_json_search_coupons() {
						//woocommerce_json_find_coupons( '', array('coupon') );
						woocommerce_json_search_products( '', array('shop_coupon') );
					}
					
					function check_email_sent_for_order($abandoned_order_id)
					{
						global $wpdb;
					
						$query = "SELECT id FROM `".$wpdb->prefix."ac_sent_history`
						WHERE
						abandoned_order_id = '$abandoned_order_id' ";
						//echo $query;
						$results = $wpdb->get_results( $query );
					
						if (count($results) > 0)
						{
							return true;
						}
						return false;
					}
					
		}
		}		
		$woocommerce_abandon_cart = new woocommerce_abandon_cart();
		
}

?>