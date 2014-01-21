<?php
/**
 * Checkout Form Multistep
 *
 * @author        Your Inspiration Themes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();


/* YIT Customizations */
wp_enqueue_script('yiw_checkout', get_template_directory_uri() . '/theme/assets/js/yit/jquery.yit_checkout.js', array('jquery'), '1.0.0', true);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
add_action('woocommerce_checkout_login_form', 'woocommerce_checkout_login_form', 10);

// remove the coupon form
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'yit'));
    return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters('woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url()); ?>

<?php if (sizeof($checkout->checkout_fields) > 0) : ?>

    <div class="checkout_multistep_resume group">
        <ul class="group">
            <li><a href="#" <?php if (!is_user_logged_in()) : ?>class="current"
                   <?php else: ?>class="disabled"<?php endif ?> data-step="1"><?php _e('Login/Register', 'yit') ?></a>
            </li>
            <li><a href="#" <?php if (is_user_logged_in()) : ?>class="current"<?php endif ?>
                   data-step="2"><?php _e('Customer Details', 'yit') ?></a></li>
            <li><a href="#" data-step="3"><?php _e('Order Review', 'yit') ?></a></li>
        </ul>
    </div>

    <?php do_action('woocommerce_checkout_before_customer_details'); ?>

    <?php if (!is_user_logged_in()) : ?>
        <div class="step current col2-set" id="login_register" data-step="1">
            <div class="col-1">
                <?php do_action('woocommerce_checkout_login_form') ?>
            </div>
            <div class="col-2">
                <?php woocommerce_get_template( 'checkout/form-register.php', array( 'checkout' => $checkout ) ); ?>
            </div>
        </div>
    <?php endif ?>

    <form name="checkout" method="post" class="checkout checkout_multistep"
          action="<?php echo esc_url($get_checkout_url); ?>">

        <div class="step <?php if (is_user_logged_in()) : ?>current user_logged_in <?php endif ?>col2-set"
             id="customer_details" data-step="2">
            <div class="col-1">
                <?php do_action('woocommerce_checkout_billing'); ?>
            </div>

            <div class="col-2">
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>

            <div class="checkout_buttons group">
                <?php if (!is_user_logged_in()) : ?><input type="button" value="&larr; <?php _e('Login/Register', 'yit') ?>" class="prev button" data-step="1" /><?php endif ?>
                <input type="button" value="<?php _e('Order Review', 'yit') ?> &rarr;" class="next button" data-step="3" />
            </div>
        </div>

        <div class="step order_review" data-step="3">
            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

            <h3 id="order_review_heading"><?php _e('Your order', 'yit'); ?></h3>
            <?php do_action('woocommerce_checkout_order_review'); ?>
        </div>
    </form>

<?php endif; ?>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $('.checkout_multistep').yit_checkout();
    });
</script>