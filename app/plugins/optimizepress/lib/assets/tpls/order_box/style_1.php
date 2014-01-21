<div class="order-box-1" style="width: <?php echo (empty($width) ? '100%' : $width.'px')?>; float: <?php echo ($alignment=='left' || $alignment=='right' ? $alignment : 'none')?>;">
	<div class="order-box-header">
		<h2><img alt="" src="<?php echo OP_ASSETS_URL.'images/order_box/titles_1/'.$title ?>" /></h2>
		<img alt="" src="<?php echo OP_ASSETS_URL.'images/order_box/headers_1/'.$header ?>" />
	</div>
	<div class="order-box-content">
        <?php echo $content ?>
	</div>
</div>