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
 * Add specific fields to the tab Colors -> General
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_colors_general( $fields ) {
	
    return array_merge( $fields, array(

        240 => array(
            'id'   => 'back-top-background',
            'type' => 'colorpicker',
            'name' => __( 'Back to Top background', 'yit' ),
            'desc' => __( 'Select the color to use for Back to Top background. ', 'yit' ),
            'std'  => apply_filters( 'yit_back-top-background_std', '#93866d' ),
            'style' => apply_filters( 'yit_back-top-background_style', array(
                'selectors' => '#back-top',
                'properties' => 'background-color'
            ) )
        ),
        250 => array(
            'id'   => 'section-title',
            'type' => 'title',
            'name' => __( 'Section colors', 'yit' ),
            'desc' => '',
        ),
        260 => array(
            'id'   => 'hover-section',
            'type' => 'colorpicker',
            'name' => __( 'Hover of Blog and Portfolio section and Pinterest portfolio', 'yit' ),
            'desc' => __( 'Select the color to use for the overlay background for section Blog, section Portfolio and Pinterest portfolio.', 'yit' ),
            'std'  => apply_filters( 'yit_hover-section_std', '#ffffff' ),
            'opacity' => 0.8,
            'style' => apply_filters( 'yit_hover-section_style', array(
                'selectors' => '.section.blog .yit_item .description',
                'properties' => 'background-color'
            ) )
        ),
        270 => array(
            'id'   => 'data-background-section',
            'type' => 'colorpicker',
            'name' => __( 'Date background of the Blog', 'yit' ),
            'desc' => __( 'Select the color to use for the date background of the Blog', 'yit' ),
            'std'  => apply_filters( 'yit_data-background-section_std', '#ffffff' ),
            'opacity' => 0.8,
            'style' => apply_filters( 'yit_data-background-section_style', array(
                'selectors' => '.section.blog .date',
                'properties' => 'background-color'
            ) )
        )
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_colors_general', 'yit_tab_colors_general' );

add_filter( 'yit_general-border_std', create_function( '', 'return "#d8d4d4";' ) );

function yit_general_border_style( $array ) {
    $array['selectors'] = 'code, pre, body hr, #copyright .inner, #footer .inner, .gallery img, .gallery img, .content .archive-list ul, .content .archive-list ul li, 
.more-projects-widget .work-thumb, .more-projects-widget .controls, .more-projects-widget .top, .featured-projects-widget img,
.thumb-project img, #searchform input, .portfolio-categories ul li, .portfolio-categories ul li:hover, .recent-comments .avatar img,
#portfolio .read-more, #portfolio .more-link, #portfolio .read-more:hover,
#portfolio .more-link:hover, .accordion-title, .accordion-item-thumb img, form input[type="text"], form textarea, .testimonial-page,
div.section-caption .caption, .line, .last-tweets-widget ul li, .toggle p.tab-index, .toggle .content-tab, .testimonial,
.google-map-frame, .section.blog .post, .section.blog h4.other-articles, .section.blog .sticky .thumbnail, .section .portfolio-sticky .work-categories,
.testimonial, #searchform input, .blog-big .meta p, .blog-big p.list-tags, .blog-small .image-wrap, .comment-container, .image-square-style #comments img.avatar,
#comments .comment-author img, .comment-meta, #respond input, #respond textarea, img.comment-avatar, .portfolio-big-image a.thumb, .portfolio-big-image a.more,
.portfolio-big-image a.more:hover, .portfolio-big-image .work-thumbnail a.nozoom, .portfolio-big-image .work-skillsdate, .internal_page_item, .gallery-wrap li h5,
.gallery-filters, .portfolio-full-description a.thumb, .portfolio-full-description a.more, .portfolio-full-description a.more:hover,
.portfolio-full-description .work-skillsdate, .related_img, #portfolio.columns .overlay_a, .yit-widget-content .widget,
.slider.thumbnails .showcase-thumbnail img, .slider.thumbnails .showcase-thumbnail img:hover, .slider.thumbnails .showcase-thumbnail.active img,
.recent-post .thumb-img img, .widget_archive ul li a, .widget_archive ul li a:hover, .widget_nav_menu ul li a, .widget_nav_menu ul li a:hover,
.widget_pages ul li a, .widget_pages ul li a:hover, .widget_categories ul li a, .widget_categories ul li a:hover, #searchform input,
.widget_flickrRSS img, .sidebar .widget li ul.sub-menu li:last-child a,.widget_nav_menu ul li a, .widget_pages ul li a, .widget_categories ul li a, .widget_archive ul li a:hover,
.widget_nav_menu ul li.current_page_item > a, .widget_pages ul li.current_page_item > a, .widget_categories ul li.current_page_item > a,
.testimonial-widget div.name-testimonial, .last-tweets-widget ul li, .yit-widget-content .widget, .portfolio-categories ul li, .recent-comments .avatar img,
.more-projects-widget .work-thumb, .more-projects-widget .controls, .more-projects-widget .top, .featured-projects-widget img, .thumb-project img, .picture_overlay,
#respond textarea:focus, .section-portfolio-classic .work-projects a.img, .border, #header-cart-search .cart-items, #header-cart-search .cart-subtotal,
#header-cart-search .widget_shopping_cart .cart_control, #nav .container, .sitemap h3, #copyright .border,
#topbar .widget_search_mini, #header-sidebar #mini-search-submit, #header-sidebar .widget_search_mini .search_mini_content, .topbar-border, .faq-filters-container, .woocommerce .cart-collaterals .cart_totals,
.woocommerce table, .woocommerce table.shop_table, .woocommerce-page table.shop_table, .ie_border, .woocommerce form.login,
.woocommerce .woocommerce_checkout_coupon, .woocommerce form.register, .woocommerce-page form.login, .woocommerce-page .woocommerce_checkout_coupon, .woocommerce-page form.register,
.woocommerce-account .woocommerce form, .woocommerce .address, .woocommerce form.checkout_coupon, .services h1.post-title, .services h1,

.woocommerce ul.products li.product a.thumb,

.woocommerce div.product div.images .thumbnails img
#primary .woocommerce div.product table.variations,
.single-product.woocommerce div.product .related-products h2, .woocommerce .content #page-meta, .single-product.woocommerce div.product div.images .thumbnails img,
.single-product.woocommerce div.product .single_variation_wrap span.label, .single-product.woocommerce div.product .single_variation_wrap span.value,
.single-product.woocommerce div.product div.images img,
.woocommerce table:after, .woocommerce-page .woocommerce_checkout_coupon:after, .woocommerce .woocommerce_checkout_coupon:after, .woocommerce .address:after, .woocommerce-account .woocommerce form:after, .woocommerce form.checkout_coupon:after,

.team-professional ul li .padding, .the-content-list > div,
.thumb-img img, .recent-post .thumb-img img, .sidebar .recent-post .thumb-img img, .recent-post .thumb-img img,
#portfolio.filterable .ch-item, .error404 .border-img-bottom, .error404 .error-404-text, .error404 .error-404-search, .error-404-search input#s,
.faq-title, .recent-post .hentry-post, .toggle h4.tab-index,

.teaser .image img, ul.filters, #map .view-map a,

.woocommerce ul.products li.product.grid.classic.with-border a.thumb,

div.yit_quick_contact, .woocommerce ul.cart_list li, .woocommerce-page ul.cart_list li, .woocommerce ul.product_list_widget li,
.woocommerce-page ul.product_list_widget li, .woocommerce.widget_best_sellers, .sidebar .recent-post .hentry-post,
.sidebar .recent-comments .border, .testimonial-widget li blockquote, .almost-all-categories ul > li, .sidebar .home-widget.contact-info ul li, .sidebar .widget.contact-info ul li,
#footer .widget.contact-info ul li, .yit_toggle_menu ul.menu li a, .widget_product_categories .product-categories li,
.widget.widget_layered_nav li small.count, .widget_product_categories .product-categories li span.count,

.boxed #header-container .innerborder,
.boxed #header-cart:after, .woocommerce table th, .woocommerce table.shop_table th, .woocommerce-page table.shop_table th,
.woocommerce table td, .woocommerce table.shop_table td, .woocommerce-page table.shop_table td, .woocommerce table.cart .product-thumbnail img,
.woocommerce #content table.cart .product-thumbnail img, .woocommerce-page table.cart .product-thumbnail img, .woocommerce-page #content table.cart .product-thumbnail img,
.woocommerce .quantity input.qty, .woocommerce #content .quantity input.qty, .woocommerce-page .quantity input.qty, .woocommerce-page #content .quantity input.qty,
.single-product.woocommerce div.product .related.products h2,
.sidebar input[type=text], .sidebar input[type=search], .sidebar .widget, .welcome_menu .welcome_menu_inner form,
.comment .comment-meta, .comment .comment-content .comment_line, .comment-flexslider, .comment-flexslider .comment-text,

#header-sidebar, .slogan .container, #nav ul.sub-menu, #nav ul.children, #nav .megamenu ul.sub-menu li.dropdown a, #nav .megamenu ul.sub-menu,

.autocomplete-suggestions, #header-sidebar #yith-s, #header-sidebar #yith-searchsubmit,

.general-pagination a, .section .title, #header-sidebar .widget_nav_menu ul.sub-menu,
#header-sidebar .widget_nav_menu #lang_sel ul ul,

.yit_cart_widget .cart_wrapper, .yit_cart_widget .cart_wrapper .widget_shopping_cart_content li,
.yit_cart_widget .cart_wrapper .widget_shopping_cart_content li img,

.checkout_multistep .checkout_multistep_resume, .woocommerce .shop_table_coupon input.input-text,

.tabs-container ul.tabs, .tabs-container ul.tabs li.current a, div.plus, div.minus, .widget.faq-filters ul li, .faq-wrapper, .toggle,
.section.portfolio .wrap-title:after, .section.portfolio .classic .classic-thumbnail-wrap, .box-title .wrap-title, .box-title.wrap-title:after, .box-title.wrap-title .title,
.ie .section.portfolio .classic .classic-thumbnail-wrap, .ie .section.portfolio .classic .classic-thumbnail-wrap:hover,

.woocommerce .quantity .minus, .woocommerce #content .quantity .minus, .woocommerce-page .quantity .minus,
.woocommerce-page #content .quantity .minus, .woocommerce .quantity .plus, .woocommerce #content .quantity .plus,
.woocommerce-page .quantity .plus, .woocommerce-page #content .quantity .plus,

.section-services-bandw .service-wrapper,
.testimonials-flexslider ul li blockquote p, .testimonials-flexslider,
.testimonials-flexslider ul li blockquote p, .testimonials-flexslider,

.home-row .home-widget h3:before, .home-row .home-widget h3:after, .home-row .home-widget img,
.page .home-row .featured-products-widget h3:before, .page .home-row .featured-products-widget h3:after,

.single-product.woocommerce div.product div.images a.add_to_wishlist, .single-product.woocommerce div.product div.images a.compare,
#copyright .container,

.sbHolder .sbSelector, .single-product.woocommerce div.og-close,

#footer .container .row-fluid:first-child';

    return $array;
}
add_filter( 'yit_general-border_style', 'yit_general_border_style' );

function yit_container_background_style( $array ) {
    $array['selectors'] = '.boxed #wrapper, #header .slider.slider-thumbnails, #header .slider.slider-thumbnails .showcase-thumbnail-container, .section.portfolio .wrap-title .title,
    .page .home-row .home-widget h3';
    return $array;
}
add_filter( 'yit_container-background_style', 'yit_container_background_style' );


