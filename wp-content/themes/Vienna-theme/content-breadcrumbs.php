<!-- Breadcrumbs -->
<?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>

	<?php if( is_shop() || is_product() || is_product_category() || is_product_tag()  ) { ?>
		<div class="pm-sub-header-breadcrumbs">
			<?php				
				$args = array(
						'delimiter' => '<p> &nbsp;<i class="fa fa-angle-right"></i> &nbsp;</p>',
						'wrap_before' => '<div class="woocommerce-breadcrumb pm-sub-header-breadcrumbs-ul">',
						'wrap_after' => '</div>',
						'before' => '<p>',
						'after' => '</p>',
				);
			?>
			
			<?php woocommerce_breadcrumb( $args ); ?>
		</div>
	<?php } else { ?>
	
			<?php if(!is_single()) { ?>
    
				<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs'); ?>
                <?php if($enableBreadCrumbs === 'on'){ ?>
                        <div class="pm-sub-header-breadcrumbs">
                            <?php pm_ln_breadcrumbs(); ?>
                        </div>
                <?php } ?>
            
            <?php } ?>
	
	<?php } ?>	

<?php } else {//Woocommerce not enabled ?>

	<?php if(!is_single()) { ?>
    
    	<?php $enableBreadCrumbs = get_theme_mod('enableBreadCrumbs'); ?>
		<?php if($enableBreadCrumbs === 'on'){ ?>
                <div class="pm-sub-header-breadcrumbs">
                    <?php pm_ln_breadcrumbs(); ?>
                </div>
        <?php } ?>
    
    <?php } ?>

	

<?php } ?>