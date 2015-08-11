<?php get_header(); ?>

<?php 
$universalLayout = get_theme_mod('universalLayout');
?>

<div class="container pm-containerPadding80">
    <div class="row">

		<?php if($universalLayout === 'no-sidebar') { ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                	<div class="col-lg-4 col-md-4 col-sm-6 pm-column-spacing">
						<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    </div>
                    
                <?php endwhile; else: ?>
                    <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
            
            </div>
        
        <?php } else if($universalLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-main-posts">
                
                
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">
						<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    </div>
                    
                <?php endwhile; else: ?>
                    <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?>
                
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                                            
            </div>
            
             <!-- Right Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Right Sidebar -->
        
        <?php } else if($universalLayout === 'left-sidebar') { ?>
                
        	 <!-- Left Sidebar -->
             <?php get_sidebar(); ?>
             <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-main-posts">
            
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">
						<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    </div>
                    
                <?php endwhile; else: ?>
                    <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                            
            </div>
                    
        <?php } else {//default full width layout ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
                
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
					<div class="col-lg-4 col-md-4 col-sm-6 pm-column-spacing">
						<?php get_template_part( 'content', 'gallerypostarchive' ); ?>
                    </div>
                    
                <?php endwhile; else: ?>
                    <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php endif; ?>
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                            
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->


<?php get_footer(); ?>