<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $woocommerce;

$getHideShopPrices = get_theme_mod('hideShopPrices');
$hideShopPrices = $getHideShopPrices == '' ? 'no' : $getHideShopPrices;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
	
$product_id = $product->id;
$in_cart = '';

//check if product is already in the cart
if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
									
	foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
		
		$_product = $values['data'];
											
		if ( $_product->id == $product_id ) {
			
			$in_cart = 'in_cart';
			
		} 
		
	}//foreach								
		
} 
	
?>

<?php

	$pageLayout = '';

	if( is_shop() ){
		
		$page_id = get_option( 'woocommerce_shop_page_id' );
		$pageLayout = get_post_meta($page_id, 'pm_woocom_post_layout_meta', true);
		
	} else {
		
		global $has_sidebar;
		if($has_sidebar){
			$pageLayout = 'left-sidebar'; //this can be left or right sidebar - we just need activate sidebar mode
		} 
		
	}


	if($pageLayout == 'left-sidebar' || $pageLayout == 'right-sidebar') {
		echo ' <div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">';
	} else {
		echo ' <div class="col-lg-3 col-md-4 col-sm-6 pm-column-spacing">';
	}

?>

    <div <?php post_class( $classes ); ?>>
    
        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        
        <div class="pm-added-to-cart-icon <?php echo $in_cart; ?>">
            <a href="<?php echo site_url('cart') ?>"><i class="fa fa-shopping-cart"></i></a>
        </div>
    
        	<a href="<?php the_permalink(); ?>">
                <div class="pm-product-img-container">
                                                            
                        <?php if ( $price_html = $product->get_price_html() && $hideShopPrices === 'no' ) : ?>
                        	<div class="pm-store-item-date">
                            	<p class="pm-store-item-price"><?php echo $product->get_price_html(); ?></p>
                            </div>
                        <?php endif; ?>
                                                            
                    <?php
                        /**
                         * woocommerce_before_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                         */
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                    ?>
                </div>
            </a>
    
    		<div class="pm-store-item-desc">
    
            	<p class="pm-store-item-title"><?php the_title(); ?></p>
        
        		<div class="pm-store-item-divider"></div>
        
                <?php
                    /**
                     * woocommerce_after_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                ?>
                
                
                <div class="pm-store-item-divider"></div>
                
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                
                <ul class="pm-store-item-btns">
                    <li>
                    
                    <?php if ( $price_html = $product->get_price_html() && $hideShopPrices === 'no' ) { ?>
                    
                    	<?php 
							echo apply_filters( 'woocommerce_loop_add_to_cart_link',
								sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="pm-rounded-btn small pm-add-to-cart-btn %s product_type_%s">%s</a>',
									esc_url( $product->add_to_cart_url() ),
									esc_attr( $product->id ),
									esc_attr( $product->get_sku() ),
									$product->is_purchasable() ? 'add_to_cart_button' : '',
									esc_attr( $product->product_type ),
									esc_html( $product->add_to_cart_text() )
								),
							$product );
						?>
                    
                    <?php } else { ?>
                    
                    	<?php 
							/*echo apply_filters( 'woocommerce_loop_add_to_cart_link',
								sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="pm-rounded-btn small %s product_type_%s">%s</a>',
									esc_url( $product->add_to_cart_url() ),
									esc_attr( $product->id ),
									esc_attr( $product->get_sku() ),
									$product->is_purchasable() ? 'add_to_cart_button' : '',
									esc_attr( $product->product_type ),
									esc_html( $product->add_to_cart_text() )
								),
							$product );*/
						?>
                        
                        <li><a href="<?php the_permalink(); ?>" class="pm-rounded-btn expand small pm-add-to-cart"><i class="fa fa-bars"></i></a></li>
                    
                    <?php } ?>
                    
                    
                    </li>
                    
					<?php if ( $price_html = $product->get_price_html() && $hideShopPrices === 'no' ) : ?>
                    	<li><a href="<?php the_permalink(); ?>" class="pm-rounded-btn expand small pm-add-to-cart"><i class="fa fa-bars"></i></a></li>
                    <?php endif; ?>
                    
                </ul>
                
            </div>
        
    
    </div>

</div><!-- /col -->