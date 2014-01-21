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
?>


<div id="header-container" class="header_skin1 container">
    <!-- START LOGO -->
    <?php do_action( 'yit_before_logo' ) ?>
    <div id="logo">
        <?php
        /**
         * @see yit_logo
         */
        do_action( 'yit_logo' ) ?>
    </div>
    <?php do_action( 'yit_after_logo' ) ?>
    <!-- END LOGO -->


    <!-- START HEADER SIDEBAR -->
    <div id="header-sidebar"<?php if ( ! yit_get_option('responsive-show-header-sidebar') ) echo ' class="hidden-phone"' ?>>
        <?php get_sidebar( 'header' ) ?>
    </div>
    <?php do_action( 'yit_after_header_sidebar' ); ?>
    <!-- END HEADER SIDEBAR -->


    <!-- START NAVIGATION -->
    <div id="nav"<?php if( yit_get_option('header-menu-posution') == 'left' ): ?> class="below-the-logo"<?php endif ?>>
        <?php
        do_action( 'yit_main_navigation') ?>
    </div>
    <?php do_action( 'yit_after_main_navigation' ); ?>
    <!-- END NAVIGATION -->
</div>