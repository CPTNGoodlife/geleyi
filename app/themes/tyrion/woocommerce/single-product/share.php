<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    // add share for single product
    global $woocommerce_loop;
    if ( ! isset( $woocommerce_loop ) && yit_get_option('shop-single-show-share') ) {
    echo '<div class="product-share">' . do_shortcode('[share icon_type="simple-black" socials="facebook, twitter, google, pinterest, bookmark"]') . '</div><div class="clearfix"></div>';
    }

?>
<?php do_action('woocommerce_share'); // Sharing plugins can hook into here ?>