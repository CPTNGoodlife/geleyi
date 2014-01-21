// ==ClosureCompiler==
// @output_file_name default.js
// @compilation_level SIMPLE_OPTIMIZATIONS
// ==/ClosureCompiler==

jQuery( document ).ready( function( $ ) {

    //share
    $(document).on('click', '.yit_share', function(e){
        e.preventDefault();

        var share = $(this).parents('.product-actions').siblings('.product-share');
        var template = '<div class="popupOverlay share"></div>' +
            '<div id="popupWrap" class="popupWrap share">' +
            '<div class="popup">' +
            '<div class="border-1 border">' +
            '<div class="border-2 border">' +
            '<div class="product-share">' +
            share.html() +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="close-popup"></div>' +
            '</div>' +
            '</div>';

        $('body').append(template);

        $('.popupWrap').center();
        $('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
        $('.popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );

        /** Close popup function **/
        var close_popup = function() {
            $('.popupOverlay').animate( {opacity:0}, 200);
            $('.popupOverlay').remove();
            $('.popupWrap').animate( {opacity:0}, 200);
            $('.popupWrap').remove();
        }

        /**
         *	Close popup on:
         *	- 'X button' click
         *   - wrapper click
         *   - esc key pressed
         **/
        $('.close-popup, .popupOverlay').click(function(){
            close_popup();
        });

        $(document).bind('keydown', function(e) {
            if (e.which == 27) {
                if($('.popupOverlay')) {
                    close_popup();
                }
            }
        });

        /** Center popup on windows resize **/
        $(window).resize(function(){
            $('#popupWrap').center();
        });
    });

    // hover opacity
    /*$(document).on('hover', '.content ul.products li:not(.list):not(.classic)', function(e){
     var ul = $('ul.products');
     if(e.type == 'mouseenter') {
     ul.find('li').not(this).stop(true, false).animate({opacity:0.6}, 300);

     } else if ( e.type == 'mouseleave' ) {
     ul.find('li').not(this).delay(10).animate({opacity:1}, 300);
     }
     });*/

    $(document).on('hover', 'ul.products li', function(e){
        if(e.type == 'mouseenter') {
            var img = $(this).find('img.image-hover');
            if ( img.length > 0 ) img.css({'display':'block', opacity:0}).animate({opacity:1}, 400);

        } else if ( e.type == 'mouseleave' ) {
            var img = $(this).find('img.image-hover');
            if ( img.length > 0 ) img.animate({opacity:0}, 400);
        }
    });

    // shop style switcher
    $('.list-or-grid a').on( 'click', function(){
        var actual_view = $(this).attr('class').replace( '-view', '' );

        if( YIT_Browser.isIE8() ) {
            actual_view = actual_view.replace( ' last-child', '' );
        }

        $('ul.products li').removeClass('list grid').addClass( actual_view );
        $(this).parent().find('a').removeClass('active');
        $(this).addClass('active');

        switch ( actual_view ) {
            case 'list' :
                $('ul.products li').find('.product-meta-wrapper').css('height', '');
                break;

            case 'grid' :
                break;
        }

        // reset the height of ajax layered nav plugin
        $('#products').css('min-height', '');

        $.cookie(yit_shop_view_cookie, actual_view);

        $('ul.products li').trigger('styleswitch');

        return false;
    });

    // add to cart
    var product;
    $('ul.products').on( 'click', 'li.product .add_to_cart_button', function(){
        product = $(this).parents('li.product');
        product.find('.product-wrapper').block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.3, cursor:'none'}});
        $('.widget.woocommerce.widget_shopping_cart a.cart_control').show();
        $('.widget.woocommerce.widget_shopping_cart a.cart_control.cart_control_empty').remove();
    });
    $('body').on( 'added_to_cart', function( fragmentsJSON, cart_hash ){
        if ( typeof product == 'undefined' ) return;

        if ( product.find('.product-wrapper > .added').length == 0 ) {
            product.find('.product-wrapper').append('<span class="added">added</span>');
            product.find('.added').fadeIn(500);
            product.find('.product-wrapper .grid-add-to-cart .add_to_cart_button').addClass('added');
        }
        product.find('.product-wrapper').unblock();

        $.each(fragments, function(key, value) {
            if ( key == '#popupWrap .message' ) {

                var template = '<div class="popupOverlay add-to-cart"></div>' +
                    '<div id="popupWrap" class="popupWrap add-to-cart">' +
                    '<div class="message">' +
                    value +
                    '</div>' +
                    '<div class="close-popup"></div>' +
                    '</div>' +
                    '</div>';

                if ( $('#popupWrap').length > 0 ) {
                    $('#popupWrap.add-to-cart, .popupOverlay.add-to-cart').remove();
                }

                $('body').append(template);

                $('.popupWrap').center();
                $('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
                $('.popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );

                /** Close popup function **/
                var close_popup = function() {
                    $('.popupOverlay').animate( {opacity:0}, 400);
                    $('.popupOverlay').remove();
                    $('.popupWrap').animate( {opacity:0}, 400);
                    $('.popupWrap').remove();
                }

                /**
                 *	Close popup on:
                 *	- 'X button' click
                 *   - wrapper click
                 *   - esc key pressed
                 **/
                $('.close-popup, .popupOverlay, .continue-shopping').click(function(e){
                    e.preventDefault();
                    close_popup();
                });

                $(document).bind('keydown', function(e) {
                    if (e.which == 27) {
                        if($('.popupOverlay')) {
                            close_popup();
                        }
                    }
                });

                /** Center popup on windows resize **/
                $(window).resize(function(){
                    $('#popupWrap').center();
                });

                return false;

            }
        });
    });

    // variations select
    if( $.fn.selectbox !== undefined ) {
        var form = $('form.variations_form');
        var select = form.find('select');

        if( form.data('wccl') ) {
            select = select.filter(function(){ return $(this).data('type') == 'select' });
        }

        select.selectbox({
            effect: 'fade',
            onOpen: function() {       //console.log('open');
                //$('.variations select').trigger('focusin');
            }
        });

        var update_select = function(event){  // console.log(event);
            select.selectbox("detach");
            select.selectbox("attach");
        };

        // fix variations select
        form.on( 'woocommerce_update_variation_values', update_select);
        form.find('.reset_variations').on('click.yit', update_select);
    }

    // add to wishlist
    var wishlist_clicked;
    $(document).on( 'click', '.yith-wcwl-add-button a', function(){
        wishlist_clicked = $(this);
        wishlist_clicked.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.6, cursor:'none'}});
    });

    // wishlist tooltip (single page)
    var apply_tiptip = function() {
        if ( $(this).parent().find('.feedback').length != 0 ) {
            $(this).tipTip({
                defaultPosition: "top",
                maxWidth: 'auto',
                edgeOffset: 30,
                content: $(this).parent().find('.feedback').text()
            });
        };
    }
    $('.yith-wcwl-add-to-wishlist a').each(apply_tiptip).on('mouseenter', apply_tiptip);



    // shop buttons label
    $('.product-actions a.add_to_wishlist, .product-actions a.compare').each(function(){
        $(this).tipTip({
            defaultPosition: "bottom",
            maxWidth: 'auto',
            edgeOffset: 30,
            content: $(this).text()
        });
    });

    // shop buttons label
    $('.product-actions-loop a.add_to_wishlist, .product-actions-loop a.compare').each(function(){
        $(this).tipTip({

            defaultPosition: "bottom",
            maxWidth: 'auto',
            edgeOffset: 30,
            content: $(this).text()
        });
    });

    if( $.fn.owlCarousel ) {
        $('.products-slider-wrapper').each(function(){
            var t = $(this);

            t.imagesLoaded(function(){
                var cols = t.data('columns') ? t.data('columns') : 4;
                var owl = t.find('.products').owlCarousel({
                    autoPlay: 3000,
                    items : cols,
                    itemsDesktop : [1199,cols],
                    itemsDesktopSmall : [979,cols],
                    itemsTablet : [768, cols],
                    itemsMobile : [480, 1]
                });

                // Custom Navigation Events
                t.on('click', '.es-nav-next', function(){
                    owl.trigger('owl.next');
                });

                t.on('click', '.es-nav-prev', function(){
                    owl.trigger('owl.prev');
                });

            });
        });
    }

    //shop sidebar
    $('#sidebar-shop-sidebar .widget h3').prepend('<div class="minus" />');
    $('#sidebar-shop-sidebar .widget').on('click', 'h3', function(){
        $(this).parent().find('> *:not(h3)').slideToggle();

        if( $(this).find('div').hasClass('minus') ) {
            $(this).find('div').removeClass('minus').addClass('plus');
        } else {
            $(this).find('div').removeClass('plus').addClass('minus');
        }
    });


    //cart dropdown
    $('.shop_table_shipping th, .shop_table_coupon th').on('click', function(e){
        e.preventDefault();

        $(this).find('a').toggleClass('open');

        $('.shipping-calculator-form').show();

        tbody = $(this).parents('table').find('tbody td');
        tbody.slideToggle();
    });

    // update calculate shipping select
    $('body').on('country_to_state_changed', function(){
        $('.shipping-calculator-form .state_select').selectbox({
            effect: 'fade'
        });
    });




});