<?php
/**
 * Plugin Name: Yith WooCommerce Hide Price
 * Description: Hide products prices to unregistered users.
 * Version: 1.0.0
 * Author: Your Inspiration Themes
 * Author URI: www.yithemes.com
 * License: 
 */

if( is_admin() ) {
	include_once 'hide-price-admin.php';
}

if(get_option('yith_hide_price_enable_plugin')=='yes'){

	// Remove the price
	add_filter('woocommerce_get_price_html','members_only_price');
	function members_only_price($price){
		if(is_user_logged_in() ){
		    return $price;
		} else {
			return '<p style="color:'. get_option('yith_hide_price_change_color') .'"><a style="display:inline; color:'. get_option('yith_hide_price_change_color') .'" href="' .get_permalink(woocommerce_get_page_id('myaccount')). '">'. get_option('yith_hide_price_link_text') .'</a> '. get_option('yith_hide_price_text').'</p>';
		}
	}
	//Remove the add to cart
	function woocommerce_template_single_add_to_cart() {
		if ( ! is_user_logged_in() ) return;

		global $product;
		do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );
	}
	//Remove the add to cart
	function woocommerce_template_loop_add_to_cart() {
		if ( ! is_user_logged_in() ) return;

		woocommerce_get_template( 'loop/add-to-cart.php' );
	}
}