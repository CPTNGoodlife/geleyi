<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$woocommerce_loop['li_class'] = array();

if ( !( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) )
    $woocommerce_loop['layout'] = yit_get_option( 'shop-layout', 'with-hover' );

// view
if ( !( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) )
    $woocommerce_loop['view'] = yit_get_option( 'shop-view', 'grid' );

$woocommerce_loop['li_class'][] = $woocommerce_loop['view'];

yit_detect_span_catalog_image();  //automatically add the classes

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
    $woocommerce_loop['li_class'][] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
    $woocommerce_loop['li_class'][] = 'last';

$woocommerce_loop['li_class'][] = 'product-category';

// control for the product counter
if(!$show_counter){ $show_counter= yit_get_option( 'shop-category-count');  }
// control for the discovery text
if(!$discovery_text){ $discovery_text=yit_get_option( 'discovery-text');  }
// control for the category's style
if(!$style){ $style = yit_get_option( 'shop-category-style' ); }
// Put the style in the <li> tag
if ($style=='white'): $woocommerce_loop['li_class'][] = 'white'; else: $woocommerce_loop['li_class'][] = 'black'; endif;


yit_detect_span_catalog_image();  //automatically add the classes
?>
<li <?php post_class( $woocommerce_loop['li_class'] ); ?>>

    <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

    <?php

    // Took the thumbnail infos from woocommerce
    $small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
    $thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

    // Put this infos in yit_image
    $default_cat_img=woocommerce_placeholder_img_src();
    $values_category = yit_image( "id={$thumbnail_id}&output=array&size={$small_thumbnail_size}&default={$default_cat_img} " );
    ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" style="background:url('<?php yit_image("id={$thumbnail_id}&output=url"); ?>'); height:<?php echo $values_category[2]-14; ?>px ;">


        <div class="show-category-background">
            <h3>
                <?php
                echo $category->name;

                // Second control for the show counter
                if($show_counter==1){
                    if ( $category->count > 0 )
                        echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">(' . $category->count . ')</span>', $category );
                }
                // Below this we Echo the discovery text
                ?>
                <span class="discovery-now"><?php echo $discovery_text; ?></span>
            </h3>

            <?php
            /**
             * woocommerce_after_subcategory_title hook
             */
            do_action( 'woocommerce_after_subcategory_title', $category );
            ?>
        </div>

        <?php
        /**
         * woocommerce_before_subcategory_title hook
         *
         * @hooked woocommerce_subcategory_thumbnail - 10
         */
        do_action( 'woocommerce_before_subcategory_title', $category );
        ?>
    </a>

    <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>