<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $woocommerce;

?>

<?php if ($checkout->enable_signup): ?>
    <form method="post" class="register">

    <h3><?php _e('I\'m new here', 'yit') ?></h3>

        <?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

        <p class="form-row form-row-first">
            <label for="reg_username"><?php _e( 'Username', 'yit' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
        </p>

    <p class="form-row form-row-last">

    <?php else : ?>

        <p class="form-row form-row-wide">

            <?php endif; ?>

            <label for="reg_email"><?php _e( 'Email', 'yit' ); ?> <span class="required">*</span></label>
            <input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
        </p>

        <div class="clear"></div>

        <p class="form-row form-row-first">
            <label for="reg_password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
            <input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
        </p>
        <p class="form-row form-row-last">
            <label for="reg_password2"><?php _e( 'Re-enter password', 'yit' ); ?> <span class="required">*</span></label>
            <input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
        </p>
        <div class="clear"></div>

        <!-- Spam Trap -->
        <div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

        <?php do_action( 'register_form' ); ?>

        <div class="checkout_buttons">
            <p class="form-row">
                <?php $woocommerce->nonce_field('register', 'register') ?>
                <input type="hidden" name="yit_checkout" value="true" />

                <?php if( get_option('woocommerce_enable_guest_checkout')=="yes" ): ?>
                <input type="button" class="guest next button" value="<?php _e( 'Checkout as guest', 'yit' ); ?>" data-step="2" />
                <?php endif ?>

                <input type="submit" class="button" name="register" value="<?php _e( 'Register', 'yit' ); ?>" />
            </p>
        </div>

    </form>
<?php elseif( get_option('woocommerce_enable_guest_checkout')=="yes" ): ?>
    <div class="checkout_buttons">
        <input type="button" class="guest next button" value="<?php _e( 'Checkout as guest', 'yit' ); ?>" data-step="2" />
    </div>
<?php endif ?>