<div class="order-box-3" style="width: <?php echo (empty($width) ? '100%' : $width.'px')?>; float: <?php echo ($alignment=='left' || $alignment=='right' ? $alignment : 'none')?>;">
	<div class="order-box-3-internal cf">
		<div class="order-box-header">
			<h2><img alt="" src="<?php echo OP_ASSETS_URL ?>images/order_box/green-tick.png" /> <?php echo $title ?></h2>
		</div>
							
		<div class="order-box-content">
			<?php echo $content ?>
		</div>
	</div>
</div>