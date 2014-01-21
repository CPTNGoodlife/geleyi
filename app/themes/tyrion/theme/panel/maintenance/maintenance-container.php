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



function yit_maintenance_container_message_font_std( $array ) {
    $array['family'] = 'Lato';
    $array['color'] = '#525251';
    $array['size'] = '13';
    return $array;
}
add_filter( 'yit_maintenance-container-message-font_std', 'yit_maintenance_container_message_font_std' );

function yit_maintenance_container_height_std( $array ) {
    return '264';
}
add_filter( 'yit_maintenance-container_height_std', 'yit_maintenance_container_height_std' );

function yit_maintenance_container_bg_color( $array ) {
    return 'transparent';
}
add_filter( 'yit_maintenance-container-bg_color_std', 'yit_maintenance_container_bg_color' );


function yit_maintenance_container_width_std( $array ) {
    return '470';
}
add_filter( 'yit_maintenance-container_width_std', 'yit_maintenance_container_width_std' );


