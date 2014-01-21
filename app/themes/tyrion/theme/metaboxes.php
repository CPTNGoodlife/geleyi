<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register theme metaboxes.
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

if( !is_admin() ) return;

function yit_remove_options_metabox( $array ) {
    
    return $array;
}
add_filter( 'yit_remove_options_metabox', 'yit_remove_options_metabox' );

/**
 * SLIDER BACKGROUND
 */
/*yit_metaboxes_sep( 'yit-page-settings', __( 'Body Background', 'yit' ) );

$options = array(
    'title' => __( 'Background slider', 'yit' ),
    'desc' =>  __( 'Select the slider to use for background. (Ignore the options below, if you want to use a slider for the background)', 'yit' ),
    'options' => array_merge( array( '' => '' ), yit_get_sliders('background') )
);
yit_add_option_metabox( 'yit-page-settings', __( 'Body Background', 'yit' ), '_bg_slider', 'select', $options );*/

/**
 * BLOG'S SUBTITLE
 */
yit_register_metabox ( 'yit-subtitle-post', __( 'Post Subtitle', 'yit' ), 'post' );
$options = array(
    'title' => __( 'Subtitle', 'yit' ),
    'desc' =>  __( 'Insert the subtitle for the post.', 'yit' ),
);
yit_add_option_metabox( 'yit-subtitle-post', __( 'Post Subtitle', 'yit' ), '_subtitle', 'textarea', $options );

/**
 * TESTIMONIALS
 */
/*yit_metaboxes_sep( 'yit-testimonial-site', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Small quote', 'yit' ),
    'desc' =>  __( 'Insert the text to show with blockquote', 'yit' ),
);

yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_small-quote', 'text', $options );*/

/**
 * LOGOS
 */
yit_register_metabox ( 'yit-logo-site', __( 'Other Logo info', 'yit' ), 'logo' );
$options = array(
    'title' => __( 'Link', 'yit' ),
    'desc' =>  __( 'Insert the link for Logo.', 'yit' ),
);
yit_add_option_metabox( 'yit-logo-site', __( 'Settings', 'yit' ), '_site-link', 'text', $options );

/**
 * Custom Slogan Icon
 */
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );
$options = array(
    'title' => __( 'Slogan Icon', 'yit' ),
    'desc' =>  __( 'Select an image for the slogan.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_slogan-icon-image', 'upload', $options );

/**
 * SITEMAP
 */
$options = array(
    'title' => __( 'Hide in Sitemap', 'yit' ),
    'desc' =>  __( 'Do not show in Sitemap.', 'yit' ),
);
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_exclude-sitemap', 'checkbox', $options );
yit_metaboxes_sep( 'yit-post-settings', __( 'Settings', 'yit' ) );
yit_add_option_metabox( 'yit-post-settings', __( 'Settings', 'yit' ), '_exclude-sitemap', 'checkbox', $options );


/**
* PRODUCT SIDEBAR LAYOUT
*/

yit_register_metabox ( 'yit-custom-product-settings', __( 'Product Page Settings', 'yit' ), 'product' );
 
                                                            

/**
* PRODUCT CUSTOM TABS
*/

$options = array(
    'title' => __( 'Show ask info form?', 'yit' ),
    'desc'  =>  __( 'Set YES if you want a tab with the "Ask Info" form.', 'yit' ),
    'std'   => (yit_get_option('shop-products-details-contact-form') != -1) ? 1 : 0 , // -1 No from selected
);
yit_add_option_metabox( 'yit-custom-product-settings', __( 'Tabs', 'yit' ), '_use_ask_info', 'onoff', $options );

$options = array(
	'title' => __( 'Tabs', 'yit' ),
	'desc' => __( 'Insert a custom tab.', 'yit' ),
);
yit_add_option_metabox ( 'yit-custom-product-settings', __( 'Tabs', 'yit' ), '_custom_tabs', 'customtabs', $options );

if( yit_get_admin_post_type() != 'product' ) {
    // move up the background slider option
    function yit_move_up_background_slider( $options ) {
        if( isset( $options['yit-page-settings']['Body Background'] ) ) {
            $tmp_options = $options['yit-page-settings']['Body Background'];

            $last = array();
            $last[] = array_pop( $tmp_options );
            $last[] = array_pop( $tmp_options );
            $tmp_options = array_merge( $last, $tmp_options );

            $options['yit-page-settings']['Body Background'] = $tmp_options;
        }

        return $options;
    }
    add_filter( 'yit_add_options_metabox', 'yit_move_up_background_slider', 10 );
}

/* HEADER */
yit_metaboxes_sep( 'yit-page-settings', __( 'Header', 'yit' ) );

$options = array(
    'title' => __( 'Enable custom header background', 'yit' ),
    'desc'  =>  __( 'Set YES if you want to customize the header background.', 'yit' ),
    'std'   => 0
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_enable_custom_header', 'onoff', $options );

/*
$options = array(
    'title' => __( 'Header Min-Height', 'yit' ),
    'desc' =>  __( 'Select the min-height of the header.', 'yit' ),
    'std' => 0
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_header-height', 'number', $options );
*/

$options = array(
    'title' =>  __( 'Header background color', 'yit' ),
    'desc' =>  __( 'Select a background color for the header.', 'yit' )
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header', 'colorpicker', $options );

$options = array(
    'title' => __( 'Header background image', 'yit' ),
    'desc' =>  __( 'Select a background image for the header.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-image', 'upload', $options );

$options = array(
    'title' => __( 'Background repeat', 'yit' ),
    'desc' => __( 'Select the repeat mode for the background image.', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'repeat' => __( 'Repeat', 'yit' ),
        'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
        'repeat-y' => __( 'Repeat Vertically', 'yit' ),
        'no-repeat' => __( 'No Repeat', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-repeat', 'select', $options );

$options = array(
    'title' => __( 'Background position', 'yit' ),
    'desc' => __( 'Select the position for the background image.', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'center' => __( 'Center', 'yit' ),
        'top left' => __( 'Top left', 'yit' ),
        'top center' => __( 'Top center', 'yit' ),
        'top right' => __( 'Top right', 'yit' ),
        'bottom left' => __( 'Bottom left', 'yit' ),
        'bottom center' => __( 'Bottom center', 'yit' ),
        'bottom right' => __( 'Bottom right', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-position', 'select', $options );

$options = array(
    'title' => __( 'Background attachment', 'yit' ),
    'desc' => __( 'Select the attachment for the background image.', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'scroll' => __( 'Scroll', 'yit' ),
        'fixed' => __( 'Fixed', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-attachment', 'select', $options );

yit_metaboxes_sep( 'yit-page-settings', __( 'Header', 'yit' ) );

$options = array(
    'title' => __( 'Border bottom of header', 'yit' ),
    'desc' => __( 'Select what you want to do for the border bottom of the header, for this page.', 'yit' ),
    'options' => array(
        'default' => __( 'Default', 'yit' ),
        'enable' => __( 'Enable', 'yit' ),
        'remove' => __( 'Remove', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_header-border-bottom-custom', 'select', $options );





/*

if( yit_get_admin_post_type() != 'product' ) {
    // move up the background slider option
    function yit_move_up_background_slider( $options ) {
        if( isset( $options['yit-page-settings']['Body Background'] ) ) {
            $tmp_options = $options['yit-page-settings']['Body Background'];

            $last = array();
            $last[] = array_pop( $tmp_options );
            $last[] = array_pop( $tmp_options );
            $tmp_options = array_merge( $last, $tmp_options );

            $options['yit-page-settings']['Body Background'] = $tmp_options;
        }

        return $options;
    }
    add_filter( 'yit_add_options_metabox', 'yit_move_up_background_slider', 10 );
}

 */


add_filter('yit_add_options_metabox', 'yit_register_theme_metaboxes');
function yit_register_theme_metaboxes( $options ) {

    if( isset( $options["yit-page-settings"]['Header']['_static_image_target'] ) ) {
        $header_settings = $options["yit-page-settings"]['Header'];

        $new_options = array(
            '_enable_parallax_effect' => array(
                'id' => '_enable_parallax_effect',
                'title' => __('Enable Parallax Effect', 'yit'),
                'type' => 'onoff',
                'desc' => __('Enable Parallax Effect in the header image', 'yit'),
                'name' =>  '_enable_parallax_effect',
                'val' =>  '',
                'std' =>  false,
            ),

            '_parallax_height' => array(
                'id' => '_parallax_height',
                'name' =>  '_parallax_height',
                'desc' => '',
                'title' => __('Container height', 'yit'),
                'type' => 'number',
                'std'  => 300
            ),
            '_parallax_content' => array(
                'id' => '_parallax_content',
                'name' =>  '_parallax_content',
                'desc' => '',
                'title' => __('Content', 'yit'),
                'type' => 'textarea',
                'std'  => ''
            ),
            '_parallax_valign' => array(
                'id' => '_parallax_valign',
                'name' =>  '_parallax_valign',
                'desc' => '',
                'title' => __('Vertical Align', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'top' => __('Top', 'yit'),
                    'center' => __('Center', 'yit'),
                    'bottom' => __('Bottom', 'yit'),
                ),
                'std' => 'center'
            ),
            '_parallax_halign' => array(
                'id' => '_parallax_halign',
                'name' =>  '_parallax_halign',
                'desc' => '',
                'title' => __('Horizontal Align', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'left' => __('Left', 'yit'),
                    'center' => __('Center', 'yit'),
                    'right' => __('Right', 'yit'),
                ),
                'std' => 'center'
            ),
            '_parallax_color' => array(
                'id' => '_parallax_color',
                'name' =>  '_parallax_color',
                'desc' => '',
                'title' => __('Content Text Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#ffffff'
            ),
            '_parallax_hover_color' => array(
                'id' => '_parallax_hover_color',
                'name' =>  '_parallax_hover_color',
                'desc' => '',
                'title' => __('Links hover Color', 'yit'),
                'type' => 'colorpicker',
                'std'  => '#000'
            ),
            '_parallax_effect' => array(
                'id' => '_parallax_effect',
                'name' =>  '_parallax_effect',
                'desc' => '',
                'title' => __('Effect', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'fadeIn' => __('fadeIn', 'yit'),
                    'fadeInUp' => __('fadeInUp', 'yit'),
                    'fadeInDown' => __('fadeInDown', 'yit'),
                    'fadeInLeft' => __('fadeInLeft', 'yit'),
                    'fadeInRight' => __('fadeInRight', 'yit'),
                    'fadeInUpBig' => __('fadeInUpBig', 'yit'),
                    'fadeInDownBig' => __('fadeInDownBig', 'yit'),
                    'fadeInLeftBig' => __('fadeInLeftBig', 'yit'),
                    'fadeInRightBig' => __('fadeInRightBig', 'yit'),
                    'bounceIn' => __('bounceIn', 'yit'),
                    'bounceInDown' => __('bounceInDown', 'yit'),
                    'bounceInUp' => __('bounceInUp', 'yit'),
                    'bounceInLeft' => __('bounceInLeft', 'yit'),
                    'bounceInRight' => __('bounceInRight', 'yit'),
                    'rotateIn' => __('rotateIn', 'yit'),
                    'rotateInDownLeft' => __('rotateInDownLeft', 'yit'),
                    'rotateInDownRight' => __('rotateInDownRight', 'yit'),
                    'rotateInUpLeft' => __('rotateInUpLeft', 'yit'),
                    'rotateInUpRight' => __('rotateInUpRight', 'yit'),
                    'lightSpeedIn' => __('lightSpeedIn', 'yit'),
                    'hinge' => __('hinge', 'yit'),
                    'rollIn' => __('rollIn', 'yit'),
                ),
                'std' => 'fadeIn'
            ),
            '_parallax_button_size' => array(
                'id' => '_parallax_button_size',
                'name' =>  '_parallax_button_size',
                'desc' => '',
                'title' => __('Button Size', 'yit'),
                'type' => 'select',
                'options'  => array(
                    'large' => __('Large', 'yit'),
                    'small' => __('Small', 'yit')
                ),
                'std' => 'small'
            ),

            /*
            '_parallax_header' => array(
                'id' => '_parallax_header',
                'title' => __('Parallax height', 'yit'),
                'type' => 'number',
                'desc' => __('Parallax area height in pixel', 'yit'),
                'name' =>  '_parallax_header',
                'val' =>  '',
                'std' =>  '600',
            ),
            '_parallax_title' => array(
                'id' => '_parallax_title',
                'title' => __('Parallax Title', 'yit'),
                'type' => 'text',
                'desc' => '',
                'name' =>  '_parallax_title',
                'val' =>  '',
                'std' =>  '',
            ),
            '_parallax_title_color' => array(
                'id' => '_parallax_title_color',
                'title' => __('Title color', 'yit'),
                'type' => 'colorpicker',
                'desc' => __('Leave empty in order to use the Theme Options default', 'yit'),
                'name' =>  '_parallax_title_color',
                'std' =>  '',
            ),
            '_parallax_subtitle' => array(
                'id' => '_parallax_subtitle',
                'title' => __('Parallax Subtitle', 'yit'),
                'type' => 'text',
                'desc' => '',
                'name' =>  '_parallax_subtitle',
                'val' =>  '',
                'std' =>  '',
            ),
            '_parallax_subtitle_color' => array(
                'id' => '_parallax_subtitle_color',
                'title' => __('Subtitle color', 'yit'),
                'type' => 'colorpicker',
                'desc' => __('Leave empty in order to use the Theme Options default', 'yit'),
                'name' =>  '_parallax_subtitle_color',
                'std' =>  '',
            ),
            '_parallax_horizontal_position' => array(
                'id' => '_parallax_horizontal_position',
                'title' => __('Parallax Horizontal Position', 'yit'),
                'type' => 'select',
                'desc' => __('Select the Horizontal Position of the content within the Parallax image', 'yit'),
                'name' =>  '_parallax_horizontal_position',
                'options' =>  array(
                    'left' => __('Left', 'yit'),
                    'center' => __('Center', 'yit'),
                    'right' => __('Right', 'yit'),
                ),
                'std' =>  'left',
            ),
            '_parallax_vertical_position' => array(
                'id' => '_parallax_vertical_position',
                'title' => __('Parallax Vertical Position', 'yit'),
                'type' => 'select',
                'desc' => __('Select the Vertical Position of the content within the Parallax image', 'yit'),
                'name' =>  '_parallax_vertical_position',
                'options' =>  array(
                    'left' => __('Top', 'yit'),
                    'center' => __('Center', 'yit'),
                    'right' => __('Bottom', 'yit'),
                ),
                'std' =>  'center',
            ),
            '_parallax_effect' => array(
                'id' => '_parallax_effect',
                'title' => __('Parallax Animation Effect', 'yit'),
                'type' => 'select',
                'desc' => '',
                'name' =>  '_parallax_effect',
                'options' =>  array(
                    'fadeIn' => __('fadeIn', 'yit'),
                    'fadeInUp' => __('fadeInUp', 'yit'),
                    'fadeInDown' => __('fadeInDown', 'yit'),
                    'fadeInLeft' => __('fadeInLeft', 'yit'),
                    'fadeInRight' => __('fadeInRight', 'yit'),
                    'fadeInUpBig' => __('fadeInUpBig', 'yit'),
                    'fadeInDownBig' => __('fadeInDownBig', 'yit'),
                    'fadeInLeftBig' => __('fadeInLeftBig', 'yit'),
                    'fadeInRightBig' => __('fadeInRightBig', 'yit'),
                    'bounceIn' => __('bounceIn', 'yit'),
                    'bounceInDown' => __('bounceInDown', 'yit'),
                    'bounceInUp' => __('bounceInUp', 'yit'),
                    'bounceInLeft' => __('bounceInLeft', 'yit'),
                    'bounceInRight' => __('bounceInRight', 'yit'),
                    'rotateIn' => __('rotateIn', 'yit'),
                    'rotateInDownLeft' => __('rotateInDownLeft', 'yit'),
                    'rotateInDownRight' => __('rotateInDownRight', 'yit'),
                    'rotateInUpLeft' => __('rotateInUpLeft', 'yit'),
                    'rotateInUpRight' => __('rotateInUpRight', 'yit'),
                    'lightSpeedIn' => __('lightSpeedIn', 'yit'),
                    'hinge' => __('hinge', 'yit'),
                    'rollIn' => __('rollIn', 'yit'),
                ),
                'std' =>  'fadeIn',
            ),
            '_parallax_link1_text' => array(
                'id' => '_parallax_link1_text',
                'title' => __('Parallax Link 1 text', 'yit'),
                'type' => 'text',
                'desc' => '',
                'name' =>  '_parallax_link1_text',
                'std' =>  '',
            ),
            '_parallax_link1_url' => array(
                'id' => '_parallax_link1_url',
                'title' => __('Parallax Link 1 url', 'yit'),
                'type' => 'text',
                'desc' => '',
                'name' =>  '_parallax_link1_url',
                'std' =>  '',
            ),
            '_parallax_link2_text' => array(
                'id' => '_parallax_link2_text',
                'title' => __('Parallax Link 2 text', 'yit'),
                'type' => 'text',
                'desc' => '',
                'name' =>  '_parallax_link2_text',
                'std' =>  '',
            ),
            '_parallax_link2_url' => array(
                'id' => '_parallax_link2_url',
                'title' => __('Parallax Link 2 url', 'yit'),
                'type' => 'text',
                'desc' => '',
                'name' =>  '_parallax_link2_url',
                'std' =>  '',
            ),
            '_parallax_links_color' => array(
                'id' => '_parallax_links_color',
                'title' => __('Links color', 'yit'),
                'type' => 'colorpicker',
                'desc' => __('Leave empty in order to use the Theme Options default', 'yit'),
                'name' =>  '_parallax_links_color',
                'std' =>  '',
            ),
            '_parallax_links_hover_color' => array(
                'id' => '_parallax_links_hover_color',
                'title' => __('Links hover color', 'yit'),
                'type' => 'colorpicker',
                'desc' => __('Leave empty in order to use the Theme Options default', 'yit'),
                'name' =>  '_parallax_links_hover_color',
                'std' =>  '',
            ),
            '_parallax_links_background_color' => array(
                'id' => '_parallax_links_background_color',
                'title' => __('Links hover background color', 'yit'),
                'type' => 'colorpicker',
                'desc' => __('Leave empty in order to use the Theme Options default', 'yit'),
                'name' =>  '_parallax_links_background_color',
                'std' =>  '',
            ),
            */
            'sep' => array(
                'id' => 'sep',
                'title' => '',
                'type' => 'sep',
                'desc' => '',
                'name' =>  'sep',
                'val' =>  '',
                'std' =>  '',
            ),
        );

        foreach( $new_options as $k => $option ) {
            yit_array_splice_assoc( $header_settings, array( $k => $option), '_enable_custom_header' );
        }

        $options["yit-page-settings"]['Header'] = $header_settings;
    }

    return $options;
}
