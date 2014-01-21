/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js
 *
 * Copyright 2011 @louis_remi
 * Licensed under the MIT license.
 */
(function($) {
    var $event = $.event,
        $special,
        animRunning,
        resizeTimeout;

    $special = $event.special.throttledresize = {
        setup: function() {
            $( this ).on( "resize", $special.handler );
        },
        teardown: function() {
            $( this ).off( "resize", $special.handler );
        },
        handler: function( event, execAsap ) {
            // Save the context
            var context = this,
                args = arguments;

            wasResized = true;
            /*
             if ( !animRunning ) {
             setInterval(function(){
             frame++;

             if ( frame > $special.threshold && wasResized || execAsap ) {
             // set correct event type
             event.type = "throttledresize";
             $event.dispatch.apply( context, args );
             wasResized = false;
             frame = 0;
             }
             if ( frame > 9 ) {
             $(dummy).stop();
             animRunning = false;
             frame = 0;
             }
             }, 30);
             animRunning = true;
             }
             */
        },
        threshold: 0
    };

    var Grid = (function() {

        // list of items
        var $grid = $( 'ul.products:not(.yit_products_slider)' ),
        // the items
            $items = $grid.children( 'li.product' ),
        // current expanded item's index
            current = -1,
        // position (top) of the expanded item
        // used to know if the preview will expand in a different row
            previewPos = -1,
        // extra amount of pixels to scroll the window
            scrollExtra = 0,
        // extra margin when expanded (between preview overlay and the next items)
            marginExpanded = 10,
            $window = $( window ), winsize,
            $body = $( 'html, body' ),
        // transitionend events
            transEndEventNames = {
                'WebkitTransition' : 'webkitTransitionEnd',
                'MozTransition' : 'transitionend',
                'OTransition' : 'oTransitionEnd',
                'msTransition' : 'MSTransitionEnd',
                'transition' : 'transitionend'
            },
            transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
        // support for csstransitions
            support = Modernizr.csstransitions,
        // default settings
            settings = {
                minHeight : 500,
                speed : 350,
                easing : 'ease'
            };

        function init( config ) {

            // the settings..
            settings = $.extend( true, {}, settings, config );

            // preload all images
            $grid.imagesLoaded( function() {

                // save item´s size and offset
                saveItemInfo( true );
                // get window´s size
                getWinSize();
                // initialize some events
                initEvents();

            } );

        }

        // add more items to the grid.
        // the new items need to appended to the grid.
        // after that call Grid.addItems(theItems);
        function addItems( $newitems ) {

            $items = $items.add( $newitems );

            $newitems.each( function() {
                var $item = $( this );
                $item.data( {
                    offsetTop : $item.offset().top,
                    height : $item.height()
                } );
            } );

            initItemsEvents( $newitems );

        }

        // saves the item´s offset top and height (if saveheight is true)
        function saveItemInfo( saveheight ) {
            $items.each( function() {
                var $item = $( this );
                $item.data( 'offsetTop', $item.offset().top );
                if( saveheight ) {
                    $item.data( 'height', $item.height() );
                }
            } );
        }

        function initEvents() {

            // when clicking an item, show the preview with the item´s info and large image.
            // close the item if already expanded.
            // also close if clicking on the item´s cross
            initItemsEvents( $items );

            // on window resize get the window´s size again
            // reset some values..
            $window.on( 'throttledresize', function() {

                scrollExtra = 0;
                previewPos = -1;
                // save item´s offset
                saveItemInfo();
                getWinSize();
                var preview = $.data( this, 'preview' );
                if( typeof preview != 'undefined' ) {
                    hidePreview();
                }

            } );

        }

        function initItemsEvents( $items ) {
            $items.on( 'click', 'span.og-close', function() {
                hidePreview();
                return false;
            } ).on( 'click', 'a.thumb', function(e) {
                    if ( $(window).width() > 767 ) {

                        var $item = $( this ).parents('li.product');
                        // check if item already opened
                        current === $item.index() ? hidePreview() : showPreview( $item );
                        return false;

                    }

                } );
        }

        function getWinSize() {
            winsize = { width : $window.width(), height : $window.height() };
        }

        function showPreview( $item ) {

            $('.woocommerce-message').hide();

            var preview = $.data( this, 'preview' ),
            // item´s offset top
                position = $item.data( 'offsetTop' );

            scrollExtra = 0;

            // if a preview exists and previewPos is different (different row) from item´s top then close it
            if( typeof preview != 'undefined' ) {

                // not in the same row
                if( previewPos !== position ) {
                    // if position > previewPos then we need to take te current preview´s height in consideration when scrolling the window
                    if( position > previewPos ) {
                        scrollExtra = preview.height;
                    }
                    hidePreview();
                }
                // same row
                else {
                    preview.update( $item );
                    return false;
                }

            }

            // update previewPos
            previewPos = position;
            // initialize new preview for the clicked item
            preview = $.data( this, 'preview', new Preview( $item ) );
            // expand preview overlay
            preview.open();

        }

        function hidePreview() {
            current = -1;
            var preview = $.data( this, 'preview' );
            preview.close();
            $.removeData( this, 'preview' );
        }

        // the preview obj / overlay
        function Preview( $item ) {
            this.$item = $item;
            this.expandedIdx = this.$item.index();
            this.create();
            this.update();
        }

        Preview.prototype = {
            create : function() {
                // create Preview structure:
                this.$productContainer = $( '<div class="productWrapper" />' );
                this.$closePreview = $( '<span class="og-close" />' );
                this.$previewInner = $( '<div class="og-expander-inner" />' ).append( this.$closePreview, this.$productContainer );
                this.$previewEl = $( '<div class="og-expander single-product woocommerce" />' ).append( this.$previewInner );
                // append preview element to the item
                this.$item.append( this.getEl() );
                // set the transitions for the preview and the item
                if( support ) {
                    this.setTransition();
                }
            },
            update : function( $item ) {

                if( $item ) {
                    this.$item = $item;
                }

                // if already expanded remove class "og-expanded" from current item and add it to new item
                if( current !== -1 ) {
                    var $currentItem = $items.eq( current );
                    $currentItem.removeClass( 'og-expanded' );
                    this.$item.addClass( 'og-expanded' );
                    // position the preview correctly
                    this.positionPreview();
                }

                // update current value
                current = this.$item.index();

                // update preview´s content
                var product_url = this.$item.find( 'a.thumb').attr('href'),
                    self = this;


                //add loading icon
                self.$productContainer.html('<div class="quick-view-loading" />');

                $.get( product_url, { doing_ajax : 1 }, function( html ) {
                    self.$productContainer.html( html).addClass('group').imagesLoaded(function(){
                        var minHeight = self.$item.siblings(':first').outerHeight();
                        minHeight = minHeight ? minHeight : 470;

                        self.itemMinHeight = minHeight;

                        self.$previewEl.height( self.itemHeight );
                        self.$item.height( minHeight + self.itemHeight - 50 );
                    });

                    var form = self.$productContainer.find('form.variations_form').wc_variation_form();

                    //selectbox - yith_wccl
                    var select = form.find('.variations select[data-type="select"]');
                    select.selectbox({
                        effect: 'fade'
                    }).change();

                    form.find('.reset_variations').on('click', function(e){
                        if( !form.data('wccl') ) {
                            select.each(function(){
                                $(this).selectbox('detach').removeAttr('sb').val('');
                                $(this).selectbox('attach');
                            });
                        }
                    });

                    if( form.data('wccl') ) {
                        form.yith_wccl();
                    }


                    //quantity
                    self.$productContainer.find('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)')
                        .addClass('buttons_added')
                        .append("<input type='button' value='+' class='plus' />")
                        .prepend("<input type='button' value='-' class='minus' />");

                    //tiptip
                    self.$productContainer.find('.product-actions a.add_to_wishlist, .product-actions a.compare').each(function(){
                        $(this).tipTip({
                            defaultPosition: "bottom",
                            maxWidth: 'auto',
                            edgeOffset: 20,
                            content: $(this).text()
                        });
                    });

                    //lightbox
                    if( typeof $.prettyPhoto != 'undefined' ) {
                        // Hide review form - it will be in a lightbox
                        self.$productContainer.find('#review_form_wrapper').hide();

                        // Lightbox
                        self.$productContainer.find("a.zoom").prettyPhoto({
                            social_tools: false,
                            theme: 'pp_woocommerce',
                            horizontal_padding: 40,
                            opacity: 0.9,
                            deeplinking: false
                        });
                        self.$productContainer.find("a.show_review_form").prettyPhoto({
                            social_tools: false,
                            theme: 'pp_woocommerce',
                            horizontal_padding: 40,
                            opacity: 0.9,
                            deeplinking: false
                        });
                        self.$productContainer.find("a[rel^='thumbnails']").prettyPhoto({
                            social_tools: false,
                            theme: 'pp_woocommerce',
                            horizontal_padding: 40,
                            opacity: 0.9,
                            deeplinking: false
                        });

                        // Open review form lightbox if accessed via anchor
                        if( window.location.hash == '#review_form' ) {
                            self.$productContainer.find('a.show_review_form').trigger('click');
                        }
                    }

                    // add to cart
                    self.$productContainer.find('form.cart').on('submit', function(e){
                        e.preventDefault();

                        var form = $(this),
                            button = form.find('button');

                        self.$productContainer.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.3, cursor:'none'}});

                        $.post( form.attr('action'), form.serialize() + '&_wp_http_referer=' + product_url, function( result ) {
                            var message = $('.woocommerce-message', result),
                                cart_dropdown = $('#header .yit_cart_widget', result);

                            // update dropdown cart
                            $('#header .yit_cart_widget').replaceWith( cart_dropdown );

                            // update fragments
                            $.ajax( $fragment_refresh );

                            // add message
                            self.$productContainer.before( message );

                            // update height
                            self.$previewEl.height( self.$previewEl.height() + message.outerHeight(true) );
                            self.$item.height( self.$item.height() + message.outerHeight(true) );

                            // move close button
                            self.$closePreview.insertBefore( self.$productContainer );

                            // remove loading
                            self.$productContainer.unblock();
                        });
                    });

                    $(document).trigger('yit-quick-view-loaded');
                });

            },
            open : function() {

                setTimeout( $.proxy( function() {
                    // set the height for the preview and the item
                    this.setHeights();
                    // scroll to position the preview in the right place
                    this.positionPreview();
                }, this ), 25 );

            },
            close : function() {

                var self = this,
                    onEndFn = function() {
                        if( support ) {
                            $( this ).off( transEndEventName );
                        }
                        self.$item.removeClass( 'og-expanded' );
                        self.$previewEl.remove();


                        $('ul.products:not(.yit_products_slider) li.product').removeAttr('style');
                    };

                setTimeout( $.proxy( function() {

                    if( typeof this.$largeImg !== 'undefined' ) {
                        this.$largeImg.fadeOut( 'fast' );
                    }
                    this.$previewEl.css( 'height', 0 );
                    // the current expanded item (might be different from this.$item)
                    var $expandedItem = $items.eq( this.expandedIdx );
                    $expandedItem.css( 'height', $expandedItem.data( 'height' ) ).on( transEndEventName, onEndFn );

                    if( !support ) {
                        onEndFn.call();
                    }

                }, this ), 25 );

                return false;

            },
            calcHeight : function() {

                var heightPreview = winsize.height - this.$item.data( 'height' ) - marginExpanded,
                    itemHeight = winsize.height;

                if( heightPreview < settings.minHeight ) {
                    heightPreview = settings.minHeight;
                    itemHeight = settings.minHeight + this.$item.data( 'height' ) + marginExpanded;
                }

                this.height = heightPreview;
                this.itemHeight = itemHeight;

            },
            setHeights : function() {

                var self = this,
                    onEndFn = function() {
                        if( support ) {
                            self.$item.off( transEndEventName );
                        }
                        self.$item.addClass( 'og-expanded' );
                    };

                this.calcHeight();
                this.$previewEl.css( 'height', this.height );
                this.$item.css( 'height', this.itemHeight ).on( transEndEventName, onEndFn );

                if( !support ) {
                    onEndFn.call();
                }

            },
            positionPreview : function() {

                // scroll page
                // case 1 : preview height + item height fits in window´s height
                // case 2 : preview height + item height does not fit in window´s height and preview height is smaller than window´s height
                // case 3 : preview height + item height does not fit in window´s height and preview height is bigger than window´s height
                var position = this.$item.data( 'offsetTop' ),
                    previewOffsetT = this.$previewEl.offset().top - scrollExtra,
                    scrollVal = this.height + this.$item.data( 'height' ) + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;

                $body.animate( { scrollTop : scrollVal }, settings.speed );

            },
            setTransition  : function() {
                this.$previewEl.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
                this.$item.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
            },
            getEl : function() {
                return this.$previewEl;
            }
        }

        return {
            init : init,
            addItems : addItems
        };

    })();

    Grid.init();
    // ajax filter
    $(document).on('yith-wcan-ajax-filtered', function(){
        Grid.addItems( $('ul.products:not(.yit_products_slider) li.product') );
    });
})(jQuery);