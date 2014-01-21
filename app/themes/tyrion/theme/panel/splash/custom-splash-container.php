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


function yit_submenu_tabs_splash_custom_splash_container($array){
    unset($array[85]);

    return $array;
}

add_filter('yit_submenu_tabs_splash_custom_splash_container', 'yit_submenu_tabs_splash_custom_splash_container');

function yit_splash_container_width_std() {
    return 331;
}
add_filter( 'yit_splash-container_width_std', 'yit_splash_container_width_std' );

function yit_splash_container_height_std() {
    return 416;
}
add_filter( 'yit_splash-container_height_std', 'yit_splash_container_height_std' );

function yit_splash_container_submit_font_std( $array ) {

    $array['family'] = 'Lato';
    $array['size'] = 13;
    $array['style'] = 'regular';
    $array['color'] = '#fff';


    return $array;
}
add_filter( 'yit_splash-container-submit_font_std', 'yit_splash_container_submit_font_std' );

function yit_splash_container_label_font_std( $array ) {

    $array['family'] = 'Lato';
    $array['color'] = '#302e2e';
    $array['size'] = 13;
    $array['style'] = 'regular';

    return $array;
}

function yit_splash_container_lostback_font_std( $array ) {

    $array['family'] = 'Lato';
    $array['color'] = '#302e2e';
    $array['style'] = 'regular';
    $array['size'] = 12;

    return $array;
}

add_filter( 'yit_splash-container-label_font_std', 'yit_splash_container_label_font_std' );
add_filter( 'yit_splash-container-lostback_font_std', 'yit_splash_container_lostback_font_std' );

function yit_splash_container_submit_font( $array ) {

    $array['family'] = 'Lato';
    $array['color'] = '#ffffff';
    $array['style'] = 'bold';
    $array['size'] = 12;

    return $array;
}
add_filter( 'yit_splash-container-submit_font_std', 'yit_splash_container_submit_font' );

function yit_splash_container_submit_bg_color_std( $array ) {
    return '#ca4b4b';
}
add_filter( 'yit_splash-container-submit_bg_color_std', 'yit_splash_container_submit_bg_color_std' );

function yit_splash_container_submit_bg_color_hover_std( $array ) {
    return '#8D0202';
}
add_filter( 'yit_splash-container-submit_bg_color_hover_std', 'yit_splash_container_submit_bg_color_hover_std' );

function yit_splash_container_bg_color_std( $array ) {
    return '#ffffff';
}
add_filter( 'yit_splash-container-bg_color_std', 'yit_splash_container_bg_color_std' );
