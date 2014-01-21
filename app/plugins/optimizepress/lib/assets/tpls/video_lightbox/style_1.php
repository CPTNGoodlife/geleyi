<div class="video-lightbox-link video-lightbox-style-1 <?php echo $video_type; ?>" style="width:<?php echo $placeholder_width; ?>px; <?php echo $align; ?>">
        <div class="frame-style-inner">
                <a href="<?php echo $url; ?>" title="<?php echo __('Click to play',OP_SN); ?>" rel="prettyPhoto">
                        <div class="play-icon"></div>
                        <img alt="" src="<?php echo $placeholder; ?>" style="width:<?php echo $placeholder_width; ?>px; height: <?php echo $placeholder_height; ?>px;" />
                </a>
        </div>
        <?php echo (empty($inlinecontent) ? '' : $inlinecontent); ?>
</div>