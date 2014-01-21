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
 * Class to print fields in the tab Colors -> Buttons
 *
 * @since 1.0.0
 */

class YIT_Submenu_Tabs_Theme_option_Colors_Buttons extends YIT_Submenu_Tabs_Abstract {
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
.woocommerce .cart-collaterals input[type=submit].button.checkout-button, .pricing_box p.button a, .price-table .body .more a,
.yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.checkout';

		$default_selectors_hover = '.black-button:hover, .alt-buttons a:hover, .alt-button:hover, .btn.btn-alt-button:hover,  .btn.btn-black-button:hover,

a.button:hover, button.button:hover, input.button:hover,
.woocommerce .wishlist_table .product-add-to-cart a.add_to_cart.button.alt:hover,
#popupWrap .popup .popup-newsletter-section .input-prepend .submit-field:hover, .btn-button:hover,
#portfolio.columns .read-more:hover,
.contact-form li.submit-button input:hover,
.woocommerce .cart-collaterals input[type=submit].button.checkout-button:hover, .pricing_box p.button a:hover, .price-table .body .more a:hover,
.yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.checkout:hover';


		$red_buttons = '.red-button,
                        .contact-form li.submit-button input,
                        #place_order,
		                .sidebar .contact-form li.submit-button input,
					    .sidebar .widget_search #searchform .button,
                        .woocommerce ul.products li.product.grid .buttons-list-wrapper a.button, .woocommerce div.product form.cart .button,
                        .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce input.checkout-button,
                        .woocommerce #respond input#submit, .woocommerce-page input.button.alt,
                        .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button,
                        .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button,
                        .woocommerce #payment #place_order, .btn.btn-red-button,
                        .yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.cart,
                        .sidebar .widget_product_search #searchform #searchsubmit,
                        .woocommerce .wishlist_table .product-add-to-cart a.add_to_cart.button.alt,
                        #respond #commentsubmit,
                        .error-404-search input#searchsubmit';

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
                                .yit_cart_widget .cart_wrapper .widget_shopping_cart_content p.buttons .button.cart:hover,
                                .sidebar .widget_product_search #searchform #searchsubmit:hover,
                                .woocommerce .wishlist_table .product-add-to-cart a.add_to_cart.button.alt:hover,
                                #respond #commentsubmit:hover,
                                .error-404-search input#searchsubmit:hover';

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
				'id' => 'background-black-buttons',
				'type' => 'colorpicker',
				'name' => __( 'Buttons background', 'yit' ),
				'desc' => __( 'Select a background for the buttons of all pages.', 'yit' ),
				'std' => apply_filters( 'yit_background-black-buttons_std', '#000000' ),
				'style' => apply_filters( 'yit_background-buttons_selectors', array(
					'selectors' => $default_selectors ,
					'properties' => 'background-color'
				) )
			),

			20 => array(
				'id' => 'background-black-buttons-hover',
				'type' => 'colorpicker',
				'name' => __( 'Buttons Background Hover', 'yit' ),
				'desc' => __( 'Select a background hover for the buttons of all pages.', 'yit' ),
				'std' => apply_filters( 'yit_background-black-buttons-hover_std', '#454545' ),
				'style' => apply_filters( 'yit_background-buttons-hover_selectors', array(
					'selectors' => $default_selectors_hover,
					'properties' => 'background-color'
				) )
			),

			30 => array(
				'id' => 'black-buttons-border-colors',
				'type' => 'colorpicker',
				'name' => __( 'Buttons border color', 'yit' ),
				'desc' => __( 'Select a color for the border buttons of all pages.', 'yit' ),
				'std' => apply_filters( 'yit_black-buttons-border-colors_std', '#5d5959' ),
				'style' => apply_filters( 'yit_buttons-border-colors_selectors', array(
					'selectors' => $default_selectors,
					'properties' => 'border-color'
				) )
			),

			40 => array(
				'id' => 'black-buttons-border-hover-colors',
				'type' => 'colorpicker',
				'name' => __( 'Buttons border hover color', 'yit' ),
				'desc' => __( 'Select a color for the hover border buttons of all pages.', 'yit' ),
				'std' => apply_filters( 'yit_black-buttons-border-hover-colors_std', '#5d5959' ),
				'style' => apply_filters( 'yit_buttons-border-hover-colors_selectors', array(
					'selectors' => $default_selectors_hover,
					'properties' => 'border-color'
				) )

			),


			50 => array(
				'type' => 'title',
				'name' => __( 'Red Buttons', 'yit' ),
				'desc' => __( 'Used for shop pages and important call to actions', 'yit' )
			),

			60 => array(
				'id' => 'red-buttons-background',
				'type' => 'colorpicker',
				'name' => __( 'Buttons background', 'yit' ),
				'desc' => __( 'Select a background for the buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_red-buttons-background_std', '#ca4b4b' ),
				'style' => apply_filters( 'yit_red-buttons-background_selectors', array(
					'selectors' => $red_buttons,
					'properties' => 'background-color'
				) )
			),

			70 => array(
				'id' => 'red-buttons-background-hover',
				'type' => 'colorpicker',
				'name' => __( 'Buttons Background Hover', 'yit' ),
				'desc' => __( 'Select a background hover for the buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_red-buttons-background-hover_std', '#8d0202' ),
				'style' => apply_filters( 'yit_red-buttons-background-hover_selectors', array(
					'selectors' => $red_buttons_hover,
					'properties' => 'background-color'
				) )
			),

			80 => array(
				'id' => 'red-buttons-border-colors',
				'type' => 'colorpicker',
				'name' => __( 'Buttons border color', 'yit' ),
				'desc' => __( 'Select a color for the border buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_red-buttons-border-colors_std', '#9f2424' ),
				'style' => apply_filters( 'yit_red-buttons-border-colors_selectors', array(
					'selectors' => $red_buttons,
					'properties' => 'border-color'
				) )
			),

			90 => array(
				'id' => 'red-buttons-border-hover-colors',
				'type' => 'colorpicker',
				'name' => __( 'Buttons border hover color', 'yit' ),
				'desc' => __( 'Select a color for the hover border buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_red-buttons-border-hover-colors_std', '#9f2424' ),
				'style' => apply_filters( 'yit_red-buttons-border-hover-colors_selectors', array(
					'selectors' => $red_buttons_hover,
					'properties' => 'border-color'
				) )

			),


			120 => array(
				'type' => 'title',
				'name' => __( 'White Buttons', 'yit' ),
				'desc' => __( 'Used for slider and parallax header', 'yit' )
			),

			130 => array(
				'id' => 'white-buttons-background',
				'type' => 'colorpicker',
				'name' => __( 'Buttons background', 'yit' ),
				'desc' => __( 'Select a background for the buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_white-buttons-background_std', '#ffffff' ),
				'style' => apply_filters( 'yit_white-buttons-background_selectors', array(
					'selectors' => $white_buttons,
					'properties' => 'background-color'
				) )
			),

			140 => array(
				'id' => 'white-buttons-background-hover',
				'type' => 'colorpicker',
				'name' => __( 'Buttons Background Hover', 'yit' ),
				'desc' => __( 'Select a background hover for the buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_white-buttons-background-hover_std', '#414141' ),
				'style' => apply_filters( 'yit_white-buttons-background-hover_selectors', array(
					'selectors' => $white_buttons_hover,
					'properties' => 'background-color'
				) )
			),

			150 => array(
				'id' => 'white-buttons-border-colors',
				'type' => 'colorpicker',
				'name' => __( 'Buttons border color', 'yit' ),
				'desc' => __( 'Select a color for the border buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_white-buttons-border-colors_std', '#414141' ),
				'style' => apply_filters( 'yit_white-buttons-border-colors_selectors', array(
					'selectors' => $white_buttons,
					'properties' => 'border-color'
				) )
			),

			160 => array(
				'id' => 'white-buttons-border-hover-colors',
				'type' => 'colorpicker',
				'name' => __( 'Buttons border hover color', 'yit' ),
				'desc' => __( 'Select a color for the hover border buttons in sidebar.', 'yit' ),
				'std' => apply_filters( 'yit_white-buttons-border-hover-colors_std', '#414141' ),
				'style' => apply_filters( 'yit_white-buttons-border-hover-colors_selectors', array(
					'selectors' => $white_buttons_hover,
					'properties' => 'border-color'
				) )

			),
		);
	}
}