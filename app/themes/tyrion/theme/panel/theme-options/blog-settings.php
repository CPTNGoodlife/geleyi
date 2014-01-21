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

function yit_blog_type_options( $array ) {
    $array['small-image'] = __( 'Small Image', 'yit' );
    $array['big']         = __( 'Big Thumbnail', 'yit' );

    return $array;
}
add_filter( 'yit_blog-type_options', 'yit_blog_type_options' );
 
function yit_tab_blog_settings( $items ) {

    unset( $items[66], $items[72], $items[74], $items[76], $items[78]  );

    $items[51] = array(
        'id'   => 'blog-single-type',
        'type' => 'select',
        'name' => __( 'Blog single type', 'yit' ),
        'desc' => __( 'Choose the layout for your blog in the post detail page.', 'yit' ),
        'options' => array(
            'big' => __( 'Big Thumbnail', 'yit' ),
        ),
        'std' => $items[50]['std'] // Same blog type of the list
    );

    $items[75] = array(
        'id'   => 'blog-show-categories',
        'type' => 'onoff',
        'name' => __( 'Show categories', 'yit' ),
        'desc' => __( 'Select if you want to show the categories links.', 'yit' ),
        'std'  => apply_filters( 'yit_blog-show-categories_std', 1 ),
    );

    $items[91] = array(
        'id'   => 'blog-show-share',
        'type' => 'onoff',
        'name' => __( 'Show share', 'yit' ),
        'desc' => __( 'Select if you want to show the share buttons.', 'yit' ),
        'std'  => apply_filters( 'yit_blog-show-share_std', 1 ),
    );

    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_blog_settings', 'yit_tab_blog_settings' );

add_filter( 'yit_blog_read_more_text_std', create_function( '', 'return "READ MORE";' ) );

add_filter( 'yit_blog-type_std', create_function( '', 'return "big";' ) );
