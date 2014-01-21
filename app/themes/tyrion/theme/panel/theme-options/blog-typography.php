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

function yit_submenu_tabs_theme_option_blog_typography( $items ) {

    $items[12] = array(
        'id'   => 'yit_subtitle-font',
        'type' => 'typography',
        'name' => __( 'Subtitle Font', 'yit' ),
        'desc' => __( 'Select the font for the subtitles. ', 'yit' ),
        'min'  => 1,
        'max'  => 22,
        'std'  => apply_filters( 'yit_subtitle-font_std', array(
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'light',
            'color'  => '#4d4b4b'
        ) ),
        'style' => apply_filters( 'yit_subtitle-font_style', array(
            'selectors' => '.the-content-post .post-subtitle',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        ) )
    );

    $items[11] = array(
        'id'   => 'yit_blog-post-font',
        'type' => 'typography',
        'name' => __( 'Post\'s font', 'yit' ),
        'desc' => __( 'Select the font for the blog posts. ', 'yit' ),
        'min'  => 1,
        'max'  => 18,
        'std'  => apply_filters( 'yit_blog-post-font_std', array(
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#4d4b4b'
        ) ),
        'style' => apply_filters( 'yit_blog-post-font_style', array(
            'selectors' => '.the-content-post p',
            'properties' => 'font-size, font-family, color, font-style, font-weight'
        ) )
    );

    $items[14] = array(
        'id'   => 'blog-title-hover-color',
        'type' => 'colorpicker',
        'name' => __( 'Title hover color', 'yit' ),
        'desc' => __( 'Choose the font color for the title hover.', 'yit' ),
        'std'  => apply_filters( 'yit_blog-title-hover-color_std', '#ca4b4b'),
        'style' => apply_filters('yit_blog-title-hover-color_style',array(
            'selectors' => '.post-title:hover, .post-title a:hover, .blog-big .meta .post-title a:hover,
                            .hentry-post .post-title > a:hover,  .blog-big-image .blog-big-image-content h2 a:hover',
            'properties' => 'color'
        ))
    );

     $items[13] = array(
        'id'   => 'blog-postfooter-link-color',
        'type' => 'colorpicker',
        'name' => __( 'Meta link color', 'yit' ),
        'desc' => __( 'Choose the link font color for the meta information', 'yit' ),
        'std'  => apply_filters( 'yit_blog-postfooter-link-color_std', '#000000'),
        'style' => apply_filters('yit_blog-postfooter-link-color_style',array(
            'selectors' => '.blog-small-image-content .meta p a, .blog-pinterest .meta div p a, .blog-big-image .meta p a',
            'properties' => 'color'
        ))
    );

     $items[15] = array(
        'id'   => 'blog-postfooter-link-hover-color',
        'type' => 'colorpicker',
        'name' => __( 'Meta link hover color', 'yit' ),
        'desc' => __( 'Choose the link hover font color for the meta information', 'yit' ),
        'std'  => apply_filters( 'yit_blog-postfooter-link-hover-color_std', '#736e6e'),
        'style' => apply_filters('yit_blog-postfooter-link-hover-color_style',array(
            'selectors' => '.blog-small-image-content .meta p a:hover, .blog-pinterest .meta div p a:hover,  .blog-big-image .meta p a:hover',
            'properties' => 'color'
        ))
    );

    $items[16] = array(
        'id'   => 'blog-title-uppercase',
        'type' => 'onoff',
        'name' => __( 'Force title uppercase', 'yit' ),
        'desc' => __( 'Set uppercase for all titles of the blog.', 'yit' ),
        'std'  => 0
    );

    /* Remove blog meta font and blog meta font hover */
    unset($items[20]);
    unset($items[21]);

    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_blog_typography', 'yit_submenu_tabs_theme_option_blog_typography' );
 
function yit_blog_title_std( $array ) {
    $array['color'] = '#4d4b4b';
    $array['family'] = 'Lato';
    $array['style'] = 'extra-bold';
    $array['size'] = 24;
    
    return $array;    
}
add_filter( 'yit_blog-title-font_std', 'yit_blog_title_std' );

function yit_blog_title_style( $array ) {
    $array['selectors'] = '.post-title, .blog-big .meta .post-title a, .blog-small .meta .post-title a,
    .blog-big-image .blog-big-image-content h2, .blog-big-image .blog-big-image-content h2 a';
    return $array;    
}
add_filter( 'yit_blog-title-font_style', 'yit_blog_title_style' );

function yit_section_blog_post_title_std( $array ) {
    $array['color'] = '#0a0a0a';
    $array['family'] = 'Lato';
    $array['style'] = 'bold';
    $array['size'] = 11;
    
    return $array;    
}
add_filter( 'yit_section-blog-post-title_std', 'yit_section_blog_post_title_std' );
function yit_section_blog_post_title_style( $array ) {
    $array['selectors'] = '.section.blog .description h3 a, .section.blog div.figure h3 a';
    return $array;    
}
add_filter( 'yit_section-blog-post-title_style', 'yit_section_blog_post_title_style' );

function yit_section_blog_post_title_hover_std( $array ) {
    return '#ca4b4b';
}
add_filter( 'yit_section-blog-post-title-hover_std', 'yit_section_blog_post_title_hover_std' );

function yit_section_blog_post_title_hover_style( $array ) {
    $array['selectors'] = '.section.blog .description h3 a:hover';
    return $array;  
}
add_filter( 'yit_section-blog-post-title-hover_style', 'yit_section_blog_post_title_hover_style' );

function yit_section_blog_metas_std( $array ) {
    $array['family'] = 'Lato';
    $array['color'] = '#5F5E5E';
    return $array;    
}
add_filter( 'yit_blog-meta-font_std', 'yit_section_blog_metas_std' );

function yit_section_blog_metas_style( $array ) {
    $array['selectors'] = '.blog-big .meta div p, .blog-big .meta div p a, .blog-pinterest .meta div p, .blog-pinterest .meta div p a';
    return $array;    
}
add_filter( 'yit_blog-meta-font_style', 'yit_section_blog_metas_style' );