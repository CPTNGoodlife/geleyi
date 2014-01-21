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
 
global $post;

$post_id = yit_post_id();

// use static header image
if ( isset( $post_id ) && yit_get_post_meta( $post_id, '_use_static_image' ) ) { 
    $image_url = yit_get_post_meta( $post_id, '_static_image' );
    $image_size = yit_getimagesize($image_url);
    $image_id = yit_get_attachment_id( $image_url );
    list( $thumb_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id );
    $static_image_link = yit_get_post_meta( $post_id, '_static_image_link' );


    if( yit_get_post_meta($post_id, '_enable_parallax_effect') ):

        $height = yit_get_post_meta($post_id, '_parallax_height');
        $color = yit_get_post_meta($post_id, '_parallax_color');
        $hover_color = yit_get_post_meta($post_id, '_parallax_hover_color');
        $valign = yit_get_post_meta($post_id, '_parallax_valign');
        $halign = yit_get_post_meta($post_id, '_parallax_halign');
        $effect = yit_get_post_meta($post_id, '_parallax_effect');
        $button_size = yit_get_post_meta($post_id, '_parallax_button_size');
        $content = yit_get_post_meta($post_id, '_parallax_content');

        $parallax = "[parallax ";
        $parallax .= " image='{$image_url}' ";
        if( $height ) $parallax .= " height='{$height}' ";
        if( $color ) $parallax .= " color='{$color}' ";
        if( $hover_color ) $parallax .= " hover_color='{$hover_color}' ";
        if( $valign ) $parallax .= " valign='{$valign}' ";
        if( $halign ) $parallax .= " halign='{$halign}' ";
        if( $effect ) $parallax .= " effect='{$effect}' ";
        if( $button_size ) $parallax .= " button_size='{$button_size}' ";

        $parallax .= "]";

        if( $content ) $parallax .= $content;
        $parallax .= '[/parallax]';

        echo '<div class="header-parallax">' . do_shortcode($parallax) . '</div>';

    else: ?>
	    <div class="slider fixed-image inner group">
			<div class="fixed-image-wrapper" style="max-width: <?php echo $image_size[0] ?>px;">
	        	<?php if( !empty( $static_image_link ) ) : ?><a href="<?php echo $static_image_link ?>" title="" target="<?php echo yit_get_post_meta( $post_id, '_static_image_target' ) ?>"><?php endif ?>
                    <img src="<?php echo yit_get_post_meta( $post_id, '_static_image' ) ?>" alt="<?php bloginfo('name') ?> Header" />
                <?php if( !empty( $static_image_link ) ) : ?></a><?php endif ?>
			</div>
	    </div>
	<?php
        define( 'YIT_SLIDER_USED', true );
    endif;
		
// use static header of Appearance -> Header
} elseif ( get_header_image() != '' ) {

?>
	    <div class="slider fixed-image inner group">
			<div class="fixed-image-wrapper" style="max-width: <?php echo get_custom_header()->width ?>px;">
	        	<img src="<?php header_image() ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name') ?> Header" />
            </div>
	    </div>
	<?php
    define( 'YIT_SLIDER_USED', true );
    
// use the slider
} else {
    yit_slider();
}