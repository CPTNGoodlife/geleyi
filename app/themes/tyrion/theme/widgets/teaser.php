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

if( !class_exists( 'teaser' ) ) :
class teaser extends WP_Widget
{
    function teaser() {
        $widget_ops = array( 
            'classname' => 'teaser',
            'description' => __( 'An image with a text linkable', 'yit' )
        );

        $control_ops = array( 'id_base' => 'teaser', 'width' => 430 );

        $this->WP_Widget( 'teaser', __( 'Teaser', 'yit' ), $widget_ops, $control_ops );
    }
    
    function form( $instance ) {
        global $icons_name;
        
        /* Impostazioni di default del widget */
        $defaults = array(
            'title' => '',
            'icon_title' => '',
            'hover_class' => '',
            'slogan' => '',
            'subslogan' => '',
            'slogan_position' => '',
            'image' => '',
            'link' => '',
            'read_more' => '',
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Title', 'yit' ) ?>:</strong><br />
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
            <?php _e('Hover Skin', 'yit'); ?>:<br />
            <select id="<?php echo $this->get_field_id( 'hover_class' ); ?>" name="<?php echo $this->get_field_name( 'hover_class' ); ?>">
                <option value="black" <?php selected( $instance['hover_class'], 'black' ) ?>><?php _e('Black', 'yit') ?></option>
                <option value="white" <?php selected( $instance['hover_class'], 'white' ) ?>><?php _e('White', 'yit') ?></option>
            </select>
        </p>

        <p>
            <label>
                <strong><?php _e( 'Slogan', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'slogan' ); ?>" name="<?php echo $this->get_field_name( 'slogan' ); ?>" value="<?php echo $instance['slogan']; ?>" />
            </label>
        </p>

        <p>
            <label>
                <strong><?php _e( 'Subslogan', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'subslogan' ); ?>" name="<?php echo $this->get_field_name( 'subslogan' ); ?>" value="<?php echo $instance['subslogan']; ?>" />
            </label>
        </p>

        <p>
            <?php _e('Slogan Position', 'yit'); ?>:<br />
            <select id="<?php echo $this->get_field_id( 'slogan_position' ); ?>" name="<?php echo $this->get_field_name( 'slogan_position' ); ?>">
                <option value="top" <?php selected( $instance['slogan_position'], 'top' ) ?>><?php _e('Top', 'yit') ?></option>
                <option value="center" <?php selected( $instance['slogan_position'], 'center' ) ?>><?php _e('Center', 'yit') ?></option>
                <option value="bottom" <?php selected( $instance['slogan_position'], 'bottom' ) ?>><?php _e('Bottom', 'yit') ?></option>
            </select>
        </p>
        
        <p>
            <label><?php _e( 'Image', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" id="<?php echo $this->id ?>-upload-button" class="upload-image button-secondary">Upload</a>
            </label>
        </p>

        <p>
            <label><?php _e( 'Link', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
            </label>
        </p>
        <?php
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
                   
        if ( strpos( $before_widget, 'widget-wrap' ) === false ) {
            $before_widget .= '<div class="widget-wrap">';
            $after_widget  .= '</div>';
        }

        if(isset($instance['icon_title']) && $instance['icon_title'] != '') {
            $img_title = '<img class="title-icon" src="' . $instance['icon_title'] . '" />';
        }else{
            $img_title = '';
        }
        
        echo $before_widget;

        if( isset($title) && $title != '' ) {
            echo $before_title . $img_title .  $title . $after_title;
        }

        echo do_shortcode('[teaser title="' . $instance['slogan'] . '" subtitle="' . $instance['subslogan'] . '" image="' . $instance['image'] . '" link="' . $instance['link'] . '" hover_class="' . $instance['hover_class'] . '" slogan_position="' . $instance['slogan_position'] . '" ]');
        
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['icon_title'] = strip_tags( $new_instance['icon_title'] );

        $instance['hover_class'] = strip_tags( $new_instance['hover_class'] );

        $instance['slogan'] = strip_tags( $new_instance['slogan'] );

        $instance['subslogan'] = strip_tags( $new_instance['subslogan'] );

        $instance['slogan_position'] = strip_tags( $new_instance['slogan_position'] );

        $instance['image'] = $new_instance['image'];
        
        $instance['link'] = esc_url( $new_instance['link'] );
        
        $instance['read_more'] = $new_instance['read_more'];

        return $instance;
    }
    
}     
endif;