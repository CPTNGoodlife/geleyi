<?php	
	global $icons_name;

	remove_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links

	$args = array(
		'posts_per_page'      => $items,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => 1
	);

	if(isset($other_atts['popular'])) $popular = $other_atts['popular'];
	if( isset( $popular ) ) $args['orderby'] = 'comment_count';
	if( isset( $cat_name ) && !empty( $cat_name ) ) $args['category_name'] = $cat_name;

	$myposts = new WP_Query( $args );

	$html = '';
	if( $myposts->have_posts() )
	{
		$html .= "\n";
		$html .= '<div class="recent-post group">'."\n";

		while( $myposts->have_posts() )
		{
			$myposts->the_post();

			$html .= '<div class="hentry-post group">'."\n";

			// Show Date
			if( $date == 'yes' )
			{
				$html .= '<p class="post-date">';
				$html .= '<span class="day">'   . get_the_time('d') . '</span>';
				$html .= '<span class="month">' . get_the_time('M') . '</span>';
				$html .= '</p>';
			}

			// Show Post Thumbnail
			if ( $showthumb == 'yes' )
			{
				if( has_post_thumbnail() )
					$html .= '<div class="thumb-img">' . yit_image( "size=blog_thumb&alt=blog_thumb", false ) . '</div>' . "\n";
				else
					$html .= '<div class="thumb-img"><img src="'.get_template_directory_uri().'/images/no_image_recentposts.jpg" alt="No Image" /></div>';

				$html .= '<div class="text">';
			}
			else
			{
				$html .= '<div class="text without-thumbnail">';
			}

			// Post Title
			$html .= the_title( '<a href="'.get_permalink().'" title="'.get_the_title().'" class="title">', '</a>', false );
			// The Post Content
			$html .= '' . yit_content( 'excerpt', $excerpt_length, $readmore ) . '';

			/*
			if( strpos( $readmore, "href='#'" ) )
				$post_readmore = str_replace( "href='#'", "href='" . get_permalink() . "'", $readmore );
			else
				$post_readmore = $readmore;
			*/
			$html .= '</div>' . "\n";
			$html .= '</div>' . "\n";

		}
		wp_reset_query();

		$html .= '</div>';
	}

	add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links ?>

<?php echo $html; ?>