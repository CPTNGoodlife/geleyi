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

$post_classes = 'hentry-post group blog-small-image span6';
$span = yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9;

$post_format = get_post_format() == '' ? 'standard' : get_post_format();
$post_format = yit_get_option( 'blog-post-formats-list' ) && get_post_format() != ''  ? get_post_format() : $post_format;




if( yit_get_option( 'blog-post-formats-list' ) ) {
    $post_classes .= ' post-formats-on-list';
}

$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true;

$upper = yit_get_option('blog-title-uppercase') ? ' upper' : '';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

                <?php yit_get_template( 'blog/small-image/post-formats/standard.php', array('span' => $span, 'has_thumbnail' => $has_thumbnail) ); ?>

                <!-- post content -->

</div>