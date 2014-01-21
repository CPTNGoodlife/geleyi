<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;

// add support to slide
yit_add_slide_support( $slider_type, 'content', array(

    array(
        'name' => __( 'Vertical align', 'yit' ),
        'id' => 'valign',
        'type' => 'select',
        'desc' => '',
        'std' => 'center',
        'options' => array(
            'top' => __('Top', 'yit'),
            'center' => __('Center', 'yit'),
            'bottom' => __('Bottom', 'yit'),
        )
    ),
    array(
        'name' => __( 'Horizontal align', 'yit' ),
        'id' => 'halign',
        'type' => 'select',
        'desc' => '',
        'std' => 'center',
        'options' => array(
            'left' => __('Left', 'yit'),
            'center' => __('Center', 'yit'),
            'right' => __('Right', 'yit'),
        )
    ),

    array(
        'id' => 'color',
        'name' => __('Content Text Color', 'yit'),
        'desc' => '',
        'type' => 'colorpicker',
        'std'  => '#ffffff'
    ),

    array(
        'id' => 'hover_color',
        'name' => __('Links hover Color', 'yit'),
        'desc' => '',
        'type' => 'colorpicker',
        'std'  => '#000'
    ),

    array(
        'id' => 'effect',
        'name' => __('Effect', 'yit'),
        'desc' => '',
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

    array(
        'id' => 'button_size',
        'name' => __('Button Size', 'yit'),
        'desc' => '',
        'type' => 'select',
        'options'  => array(
            'large' => __('Large', 'yit'),
            'small' => __('Small', 'yit')
        ),
        'std' => 'small'
    ),



));

// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Height content', 'yit' ),
        'id' => 'height',
        'type' => 'number',
        'desc' => __( 'Select the height of container.', 'yit' ),
        'min' => 100,
        'max' => 2000,
        'std' => 600
    ),

    array(
        'name' => __( 'Enable Autoplay', 'yit' ),
        'id' => 'autoplay',
        'type' => 'onoff',
        'desc' => __( 'Enable autoplay of slides.', 'yit' ),
        'std' => true
    ),

    array(
        'name' => __( 'Autoplay speed', 'yit' ),
        'id' => 'autoplay_speed',
        'type' => 'number',
        'desc' => __( 'Autoplay speed in seconds', 'yit' ),
        'min' => 1,
        'max' => 60,
        'std' => 5
    ),
) );