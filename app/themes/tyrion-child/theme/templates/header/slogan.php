<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
global $post, $woocommerce;

$post_id = yit_post_id();
$slogan = $slogan_class = "";

if(  isset($woocommerce) && yit_get_option( 'shop-checkout-slogan-breadcrumb' ) ){
    
    if ( is_cart() || is_checkout() || is_order_received_page() ) {
        $slogan_class .= 'yith-checkout-single ';
        ob_start();
        ?>
            <span <?php if(is_cart()){?> class="current"<?php } ?> >Shopping Cart</span>
            <span <?php if(is_page( woocommerce_get_page_id( 'checkout' ) )){?> class="current"<?php } ?> >Checkout Details</span>
            <span <?php if(is_page( woocommerce_get_page_id( 'pay' ) ) or is_order_received_page()){?> class="current"<?php } ?> >
                Order Complete
            </span>

        <?php
        $slogan = ob_get_clean();
    } else {
        $slogan          = yit_get_post_meta( $post_id, '_slogan' );
    }
}else{ 
    $slogan          = yit_get_post_meta( $post_id, '_slogan' ); 
}


$sub_slogan      = yit_get_post_meta( $post_id, '_sub-slogan' );
$icon_slogan      = yit_get_post_meta( $post_id, '_slogan-icon-image' );

$slogan_class .="slogan";

if( $slogan ) : 
    $tag_slogan     = apply_filters( 'yit_page_slogan_tag', 'h2' );  
    $tag_sub_slogan = apply_filters( 'yit_page_sub_slogan_tag', 'h3' );
    if($icon_slogan){
        $tag_icon_slogan = apply_filters( 'yit_page_sub_slogan_tag', 'img' );
    }

?>
    <!-- SLOGAN -->
    <div class="<?php echo $slogan_class ?> container">
        <div class="slogan_container">
    <?php
        do_action( 'yit_before_slogan' );

        if($icon_slogan){
            yit_string( '<' . $tag_slogan . ' class="' . $slogan_class . ( defined('YIT_SLIDER_USED') && YIT_SLIDER_USED ? ' nopadding' : '' ) . '">', yit_image("src=$icon_slogan&echo=0"). yit_decode_title($slogan), '</' . $tag_slogan . '>' );
        }
        else{
            yit_string( '<' . $tag_slogan . ' class="' . $slogan_class . ( defined('YIT_SLIDER_USED') && YIT_SLIDER_USED ? ' nopadding' : '' ) . '">', yit_decode_title($slogan), '</' . $tag_slogan . '>' );
        }

        if( $sub_slogan ) {
            do_action( 'yit_before_sub_slogan' );
            yit_string( '<' . $tag_sub_slogan . '>', yit_decode_title($sub_slogan), '</' . $tag_sub_slogan . '>' );
        }    
    ?>
        </div>
    </div>
<?php endif; ?>  