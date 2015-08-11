<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$getPostLayout = get_post_meta(get_the_ID(), 'pm_woocom_post_layout_meta', true);
$postLayout = $getPostLayout !== '' ? $getPostLayout : 'no-sidebar';


?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>


<?php if($postLayout === 'no-sidebar') { //Render col-lg-12 ?>

			<?php 
				global $has_sidebar;  //we use this for woocommerce product loop
				$has_sidebar = false;
			?>
         	
           <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php
                /**
                 * woocommerce_before_single_product_summary hook
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action( 'woocommerce_before_single_product_summary' );
            ?>
            
            <div class="col-lg-8 col-md-8 col-sm-12 pm-column-spacing">
            
                <div class="summary entry-summary">
            
                    <?php
                        /**
                         * woocommerce_single_product_summary hook
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         */
                        do_action( 'woocommerce_single_product_summary' );
                    ?>
            
                </div><!-- .summary -->
                
            </div>
            <?php
                /**
                 * woocommerce_after_single_product_summary hook
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action( 'woocommerce_after_single_product_summary' );
            ?>
        
            <meta itemprop="url" content="<?php the_permalink(); ?>" />
        
        </div><!-- #product-<?php the_ID(); ?> -->
            
<?php } ?>

<?php if($postLayout === 'left-sidebar') { //Render col-lg-12 ?>

		<?php 
			global $has_sidebar;  //we use this for woocommerce product loop
			$has_sidebar = true;
		?>
         	
        <?php get_sidebar('woocommerce'); ?>
        
        <div class="col-lg-8 col-md-8 col-sm-12 pm-single-product-with-sidebar">
            
            <div class="row">
            
            	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php
                        /**
                         * woocommerce_before_single_product_summary hook
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                
                	<div class="col-lg-8 col-md-8 col-sm-12">
                    	<div class="summary entry-summary">
                        
							<?php
                                /**
                                 * woocommerce_single_product_summary hook
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 20
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_meta - 40
                                 * @hooked woocommerce_template_single_sharing - 50
                                 */
                                do_action( 'woocommerce_single_product_summary' );
                            ?>
                    
                        </div><!-- .summary -->
                    </div>
                   
                    <?php
                        /**
                         * woocommerce_after_single_product_summary hook
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                    ?>
                
                    <meta itemprop="url" content="<?php the_permalink(); ?>" />
                
                </div><!-- #product-<?php the_ID(); ?> -->
            
            </div>
            
        </div> 
            
<?php } ?>

<?php if($postLayout === 'right-sidebar') { //Render col-lg-12 ?>
         	
        <?php 
			global $has_sidebar;  //we use this for woocommerce product loop
			$has_sidebar = true;
		?>
        
        <div class="col-lg-8 col-md-8 col-sm-8 pm-single-product-with-sidebar">
            
            <div class="row">
            
            	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php
                        /**
                         * woocommerce_before_single_product_summary hook
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                                            
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="summary entry-summary">
                    
                            <?php
                                /**
                                 * woocommerce_single_product_summary hook
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 20
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_meta - 40
                                 * @hooked woocommerce_template_single_sharing - 50
                                 */
                                do_action( 'woocommerce_single_product_summary' );
                            ?>
                    
                        </div><!-- .summary -->
                    </div>
                        
                    
                    <?php
                        /**
                         * woocommerce_after_single_product_summary hook
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                    ?>
                
                    <meta itemprop="url" content="<?php the_permalink(); ?>" />
                
                </div><!-- #product-<?php the_ID(); ?> -->
            
            </div>
            
        </div>  
        
        <?php get_sidebar('woocommerce'); ?>  
            
<?php } ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
