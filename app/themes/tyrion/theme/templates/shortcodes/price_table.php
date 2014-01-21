<?php
	$type = (isset($type)) ? $type : '';
    $content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );
?>
<div class="pricing_box <?php echo $type; ?>  ">
	<div class="header"><h3><?php echo $title; ?></h3></div>
	<ul>
		<?php echo do_shortcode( $content ); ?>
	</ul>
    <div class="clearfix"></div>
	<h3 class="price"><?php echo $price; ?></h3>
	<?php if ( isset($href) && isset($buttontext) && $href != '' && $buttontext != '' ) : ?>
		<p class="button signup"><a href="<?php echo esc_url($href); ?>"><?php echo $buttontext; ?></a></p>
	<?php endif; ?>
</div>