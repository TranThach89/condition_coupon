<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$pageLayout = get_post_meta($post->ID, 'pm_woocom_post_layout_meta', true);

?>

<?php if($pageLayout === 'no-sidebar') { ?>
	<div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">
<?php } else { ?>
	<div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing"> <!-- this will have to change -->
<?php } ?>


    <div class="images pm-product-images pm-product-img-hover-container" id="pm-product-img-single">
    
    	<?php if ( $product->is_on_sale() ) : ?>
        
        		<span class="onsale">On Sale</span>
        
        <?php endif; ?>
        
        <?php
            if ( has_post_thumbnail() ) {
    
                $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
                $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
                $image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                    'title' => $image_title,
					'class'	=> "img-responsive",
                    ) );
                $attachment_count   = count( $product->get_gallery_attachment_ids() );
    
                if ( $attachment_count > 0 ) {
                    $gallery = '[product-gallery]';
                } else {
                    $gallery = '';
                }
				
				echo '
				<div class="pm-product-img-hover-icon">
					<a href="'.$image_link.'" itemprop="image" class="woocommerce-main-image zoom" title="'.$image_title.'" data-rel="prettyPhoto' . $gallery . '"><i class="fa-expand"></i></a>
				</div>
				';
    
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
    
            } else {
                
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
    
            }
        ?>
    
        <?php do_action( 'woocommerce_product_thumbnails' ); ?>
    
    </div>


</div>
