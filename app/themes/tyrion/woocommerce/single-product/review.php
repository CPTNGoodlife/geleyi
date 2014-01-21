<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">



		<div class="comment-text">

            <?php echo get_avatar( $GLOBALS['comment'], $size='71' ); ?>

            <?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
			<?php else : ?>

				<p class="meta">

                    <span class="vcard author" itemprop="author">
                        <span class="fn"><?php comment_author(); ?></span>
                    </span>

                    <?php
						if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
							if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';
					?>

                    <time class='timestamp-link' expr:href='data:post.url' title='permanent link' itemprop="datePublished">
                        <abbr class='updated published' expr:title='data:post.timestampISO8601'>
                            <data:post.timestamp/>
                            <?php echo get_comment_date(__( get_option('date_format'), 'woocommerce' )); ?>
                        </abbr>
                    </time>

                    <?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>

                        <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">

                            <span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%">
                                <meta itemprop="worstRating" content = "1">

                                <strong itemprop="ratingValue">
                                    <?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?>
                                </strong>

                                <?php _e( 'out of 5', 'woocommerce' ); ?>
                                <meta itemprop="bestRating" content = "5">
                            </span>

                        </div>

			        <?php endif; ?>
				</p>
			<?php endif; ?>

				<div itemprop="description" class="description"><?php comment_text(); ?></div>
				<div class="clear"></div>
			</div>
		<div class="clear"></div>
	</div>
</li>