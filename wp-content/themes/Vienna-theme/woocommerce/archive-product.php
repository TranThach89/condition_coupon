<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_id = get_option( 'woocommerce_shop_page_id' );
$getPageLayout = get_post_meta($page_id, 'pm_page_layout_meta', true);
$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
		
get_header( 'shop' ); ?>
    
    
    <?php if($pageLayout === 'no-sidebar') { //Render col-lg-12 ?>

			<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>
            
            <?php do_action( 'woocommerce_archive_description' ); ?>
        
			<?php if ( have_posts() ) : ?>
    
                <?php
                    /**
                     * woocommerce_before_shop_loop hook
                     *
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );
                ?>
    
                <?php woocommerce_product_loop_start(); ?>
    
                    <?php woocommerce_product_subcategories(); ?>
    
                    <?php while ( have_posts() ) : the_post(); ?>
    
                        <?php wc_get_template_part( 'content', 'product' ); ?>
    
                    <?php endwhile; // end of the loop. ?>
    
                <?php woocommerce_product_loop_end(); ?>
    
                <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>
    
            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
    
                <?php wc_get_template( 'loop/no-products-found.php' ); ?>
    
            <?php endif; ?>
    
        <?php
            /**
             * woocommerce_after_main_content hook
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
        ?>
    
    <?php } ?>
    
    <?php if($pageLayout === 'left-sidebar') { ?>
    
    	<div class="pm-column-container container pm-containerPadding60">
          	<div class="row">
            	<?php get_sidebar('woocommerce'); ?>
        
                <div class="col-lg-8 col-md-8 col-sm-8">
                    
                    <?php do_action( 'woocommerce_archive_description' ); ?>
        
					<?php if ( have_posts() ) : ?>
            
                        <?php
                            /**
                             * woocommerce_before_shop_loop hook
                             *
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            do_action( 'woocommerce_before_shop_loop' );
                        ?>
            
                        <?php woocommerce_product_loop_start(); ?>
            
                            <?php woocommerce_product_subcategories(); ?>
            
                            <?php while ( have_posts() ) : the_post(); ?>
            
                                <?php wc_get_template_part( 'content', 'product' ); ?>
            
                            <?php endwhile; // end of the loop. ?>
            
                        <?php woocommerce_product_loop_end(); ?>
            
                        <?php
                            /**
                             * woocommerce_after_shop_loop hook
                             *
                             * @hooked woocommerce_pagination - 10
                             */
                            do_action( 'woocommerce_after_shop_loop' );
                        ?>
            
                    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
            
                        <?php wc_get_template( 'loop/no-products-found.php' ); ?>
            
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>

    
    <?php } ?>
    
    <?php if($pageLayout === 'right-sidebar') { ?>
    
    		<div class="pm-column-container container pm-containerPadding60">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        
                        <?php do_action( 'woocommerce_archive_description' ); ?>
        
						<?php if ( have_posts() ) : ?>
                
                            <?php
                                /**
                                 * woocommerce_before_shop_loop hook
                                 *
                                 * @hooked woocommerce_result_count - 20
                                 * @hooked woocommerce_catalog_ordering - 30
                                 */
                                do_action( 'woocommerce_before_shop_loop' );
                            ?>
                
                            <?php woocommerce_product_loop_start(); ?>
                
                                <?php woocommerce_product_subcategories(); ?>
                
                                <?php while ( have_posts() ) : the_post(); ?>
                
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                
                                <?php endwhile; // end of the loop. ?>
                
                            <?php woocommerce_product_loop_end(); ?>
                
                            <?php
                                /**
                                 * woocommerce_after_shop_loop hook
                                 *
                                 * @hooked woocommerce_pagination - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop' );
                            ?>
                
                        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                
                            <?php wc_get_template( 'loop/no-products-found.php' ); ?>
                
                        <?php endif; ?>
                        
                    </div>
                    <?php get_sidebar('woocommerce'); ?>
                </div>
            </div>
    
    <?php } ?>
    

    

<?php get_footer( 'shop' ); ?>