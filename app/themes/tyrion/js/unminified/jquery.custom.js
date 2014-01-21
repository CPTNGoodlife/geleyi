// In case we forget to take out console statements. IE becomes very unhappy when we forget. Let's not make IE unhappy
if(typeof(console) === 'undefined') {
    var console = {}
    console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
}

jQuery( document ).ready( function( $ ) {
    $('body').removeClass('no_js').addClass('yes_js');

    if ( YIT_Browser.isIE8() ) {
        $('*:last-child').addClass('last-child');
    }

    if( YIT_Browser.isIE10() ) {
        $( 'html' ).attr( 'id', 'ie10' ).addClass( 'ie' );
    }

    //placeholder support
    if($.fn.placeholder) {
        $('input[placeholder], textarea[placeholder]').placeholder();
    }

    // simple select style
    var custom_selects = $('.woocommerce-ordering select, .faq-filters select, .woocommerce table.shop_table_shipping p select');
    if ( custom_selects.length > 0 ) {
        custom_selects.selectbox({
            effect: 'fade'
        });
    }

    //header fixed
    if( $('body.stretched').hasClass('header-fixed') ) {
        var headHeight = $('#header').height();
        var mTop = $('#wrapper').css('margin-top');

        $(document).on("scroll",function(){

            if( $(document).scrollTop() > 100  & $(window).width() > 767){

                var top = 0;
                if ( $('#banner.tyrion').length > 0 ) top = $('#banner.tyrion').height();

                if( !$("#header").hasClass("header-small") ) {
                    $("#header")
                        .hide()
                        .removeClass("header-large")
                        .addClass("header-small")
                        .css({
                            top : - headHeight,
                            display: 'block'
                        })
                        .delay(500)
                        .animate({ top: top }, 500);
                }

                $('#wrapper').css('padding-top', headHeight);

            } else {
                $("#header")
                    .removeClass("header-small")
                    .addClass("header-large")
                    .css({
                        top: 0
                    })
                    .show();

                $('#wrapper').css('padding-top', mTop);
            }
        });

    }

    //iPad, iPhone hack
    $('.ch-item').bind('hover', function(e){});

    //Form fields shadow
    $( 'form input[type="text"], form textarea' ).focus(function() {
        //Hide label
        $( this ).parent().find( 'label.hide-label' ).hide();
    }).blur(function() {
            //Show label
            if( $( this ).val() == '' )
            { $( this ).parent().find( 'label.hide-label' ).show(); }
        }).each( function() {
            //Show label
            if( $( this ).val() != '' && $( this ).parent().find( 'label.hide-label' ).is( ':visible' ) )
            { $( this ).parent().find( 'label.hide-label' ).hide(); }
        });
    /*
     // remove margin from the slider, if the page is empty
     if ( $('.slider').length != 0 && $.trim( $('#primary *, #page-meta').text() ) == '' ) {
     //$('.slider').attr('style', 'margin-bottom:0 !important;');
     $('#primary').remove();
     }
     */

    //play, zoom on image hover
    var yit_lightbox;
    (yit_lightbox = function(){

        if( jQuery( 'body' ).hasClass( 'isMobile' ) ) {
            jQuery("a.thumb.img, .overlay_img, .section .related_proj, a.ch-info-lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox',
                fixed:true,
                maxWidth: '100%',
                maxHeight: '100%',
                opacity : 0.7
            });

            jQuery(".section .related_lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox2',
                fixed:true,
                maxWidth: '100%',
                maxHeight: '100%',
                opacity : 0.7
            });
        } else {
            jQuery("a.thumb.img, .overlay_img, .section.portfolio .related_proj, a.ch-info-lightbox, a.ch-info-lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox',
                fixed:true,
                maxWidth: '80%',
                maxHeight: '80%',
                opacity : 0.7
            });

            jQuery(".section.portfolio .related_lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox2',
                fixed:true,
                maxWidth: '80%',
                maxHeight: '80%',
                opacity : 0.7
            });
        }

        jQuery("a.thumb.video, .overlay_video, .section.portfolio .related_video, a.ch-info-lightbox-video").colorbox({
            transition:'elastic',
            rel:'lightbox',
            fixed:true,
            maxWidth: '60%',
            maxHeight: '80%',
            innerWidth: '60%',
            innerHeight: '80%',
            opacity : 0.7,
            iframe: true,
            onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
        });
        jQuery(".section.portfolio .lightbox_related_video").colorbox({
            transition:'elastic',
            rel:'lightbox2',
            fixed:true,
            maxWidth: '60%',
            maxHeight: '80%',
            innerWidth: '60%',
            innerHeight: '80%',
            opacity : 0.7,
            iframe: true,
            onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
        });
    })();


    //overlay
    $('.picture_overlay').hover(function(){

        var width = $(this).find('.overlay div').innerWidth();
        var height =  $(this).find('.overlay div').innerHeight();
        var div = $(this).find('.overlay div').css({
            'margin-top' : - height / 2,
            'margin-left' : - width / 2
        });

        if(YIT_Browser.isIE8()) {
            $(this).find('.overlay > div').show();
        }
    }, function(){

        if(YIT_Browser.isIE8()) {
            $(this).find('.overlay > div').hide();
        }
    }).each(function(){
            var width = $(this).find('.overlay div').innerWidth();
            var height =  $(this).find('.overlay div').innerHeight();
            var div = $(this).find('.overlay div').css({
                'margin-top' : - height / 2,
                'margin-left' : - width / 2
            });
        });



    //Sticky Footer
    $( '#primary' ).imagesLoaded( function() {
        if( $( '#footer' ).length > 0 )
        { $( '#footer' ).stickyFooter(); }
        else
        { $( '#copyright' ).stickyFooter(); }
    } );

    // portfolio simply project info fix
    $('.portfolio-simply').each(function(){
        var add_padding;
        var $thisp = $(this);
        (add_padding = function(){
            var project_info_height = $thisp.find('.work-skillsdate').height() + 14;
            $thisp.find('.work-description').css( 'padding-bottom', project_info_height+'px' );
        })();
        $(window).resize(add_padding);
    });

    // replace type="number" in opera
    $('.opera .quantity input.input-text.qty').replaceWith(function() {
        $(this).attr('value')
        return '<input type="text" class="input-text qty text" name="quantity" value="' + $(this).attr('value') + '" />';
    });

    // hide #back-top first
    $("#back-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    // bookmark
    $("a.bookmark").click(function(e) {
        e.preventDefault();

        var url = $(this).attr('href'),
            title = $(this).attr('title');

        if (window.sidebar) { // Mozilla Firefox Bookmark
            window.sidebar.addPanel(title, url,"");
        } else if( window.external ) { // IE Favorite
            window.external.AddFavorite( url, title);
        } else if(window.opera && window.print) { // Opera Hotlist
            return true;
        }
    });

    // teaser fix
    var fix_teaser_height = function(){
        $('.teaser .image p.title').each( function(){
            var title = $(this);
            title.height( title.height() );
        });
    };
    $('.teaser').imagesLoaded( fix_teaser_height );
    $(window).on( 'resize', fix_teaser_height );

    //widget dropdown
    $('.sidebar .widget.widget_nav_menu').each(function(){
        var header = $(this).find(':header');
        header.append('<span class="dropdown_widget"></span>');


        $(this).on('click', ':header', function(){
            $(this).parent().find('> *:not(:header)').slideToggle();

            if( $(this).find('.dropdown_widget').hasClass('closed') ) {
                $(this).find('.dropdown_widget').removeClass('closed').addClass('opened');
            } else {
                $(this).find('.dropdown_widget').removeClass('opened').addClass('closed');
            }
        });
    })

    $(document).on('click', '.search_mini_button', function(e){
        e.preventDefault();
        $(this).next().toggleClass('animated');
    });

    //arrow menu
    $('#nav > ul > li > div.submenu, #header-sidebar .widget_nav_menu ul.sub-menu, #lang_sel ul ul').append('<span class="dropdown_arrow" />');

    //Widgets image border
    $('.yit_widget_border_image .sidebar .widget').each(function(){
        $(this).find('li a img').addClass('no-border');
        $(this).find('div img').addClass('no-border');
    })

    // Services Rollover
    $(".services .service").hover(
        function(){
            $('.services .service').not(this).stop().animate({opacity:1}, 300);
        },
        function(){
            $('.services .service').not(this).stop().animate({opacity:1}, 300);
        }
    );


    if( $('#primary .parallaxeos').length > 0 && $('body').hasClass('boxed') ) {
        $('#wrapper').css('overflow', 'hidden');
    }

    //Chrome flip/parallax fix
    //enable the wrap only if the parallax is contained within the primary content
    if( navigator.userAgent.indexOf('Chrome') && $('#primary .parallaxeos').length > 0 ) {
        var products = $('ul.products');
        products.each(function(){
            if( $(this).parents('.products-slider').length == 0 ) {
                $(this).addClass('chromeparallax');
            }
        });
    }
});

