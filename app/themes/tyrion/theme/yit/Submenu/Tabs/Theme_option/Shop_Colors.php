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
 * Class to print fields in the tab Shop -> Colors
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Colors extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_colors
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
        	/* === START COLORS === */     
            5 => array(
                'type' => 'title',
                'name' => __( 'Cart header widget', 'yit' ),
                'desc' => __( 'Color settings for the widget of shopping cart in header.', 'yit' )
            ),

            20 => array(
                'id' => 'shop-cart-background',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart background', 'yit' ),
                'desc' => __( 'Select the color of shop cart on topbar background.', 'yit' ),
                'std' => '#ffffff',
                'style' => array(
                    'selectors' => '.yit_cart_widget .cart_wrapper .widget_shopping_cart_content, .yit_cart_widget .cart_wrapper , .yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons',
                    'properties' => 'background-color'
                )
            ),

            70 => array(
                'type' => 'title',
                'name' => __( 'Grid View', 'yit' ),
                'desc' => __( 'Colors for the grid view.', 'yit' )
            ),
            120 => array(
                'id' => 'shop-out-of-stock-bg',
                'type' => 'colorpicker',
                'name' => __( 'Color background out of stock message', 'yit' ),
                'desc' => __( 'Select the background color of out of stock message.', 'yit' ),
                'std' => '#8e0404',
                'style' => array(
                	'selectors' => '#primary ul.products li.product a.button.out-of-stock',
                	'properties' => 'background-color'
				)
            ),
            130 => array(
                'id' => 'shop-out-of-stock-text',
                'type' => 'colorpicker',
                'name' => __( 'Color text out of stock message', 'yit' ),
                'desc' => __( 'Select the text color of out of stock message.', 'yit' ),
                'std' => '#fff',
                'style' => array(
                	'selectors' => '#primary ul.products li.product a.button.out-of-stock',
                	'properties' => 'color'
				)
            ),


            340 => array(
                'type' => 'title',
                'name' => __( 'Shop Widgets', 'yit' ),
                'desc' => __( 'Colors for the widgets.', 'yit' )
            ),   
            350 => array(
                'id' => 'shop-price-filter-bar-inactive',
                'type' => 'colorpicker',
                'name' => __( 'Price Filter - Inactive bar', 'yit' ),
                'desc' => __( 'Select the color for the bar rappresents the prices not included in the filtering.', 'yit' ),
                'std' => '#DADADA',
                'style' => array(
                	'selectors' => '.widget.widget_price_filter .price_slider_wrapper .ui-widget-content',
                	'properties' => 'background-color'
				)
            ),  
            360 => array(
                'id' => 'shop-price-filter-bar-active',
                'type' => 'colorpicker',
                'name' => __( 'Price Filter - Active bar', 'yit' ),
                'desc' => __( 'Select the color for the bar rappresents the prices included in the filtering.', 'yit' ),
                'std' => '#CD8906',
                'style' => array(
                	'selectors' => '.widget.widget_price_filter .ui-slider .ui-slider-range, .widget.widget_price_filter .ui-slider .ui-slider-handle',
                	'properties' => 'background-color'
				)
            ), 
            370 => array(
                'id' => 'shop-layered-nav-active-text',
                'type' => 'colorpicker',
                'name' => __( 'Layered Nav - Active filter text', 'yit' ),
                'desc' => __( 'Select the text color for the selected filter.', 'yit' ),
                'std' => '#c38204',
                'style' => array(
                	'selectors' => '.widget.widget_layered_nav .sizes li.chosen .size-filter',
                	'properties' => 'color'
				)
            ),
            380 => array(
                'id' => 'shop-layered-nav-active-border',
                'type' => 'colorpicker',
                'name' => __( 'Layered Nav - Active filter border', 'yit' ),
                'desc' => __( 'Select the text color for the selected filter.', 'yit' ),
                'std' => '#dec084',
                'style' => array(
                	'selectors' => '.widget.widget_layered_nav .sizes li.chosen .size-filter',
                	'properties' => 'border-color'
				)
            ),
            410 => array(
                'id' => 'shop-layered-nav-links',
                'type' => 'colorpicker',
                'name' => __( 'Layered Nav - Links color', 'yit' ),
                'desc' => __( 'Select the text color for the links.', 'yit' ),
                'std' => '#4F4D4D',
                'style' => array(
                	'selectors' => '.widget.widget_layered_nav li a, .widget_product_categories .product-categories li a, .widget.widget_layered_nav .sizes li .size-filter',
                	'properties' => 'color'
				)
            ),
            420 => array(
                'id' => 'shop-layered-nav-links-hover',
                'type' => 'colorpicker',
                'name' => __( 'Layered Nav - Links color (hover and active)', 'yit' ),
                'desc' => __( 'Select the text color for the links.', 'yit' ),
                'std' => '#ca4b4b',
                'style' => array(
                	'selectors' => '.widget.widget_layered_nav li a:hover, .widget_product_categories .product-categories li a:hover, .woocommerce .widget_layered_nav ul li.chosen a:after, .woocommerce .widget_layered_nav ul li.chosen a:before, .woocommerce .widget_layered_nav ul li.chosen a, .widget_product_categories .product-categories li.current-cat a, .widget.widget_layered_nav .sizes li .size-filter:hover, .widget.widget_layered_nav .sizes li.chosen .size-filter',
                	'properties' => 'color, border-color'
				)
            ),
        );
    }
}