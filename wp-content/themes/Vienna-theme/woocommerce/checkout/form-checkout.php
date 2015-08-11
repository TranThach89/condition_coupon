<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

         <ul class="nav nav-tabs pm-checkout-tabs" id="pm-checkout-tabs">
             <li><a href="#Tab1" data-toggle="tab">Billing Address</a></li>
             <li><a href="#Tab2" data-toggle="tab">Shipping Address</a></li>
             <li><a href="#Tab3" data-toggle="tab">Review &amp; Payment</a></li>
         </ul>
         <div class="tab-content" id="pm-checkout-tabs-content">
            <div id="Tab1" class="tab-pane active">
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>
            <div id="Tab2" class="tab-pane fade">
                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
            </div>
            <div id="Tab3" class="tab-pane fade">
            	<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
         </div>


		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		

	<?php endif; ?>

	

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>