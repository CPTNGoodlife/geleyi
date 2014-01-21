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

/*
Template name: My Account

Template used for shop account pages.
*/

get_header();

$_isLoggedIn = is_user_logged_in();

do_action( 'yit_before_primary' ) ?>
    <!-- START PRIMARY -->
    <div id="primary" class="sidebar-no">
        <div class="container group">
            <div class="row">
                <?php do_action( 'yit_before_content' ) ?>
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group my-account-page-template<?php if( $_isLoggedIn ) echo ' my-account-page-template-loggedin' ?>">
                    <div class="row">
                        <?php if( $_isLoggedIn ): ?>
                        <!-- MY ACCOUNT -->
                        <div class="span3">

                            <div class="my-account-box group">
                                <header class="title">
                                    <h3><?php _e('My Account', 'yit') ?></h3>
                                </header>

                                <div class="my-account-box-content group">
                                    <?php
                                    $current_user = wp_get_current_user();
                                    $user_id = $current_user->ID;
                                    echo get_avatar( $user_id, 63 );
                                    ?>

                                    <span class="username"><?php echo $current_user->display_name?></span>
                                    <span class="logout"><a href="<?php echo wp_logout_url(); ?>"><?php _e('logout', 'yit') ?></a></span>
                                </div>
                                <div class="facebook-unlink">
                                    <?php if( defined('NEW_FB_LOGIN') && NEW_FB_LOGIN == 1 && function_exists('new_fb_is_user_connected') && new_fb_is_user_connected() && function_exists('new_fb_unlink_button')): ?>
                                        <?php echo '<a href="' . new_fb_login_url() . '&action=unlink&redirect=' . new_fb_curPageURL() . '">'.__('Unlink Account', 'yit').'</a>'; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /MY ACCOUNT -->
                        <?php endif ?>

                        <div class="span<?php echo $_isLoggedIn ? 9 : 12 ?>">
                            <?php if ( has_nav_menu( 'my-account-page' ) && $_isLoggedIn ) : ?>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'my-account-page',
                                    'menu_class'      => 'tabs-nav group',
                                    'container_class' => 'menu-account-menu-page-container',
                                    'depth' => 0,
                                ));
                                ?>
                            <?php endif; ?>

                            <?php do_action( 'yit_loop_page' ); ?>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
                <?php do_action( 'yit_after_content' ) ?>

                <!-- START EXTRA CONTENT -->
                <?php do_action( 'yit_extra_content' ) ?>
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>