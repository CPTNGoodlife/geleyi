<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $yit_portfolio_index, $yit;

if ( !isset($yit_portfolio_index) ) { $yit_portfolio_index = 0; }

$var['posts_per_page'] = (!is_null( $items )) ? $items : -1;
// Set std style if is an empty string.
$std_portfolio_style   = yit_get_model('shortcodes')->shortcodes['section_portfolio']['attributes']['portfolio_style']['std'];
$portfolio_style       = !empty($portfolio_style) ? $portfolio_style : $std_portfolio_style;
// Compact to pass vars for portfolio style file
$portfolio_compact     = compact( 'show_lightbox_hover' );

yit_get_model( 'portfolio' )->shortcode_atts = $var;
yit_set_portfolio_loop( $portfolio );

$sidebar_layout = yit_get_sidebar_layout();
?>
<div id="section-portfolio-<?php echo $yit_portfolio_index ?>" class="section portfolio<?php if( $sidebar_layout != 'sidebar-no' ): ?> section-portfolio-with-sidebar<?php endif ?>">

	<?php if( ! yit_is_portfolio_empty() ): ?>

		<?php
		$portfolio_length = yit_get_portfolio_lenght();
		$portfolio_groups = array();
		$classes          = " work yit_item";

		// Get Title and icon section
		if( !empty($title) ) {
			if( !empty($portfolio_icon_title)){ $icon_image = yit_image("src=$portfolio_icon_title"); }
			$title = yit_string( '<div class="wrap-title"><h3 class="title">', yit_decode_title($title), '</h3></div>' );
		}

		// Section Description
		if( !empty( $description ) ) { $description = yit_string( '<p class="desc">', $description, '</p>' ); }
?>
		<div class="portfolio-projects row<?php echo ' '.$portfolio_style ?>">
			<?php yit_get_template( '/shortcodes/portfolio/'.$portfolio_style.'.php', $portfolio_compact ); ?>
		</div>
	<?php endif ?>

</div><!-- end section portfolio wrapper -->

<div class="clear"></div>

<?php $yit_portfolio_index++ ?>