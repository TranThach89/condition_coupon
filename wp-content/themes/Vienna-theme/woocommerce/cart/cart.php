<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<!-- cart summary -->


<?php do_action( 'woocommerce_before_cart_contents' ); ?>

<div class="pm-cart-items-container">
<?php

echo '<div class="pm-cart-count">
			<p class="pm-cart-count-text pm-center-mobile">You Have '.sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count).' in Your Cart</p>
	  </div>';

foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		
	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		?>
		<div class="row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

			<!--<div class="product-thumbnail pm-center-mobile col-lg-2 col-md-2 col-sm-2">
				<?php
					/*$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $_product->is_visible() )
						echo $thumbnail;
					else
						printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );*/
				?>
			</div>-->

			<div class="product-name pm-center-mobile col-lg-4 col-md-4 col-sm-12">
				<?php
					if ( ! $_product->is_visible() )
						echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					else
						echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

					// Meta data
					echo WC()->cart->get_item_data( $cart_item );

					// Backorder notification
					if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
						echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
				?>
			</div>

			<div class="product-price pm-center-mobile col-lg-2 col-md-2 col-sm-12">
				<?php
					echo '<strong>Price</strong>: '.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				?>
			</div>

			<div class="product-quantity pm-product-quantity pm-center-mobile col-lg-2 col-md-2 col-sm-12">
				<?php
					if ( $_product->is_sold_individually() ) {
						echo '<strong>Quantity:</strong> ';
						$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
					} else {
						$product_quantity = woocommerce_quantity_input( array(
							'input_name'  => "cart[{$cart_item_key}][qty]",
							'input_value' => $cart_item['quantity'],
							'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
						), $_product, false );
					}

					echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
				?>
			</div>

			<div class="product-subtotal pm-center-mobile col-lg-2 col-md-2 col-sm-12">
				<?php
					echo '<strong>Sub Total:</strong> '.apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
				?>
			</div>
            
            <div class="product-remove pm-center col-lg-2 col-md-2 col-sm-12">
				<?php
					echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove pm-rounded-btn small" title="%s">Remove</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
				?>
			</div>
            
		</div>
		<?php
	}
}

echo '</div>';

do_action( 'woocommerce_cart_contents' );
?>


<!-- cart summary -->

<div class="shop_table cart">
	
    <div class="pm-cart-coupon-box actions col-lg-6 col-md-6 col-sm-6">

        <?php if ( WC()->cart->coupons_enabled() ) { ?>
            <div class="coupon">

                <label for="coupon_code"><p class="pm-coupon-code"><?php _e( 'Have a Promotional Code?', 'woocommerce' ); ?></p></label> <input type="text" name="coupon_code" class="input-text pm-textfield" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button pm-rounded-submit-btn" style="margin-top:10px;" name="apply_coupon" value="<?php _e( 'Apply Promotion', 'woocommerce' ); ?>" />

                <?php do_action('woocommerce_cart_coupon'); ?>

            </div>
        <?php } ?>
                
        <div class="cart-collaterals">
        
            <?php woocommerce_shipping_calculator(); ?>
        
        </div>
                
    </div>
    
    <div class="pm-cart-total-box col-lg-6 col-md-6 col-sm-6">
    
    	<div class="pm-cart-total-container">
    
			<?php do_action( 'woocommerce_cart_collaterals' ); ?>
    
            <?php woocommerce_cart_totals(); ?>
            
            <input type="submit" class="button pm-rounded-submit-btn" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" /> <input type="submit" class="checkout-button button alt wc-forward pm-rounded-submit-btn" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?> &rarr;" />
        
            <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
    
            <?php wp_nonce_field( 'woocommerce-cart' ); ?>
        
        </div>
    
    </div>

    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>



<?php do_action( 'woocommerce_after_cart' ); ?>