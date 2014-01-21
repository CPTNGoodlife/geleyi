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
 * Class to print fields in the tab Shop -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Typography extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_typography
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
        	/* === START FONT === */
            10 => array(
                'type' => 'title',
                'name' => __( 'Product list', 'yit' ),
                'desc' => __( 'Typography settings for the products list.', 'yit' )
            ),


            30 => array(
                'id'   => 'shop-add-to-cart-typo-color',
                'type' => 'colorpicker',
                'name' => __( 'Add to cart (on hover)', 'yit' ),
                'desc' => __( 'Choose the color for the add to cart when mouse over.', 'yit' ),
                'std'  => '#ca4b4b',
                'style' => array(
                    'selectors' => '.woocommerce ul.products li.product.grid a.add_to_cart_button:hover',
                    'properties' => 'color'
                )
            ),

            40 => array(
                'type' => 'title',
                'name' => __( 'Product detail page', 'yit' ),
                'desc' => __( 'Typography settings for the products list.', 'yit' )
            ),

            50 => array(
                'id'   => 'shop-product-detail-title',
                'type' => 'typography',
                'name' => __( 'Product detail title and price', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 24,
                'std'  => array(
                    'size'   => 16,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'bold',
                    'color'  => '#0a0a0a'
                ),
                'style' => array(
                    'selectors' => '.single-product.woocommerce div.product .product_title',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),


            110 => array(
                'type' => 'title',
                'name' => __( 'Cart header widget', 'yit' ),
                'desc' => __( 'Typography settings for the widget of shopping cart in header.', 'yit' )
            ),


            120 => array(
                'id'   => 'shop-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart list font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 11,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'extra-bold',
                    'color'  => '#000000'
                ),
                'style' => array(
                    'selectors' => '.woo_cart .yit_cart_widget.widget_shopping_cart .cart_wrapper ul.cart_list li a, .woo_cart .yit_cart_widget.widget_shopping_cart .cart_wrapper .cart_list li.empty, .woo_cart .yit_cart_widget.widget_shopping_cart .cart_wrapper h2, .yit_cart_widget .cart_wrapper .widget_shopping_cart_content li a, .yit_cart_widget .cart_wrapper .widget_shopping_cart_content li .quantity, .yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons a',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),

            125 => array(
                'id'   => 'shop-cart-remove-link-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart list, remove link font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 11,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#b4b4b4'
                ),
                'style' => array(
                    'selectors' => ' .yit_cart_widget .cart_wrapper .widget_shopping_cart_content li .remove_item',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),


            130 => array(
                'id' => 'shop-cart-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Shopping cart list font hover', 'yit' ),
                'desc' => __( 'Select the color of shop cart list on hover.', 'yit' ),
                'std' => '#ca4b4b',
                'style' => array(
                    'selectors' => '.yit_cart_widget .cart_wrapper .widget_shopping_cart_content li a:hover',
                    'properties' => 'color'
                )
            ),


            140 => array(
                'id'   => 'price-cart-font',
                'type' => 'typography',
                'name' => __( 'Shopping cart price font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color.', 'yit' ),
                'min'  => 10,
                'max'  => 18,
                'std'  => array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'regular',
                    'color'  => '#9f6110'
                ),
                'style' => array(
                    'selectors' => '.woo_cart .yit_cart_widget.widget_shopping_cart ul.product_list_widget li .quantity, .woo_cart .yit_cart_widget.widget_shopping_cart ul.product_list_widget li .amount',
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                )
            ),

        );
    }
}