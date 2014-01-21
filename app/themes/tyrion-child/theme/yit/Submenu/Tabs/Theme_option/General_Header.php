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
class YIT_Submenu_Tabs_Theme_option_General_Header extends YIT_Submenu_Tabs_Abstract {
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
                'id'   => 'topbar',
                'type' => 'onoff',
                'name' => __( 'Show Top Bar', 'yit' ),
                'desc' => __( 'Select if you want to show the Top Bar above the header.', 'yit' ),
                'std'  => 1
            ),

            21 => array(
                'id'   => 'fixed-header',
                'type' => 'onoff',
                'name' => __( 'Enable Fixed Header', 'yit' ),
                'desc' => __( 'Select if you want to leave the header fixed when the page is scrolled down.', 'yit' ),
                'std'  => 0,
                'deps' => array(
                    'ids' => 'layout-type',
                    'values' => 'stretched'
                )
            ),

            30 => array(
                'id'   => 'header-arrow',
                'type' => 'upload',
                'name' => __( 'Header dropdown arrow', 'yit' ),
                'desc' => __( 'Select the image you want to use as dropdown arrow.', 'yit' ),
                'std'  => get_template_directory_uri() . '/images/dropdown-arrow.png',
                'style' => array(
                    'selectors' => '.dropdown_arrow',
                    'properties' => 'background-image'
                )
            ),

            40 => array(
            'id'   => 'header-menu-posution',
            'type' => 'select',
            'name' => __( 'Main Menu Position', 'yit' ),
            'desc' => __( 'Select the position for the main menu.', 'yit' ),
            'std'  => 'right',
            'options' => array(
                'right' => __('Near the logo', 'yit'),
                'left' => __('Below the logo', 'yit')
            )
        )

        );
    }
}
