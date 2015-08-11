<?php /* Template Name: Book an Event Form Template */ ?>
<?php get_header(); ?>

<?php 
	$getPageLayout = get_post_meta(get_the_ID(), 'pm_page_layout_meta', true);
	$pageLayout = $getPageLayout !== '' ? $getPageLayout : 'no-sidebar';
?>


<div class="container pm-containerPadding80">
    <div class="row">

		<?php if($pageLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        		
                	<?php the_content(); ?>
                
                <?php endwhile; else: ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'eventform' ); ?>
                            
            </div>
            
        <?php }  ?>
        
        <?php if($pageLayout === 'right-sidebar') {?>
                        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-main-posts sidebar">
            
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        		
                	<?php the_content(); ?>
                
                <?php endwhile; else: ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'eventform' ); ?>
                            
            </div>
            
             <!-- Right Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Right Sidebar -->
             
        <?php }  ?>
        
        <?php if($pageLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-8 pm-main-posts sidebar">
            
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
        		
                	<?php the_content(); ?>
                
                <?php endwhile; else: ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?> 
                
                <?php get_template_part( 'content', 'eventform' ); ?>
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>