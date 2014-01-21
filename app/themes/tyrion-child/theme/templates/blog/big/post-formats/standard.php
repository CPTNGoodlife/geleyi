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
?>

<?php if ( $has_thumbnail ): ?>
    <div class="thumbnail ">

        <div class="thumbnail-wrapper ">

            <?php
            if( $has_thumbnail ) {
                global $yit_sidebar_layout;
                if ( $yit_sidebar_layout['layout']== "sidebar-no" ){
                    $blog_thumb_size="size=thumb_portfolio_fulldesc_big&alt=blogimage";
                } else{
                    $blog_thumb_size="size=blog_big&alt=blogimage ";
                }

                yit_image($blog_thumb_size);
            }
            ?>

            <div class="blog-meta">
                <?php if( yit_get_option( 'blog-show-date' ) ): ?>
                    <div class="blog-big-image-date">
                        <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                        <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                    </div>
                <?php endif ?>
            </div>



        </div>
    </div>
<?php endif ?>