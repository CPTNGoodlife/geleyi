<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */

global $is_primary, $yit_is_parallax_slider;
define( 'YIT_SLIDER_USED', true );

wp_enqueue_script('owl-carousel');

$slider_type = yit_slide_get( 'slider_type' );
$height = yit_slide_get( 'height' );
$autoplay = yit_slide_get( 'autoplay' );
$autoplay_speed = yit_slide_get( 'autoplay_speed' ) * 1000;

$slider_class = '';
$yit_is_parallax_slider = true;
?>

<div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?> style="height: <?php echo $height; ?>px; overflow: hidden; margin-top: -20px">
    <?php while( yit_have_slide() ) : ?>

        <?php
            $color = yit_slide_get('color');
            $hover_color = yit_slide_get('hover_color');
            $valign = yit_slide_get('valign');
            $halign = yit_slide_get('halign');
            $effect = yit_slide_get('effect');
            $button_size = yit_slide_get('button_size');
            $content = yit_slide_get('content');
            $image_url = yit_image( "id=" . yit_slide_get('item_id') . "&output=url&echo=0" );

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
        ?>
        <div class="slider-parallax-item" data-effect="<?php echo $effect ?>"><?php echo do_shortcode($parallax); ?></div>
    <?php endwhile; ?>
</div>
<script type="text/javascript">

    jQuery(document).ready(function($){
        $('.slider-parallax').imagesLoaded(function(){
            $(this).owlCarousel({
                singleItem:true,
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,

                //stopOnHover : true,
                beforeInit: function() {
                    $('.slider-parallax-item').each(function(){
                        $(this)
                            .addClass('parallaxeos_slider')
                            .find('.parallaxeos_animate').removeClass('animated');
                    });

                    //$('.slider-parallax .owl-controls, .slider-parallax .owl-pagination').css('z-index', 10);
                },
                afterAction: function(current) {
                    current.find('.parallaxeos_animate').removeClass('animated');
                    setTimeout(function(){
                        current.find('.parallaxeos_animate').addClass('animated');
                    }, 50);
                }
            });

            $('.parallaxeos').waypoint(function() {
                $(this).parallaxeos({
                    initialOffset : 77
                });
            },{offset: '200%'});

            $(document).scroll(function(){
                if( $(window).scrollTop() == 0 ) {
                    $('.slider-parallax .parallaxeos').css('background-position', '50% 0');
                }
            })
        });
    });

</script>
<?php
$yit_is_parallax_slider = false;
?>