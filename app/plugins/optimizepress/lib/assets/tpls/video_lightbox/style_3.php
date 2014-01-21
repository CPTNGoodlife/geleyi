<?php
    if (!empty($inlinecontent)) $inlinecontent = ($data['type']=='embed' ? $inlinecontent : '<span>'.$inlinecontent.'</span>');
?>

<a href="<?php echo $url; ?>" class="video-lightbox-style-3" style="<?php echo $align; ?>" rel="prettyPhoto">
        <div class="preview-container">
                <img src="<?php echo $placeholder; ?>" class="scale-with-grid">
                <div class="circle"><div class="play"></div></div>
                <?php echo $inlinecontent; ?>
        </div>
</a>