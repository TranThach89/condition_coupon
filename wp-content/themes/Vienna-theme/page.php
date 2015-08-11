<?php get_header(); ?>

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
	$disableContainer = get_post_meta(get_the_ID(), 'pm_page_disable_container_meta', true);
	$disableContainer == '' ? 'on' : $disableContainer;
	
	$printAndShareOptions = get_post_meta(get_the_ID(), 'pm_page_print_share_meta', true);
	
?>

<?php if($pageLayout === 'no-sidebar') { //Render col-lg-12 ?>

		<?php 
			global $has_sidebar;  //we use this for woocommerce product loop
			$has_sidebar = false;
		?>

		<?php if($disableContainer === 'yes') { ?>
        
        	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		    	<?php the_content(); ?>
            <?php endwhile; else: ?>
            	<p><?php echo _e('No content was found.', 'viennatheme'); ?></p>
            <?php endif; ?>
           
            <?php
				
				if($printAndShareOptions == 'on') {?>
                    <div class="container pm-containerPadding-bottom-60">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
								<?php
                                	get_template_part('content', 'pageoptions');
                                ?>
                    		</div>
                    	</div>
                    </div>
                    <?php
				}
				
			?>
        
        <?php } else { ?>
        
            <div class="container pm-containerPadding80">
            
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 pm-page-post-content">
                        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; else: ?>
                            <p><?php echo _e('No content was found.', 'viennatheme'); ?></p>
                        <?php endif; ?>
                        
                        <?php
                        
                            if($printAndShareOptions === 'on') {
                                get_template_part('content', 'pageoptions');
                            }
                            
                        ?>
                                                
                    </div>
                </div>
            </div>
        
        <?php } ?>

<?php } ?>

<?php if($pageLayout === 'left-sidebar') { ?>

		<?php 
			global $has_sidebar;  //we use this for woocommerce product loop
			$has_sidebar = true;
		?>

		<div class="container pm-containerPadding80">
          	<div class="row">
            	<?php get_sidebar(); ?>
        
                <div class="col-lg-8 col-md-8 col-sm-8 pm-page-post-content">
                    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; else: ?>
                        <p><?php echo _e('No content was found.', 'viennatheme'); ?></p>
                    <?php endif; ?>
                    
                    <?php
						
						if($printAndShareOptions == 'on') {
							get_template_part('content', 'pageoptions');
						}
						
					?>
                                        
                </div>
            </div>
        </div>

<?php } ?>

<?php if($pageLayout === 'right-sidebar') { ?>

		<?php 
			global $has_sidebar; //we use this for woocommerce product loop
			$has_sidebar = true;
		?>
        
        <div class="container pm-containerPadding80">
          	<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 pm-page-post-content">
                    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; else: ?>
                        <p><?php echo _e('No content was found.', 'viennatheme'); ?></p>
                    <?php endif; ?>
                    
                    <?php
						
						if($printAndShareOptions == 'on') {
							get_template_part('content', 'pageoptions');
						}
						
					?>
                    
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>

<?php } ?>

<?php get_footer(); ?>