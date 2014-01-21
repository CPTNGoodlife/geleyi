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


$post_format = get_post_format() == '' ? 'standard' : get_post_format();
$post_format = yit_get_option( 'blog-post-formats-list' ) && get_post_format() != ''  ? get_post_format() : $post_format;
?>

<?php if ( $has_thumbnail ): ?>
    <div class="thumbnail">
        <?php
        if( $has_thumbnail ) {
            yit_image( "size=blog_small_image&alt=blogimage" );
        }
        ?>

        <!-- Post Date  -->
        <div class="blog-meta">
            <?php if( yit_get_option( 'blog-show-date' ) ): ?>
                <div class="blog-small-image-date">
                    <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                    <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                </div>
            <?php endif ?>
        </div>

        <!-- The post content box -->
        <div class="the-content-list the-content <?php if( $post_format == 'quote' ) echo 'the-content-quote'; ?> ">
            <div class="blog-small-image-content">

                <!-- post title -->
                <?php
                $link = get_permalink();
                $title = get_the_title() == '' ? __( '(this post does not have a title)', 'yit' ) : get_the_title();
                $upper = yit_get_option('blog-title-uppercase') ? ' upper' : '';



                yit_string( "<h2 class=\"post-title{$upper}\"><a href=\"$link\">", $title, "</a></h2>" );

                // CONTROL TO THE SUBTITLE SETTINGS
                $subtitle= yit_get_post_meta( get_the_ID(), '_subtitle' );
                if( yit_get_option( 'list-blog-show-subtitle' ) ) :
                    if( isset($subtitle) && $subtitle!='' ): echo "<div class= \"post-subtitle \">". $subtitle ."</div>";  endif;
                endif;

                // CONTROL TO THE EXCERPT
                if( yit_get_option( 'list-blog-show-excerpt' ) ) :
                     echo yit_content('excerpt','40'," [".yit_get_option( 'blog-read-more-text' )."] ",'[...]', true);
                endif;
                ?>

                <?php wp_link_pages(); ?>

            </div>
        </div>
    </div>

<?php
    // if there is not thumbnail
    // we have this code
    else:

?>
<div class="no-thumb">
    <!-- Post Date  -->
     <div class="blog-meta">
     <?php if( yit_get_option( 'blog-show-date' ) ): ?>
        <div class="blog-small-image-date">
            <span class="day"><?php echo get_the_date( 'd' ) ?></span>
            <span class="month"><?php echo get_the_date( 'M' ) ?></span>
        </div>
    <?php endif ?>
    </div>

    <!-- The post content box -->
    <div class="blog-small-image-content">

        <!-- post title -->
        <?php
        $link = get_permalink();
        $title = get_the_title() == '' ? __( '(this post does not have a title)', 'yit' ) : get_the_title();
        $upper = yit_get_option('blog-title-uppercase') ? ' upper' : '';



        yit_string( "<h2 class=\"post-title{$upper}\"><a href=\"$link\">", $title, "</a></h2>" );

        // CONTROL TO THE SUBTITLE SETTINGS
        $subtitle= yit_get_post_meta( get_the_ID(), '_subtitle' );
        if( yit_get_option( 'list-blog-show-subtitle' ) ) :
            if( isset($subtitle) && $subtitle!='' ): echo "<div class= \"post-subtitle \">". $subtitle ."</div>";  endif;
        else: // Nothing
        endif;

        // CONTROL TO THE EXCERPT
        if( yit_get_option( 'list-blog-show-excerpt' ) ) :
            echo yit_content('excerpt','40'," ".yit_get_option( 'blog-read-more-text' ),'[...]');
        else: // Nothing
        endif;
        ?>

        <?php wp_link_pages(); ?>


        </div>

    </div> <!-- End no-thumb -->

<?php
    endif;
?>