<?php
	wp_reset_query();

    $args = array(
        'post_type' => 'testimonial'
    );

	$args['posts_per_page'] = (isset($items) && $items != '') ? $items : -1;

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

    if( !$tests->have_posts() ) return false ?>
		<?php $i = 0;
		$row = 2;
		while( $tests->have_posts() ) : $tests->the_post();
			if ( $i == 0 || $i % $row == 0 ) echo '<div class="row-fluid">';
			$fulltext = '';
			$text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();

            $title=get_the_title();
			$label = yit_get_post_meta( get_the_ID(), '_site-label' );
			$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );

			$website = '';
			if ($siteurl != ''):
				if ($label != ''):
                    $website = '<span class="testimonialwebsite">'.$title.' - '.'<a  href="' . esc_url($siteurl) . '">' . $label . '</a> </span>';
                else:
                    $website = '<span class="testimonialwebsite">'.$title.' - '.'<a  href="' . esc_url($siteurl) . '">' . $siteurl . '</a> </span>';
				endif;
			elseif($label != ''):
                $website = '<span class="testimonialwebsite">'.$title.'</span>';
            else :
                $website = '<span class="testimonialwebsite">'.$title.'</span>';
			endif;
			?>
			<div class="span6">
                <div class="testimonial">
                    <div class="row">

                        <!-- Span4 with the text -->
                        <div class="span7 testimonial-cit" >
                            <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                        </div>
                        <!-- End Span4 -->

                    <?php  // Control if the thumbnail exists
                        if (yit_get_option('thumbnail-testimonials') && get_the_post_thumbnail( null, 'thumb-testimonial' )) :  ?>
                            <!-- We have the thumbnail in the span2 -->
                            <div class="span5 thumb">
                                <div class="thumbnail">
                                    <?php echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>
                                </div>
                            </div>
                        <?php endif ?>


                        <div class="clearfix"></div>
                    </div>


                    <!-- testimonial's name -->
                    <div class="testimonial-name <?php if (!yit_get_option('thumbnail-testimonials') || !get_the_post_thumbnail( null, 'thumb-testimonial' )) :  ?>nothumb<?php endif ?>"><?php echo "<div class='text'>". $website."</div>"; ?></div>


                    <div class="clearfix"></div>
                </div>
            </div>
	        <?php $i++;
	        if ( $i % $row == 0 ) echo '</div>'; ?>
		<?php endwhile; ?>

<?php if ( $i % $row != 0 ) echo '</div>'; ?>

<?php wp_reset_query() ?>