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


add_filter('yit_submenu_tabs_theme_option_popup_newsletter', 'yit_submenu_tabs_theme_option_popup_newsletter');
function yit_submenu_tabs_theme_option_popup_newsletter( $array ) {
    unset( $array[30] );

    return $array;
}




function yit_popup_submit_text_std(){
    return 'subscribe';
}

add_filter('yit_popup_submit_text', 'yit_popup_submit_text_std');
