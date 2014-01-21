<?php 

require_once('../../../wp-load.php');
global $wpdb;

$email_sent_id = $_GET['email_sent_id'];
$user_id = $_GET['user_id'];
$url = $_GET['url'];
//echo $url;
//session_start();
$user = wp_set_current_user( $user_id );

//if (!isset($user))
{
	if ($user_id >= "63000000")
	{
		$query_guest = "SELECT * from `". $wpdb->prefix."ac_guest_abandoned_cart_history`
	 					WHERE id = '".$user_id."'";
		$results_guest = $wpdb->get_results($query_guest);
		
		$query_cart = "SELECT recovered_cart FROM `".$wpdb->prefix."ac_abandoned_cart_history`
						WHERE user_id = '".$user_id."'";
		$results = $wpdb->get_results($query_cart);
	//	print_r($results);
		if ($results_guest  && $results[0]->recovered_cart == '0')
		{
		//	echo "Entered if";
			$_SESSION['guest_first_name'] = $results_guest[0]->billing_first_name;
			$_SESSION['guest_last_name'] = $results_guest[0]->billing_last_name;
			$_SESSION['guest_email'] = $results_guest[0]->email_id;
			$_SESSION['user_id'] = $user_id;
		}
		else 
		{
			wp_redirect(get_permalink(woocommerce_get_page_id('shop')));
		//	echo "entered else";
		}
	}
}
if ($user_id < "63000000")
{
	$user_login = $user->data->user_login;
	
	wp_set_auth_cookie($user_id);
	$my_temp = woocommerce_load_persistent_cart($user_login,$user);
	
	//add_action( 'wp_login', 'woocommerce_load_persistent_cart', 1, 2 );
	do_action('wp_login', $user_login);
	
	if ( isset($sign_in) && is_wp_error($sign_in) )
	{
		echo $sign_in->get_error_message();
		exit;
	}
}
else
{
	$my_temp = woocommerce_load_guest_persistent_cart($user_id);
}
if ( $email_sent_id > 0 && is_numeric($email_sent_id) )
{
	$query = "INSERT INTO `".$wpdb->prefix."ac_link_clicked_email` (email_sent_id, link_clicked, time_clicked)
	VALUES ('".$email_sent_id."', '".$url."', '".current_time('mysql')."' )";
	mysql_query($query);
	header("Location: $url");
}

function woocommerce_load_guest_persistent_cart()
{
	global $woocommerce;
	
	$saved_cart = json_decode(get_user_meta( $_SESSION['user_id'], '_woocommerce_persistent_cart', true ), true);
	
	$c = array();
	$cart_contents_total = $cart_contents_weight = $cart_contents_count = $cart_contents_tax = $total = $subtotal = $subtotal_ex_tax = $tax_total = 0;
	foreach ($saved_cart as $key => $value)
	{
		foreach ($value as $a => $b)
		{
			$c['product_id'] = $b['product_id'];
			$c['variation_id'] = $b['variation_id'];
			$c['variation'] = $b['variation'];
			$c['quantity'] = $b['quantity'];
			$product_id = $b['product_id'];
			$c['data'] = get_product($product_id);
			
			$value_new[$a] = $c;
			
			$cart_contents_total = $b['line_subtotal'] + $cart_contents_total;
			$cart_contents_count = $cart_contents_count + $b['quantity'];
			$total = $total + $b['line_total'];
			$subtotal = $subtotal + $b['line_subtotal'];
			$subtotal_ex_tax = $subtotal_ex_tax + $b['line_subtotal'];
		}
		$saved_cart_data[$key] = $value_new;
		$woocommerce_cart_hash = $a;
	}
	
	/*echo "CART IS <pre>";
	print_r($saved_cart_data);
	echo "</pre>";
	exit;*/
	
	if ( $saved_cart )
	{
		if ( empty( $woocommerce->session->cart ) || ! is_array( $woocommerce->session->cart ) || sizeof( $woocommerce->session->cart ) == 0 )
		{
			/*$woocommerce->cart->cart_contents = $saved_cart_data['cart'];
			$woocommerce->cart->cart_contents_total  = 200;
			$woocommerce->cart->cart_contents_weight = 0;
			$woocommerce->cart->cart_contents_count  = 1;
			$woocommerce->cart->cart_contents_tax    = 0;
			$woocommerce->cart->total                = 200.00;
			$woocommerce->cart->subtotal             = 200;
			$woocommerce->cart->subtotal_ex_tax      = 200;
			$woocommerce->cart->tax_total            = 0;
			$woocommerce->cart->shipping_taxes       = array();
			$woocommerce->cart->taxes                = array();*/

			$woocommerce->session->cart = $saved_cart['cart'];
			$woocommerce->session->cart_contents_total  = $cart_contents_total;
			$woocommerce->session->cart_contents_weight = $cart_contents_weight;
			$woocommerce->session->cart_contents_count  = $cart_contents_count;
			$woocommerce->session->cart_contents_tax    = $cart_contents_tax;
			$woocommerce->session->total                = $total;
			$woocommerce->session->subtotal             = $subtotal;
			$woocommerce->session->subtotal_ex_tax      = $subtotal_ex_tax;
			$woocommerce->session->tax_total            = $tax_total;
			$woocommerce->session->shipping_taxes       = array();
			$woocommerce->session->taxes                = array();
			
			$woocommerce->session->ac_customer = array();
		//	$woocommerce->session->ac_customer->country = 'IN';
		}
	}
	//echo 'here '. md5 (json_encode ($woocommerce->cart->get_cart() ) );
			
	//echo 'hash is '.COOKIEPATH.' and domain is '.COOKIE_DOMAIN;
	/*echo 'hash is '.$woocommerce_cart_hash;
	echo '<br>'.$_SERVER['HTTP_HOST']; 
	exit;*/
	//define(COOKIE_DOMAIN,'.staging.tychesoftwares.com');
	
	//setcookie( "woocommerce_items_in_cart", "1", 0, COOKIEPATH, COOKIE_DOMAIN, false );
	//setcookie( "woocommerce_cart_hash", md5( json_encode( $this->get_cart() ) ), 0, COOKIEPATH, COOKIE_DOMAIN, false );
	//setcookie( "woocommerce_cart_hash", $woocommerce_cart_hash, 0, COOKIEPATH, COOKIE_DOMAIN, false );

	//echo ' woo obj is <pre>';print_r($woocommerce);echo '</pre>';
}

?>