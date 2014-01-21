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

$items = (!is_null( $items )) ? $items : -1;
$sidebar_layout = yit_get_sidebar_layout() ?>
<div class="row">
    <!-- START SECTION BLOG -->
    <div class="section blog margin-bottom span<?php echo $sidebar_layout == 'sidebar-no' ? 12 : 9 ?>" data-columns="<?php echo $sidebar_layout == 'sidebar-no' ? 4 : 3 ?>">
        <?php
        //Separated code for a better organization of the code


            

            if( $show_title == 'yes' && $enable_slider == 'yes'){
                if( !empty($blog_icon_title) && !empty( $title )) { yit_image("src=$blog_icon_title"); }
                if( !empty( $title ) ){ echo '<h3 class="title">', yit_decode_title($title), ' &nbsp;</h3>' ;}
            }

            if( $show_title == 'yes' && $enable_slider == 'no'){
                if( !empty($blog_icon_title) && !empty( $title )) { yit_image("src=$blog_icon_title"); }
                if( !empty( $title ) ){ echo '<h3 class="title">', yit_decode_title($title), ' &nbsp;</h3>' ;}
            }

            if( $show_title == 'no' && $enable_slider == 'yes'){
                if( !empty($blog_icon_title) && !empty( $title )) { yit_image("src=$blog_icon_title"); }
                if( !empty( $title ) ){ echo '<h3 class="title">&nbsp;</h3>' ;}
            }
           

	    if( !empty( $description ) ) { yit_string( '<p class="desc">', $description, '</p>' ); }
        ?>

        <?php if( $enable_slider == 'yes' ): ?>
        <div class="nav">
            <a class="prev" href="#"></a>
            <a class="next" href="#"></a>
        </div>
        <?php endif ?>
            
        <div class="row">
            <?php
            //Sticky posts loop args

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $items
            );

//            if( isset( $category ) && !empty( $category ) ) {
//                $args['category_name'] = $category;
//            }

            $posts = new WP_Query( $args );

            if( $posts->have_posts() ) : echo '<div class="section-blog-container">';
                while( $posts->have_posts() ) : $posts->the_post();

                    if( !is_single() )
                        { $more = 0; }
                    ?>
                    <div <?php post_class( 'hentry-post span3' ) ?>>

                        <div class="figure">
                            <?php if( has_post_thumbnail() ) { ?>

                                <?php the_post_thumbnail( 'section_blog' ) ;

                            } else { ?>

                                <img class="attachment-section_blog wp-post-image" style="width: 261px; height: 173px;" alt="04" src="<?php echo YIT_IMAGES_URL ?>/placeholder.png">

                            <?php } ?>

                            <?php if( $show_date == '1' || $show_date == 'yes' ) : ?>
                                <p class="date">
                                    <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                                    <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                                </p>
                            <?php endif ?>

                                <div class="description">
                                    <div class="description-container">
                                        <?php if( $show_title == '1' || $show_title == 'yes' ) :
                                            the_title( '<h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h3>' );
                                        endif ?>
                                    </div>
                                <div class="post-info">
                                    <?php if( isset($show_author) && ( $show_author == '1' || $show_author == 'yes' )) : ?>
                                        <?php if ( get_the_author() != '' && yit_get_option( 'blog-show-author' ) ) : ?>
                                            <span class="author"><?php _e( 'by:', 'yit' ) ?></span> <?php the_author_posts_link(); ?>
                                        <?php endif; ?>
                                    <?php endif ?>

                                    <?php if( isset($show_author) && ( $show_author == '1' || $show_author == 'yes' )&& isset($show_comments) && ( $show_comments == '1' || $show_comments == 'yes' ) ) : ?>
                                        <?php _e(' - '); ?>
                                    <?php endif; ?>

                                    <?php if( isset($show_comments) && ( $show_comments == '1' || $show_comments == 'yes' ) ) : ?>
                                        <span class="comments">
                                            <a href="<?php comments_link(); ?> "><?php echo get_comments_number();?>&nbsp;<?php  _e('Comments', 'yit');?> </a>
                                        </span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php endwhile;
                echo '</div>';
            endif;

            wp_reset_query() ?>
        </div>
    </div>


    <?php if( $enable_slider == 'yes' ): wp_enqueue_script('owl-carousel'); ?>
    <script type="text/javascript">
    jQuery(function($){
        $('.section.blog').imagesLoaded(function(){
            var t = $(this);

            var cols = t.data('columns') ? t.data('columns') : 4;
            var owl = t.find('.section-blog-container').owlCarousel({
                autoPlay: 3000,
                items : cols,
                itemsDesktop : [1199,cols],
                itemsDesktopSmall : [979,cols],
                itemsTablet : [768, cols],
                itemsMobile : [480, 1]
            });

            // Custom Navigation Events
            t.on('click', '.next', function(e){
                e.preventDefault();
                owl.trigger('owl.next');
            });

            t.on('click', '.prev', function(e){
                e.preventDefault();
                owl.trigger('owl.prev');
            });

        });
    });
    </script>
    <?php endif ?>


    <!-- END SECTION BLOG -->
    <div class="clear"></div>
    <?php wp_reset_query() ?>
</div>
<?php add_action( 'the_content_more_link', 'yit_simple_read_more_classes' ) ?>