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

if( !class_exists( 'yit_recent_reviews' ) ) :
class yit_recent_reviews extends WP_Widget {
    public function yit_recent_reviews() {
        $widget_ops = array( 
            'classname' => 'yit_recent_reviews',
            'description' => __( 'Print a list of recent reviews in a sidebar', 'yit' )
        );

        $control_ops = array( 'id_base' => 'yit_recent_reviews' );

        $this->WP_Widget( 'yit_recent_reviews', __( 'YIT Product Recent Reviews', 'yit' ), $widget_ops, $control_ops );
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => '',
            'icon_title' => '',
            'reviews_numbers' => 2,
        );
        
        $instance = wp_parse_args( ( array ) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Title', 'yit' ) ?></strong>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>

         <p>
			<label>
				<?php _e('Title Icon', 'yit'); ?>:<br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'icon_title' ); ?>" name="<?php echo $this->get_field_name( 'icon_title' ); ?>" value="<?php echo $instance['icon_title']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" id="<?php echo $this->id ?>-upload-button" class="upload-image button-secondary">Upload</a>
			</label>
		</p>


        <p>
            <label for="<?php echo $this->get_field_id( 'reviews_numbers' ); ?>">Items:
                 <select id="<?php echo $this->get_field_id( 'reviews_numbers' ); ?>" name="<?php echo $this->get_field_name( 'reviews_numbers' ); ?>">

                     <?php for($i=1;$i<=20;$i++) : ?>
                        <?php $select = ''; ?>

                        <?php if($instance['reviews_numbers'] == $i) : ?>
                             <?php $select = ' selected="selected"'; ?>
                        <?php endif; ?>

                        <?php echo "<option value=\"$i\"$select>$i</option>\n"; ?>
                    <?php endfor;?>

                 </select>
            </label>
        </p>
        <?php
    }
    
    public function widget( $args, $instance ) {
        extract( $args );

        /* User Custom Settings */

        $title = apply_filters('widget_title', $instance['title'] );
        $icon_title = isset( $instance['icon_title']) ? $instance['icon_title'] : '';
        $reviews_numbers = isset( $instance['reviews_numbers']) ? $instance['reviews_numbers'] : '2';

        $reviews_args = array(
            'status' => 'approve',
            'post_status' => 'publish',
            'post_type' => 'product',
            'order' => 'DESC',
            'number' => $reviews_numbers,
        );

        if($icon_title != '') {
            $img_title = '<img class="title-icon" src="' . $icon_title . '" />';
        }else{
            $img_title = '';
        }

        echo $before_widget;

        if ( $title ) echo $before_title . $img_title . $title . $after_title;

        $reviews = get_comments($reviews_args); ?>

        <div id="<?php $widget_id; ?>" class="reviews_container">
            <ul>
                <?php foreach ( $reviews as $review ) : ?>

                    <li>
                        <div class="review-text woocommerce">

                            <div itemprop="description" class="description">
                                <?php echo $review->comment_content ?>
                            </div>

                            <p class="meta">
                                <span itemprop="author">
                                    <?php echo $review->comment_author; _e( ' on ', 'yit' ) ?>
                                    <a href="<?php echo get_permalink( $review->ID ) ?>">
                                        <?php echo $review->post_title; ?>
                                    </a>
                                </span>
                            </p>

                            <?php $rating = esc_attr( get_comment_meta( $review->comment_ID, 'rating', true ) ) ?>

                            <span class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">
                                <span style="width:<?php echo ( intval( get_comment_meta( $review->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $review->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
                            </span>

                        </div>
                        <div class="clear"></div>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>

        <?php echo $after_widget;
    }
    
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['icon_title'] = $new_instance['icon_title'];
        $instance['reviews_numbers'] = $new_instance['reviews_numbers'];

        return $instance;

    }
}
endif;