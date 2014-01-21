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

$post_classes = 'hentry-post group blog-big-image';

$span = yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9;

$post_format = get_post_format() == '' ? 'standard' : get_post_format();


$meta = yit_get_option( 'blog-show-author' )
        || yit_get_option( 'blog-show-comments' ) && comments_open()
        || yit_get_option( 'blog-show-categories' )
        || yit_get_option( 'blog-show-tags' )
        || yit_get_option( 'blog-show-subtitle' )
        || yit_get_option( 'blog-show-share' );

$subtitle= yit_get_post_meta( get_the_ID(), '_subtitle' );

if( yit_get_option( 'blog-post-formats-list' ) ) {
    $post_classes .= ' post-formats-on-list';
}

$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true;

$upper = yit_get_option('blog-title-uppercase') ? ' upper' : '';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

        <?php if(is_single() && $post_format != 'quote') : ?>
            <?php yit_get_template( 'blog/big/post-formats/' . $post_format . '.php', array('span' => $span, 'has_thumbnail' => $has_thumbnail) ); ?>
        <?php elseif( $post_format != 'quote' ): ?>
            <?php yit_get_template( 'blog/big/post-formats/standard.php', array('span' => $span, 'has_thumbnail' => $has_thumbnail) ); ?>
        <?php endif; ?>

    <div >
        <!-- post content -->
        <div class="blog-big-image-content ">

            <?php if ( !($has_thumbnail) ): ?>
                        <div class="blog-meta">
                            <?php if( yit_get_option( 'blog-show-date' ) ): ?>
                                <div class="blog-big-image-date">
                                    <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                                    <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                                </div>
                            <?php endif ?>
                        </div>
            <?php endif ?>

            <div class="the-content-post">

                <!-- post title -->
                <?php
                $link = get_permalink();
                $title = get_the_title() == '' ? __( '(this post does not have a title)', 'yit' ) : get_the_title();



                if($post_format != 'quote'){
                    yit_string( "<h2 class=\"post-title{$upper}\"><a href=\"$link\">", $title, "</a></h2>" );
                }

                if( !is_single() && $post_format != 'quote' ) {

                    if( yit_get_option( 'blog-show-read-more' ) && !yit_get_option( 'blog-show-featured' ) ) {

                        the_content( yit_get_option( 'blog-read-more-text' ) );
                    } else {
                        // CONTROL TO THE SUBTITLE SETTINGS
                        $subtitle= yit_get_post_meta( get_the_ID(), '_subtitle' );
                        if( yit_get_option( 'list-blog-show-subtitle' ) ) :
                            if( isset($subtitle) && $subtitle!='' ): echo "<div class= \"post-subtitle \">". $subtitle ."</div>";  endif;
                        else: // Nothing
                        endif;

                        // CONTROL TO THE EXCERPT
                        if( yit_get_option( 'list-blog-show-excerpt' ) ) :
                            the_excerpt();
                        else: // Nothing
                        endif;

                    }
                } elseif($post_format == 'quote') {

                    yit_string( "<blockquote><p><a href=\"$link\">", get_the_content(), "</a></p><cite>" . $title . "</cite></blockquote>" );
                }

                if(is_single() && $post_format != 'quote'){

                 if( yit_get_option( 'blog-show-subtitle' ) ) :
                    if( isset($subtitle) && $subtitle!='' ):
                        echo "<div class= \"post-subtitle \">". $subtitle ."</div>";
                    endif;
                 endif;

                    the_content();

                }

                ?>


                <?php
                //  HERE WE HAVE THE META BOX
                if (  (yit_get_option( 'blog-show-author' ) == 0)         &&
                    (yit_get_option( 'blog-show-categories' ) == 0)     &&
                    (yit_get_option( 'blog-show-comments' ) == 0)       &&
                    (yit_get_option( 'blog-show-tags' ) == 0)           ):  ?>
                <?php else:  ?>
                    <div class="post-footer meta">
                        <div class="metacont">

                        <?php if ( get_the_author() != '' && yit_get_option( 'blog-show-author' ) ) : ?>
                            <p>
                                <span class="author"><i class=" blog-icon author"></i> <?php _e( 'Author:', 'yit' ) ?></span> <?php the_author_posts_link(); ?>
                            </p>
                        <?php endif; ?>

                        <?php if( yit_get_option( 'blog-show-categories' ) ) : ?>
                            <p>
                                <span class="categories"><i class=" blog-icon tags"></i><?php _e( 'Categories:', 'yit' ) ?></span>
                                <?php the_category( ', ' ) ?>
                            </p>
                        <?php endif; ?>

                        <?php if( yit_get_option( 'blog-show-comments' ) ): ?>
                            <p>
                                <i class=" blog-icon comment"></i>
                                <a href="<?php comments_link(); ?>" class="blog-big-image-comments-count">
                                    <span class="count"><?php _e('Comments: ', 'yit'); ?> </span> <span>&nbsp;<?php echo get_comments_number(); ?></span>
                                </a>
                            </p>
                        <?php endif ?>

                        <?php if( yit_get_option( 'blog-show-tags' ) ) : ?><p><?php  ?><span class="tags"><?php the_tags( __( 'Tags: ', 'yit' ), ', ' ); ?></span></p><?php endif ?>
                        </div>
                        <div class="readmore-wrapper">
                            <?php if(yit_get_option( 'blog-show-read-more' ) && !is_single() ) : ?>
                                <a class="read-more red-button" href="<?php the_permalink() ?>"><?php echo yit_get_option( 'blog-read-more-text' ); ?></a>
                            <?php endif; ?>

                            <?php     if(is_single() && $post_format != 'quote'){
                                ?>
                                <span class="share-inpost">
                                    <?php echo do_shortcode('[share icon_type="simple-black"]'); ?>
                                    <span><?php _e( 'Share it ', 'yit' ) ?>&nbsp;</span>
                                    <div class="clearfix"></div>
                        </span>
                            <?php
                            }
                            ?>

                        </div>
                    <div class="clearfix"></div>

                    </div>


                    <?php edit_post_link( __( 'Edit', 'yit' ), '', '' );  ?>
                <?php endif; ?>







                <?php wp_link_pages(); ?>
            </div>



        </div>
        <div class="clear"></div>
    </div>
</div>