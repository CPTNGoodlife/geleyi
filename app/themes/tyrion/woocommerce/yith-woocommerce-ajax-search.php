<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.0.0
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


wp_enqueue_script('yith_wcas_jquery-autocomplete' );

?>

<div class="yith-ajaxsearchform-container">
    <form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
        <div>
            <input type="search" value="<?php echo get_search_query() ?>" name="s" id="yith-s" placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>" />
            <input type="submit" id="yith-searchsubmit" value="" />
            <input type="hidden" name="post_type" value="product" />
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery(function($){
        var search_loader_url = "<?php echo apply_filters('yith_wcas_ajax_search_icon', get_template_directory_uri() . '/woocommerce/images/yit-ajax-search.gif' ) ?>";

        $('#yith-s').autocomplete({
            minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
            appendTo: '.yith-ajaxsearchform-container',
            serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
            onSearchStart: function(){
                $(this).css('background', 'url('+search_loader_url+') no-repeat 90% center');
            },
            onSearchComplete: function(){
                $(this).css('background', 'transparent');
            },
            onSelect: function (suggestion) {
                if( suggestion.id != -1 ) {
                    window.location.href = suggestion.url;
                }
            }
        });
    });
</script>