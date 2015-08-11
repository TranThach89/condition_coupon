<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce;

$product_id = $product->id;
$in_cart = '';

//check if product is already in the cart
if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
									
	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		
		$_product = $values['data'];
											
		if ( $_product->id == $product_id ) {
			
			$in_cart = '<a href="'.site_url('cart').'">Already in cart <i class="icon-shopping-cart"></i></a>';
			
		} 
		
	}//foreach								
		
} 

?>

<div style="margin-bottom:10px;" class="pm-column-header product">
    <p itemprop="name" class="pm-woocom-item-title entry-title"><?php the_title(); ?></p>
</div>

<?php 

if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {

	$count   = $product->get_rating_count();
	$average = $product->get_average_rating();
	
	if ( $count > 0 ) {
		
		?>
        
        <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
            <div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
                <span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
                    <strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?>
                </span>
            </div>
            <a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $count, 'woocommerce' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?>)</a>
        </div>
        
        <?php
		
	}//end of count
	
}
    

?>

<p class="pm-already-in-cart"><?php echo $in_cart; ?></p>