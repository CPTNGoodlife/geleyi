<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;

?>
<?php




if( !yit_get_option('shop-checkout-multistep') ) {

    if ( !(is_user_logged_in()) ) :
    ?>
        <div class="checkout-wrapper">
    <?php
        // Not Logged in
        yit_woocommerce_loginfobox();

    endif;

}
?>

<form method="post" class=" login" style="box-sizing: border-box;">

    <h3><?php _e('I already have an account here', 'yit') ?></h3>

    <p class="form-row form-wide">
        <label for="username"><?php _e( 'Username or email', 'yit' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="username" id="username" />
    </p>
    <p class="form-row form-wide">
        <label for="password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
        <input class="input-text" type="password" name="password" id="password" />
    </p>
    <div class="clear"></div>

    <p class="form-row">
        <a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e( 'Lost Password?', 'yit' ); ?></a>
        <?php $woocommerce->nonce_field('login', 'login') ?>
        <input type="submit" class="red-button" name="login" value="<?php _e( 'Login', 'yit' ); ?>" />
        <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
    </p>

    <div class="clear"></div>
</form>
</div>