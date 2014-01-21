<?php

global $yit_is_parallax_slider;

if( !$image ) return;

$id = 'parallaxeos_' . mt_rand();
$height = $height ? (int)$height : 600;
$valign = $valign ? $valign : 'center';
$halign = $halign ? $halign : 'center';
$effect = $effect ? $effect : 'fadeIn';
$color = $color ? $color : '#fff';
$hover_color = $hover_color ? $hover_color : '#000';
$button_size = $button_size ? $button_size : 'small';

$velocity = $yit_is_parallax_slider ? 0.6 : 0.2;

wp_enqueue_script( 'jquery-parallaxeos', get_template_directory_uri() . '/theme/assets/js/jquery.parallaxeos.js', array('jquery'), '1.0.0', true );

?>
<style type="text/css">
#<?php echo $id ?> .parallaxeos_animate,
#<?php echo $id ?> .parallaxeos_animate h1,
#<?php echo $id ?> .parallaxeos_animate h2,
#<?php echo $id ?> .parallaxeos_animate h3,
#<?php echo $id ?> .parallaxeos_animate h4,
#<?php echo $id ?> .parallaxeos_animate h5,
#<?php echo $id ?> .parallaxeos_animate h6,
#<?php echo $id ?> a,
#<?php echo $id ?> p,
#<?php echo $id ?> .parallaxeos_container .testimonials-slider a:hover {
    color: <?php echo $color ?>;
}
#<?php echo $id ?> .parallaxeos_animate h1 {
    font-size: 60px;
    font-weight: 800;
    padding-bottom: 10px;
}
#<?php echo $id ?> .parallaxeos_animate h2 {
    font-size: 36px;
    font-weight: 800;
}
#<?php echo $id ?> .parallaxeos_animate h3 {
    font-size: 36px;
    font-weight: 400;
}
#<?php echo $id ?> .parallaxeos_animate h4,
#<?php echo $id ?> .parallaxeos_animate h5,
#<?php echo $id ?> .parallaxeos_animate h6 {
    font-size: 30px;
    font-weight: 400;
}
#<?php echo $id ?> a {
    border-color: <?php echo $color ?>;
}
#<?php echo $id ?> a:hover {
    background-color: <?php echo $color ?>;
    color: <?php echo $hover_color ?>;
}
</style>
<div id="<?php echo $id ?>" class="parallaxeos_outer parallaxeos_button_<?php echo $button_size ?> group" style="height:<?php echo $height ?>px">
    <div class="parallaxeos_container" style="height:<?php echo $height ?>px">
        <?php if($content): ?>
        <div class="parallaxeos_content container">
                <div class="parallaxeos_animate <?php echo $effect ?> horizontal_<?php echo $halign ?> vertical_<?php echo $valign ?>">
                    <?php echo do_shortcode($content) ?>
                </div>
        </div>
        <?php endif ?>
        <div class="parallaxeos" data-velocity="<?php echo $velocity ?>" style="background-image:url(<?php echo $image ?>);"></div>
    </div>

    <?php if(!$yit_is_parallax_slider): ?>
    <script type="text/javascript">
        jQuery(function($){
            var container = $('#<?php echo $id ?>');
            var offset = $('#primary > .container:first').offset().left;
            var isSi = $('body').hasClass('safari') || $('body').hasClass('iphone') || $('body').hasClass('ipod') || $('body').hasClass('ipad');
            var needed = container.parents('#primary').length;
            if( isSi && needed ) {
                container.width($(window).width()).css('margin-left', - offset);
            }
            $(window).on('resize', function(){
                if( isSi && needed ) {
                    var offset = $('#primary > .container:first').offset().left;
                    container.width($(window).width()).css('margin-left', - offset);
                }
            }).trigger('resize');
            container.find('.parallaxeos').waypoint(function() {
                $(this).parallaxeos();
            },{offset: '200%'});
        });
    </script>
    <?php endif ?>
</div>
<div class="clear"></div>