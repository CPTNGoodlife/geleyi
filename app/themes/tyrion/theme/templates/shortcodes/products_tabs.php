<?php
wp_enqueue_script('owl-carousel');

global $yit_products_tabs_index;
if ( ! isset( $yit_products_tabs_index )  ) $yit_products_tabs_index = 0;

$sc = array();
?>
<div class="tabs-container products_tabs">
    <ul class="tabs">
        <?php for( $i = 1; isset($var['title_'.$i]); $i++ ) :
            $title = ( !empty( $var['title_'.$i] ) ) ? $var['title_'.$i] : '' ;
            $per_page = ( !empty( $var['per_page_'.$i] ) ) ? $var['per_page_'.$i] : '-1' ;
            $category = ( !empty( $var['category_'.$i] ) ) ? $var['category_'.$i] : '0' ;
            $show = ( !empty( $var['show_'.$i] ) ) ? $var['show_'.$i] : 'all' ;
            $featured = $best_sellers = $on_sale = 'no';
            if ( $show == 'featured' ) { $featured = 'yes'; }
            elseif ( $show == 'best_sellers' ) { $best_sellers = 'yes'; }
            elseif ( $show == 'onsale' ) { $on_sale = 'yes'; }
            $orderby = ( !empty( $var['orderby_'.$i] ) ) ? $var['orderby_'.$i] : '0' ;
            $order = ( !empty( $var['order_'.$i] ) ) ? $var['order_'.$i] : '0' ;

            echo '<li><h4><a href="#" data-tab="tab-' . $yit_products_tabs_index . '" title="' . $title . '">' . $title . '</a></h4></li>';
            $sc[$yit_products_tabs_index] = '[products_slider title="' . $title . '" per_page="' . $per_page . '" featured="' . $featured . '" best_sellers="' . $best_sellers . '" on_sale="' . $on_sale . '" category="' . $category . '" orderby="' . $orderby . '" order="' . $order . '" layout="default" ]';
            $yit_products_tabs_index++;
        endfor ?>
    </ul>
    <div class="border-box group">
        <?php foreach ( $sc as $sc_key => $sc_value ) { ?>
            <div id="tab-<?php echo $sc_key ?>" class="panel group"><?php echo do_shortcode( $sc_value ); ?></div>
        <?php } ?>
    </div>
</div>

