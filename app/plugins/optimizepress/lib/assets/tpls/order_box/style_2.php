<div class="order-box-2" style="width: <?php echo (empty($width) ? '100%' : $width.'px')?>; float: <?php echo ($alignment=='left' || $alignment=='right' ? $alignment : 'none')?>;">
	<div class="order-box-2-internal cf">
		<div class="order-box-header">
			<img alt="" src="<?php echo OP_ASSETS_URL.'images/order_box/titles_2/'.$title ?>" />
		</div>
							
		<div class="order-box-content">
        <?php echo $content ?>
		</div>
	</div>
</div>