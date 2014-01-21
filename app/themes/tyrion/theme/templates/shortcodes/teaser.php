<?php

$title = ( isset($title) ) ? $title : '';
$subtitle = ( isset($subtitle) ) ? $subtitle : '';
$image = ( isset($image) ) ? esc_url($image) : '';
$link = ( isset($link) ) ? esc_url($link) : '';
$hover_class = ( isset($hover_class) ) ? $hover_class : '';
$slogan_position = ( isset($slogan_position) ) ? $slogan_position : '';

if($image != '') {
    $attachment_image_id = yit_get_attachment_id($image);
    $attachment_image_info = yit_image( "id={$attachment_image_id}&size=teaser_widget&output=array" );
}

?>

<?php if( $image != '' ) : ?>
    <div class="teaser">
        <?php if( $link != '' ) : ?>
            <a href="<?php echo $link ?>">
        <?php else: ?>
             <?php $hover_class = 'transparent ' . $hover_class; ?>
        <?php endif; ?>
            <div class="image" style="background-image: url('<?php yit_image( "id={$attachment_image_id}&size=teaser_widget&output=url" ) ?>'); width: <?php echo $attachment_image_info[1]?>px; height: <?php echo $attachment_image_info[2]?>px;">
                <div class="image_banner_inside <?php echo $hover_class ?>" style="width: <?php echo ($attachment_image_info[1] - 16); ?>px; height: <?php echo ($attachment_image_info[2] - 16);?>px;">

                    <p class="title <?php echo $slogan_position ?>">
                        <?php echo $title ?>
                        <span class="subtitle"><?php echo $subtitle ?></span>
                    </p>

                </div>
            </div>
        <?php if( $link != '' ) : ?>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>