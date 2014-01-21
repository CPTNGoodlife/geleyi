<?php
    wp_enqueue_script('owl-carousel');

	global $woocommerce_loop;
	
	$ids = '';
	if ( isset( $category ) && $category != '' ) {
		$ids = explode( ',', $category );
	  	$ids = array_map( 'trim', $ids );
		if (in_array('0', $ids)) $ids = '';
	}                         
    
    $woocommerce_loop['setLast'] = true;
                                                       
    //$woocommerce_loop['style'] = $style;


    if ( ($style) ||  $style != 'black' ): $style = 'white'; endif;
	if (!isset($numbers) || $numbers == '') $numbers = 'yes';

    if ( !isset($show_counter) || $show_counter == 'no' || $show_counter != 'yes'): $show_counter = '0'; elseif($show_counter == 'yes'): $show_counter = '1'; else: $show_counter = '1'; endif;

	$hide_empty = ( $hide_empty == true || $hide_empty == 'yes' ) ? 1 : 0;
	
  	$args = array(
  		//'number'     => $number,
  		'orderby'    => $orderby,
  		'order'      => $order,
  		'hide_empty' => $hide_empty,
		'include'    => $ids
	);
	
  	$terms = get_terms( 'product_cat', $args ); 
    
    $woocommerce_loop['view'] = 'grid';
    if ( isset( $layout ) && $layout != 'default' ) $woocommerce_loop['layout'] = $layout;


# control for the product counter
if(isset($show_counter)): /* Nothing */ else:$show_counter= yit_get_option( 'shop-category-count');  endif;
# control for the discovery text
if(isset($discovery_text)): /* Nothing */ else:$discovery_text=yit_get_option( 'discovery-text');  endif;
# control for the category's style
if(isset($style)): /* Nothing */  else: $style = yit_get_option( 'shop-category-style' ); endif;
# Put the style in the <li> tag
if ($style=='white'): $woocommerce_loop['li_class'][] = 'white'; else: $woocommerce_loop['li_class'][] = 'black'; endif;

	
	//$products_per_page = apply_filters( 'loop_shop_columns', 4 );
	//$woocommerce_loop['columns'] = $columns;
  	if ( $terms ) {

        ob_start();

  	    $html = $html_mobile = '';
		
		$i = 0;
		echo '<div class="woocommerce">';
		echo '<div class="products-slider-wrapper" data-columns="%columns%">';
		
		echo '<div class="products-slider show-category categories '.$style.' numbers-'.$numbers.'">';
		if (isset($title) && $title != '')
			echo '<h4>'.$title.'</h4>';
		else
			echo '<h4>&nbsp;</h4>';
		echo '<div class="row"><ul class="products '.$style.'">';
		foreach ( $terms as $category ) {
			woocommerce_get_template( 'content-product_cat.php', array(
				'category' => $category,

                'style' => $style,
                'show_counter'    => $show_counter,
                'discovery_text' => $discovery_text,
			) );			
		}
		echo '</ul></div>';
		
		echo '<div class="es-nav"><span class="es-nav-prev">Previous</span><span class="es-nav-next">Next</span></div>';
		
		echo '</div><div class="es-carousel-clear"></div>';

		echo '</div>';

        $content = ob_get_clean();
        echo str_replace('%columns%', $woocommerce_loop['columns'] ,$content);

	}

	wp_reset_query();	                         
	
	$woocommerce_loop['loop'] = 0;
	unset( $woocommerce_loop['setLast'] ); 
	
?>