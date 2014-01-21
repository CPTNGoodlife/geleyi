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
 * Class to print fields in the tab Shop -> Products page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Products_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_products_page
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
                'id'   => 'shop-products-title',
                'type' => 'onoff',
                'name' => __( 'Show products page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Products.', 'yit' ),
                'std'  => true,
            ),
            18 => array(
                'id'   => 'shop-show-breadcrumb',
                'type' => 'onoff',
                'name' => __( 'Show breadcrumb', 'yit' ),
                'desc' => __( 'Say if you want the breadcrumb in the shop pages.', 'yit' ),
                'std'  => true,
            ),
            20 => array(
                'id'   => 'shop-view',
                'type' => 'select',
                'name' => __( 'Show View', 'yit' ),
                'desc' => __( 'Select the default view for the page shop.', 'yit' ),
                'options' => apply_filters( 'yit_shop-view_options', array(
                    'grid' => __( 'Grid View', 'yit' ),
                    'list' => __( 'List View', 'yit' ),
                ) ),
                'std'  => apply_filters( 'yit_shop-view_std', 'grid' )
            ),
            25 => array(
                'id'   => 'shop-grid-list-option',
                'type' => 'onoff',
                'name' => __( 'Show "Grid/List" view option', 'yit' ),
                'desc' => __( 'Say if you want to show the option to switch between "Grid" and "List" view.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-grid-list-option_std', 1 )
            ),
            27 => array(
                'id'   => 'active-flip-3d',
                'type' => 'onoff',
                'name' => __( 'Active Flip 3D mouse over effect', 'yit' ),
                'desc' => __( 'Set if you want to active the flip 3d effect when the mouse over on the products.', 'yit' ),
                'std'  => apply_filters( 'yit_active-flip-3d_std', 1 )
            ),
            30 => array(
                'id'   => 'shop-use-quick-view',
                'type' => 'onoff',
                'name' => __( 'Use "Quick view"', 'yit' ),
                'desc' => __( 'Set if you want to show the "Quick View" button on product mouseover.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-use-quick-view_std', 1 )
            ),
            35 => array(
                'id'   => 'shop-quick-view-text',
                'type' => 'text',
                'name' => __( 'Quick View text', 'yit' ),
                'desc' => __( 'Set the text for the "Quick View" button.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-quick-view-text_std', __( 'Quick View', 'yit' ) ),
                'deps' => array(
                    'ids' => 'shop-use-quick-view',
                    'values' => 1
                ),
            ),
            40 => array(
                'id'   => 'shop-view-show-style',
                'type' => 'select',
                'name' => __( 'Style for product meta', 'yit' ),
                'desc' => __( 'Define the style for the product meta in the products list.', 'yit' ),
                'options' => array(
                    'floated' => __( 'Floated', 'yit' ),
                    'centered' => __( 'Centered', 'yit' ),
                ),
                'std'  => apply_filters( 'yit_shop-view-show-style_std', 'Floated' )
            ),
            45 => array(
                'id'   => 'shop-view-show-title',
                'type' => 'onoff',
                'name' => __( 'Show product title', 'yit' ),
                'desc' => __( 'Say if you want to show the product title.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-title_std', 1 )
            ),
            50 => array(
                'id'   => 'shop-view-show-price',
                'type' => 'onoff',
                'name' => __( 'Show product price', 'yit' ),
                'desc' => __( 'Say if you want to show the product price.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-price_std', 1 )
            ),
            55 => array(
                'id'   => 'shop-view-show-rating',
                'type' => 'onoff',
                'name' => __( 'Show product rating', 'yit' ),
                'desc' => __( 'Say if you want to show the product rating.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-rating_std', 1 )
            ),
            60 => array(
                'id'   => 'shop-view-show-wishlist',
                'type' => 'onoff',
                'name' => __( 'Show wishlist', 'yit' ),
                'desc' => __( 'Define if you want to show the buttons "Wishlist" in the products list.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-wishlist', 1 )
            ),
            65 => array(
                'id'   => 'shop-view-show-add-to-cart',
                'type' => 'onoff',
                'name' => __( 'Show add to cart', 'yit' ),
                'desc' => __( 'Say if you want to show the details icon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-add-to-cart_std', 1 )
            ),
            70 => array(
                'id'   => 'shop-view-show-description',
                'type' => 'onoff',
                'name' => __( 'Show product description (only for list view)', 'yit' ),
                'desc' => __( 'Say if you want to show the product description, only for list view.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-description_std', 1 )
            ),
            100 => array(
                'id'   => 'shop-added-icon',
                'type' => 'upload',
                'name' => __( 'Added icon', 'yit' ),
                'desc' => __( 'Change the icon for the Added feedback message, when you add to cart a product in AJAX.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-added-icon_std', get_template_directory_uri() . '/woocommerce/images/bullets/added.png' ),
                'style' => array(
                	'selectors' => '.woocommerce ul.products li.product span.added',
                	'properties' => 'background-image'
				)
            ),
        );
    }
}