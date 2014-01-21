<?php
/**
 * Classic Portfolio Section Style
 */
?>

<?php
$count = 0;
while( yit_have_works() ):
	$work_terms     = yit_work_get('terms');
	$work_permalink = yit_work_permalink( yit_work_get( 'item_id' ) );
	$work_title     = yit_work_get('title');
	$work_video_url = yit_work_get('video_url');
	$work_image_url = yit_work_get( 'image_url' );

	// Check for thumbnail or video
	$thumb = '';
	if ( !empty($work_video_url) )
	{
		if( $is_really_video = yit_video_type_by_url( $work_video_url ) )
			list( $work_video_type, $work_video_id ) = explode( ':', $is_really_video );

		if( isset($work_video_type) )
		{
			if( $work_video_type == 'youtube' )
				$work_video_url = 'http://www.youtube.com/embed/' . $work_video_id . '?width=640&height=480&iframe=true';
			else if( $work_video_type == 'vimeo' )
				$work_video_url = 'http://player.vimeo.com/video/' . $work_video_id;
			
			$thumb = $work_video_url;
		}
		else
		{
			$thumb = ''; // fix if $work_vide_url is not set
		}
	}
	else
	{
		$thumb = $work_image_url;
	} ?>

	<div class="span4 work<?php if($count==0) {echo  ' first'; } ?>">
		<div class="classic-thumbnail-wrap<?php echo $show_lightbox_hover === 'yes' ? ' picture_overlay' : ''?>">
			<span>
				<a href="<?php echo $work_permalink ?>" title="">
					<?php yit_image( 'id='.yit_work_get('item_id').'&class=zoom-image&size=sc_portfolio_3cols' ); ?>
				</a>

				<?php if( $show_lightbox_hover === 'yes' ): ?>
				<div class="overlay">
					<div>
						<p>
							<a href="<?php echo $thumb ?>" title="" rel="lightbox" class="ch-info-lightbox<?php if($work_video_url): ?>-video<?php endif ?>">
								<img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($work_video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" />
							</a>
						</p>
					</div>
				</div><!-- .overlay -->
				<?php endif; ?>
			</span>
		</div><!-- .classic-thumbnail-wrap -->

		<div class="classic-portfolio-info">
			<h5><a href="<?php echo $work_permalink ?>" title="<?php echo $work_title ?>"><?php echo $work_title ?></a></h5>
			<span class="classic-info-terms"><?php echo !empty($work_terms) ? implode(',', $work_terms ) : '' ?></span>
		</div><!-- .section_portfolio_info -->
    </div>
<?php
++$count;
endwhile;