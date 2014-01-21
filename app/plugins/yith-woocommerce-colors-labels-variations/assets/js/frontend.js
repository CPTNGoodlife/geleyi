/**
 * Frontend
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Colors and Labels Variations
 * @version 1.0.0
 */

(function ( $, window, document ) {

$.fn.yith_wccl = function () {
    var form = $('.variations_form');
    var last_change = form.data('last_change');
    var select = form.find('.variations select');


    this.clean = function() {
        form.find('.select_box').remove();

        return this;
    };

    this.generateOutput = function() {
        last_change = form.data('last_change');
        select.each(function(){
            var t = $(this),
                type = $(this).data('type');

            if( type != 'select' ) {
                if( t.attr('name') == last_change ) {
                    select_box = t.data('last_content');
                    select_box = select_box.insertAfter(t);
                    select_box.find('.select_option')
                        .off('click')
                        .on('click', function(e){
                            if( $(this).hasClass('selected') ) {
                                t.val('').change();
                                t.removeClass('selected');
                            } else {
                                var value = $(this).data('value');
                                var option = $(this).data('option');

                                t.append(option).val(option.val()).change();
                                t.append(option).val(option.val()).change(); //do not remove the duplicated line
                            }
                        });
                } else {
                    var select_box = $('<div />', {
                        'class' : 'select_box_' + type + ' select_box ' + t.attr('name')
                    }).insertAfter(t);

                    t.removeData('last_content');
                    t.find('option').each(function(){
                        if( $(this).data('value') ) {
                            var classes = 'select_option_' + type + ' select_option';
                            var value = $(this).data('value');
                            var o = $(this);

                            var option = $('<div/>', {
                                'class' : classes
                            }).data('value', value)
                                .data('option', o.clone(true))
                                .appendTo(select_box)
                                .off('click')
                                .on('click', function(e){
                                    if( $(this).hasClass('selected') ) {
                                        t.val('').change();
                                        t.removeClass('selected');
                                    } else {
                                        e.preventDefault();
                                        t.val(o.val()).change();
                                    }
                                });

                            if( type == 'colorpicker' ) {
                                option.append( $('<span/>', {
                                    'css'  : {
                                        'background' : value
                                    }
                                }) );
                            } else if( type == 'image' ) {
                                option.append( $('<img/>', {
                                    'src' : value
                                }) );
                            } else if( type == 'label' ) {
                                option.append( $('<span/>', {
                                    'text' : value
                                }) );
                            }
                        }
                    });
                }
            }
        }).filter(function(){ return $(this).data('type') != 'select' }).hide();
    };

    this.onSelect = function(){
        select.each(function(){
            var value = $(this).find('option:selected').data('value');
            var options = $(this).siblings('.select_box')
                .find('.select_option')
                .removeClass('selected');

            if( value ) {
                options
                    .filter(function(){ return $(this).data('value') == value })
                    .addClass('selected');
            }
        });
    };

    this.clean()
    this.generateOutput()
    this.onSelect();

    return this;
}


jQuery(function($){

    var form = $('.variations_form');
    var select = form.find('.variations select');

    $(document).on('check_variations', form, function(){
        setTimeout(function(){
            form.yith_wccl();
        }, 20);
    });
    form.yith_wccl();

    $(document).on('change', '.variations_form .variations select', function(){
        form.data('last_change', $(this).attr('name'));
        $(this).data('last_content', $(this).siblings('.select_box').clone(true));
    });

    $('.reset_variations').on('click', function(){
        setTimeout(function(){
            select.removeData('last_content');
            form.removeData('last_change');
        }, 20);
    });

});

})( jQuery, window, document );


