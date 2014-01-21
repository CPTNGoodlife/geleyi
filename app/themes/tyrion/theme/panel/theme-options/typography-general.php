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
function yit_tab_typography_general( $fields ) {

    unset($fields[61], $fields[62]);

    $fields[100] = array(
        'id'   => 'back-top-font',
        'type' => 'typography',
        'name' => __( 'Back to Top font', 'yit' ),
        'desc' => __( 'Select the font for "Back to top" button. ', 'yit' ),
        'min'  => 1,
        'max'  => 18,
        'std'  => apply_filters( 'yit_back-top-font_std', array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#ffffff'
        ) ),
        'style' => apply_filters( 'yit_back-top-font_style', array(
            'selectors' => '#back-top a, #back-top a:hover',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        ) )
    );



    /*$fields[110] = array(
        'id'   => 'back-top-font-hover',
        'type' => 'colorpicker',
        'name' => __( 'Back to Top hover font', 'yit' ),
        'desc' => __( 'Select the type to use for Back to Top. ', 'yit' ),
        'std'  => apply_filters( 'yit_back-top-font-hover_std', '#b77a2b' ),
        'style' => apply_filters( 'yit_back-top-font-hover_style', array(
            'selectors' => '#back-top a:hover',
            'properties' => 'color'
        ) )
    );*/

    return $fields;
}


add_filter( 'yit_submenu_tabs_theme_option_typography_general', 'yit_tab_typography_general' );

function yit_general_font_style( $array ) {
    $array['selectors'] = 'a, p, li, address, dd, blockquote, td, th, .paragraph-links a, a.text-color, .menu-select select, .testimonial-widget li a, .testimonial-widget li p, #search_mini, .newsletter-input input, .newsletter-submit input, .features-tab-container .features-tab-labels li, .features-tab-content, .portfolio-libra .work-projects ul.pagination_nav li a, .widget.text-image, .text-color, .content_slider_text_block_wrap a';
    return $array;
}
add_filter( 'yit_general-font_style', 'yit_general_font_style' );

function yit_links_font_style( $array ) {
    $array['selectors'] = 'a, a.text-color:hover';
    return $array;
}
add_filter( 'yit_links-font_style', 'yit_links_font_style' );

function yit_links_font_hover_style( $array ) {
    $array['selectors'] = 'a:hover, body .login_register a:hover,
                            #multistep_step1 .step1_login_form form.login_checkout .lost_password:hover,
                            .portfolio-libra .work-projects ul.pagination_nav li a:hover,
                            a:hover .title-highlight,
                            .sbHolder .sbOptions a:hover,
                            .woocommerce ul.products li.product h3:hover,
                            .woocommerce ul.products li.product h3 a:hover,
                            .widget.faq-filters ul li:hover a, .widget.faq-filters ul li a.active,
                            .woocommerce .widget_layered_nav ul.yith-wcan-list li:hover a,
                            .single-product.woocommerce div.product form.variations_form a.reset_variations:hover,
                            .last-tweets p a:hover,
                            .home-row .woocommerce ul.product_list_widget li a:hover';
    return $array;
}
add_filter( 'yit_links-font-hover_style', 'yit_links_font_hover_style' );

function yit_breadcrumb_font_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb, #page-meta #yit-breadcrumb a, .breadcrumbs span';    
    return $array;
}
add_filter( 'yit_breadcrumb-font_style', 'yit_breadcrumb_font_style' );

function yit_breadcrumb_font_current_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb a.current';    
    return $array;
}
add_filter( 'yit_breadcrumb-font-current_style', 'yit_breadcrumb_font_current_style' );
 
function yit_general_font_std( $array ) {
    $array['size'] = 14;
    $array['family'] = 'Lato';
    $array['color'] = '#4b4b4b';

    return $array;
}
add_filter( 'yit_general-font_std', 'yit_general_font_std' );

add_filter( 'yit_links-font_std', create_function( '', 'return "#000";' ) );
add_filter( 'yit_links-font-hover_std', create_function( '', 'return "#ca4b4b";' ) );

function yit_breadcrumb_font_std( $array ) {
    $array['size']  = 11;
    $array['color'] = '#000000';
    $array['family'] = 'Lato';
    
    return $array;
}
add_filter( 'yit_breadcrumb-font_std', 'yit_breadcrumb_font_std' );

function yit_breadcrumb_font_hover_style( $array ) {
    $array['selectors'] = '#page-meta #yit-breadcrumb a:hover';    
    return $array;
}
add_filter( 'yit_breadcrumb-font-hover_style', 'yit_breadcrumb_font_hover_style' );

add_filter( 'yit_breadcrumb-font-hover_std', create_function( '', 'return "#ca4b4b";' ) );

add_filter( 'yit_breadcrumb-font-current_std', create_function( '', 'return "#ca4b4b";' ) );

function yit_heading_font_std( $array ) {
    $array['color'] = '#4b4b4b';
    $array['family'] = 'Lato';
    $array['style'] = 'bold';
    
    return $array;
}
add_filter( 'yit_h1-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h2-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h3-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h4-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h5-font_std', 'yit_heading_font_std' );
add_filter( 'yit_h6-font_std', 'yit_heading_font_std' );

function yit_heading1_font_std( $array ) { $array['size'] = 30; return $array; }
add_filter( 'yit_h1-font_std', 'yit_heading1_font_std' );

function yit_heading2_font_std( $array ) { $array['size'] = 28; return $array; }
add_filter( 'yit_h2-font_std', 'yit_heading2_font_std' );

function yit_heading3_font_std( $array ) { $array['size'] = 24; return $array; }
add_filter( 'yit_h3-font_std', 'yit_heading3_font_std' );

function yit_heading4_font_std( $array ) { $array['size'] = 18; return $array; }
add_filter( 'yit_h4-font_std', 'yit_heading4_font_std' );

function yit_heading5_font_std( $array ) { $array['size'] = 15; return $array; }
add_filter( 'yit_h5-font_std', 'yit_heading5_font_std' );

function yit_heading6_font_std( $array ) { $array['size'] = 13; return $array; }
add_filter( 'yit_h6-font_std', 'yit_heading6_font_std' );

function yit_highlight_color_std() {
    return '#9f0808';
}
add_filter( 'yit_highlight-color_std', 'yit_highlight_color_std' );

function yit_highlight_color_style( $array ) {
    $array['selectors'] = 'h1 span.title-highlight, h2 span.title-highlight, h3 span.title-highlight, h4 span.title-highlight, h5 span.title-highlight, h6 span.title-highlight, .box-sections span.title-highlight, .box-sections-border span.title-highlight';
    return $array;
}
add_filter( 'yit_highlight-color_style', 'yit_highlight_color_style' );

function yit_special_font_std( $array ) {
    $array['family'] = 'Lato';
    
    return $array;
}
add_filter( 'yit_special-font_std', 'yit_special_font_std' );

function yit_special_font_style( $array ) {
    $array['selectors'] = '.special-font, #header #logo #tagline span.special-font';    
    return $array;
}
add_filter( 'yit_special-font_style', 'yit_special_font_style' );