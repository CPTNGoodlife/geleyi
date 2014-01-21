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
 * Class to print fields in the tab Typography -> General
 *
 * @since 1.0.0
 */

class YIT_Submenu_Tabs_Theme_option_Typography_Buttons extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     *
     * @var array
     * @since 1.0.0
     */
    public $fields;

    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_typography_buttons
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

        /*SELECTORS LIST*/

        $default_selectors = '.black-button, .alt-buttons a, .alt-button, .btn.btn-alt-button,  .btn.btn-black-button,
a.button, button.button, input.button, #respond input#submit,
.woocommerce-page a.button.alt,
#popupWrap .popup .popup-newsletter-section .input-prepend .submit-field, .btn-button, btn-mini,
#popupWrap.add-to-cart .buttons input.button,
#portfolio.columns .read-more,

.woocommerce .cart-collaterals input[type=submit].button.checkout-button,  .price-table .body .more a,
.yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.checkout';

        $default_selectors_hover = '.black-button:hover, .alt-buttons a:hover, .alt-button:hover, .btn.btn-alt-button:hover,  .btn.btn-black-button:hover,

a.button:hover, button.button:hover, input.button:hover,
.woocommerce .wishlist_table .product-add-to-cart a.add_to_cart.button.alt:hover,
#popupWrap .popup .popup-newsletter-section .input-prepend .submit-field:hover, .btn-button:hover,
#portfolio.columns .read-more:hover,
.contact-form li.submit-button input:hover,
.woocommerce .cart-collaterals input[type=submit].button.checkout-button:hover,  .price-table .body .more a:hover,
.yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.checkout:hover';


        $red_buttons = '.red-button,
                        #place_order,
                        .contact-form li.submit-button input,
		                .sidebar .contact-form li.submit-button input,
					    .sidebar .widget_search #searchform .button,
                        .woocommerce ul.products li.product.grid .buttons-list-wrapper a.button, .woocommerce div.product form.cart .button,
                        .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce input.checkout-button,
                        .woocommerce #respond input#submit, .woocommerce-page input.button.alt,
                        .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button,
                        .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,
                        .woocommerce #payment #place_order, .btn.btn-red-button,
                        .sidebar .widget_product_search #searchform #searchsubmit,
                        .yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.cart';

        $red_buttons_hover =   '.red-button:hover,
                                #place_order:hover,
		                        .sidebar .contact-form li.submit-button input:hover,
							    .sidebar .widget_search #searchform .button:hover,
                                .contact-form li.submit-button input:hover,
                                .woocommerce ul.products li.product.grid .buttons-list-wrapper a.button:hover, .woocommerce div.product form.cart .button:hover,
                                .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
                                .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover,
                                .woocommerce-page button.button:hover, .woocommerce-page input.button:hover,
                                .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover,
                                .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
                                .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover,
                                .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover,
                                .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover,
                                .woocommerce-page #content input.button.alt:hover,
                                .woocommerce #payment #place_order:hover, .btn.btn-red-button:hover,
                                .sidebar .widget_product_search #searchform #searchsubmit:hover,
                                .yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.cart:hover';

        /** Woocommerce Background buttons color  */
        $white_buttons       = '.white-button, .btn.btn-white-button';
        $white_buttons_hover = '.white-button:hover, .btn.btn-white-button:hover';


        return array(

            5 => array(
                'type' => 'title',
                'name' => __( 'Black Buttons', 'yit' ),
                'desc' => __( 'Default style for the buttons in the theme', 'yit' )
            ),

            10 => array(
                'id'   => 'background-black-buttons-text',
                'type' => 'typography',
                'name' => __( 'Buttons Typography', 'yit' ),
                'desc' => __( 'Select the font, color and size for buttons text. ', 'yit' ),
                'min'  => 1,
                'max'  => 32,
                'std'  => apply_filters( 'yit_background-black-buttons-text_std', array(
                    'size'   => 11,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'extra-bold',
                    'color'  => '#ffffff'
                ) ),
                'style' => apply_filters( 'yit_background-black-buttons-text_style', array(
                    'selectors' => $default_selectors,
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),

            20 => array(
                'id' => 'background-black-buttons-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Buttons color hover', 'yit' ),
                'desc' => __( 'Select a text color hover for the buttons of all pages.', 'yit' ),
                'std' => apply_filters( 'yit_background-black-buttons-text-hover_std', '#ffffff' ),
                'style' => apply_filters( 'yit_background-black-buttons-text-hover_selectors', array(
                    'selectors' => $default_selectors_hover,
                    'properties' => 'color'
                ) )
            ),

            30 => array(
                'type' => 'title',
                'name' => __( 'Red Buttons', 'yit' ),
                'desc' => __( 'Used for shop pages and important call to actions', 'yit' )
            ),

            40 => array(
                'id'   => 'red-buttons-background-text',
                'type' => 'typography',
                'name' => __( 'Buttons Typography', 'yit' ),
                'desc' => __( 'Select the font, color and size for buttons in sidebars. ', 'yit' ),
                'min'  => 1,
                'max'  => 32,
                'std'  => apply_filters( 'yit_background-black-buttons-text_std', array(
                    'size'   => 11,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'extra-bold',
                    'color'  => '#ffffff'
                ) ),
                'style' => apply_filters( 'yit_background-black-buttons-text_style', array(
                    'selectors' => $red_buttons,
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),

            50 => array(
                'id' => 'red-buttons-background-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Buttons color hover', 'yit' ),
                'desc' => __( 'Select a text color hover for the buttons in sidebars.', 'yit' ),
                'std' => apply_filters( 'yit_background-black-buttons-text-hover_std', '#ffffff' ),
                'style' => apply_filters( 'yit_background-black-buttons-text-hover_selectors', array(
                    'selectors' => $red_buttons_hover,
                    'properties' => 'color'
                ) )
            ),


            120 => array(
                'type' => 'title',
                'name' => __( 'White Buttons', 'yit' ),
                'desc' => __( 'Used for slider and parallax header', 'yit' )
            ),

            130 => array(
                'id'   => 'white-buttons-background-text',
                'type' => 'typography',
                'name' => __( 'Buttons Typography', 'yit' ),
                'desc' => __( 'Select the font, color and size for buttons in sidebars. ', 'yit' ),
                'min'  => 1,
                'max'  => 32,
                'std'  => apply_filters( 'yit_white-buttons-background-text_std', array(
                    'size'   => 11,
                    'unit'   => 'px',
                    'family' => 'Lato',
                    'style'  => 'extra-bold',
                    'color'  => '#414141'
                ) ),
                'style' => apply_filters( 'yit_background-black-buttons-text_style', array(
                    'selectors' => $white_buttons,
                    'properties' => 'font-size, font-family, color, font-style, font-weight'
                ) )
            ),

            140 => array(
                'id' => 'white-buttons-background-text-hover',
                'type' => 'colorpicker',
                'name' => __( 'Buttons color hover', 'yit' ),
                'desc' => __( 'Select a text color hover for the buttons in sidebars.', 'yit' ),
                'std' => apply_filters( 'yit_white-buttons-background-text-hover_std', '#ffffff' ),
                'style' => apply_filters( 'yit_white-buttons-background-text-hover_selectors', array(
                    'selectors' => $white_buttons_hover,
                    'properties' => 'color'
                ) )
            ),
        );
    }
}