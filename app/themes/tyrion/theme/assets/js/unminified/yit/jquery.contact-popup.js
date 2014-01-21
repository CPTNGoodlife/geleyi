(function($) {
    "use strict";

    $.yit_popup = function(element, options) {

        var defaults = {
            'class' : 'span6',
            'content' : ''
        };

        var self = this;

        self.settings = {};

        var $element = $(element),
            element = element,
            overlay = null,
            popup = null,
            close = null;

        self.init = function() {
            self.settings = $.extend({}, defaults, options);

            _createElements();
            _initEvents();

        };

        var _initEvents = function() {
                $(document).on('touchstart click', '.yitpopup_overlay', function(e){
                    if( $( e.target).hasClass('close') || $( e.target ).parents( '.yitpopup_overlay' ).length == 0 ) {
                        _close();
                    }
                }).on('keyup', function(e) {
                        if (e.keyCode == 27) {
                            _close();
                        }
                    }).on('click', '.yitpopup_wrapper a.close', function () {
                        _close();
                    });

                $(window).on('resize', function(){
                    _center();
                });

                _open();
            },

            _createElements = function() {
                if( $('body').find('.yitpopup_overlay').length == 0 ) {
                    self.overlay = $('<div />', {
                        'class' : 'yitpopup_overlay'
                    }).appendTo('body');
                } else {
                    self.overlay = $('body').find('.yitpopup_overlay');
                }

                if( self.overlay.find('.yitpopup_wrapper').length == 0 ) {
                    self.popup = $('<div />', {
                        'class' : 'yitpopup_wrapper ' + self.settings.class
                    }).appendTo( $('body') );
                } else {
                    self.popup = $('body').find('.yitpopup_wrapper');
                }

                if( self.overlay.find('.close').length == 0 ) {
                    self.close = $('<a />', {
                        'class' : 'close'
                    }).appendTo( self.popup );
                } else {
                    self.close = self.overlay.find('.close');
                }
            },

            _center = function() {
                self.popup.css({
                    position: 'absolute',
                    top: ( parseInt( Math.max(0, jQuery(window).scrollTop()) ) + 50 ) + "px",//'15%',
                    left: Math.max(0, ((jQuery(window).width() - self.popup.outerWidth()) / 2) ) + "px"
                });
            },

            _open = function() {
                _center();
                _content();

                if( self.overlay.css('opacity') != "1" ) {
                    self.overlay.css({ 'display': 'block', opacity: 0 }).animate({ opacity: 1 }, 500);
                }

                //$('body').addClass('yit-popup-opened');
            },

            _close = function() {
                self.overlay.css({ 'display': 'none', opacity: 1 }).animate({ opacity: 0 }, 500);
                $('body').removeClass('yit-popup-opened');

                _destroy();
            },

            _destroy = function() {
                $($element.data('container')).html(self.popup.html());
                self.popup.remove();
                self.overlay.remove();

                //self.popup = self.overlay = null;
                $element.removeData('yit_popup');
            },

            _content = function() {
                if( self.settings.content != '' ) {
                    self.popup.html( self.settings.content );
                } else if( $element.data('container') ) {
                    self.popup.html( $($element.data('container')).html() );
                    $($element.data('container')).empty();
                } else if( $element.data('content') ) {
                    self.popup.html( $element.data('content') );
                } else if( $element.attr('title') ) {
                    self.popup.html( $element.attr('title') );
                } else if ( $element.data('template')) {
                    $.get( $element.data('template'), function( data ) {
                        self.popup.prepend( data );
                    });
                }
                else {
                    self.popup.html('');
                }

                if( self.overlay.find('.close').length == 0 ) {
                    self.close = $('<a />', {
                        'class' : 'close'
                    }).appendTo( self.popup );
                } else {
                    self.close = self.overlay.find('.close');
                }
            };

        self.init();
    };

    $.fn.yit_popup = function(options) {

        return this.each(function() {
            if (undefined === $(this).data('yit_popup')) {
                var yit_popup = new $.yit_popup(this, options);
                $(this).data('yit_popup', yit_popup);
            }
        });

    };

})(jQuery);


(function( window, $, undefined ) {

    $.yit_contact_popup = function( options, element ) {
        this.element = $( element );
        this._init( options );
    };

    $.yit_contact_popup.defaults = {
        'handler' : '.contact-popup',
        'contactForm' : '.yitpopup_wrapper form.contact-form'
    };

    $.yit_contact_popup.prototype = {
        _init : function( options ) {
            this.options = $.extend( true, {}, $.yit_contact_popup.defaults, options );

            if( !this._isMobile() ) {
                this._initEvents();
            }
        },

        _initEvents : function() {
            var self = this;

            //open popup
            $(document).on('click', self.options.handler, function(e){
                e.preventDefault();

                if( $('body').find('.yitpopup_overlay').length == 0 ) {
                    $('<div />', {
                        'class' : 'yitpopup_overlay'
                    }).appendTo('body').css({ 'display': 'block', opacity: 0 }).animate({ opacity: 1 }, 500);
                }

                $.post(
                    contact_popup_vars.ajaxurl,
                    {
                        action : 'yit_contact_popup',
                        _nonce : contact_popup_vars.nonce
                    },
                    function( response ) {
                        if( response ) {
                            self._initPopup( response );
                        }
                    }
                );
            });

            //send email
            $(document).on('submit', self.options.contactForm, function(e){
                var contactForm = $(this);

                e.preventDefault();

                //if( $(this).find('.error').length == 0 ) {
                $.post(
                    contact_popup_vars.ajaxurl,
                    contactForm.serialize() + '&action=yit_contact_popup_send_email&_nonce=' + contact_popup_vars.nonce,
                    function( response ) {
                        if( response ) {
                            contactForm.replaceWith(response);
                        }
                    }
                );
                //}
            });
        },

        _initPopup : function( content ) {
            $('body').yit_popup({
                'class' : 'span10',
                content: content
            });
        },

        _isMobile : function() {
            if(    navigator.userAgent.match(/Android/i)
                || navigator.userAgent.match(/BlackBerry/i)
                || navigator.userAgent.match(/iPhone|iPod/i)
                || navigator.userAgent.match(/IEMobile/i) )
                return true;
            return false;
        }
    };

    $.fn.yit_contact_popup = function( options ) {
        if ( typeof options === 'string' ) {
            var args = Array.prototype.slice.call( arguments, 1 );

            this.each(function() {
                var instance = $.data( this, 'yit_contact_popup' );
                if ( !instance ) {
                    console.error( "cannot call methods on yit_contact_popup prior to initialization; " +
                        "attempted to call method '" + options + "'" );
                    return;
                }
                if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
                    console.error( "no such method '" + options + "' for yit_contact_popup instance" );
                    return;
                }
                instance[ options ].apply( instance, args );
            });
        }
        else {
            this.each(function() {
                var instance = $.data( this, 'yit_contact_popup' );
                if ( !instance ) {
                    $.data( this, 'yit_contact_popup', new $.yit_contact_popup( options, this ) );
                }
            });
        }
        return this;
    };


})( window, jQuery );

jQuery(function($){
    $('body').yit_contact_popup();
});