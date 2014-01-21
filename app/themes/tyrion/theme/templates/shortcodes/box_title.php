<?php


    $border = ( isset($border) || $border != '' ) ? $border : 'none';
    $content = (isset($content) && $content != '') ? $content : '';
    switch ( $border ):
        case 'middle':
?>
        <div class="box-title wrap-title">
            <h5><?php echo do_shortcode($content) ?></h5>
        </div>
<?php
            break;
        case 'bottom': ?>
                <div class="box-title box-title-line-bottom">
                    <h5><?php echo $content ?></h5>
                    <?php echo do_shortcode('[line]') ?>
                </div>
<?php
            break;
        case 'around': ?>
            <div class="box-title wrap-title">
                <h5 class="title"><?php echo do_shortcode($content) ?></h5>
            </div>
<?php
            break;
        default: ?>
            <div class="box-title box-title-line-none">
                <h5><?php echo do_shortcode($content) ?></h5>
            </div>
<?php
            break;

    endswitch;
?>
