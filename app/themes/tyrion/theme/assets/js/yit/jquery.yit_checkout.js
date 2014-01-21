(function( window, $, undefined ) {

    $.yit_checkout = function( options, element ) {
        this.element = $( element );
        this._init( options );
    };

    $.yit_checkout.defaults	= {
        steps    : 3,
        elements : {
            steps : $('.step'),
            sections : $('.checkout_multistep_resume a'),
            buttons : '.checkout_buttons input[type="button"]'
        }
    };

    $.yit_checkout.prototype = {

        _init : function( options ) {
            this.options = $.extend( true, {}, $.yit_checkout.defaults, options );
            this.current_step = this.options.elements.steps.filter('.current');
            this.user_logged_in = this.options.elements.steps.filter('.user_logged_in').length > 0;

            this._initEvents();
        },

        _initEvents : function() {
            var elements = this.options.elements;
            var self = this;

            elements.sections.on('click.yit', function(e){
                e.preventDefault();

                var new_step = $(this).data('step');
                var current_step = self.current_step.data('step') ? self.current_step.data('step') : 1;

                self._gotoStep(current_step, new_step);
            });

            $(document).on('click.yit', elements.buttons, function(e){
                e.preventDefault();

                var new_step = $(this).data('step');
                var current_step = self.current_step.data('step') ? self.current_step.data('step') : 1;
                self._gotoStep(current_step, new_step);
            });

            $('body').on('checkout_error', function(){

                if( $('#customer_details .woocommerce-invalid').length > 0 ) {
                    var new_step = 2;
                    var current_step = self.current_step.data('step') ? self.current_step.data('step') : 1;
                    self._gotoStep(current_step, new_step);
                }

            });

        },

        _gotoStep : function(current_step, new_step) {
            if( this._validateStep(current_step, new_step) ) {
                var element  = this.element;
                var next_step = this.options.elements.steps.filter('[data-step='+ new_step + ']');

                this.current_step.fadeOut('slow', function(){
                    next_step.fadeIn('slow').addClass('current');
                    $(this).removeClass('current');

                    element.trigger('slide_change.yit', { step: next_step });
                });

                this.current_step = next_step;
                this._updateSection(new_step);
            }
        },

        _validateStep : function(old_step, new_step) {
            var steps = this.options.steps;

            if( old_step < new_step && new_step <= steps ) {
                return true;
            } else if( this.user_logged_in && new_step > 1 && new_step < old_step ) {
                return true;
            } else if( !this.user_logged_in && new_step > 0 && new_step < old_step ) {
                return true;
            } else {
                return false;
            }
        },

        _updateSection : function( step ) {

            var sections = this.options.elements.sections;

            sections.removeClass('current')
                .removeClass('passed')
                .filter('[data-step='+ step + ']')
                .addClass('current');

            sections.filter(function(){
                return parseInt( $(this).data('step') ) < parseInt( step );
            }).addClass('passed');
        }
    };

    $.fn.yit_checkout = function( options ) {
        if ( typeof options === 'string' ) {
            var args = Array.prototype.slice.call( arguments, 1 );

            this.each(function() {
                var instance = $.data( this, 'yit_checkout' );
                if ( !instance ) {
                    console.error( "cannot call methods on yit_checkout prior to initialization; " +
                        "attempted to call method '" + options + "'" );
                    return;
                }
                if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
                    console.error( "no such method '" + options + "' for yit_checkout instance" );
                    return;
                }
                instance[ options ].apply( instance, args );
            });
        }
        else {
            this.each(function() {
                var instance = $.data( this, 'yit_checkout' );
                if ( !instance ) {
                    $.data( this, 'yit_checkout', new $.yit_checkout( options, this ) );
                }
            });
        }
        return this;
    };


})( window, jQuery );
