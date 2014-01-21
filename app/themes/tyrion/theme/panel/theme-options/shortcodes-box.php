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


function yit_tab_shortcodes_box( $items ) {
    unset($items[30]);
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_shortcodes_box', 'yit_tab_shortcodes_box' );



add_filter( 'yit_success-box_std', create_function('',"return array(
            'size'   => 19,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#677932'
			);")
);

add_filter( 'yit_arrow-box_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#599847'
			);")
);


add_filter( 'yit_alert-box_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#CA6B1C'
			);")
);

add_filter( 'yit_error-box_std', create_function('',"return array(
            'size'   => 19,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#900606'
			);")
);

add_filter( 'yit_notice-box_std', create_function('',"return array(
            'size'   => 19,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#21221e'
			);")
);

add_filter( 'yit_info-box_std', create_function('',"return array(
            'size'   => 19,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'regular',
            'color'  => '#40606d'
			);")
);

add_filter( 'yit_box-sections_std', create_function('',"return array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'Lato',
            'style'  => 'bold',
            'color'  => '#0a0a0a'
			);")
);