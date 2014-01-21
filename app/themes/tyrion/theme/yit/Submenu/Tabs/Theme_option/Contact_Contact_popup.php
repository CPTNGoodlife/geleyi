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

/**
 * Class to print fields in the tab General -> Header
 *
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Contact_Contact_popup extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     *
     * @var array
     * @since 1.0.0
     */
    public $fields;

    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_general_settings
     *
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }

    /**
     * Set default values
     *
     * @return array
     * @since 1.0.0
     */
    public function init() {
        return array(

            10 => array(
                'type' => 'title',
                'name' => __( 'Contact Popup', 'yit' ),
                'desc' => __( 'In order to use the contact popup please add the <code>contact-popup</code> class to the link in which you want to activate it.', 'yit' ),
            ),

            20 => array(
                'id' => 'enable-contact-popup',
                'type' => 'onoff',
                'name' => __( 'Enable Contact Popup', 'yit' ),
                'desc' => '',
                'std' => false,
            ),

            30 => array(
                'id'   => 'contact-title',
                'type' => 'text',
                'name' => __( 'Popup title', 'yit' ),
                'desc' => __( 'The popup title. Leave empty if you do not want to display.', 'yit' ),
                'std'  => ''
            ),

            40 => array(
                'id' => 'contact-popup',
                'type' => 'select',
                'name' => __( 'Contact Form', 'yit' ),
                'desc' => __( 'Select the contact form you\'d like to use.', 'yit' ),
                'options' => yit_contact_forms(),
                'std' => -1,
            ),

            50 => array(
                'id'   => 'contact-content',
                'type' => 'textareaeditor',
                'name' => __( 'Content below the form', 'yit' ),
                'desc' => '',
                'std'  => ''
            ),

            60 => array(
                'type' => 'title',
                'name' => __( 'Contact Popup Customizations', 'yit' ),
                'desc' => '',
            ),

            70 => array(
                'id'   => 'contact-title-font',
                'type' => 'typography',
                'name' => __( 'Title font', 'yit' ),
                'desc' => __( 'Select the type to use for the title.', 'yit' ),
                'min'  => 1,
                'max'  => 32,
                'std'  => apply_filters( 'yit_contact-title-font_std', array(
                    'size'   => 18,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'bold',
                    'color'  => '#4d4b4b'
                ) ),
                'style' => array(
                    'selectors' => '#contact_popup h1.title',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),

            80 => array(
                'id' => 'contact-title-background',
                'type' => 'colorpicker',
                'name' => __( 'Title background', 'yit' ),
                'desc' => __( 'Select the background for title.', 'yit' ),
                'std' => '#f0eded',
                'style' => array(
                    'selectors' => '#contact_popup h1.title',
                    'properties' => 'background-color'
                )
            ),

        );
    }
}
