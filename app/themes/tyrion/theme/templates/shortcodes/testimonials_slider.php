<?php

	wp_enqueue_script('owl-carousel');

	wp_reset_query();
	
	$args = array(
		'post_type' => 'testimonial'    
	);
	
	$args['posts_per_page'] = (!is_null( $items )) ? $items : -1;
	
	if ( isset( $cat ) && ! empty( $cat ) ) {
		$cat = array_map( 'trim', explode( ',', $cat ) );
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category-testimonial',
				'field' => 'id',
				'terms' => $cat
			)
		);
	}
	
	$tests = new WP_Query( $args );  
	$count_posts = wp_count_posts('testimonial');                        

	if ( $count_posts->publish == 1 )  
		$is_slider = false;
	else
		$is_slider = true;

	$html = '';
	if( !$tests->have_posts() ) return $html;
	
?>
		
<div class="testimonials-slider">
	<h4 class="testimonials-slider-title"><?php _e('Happy customers', 'yit') ?></h4>
	<ul class="testimonial-content">

		<?php 
		//loop
		$c = 0;
		while( $tests->have_posts() ) : $tests->the_post(); 
					 
			$length = create_function( '', "return $excerpt;" );
			add_filter('excerpt_length', $length );
			add_filter('excerpt_length', $length );
			
			$title = the_title( '<a class="name">', '</a>', false );
			
			$label = yit_get_post_meta( get_the_ID(), '_site-label' );
			$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );

			$text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();

			$website = '';
			if ($siteurl != ''):
				if ($label != ''):
					$website = '<a href="' . esc_url($siteurl) . '">' . $label . '</a>';
				else:
					$website = '<a href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
				endif;
			endif;
			
			?>
				
			<li class='item'>
                <blockquote><p>&rdquo;<?php echo $text ?>&rdquo;</p></blockquote>
                <p class="meta"><?php echo $title; ?> <?php if ($website != '') : ?> - <?php echo $website; endif; ?></p>
			</li>

		<?php $c++; endwhile; ?>         
			
	</ul>

</div> <?php      
	
	if ( $is_slider ) : ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.testimonial-content').owlCarousel({
			singleItem:true,
			navigation : true,
	      slideSpeed : 300,
	      paginationSpeed : 400
		});
	});
	</script>
	<?php endif;?>

<?php echo $html; ?>