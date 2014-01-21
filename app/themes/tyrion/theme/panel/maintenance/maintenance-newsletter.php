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


function yit_maintenance_newsletter_background_std(){
    return '#000000';
}

add_filter( 'yit_maintenance-newsletter-background_std' , 'yit_maintenance_newsletter_background_std');

function yit_maintenance_enable_newsletter_background_hover_std(){
    return '#302e2e';
}

add_filter( 'yit_maintenance-enable-newsletter-background_hover_std' , 'yit_maintenance_enable_newsletter_background_hover_std');



function yit_maintenance_newsletter_font_std( $array ) {
    $array['family'] = 'Lato';
	$array['size'] = 13;
	$array['color'] = '#656565';
    
    return $array;
}
add_filter( 'yit_maintenance-newsletter-font_std', 'yit_maintenance_newsletter_font_std' );

function yit_maintenance_newsletter_submit_font_std( $array ) {
    $array['family'] = 'Lato';
    $array['size'] = 12;
    $array['color'] = '#e1e1e1';
    $array['style'] = 'bold';
    return $array;
}
add_filter( 'yit_maintenance-newsletter-submit-font_std', 'yit_maintenance_newsletter_submit_font_std' );