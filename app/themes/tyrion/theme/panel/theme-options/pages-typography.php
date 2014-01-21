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

function yit_pages_404_font_std( $array ) {
    $array['size'] = 13;
    $array['family'] = 'Lato';
	$array['style']  = 'regular';
    $array['color']  = '#666767';
    
    return $array;
}
add_filter( 'yit_pages-404-font_std', 'yit_pages_404_font_std' );

function yit_pages_404_font_style( $array ) {
    $array['selectors'] = '.error-404-text p, .error-404-text p a';
    
    return $array;
}
add_filter( 'yit_pages-404-font_style', 'yit_pages_404_font_style' );

add_filter( 'yit_pages-404-a-font_std', create_function('', 'return "#302e2e";') );
add_filter( 'yit_pages-404-a-font-hover_std', create_function('', 'return "#ca4b4b";') );

add_filter('yit_submenu_tabs_theme_option_pages_typography', 'yit_submenu_tabs_theme_option_pages_typography');
function yit_submenu_tabs_theme_option_pages_typography($items) {
    $items[5] = array(
        'id'   => 'pages-404-title-font',
        'type' => 'typography',
        'name' => __( 'Pages 404 title font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min'  => 10,
        'max'  => 60,
        'std'  => apply_filters( 'yit_pages-404-title-font_std', array(
            'size'   => 25,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'bold',
            'color'  => '#302e2e'
        ) ),
        'style' => apply_filters( 'yit_pages-404-title-font_style', array(
            'selectors' => '.error404 .error-404-text h2',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        ) ),
    );

    return $items;
}