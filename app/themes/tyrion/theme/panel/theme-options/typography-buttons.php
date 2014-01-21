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

function yit_add_typography_buttons_tab( $tabs ) {
    $new_tab = array( 'buttons' => __( 'Buttons', 'yit' ) );

    yit_array_splice_assoc( $tabs['typography'], $new_tab, 'footer' );

    return $tabs;
}
add_filter( 'yit_admin_submenu_theme_options', 'yit_add_typography_buttons_tab' );