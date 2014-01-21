<?php

    wp_enqueue_script( 'yit_swiper_slider', YIT_THEME_ASSETS_URL . '/js/swiper.product-slider.js', array('jquery'), '1.0', true );
    wp_enqueue_script('owl-swiper');

global $wpdb, $woocommerce, $woocommerce_loop;

    if(yit_get_sidebar_layout() == 'sidebar-no'){
        $overflow = 'visible';
        $have_sidebar = 'sidebar-no';
    }else{
        $overflow = 'hidden';
        $have_sidebar = 'sidebar-yes';
    }

    if ( ! empty( $category ) && empty( $cat ) ) {
        $cat = $category;
    }

  	if ( isset( $latest ) && $latest == 'yes' ) {
        $orderby = 'date';
        $order = 'desc'; 
    }
	
  	$args = array(
		'post_type'	=> array( 'product', 'product_variation' ),
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'ignore_sticky_posts'	=> 1,
		'meta_query' => '',
        'fields' => 'id=>parent'
	);
	
	if(isset( $featured) && $featured == 'yes' ){
    	$args['meta_query'][] = array(
      		'key' 		=> '_featured',
      		'value' 	=> 'yes'
    	);
  	}
	
	if(isset( $best_sellers) && $best_sellers == 'yes' ){
		$args['meta_key'] = 'total_sales';
    	$args['orderby'] = 'meta_value';
    	$args['order'] = 'desc';
  	}
	
	if(isset( $on_sale) && $on_sale == 'yes' ){
		$args['meta_key'] = '_sale_price';
		$args['meta_compare'] = '>=';
		$args['meta_value'] = 0;

        $sale_products = get_posts( $args );
        $product_ids 	= array_keys( $sale_products );
        $parent_ids		= array_values( $sale_products );

        // Check for scheduled sales which have not started
        foreach ( $product_ids as $key => $id ) {
            if ( get_post_meta( $id, '_sale_price_dates_from', true ) > current_time('timestamp') ) {
                unset( $product_ids[ $key ] );
            }
        }

        $product_ids_on_sale = array_unique( array_merge( $product_ids, $parent_ids ) );

        set_transient( 'wc_products_onsale', $product_ids_on_sale );
  	}

    $query_args = array(
        'posts_per_page' 	=> $per_page,
        'no_found_rows' => 1,
        'post_status' 	=> 'publish',
        'post_type' 	=> 'product',
        'orderby' 		=> $orderby,
        'order' 		=> $order,
        'meta_query' 	=> $args['meta_query'],
    );
	
	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
        $query_args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}
	
	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
        $query_args['post__in'] = $ids;
	}           

    if ( ! empty( $cat ) ) {
        $tax = 'product_cat';
        $cat = array_map( 'trim', explode( ',', $cat ) );
        if ( count($cat) == 1 ) $cat = $cat[0];
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $cat
            )
        );
    }

    if ( $on_sale == 'yes' ) {
        if( empty( $product_ids_on_sale ) )
            { return; }

        $query_args['post__in'] = $product_ids_on_sale;
    }

    if(!isset($height) || $height == '' || $height < 0){
        $height = 0;
    }

    if(isset($autoplay) && ($autoplay == 'off' || $autoplay == '' || $autoplay == 'no')){
        $play_speed = 0;
    }

    if($play_speed == ''){
        $play_speed = 0;
    }

    $woocommerce_loop['setLast'] = true;

	$products = new WP_Query( $query_args );

	$woocommerce_loop['view'] = 'grid';
    $woocommerce_loop['layout'] =  ( isset( $layout ) && $layout != 'default' ) ? $layout : '';
    $i = 0;

    ob_start();

    $num_items = count($products->posts);

    //Set the Number of Columns
    if(!isset($columns)) {
        $columns = 2;
    }elseif($columns < 1){
        $columns = 1;
    }elseif($columns > 4){
        $columns = 4;
    }

    /*
     * The real numbers of items to display is the min value between
     * the numbers of columns and the numbers of items that the query returns,
    */
    $num_items_to_display = min($num_items, $columns);

    //Set the Image Width
    if($num_items_to_display == 1) {
        $width = 1154;
    }elseif($num_items_to_display == 2){
        $width = 575;
    }elseif($num_items_to_display == 3){
        $width = 370;
    }elseif($num_items_to_display == 4){
        $width = 270;
    }

	if ( $products->have_posts() ) : ?>

        <div class="woocommerce swiper products-slider">

            <?php if (isset($title) && $title != '') : ?>
                <?php echo '<h4>'.$title.'</h4>'; ?>
            <?php endif; ?>

            <div class="row">
                <div class="swiper-container">
                    <div class="swiper-wrapper swiper-products" data-items="<?php echo $num_items_to_display ?>" data-overflow="<?php echo $overflow ?>"  data-autoplay="<?php echo $play_speed ?>">

                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                            <?php $product = get_product( $products->post->ID ); ?>
                            <?php $post_image_id = get_post_thumbnail_id( $products->post->ID ); ?>
                            <?php $attachment_image_info = yit_image( "id={$post_image_id}&width={$width}&height={$height}&crop=1&output=array" ); ?>

                            <div class="slide swiper-slide">
                                <div class="swiper-slide-image">
                                    <div class="swiper-slide-wrapper">
                                        <?php yit_image( "id={$post_image_id}&width={$width}&height={$height}&crop=1" ); ?>
                                        <div class="opacity" style="width: <?php echo $attachment_image_info[1] - 16 ?>px; height: <?php echo $attachment_image_info[2] -16 ?>px;">
                                            <div class="swiper-product-informations item-<?php echo $num_items_to_display ?> <?php echo $have_sidebar ?>">

                                                <span class="product-title">
                                                    <a href="<?php echo the_permalink() ?>">
                                                        <?php echo $product->post->post_title; ?>
                                                    </a>
                                                </span>

                                                <span class="product-price">
                                                    <?php if ($product->product_type == 'variable') : ?>
                                                        <?php echo $product->get_child( $products->post->ID )->get_price_html();	?>

                                                        <?php elseif($product->product_type == 'simple') : ?>
                                                            <?php echo $product->get_price_html() ?>
                                                    <?php endif; ?>
                                                </span>

                                                <span class="product-add-to-cart">
                                                    <?php if ( $product->is_in_stock() && is_shop_enabled() ) : ?>

                                                        <?php if ($product->product_type == 'simple') : ?>
                                                            <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
                                                                <button type="submit" class="buttons">
                                                                    <?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'yit' ), $product->product_type); ?>
                                                                </button>
                                                            </form>

                                                        <?php elseif ($product->product_type == 'variable') : ?>
                                                            <a href="<?php the_permalink() ?>" class="buttons">
                                                                <?php _e('select options','yit'); ?>
                                                            </a>
                                                        <?php endif; ?>

                                                    <?php endif; ?>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php echo do_shortcode('[clear]');

    wp_reset_query();
	                         
	$woocommerce_loop['loop'] = 0;        
	unset( $woocommerce_loop['setLast'] );
	
