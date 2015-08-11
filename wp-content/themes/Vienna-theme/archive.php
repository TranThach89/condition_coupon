<?php get_header(); ?>

<?php 
$universalLayout = get_theme_mod('universalLayout');
?>

<?php
	//global $paged;
	/*$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged,
	);

	$blog_query = new WP_Query($arguments);

	pm_ln_set_query($blog_query);*/
	
?>

<div class="container pm-containerPadding80">
    <div class="row">

		<?php if($universalLayout === 'no-sidebar') { ?>
        
        	 <div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
            	<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'fullpost' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php //pm_ln_restore_query(); ?> 
            
            </div>
        
        <?php } else if($universalLayout === 'right-sidebar') {?>
                
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-main-posts">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'halfpost' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php //pm_ln_restore_query(); ?> 
                            
            </div>
            
            <!-- Right Sidebar -->
            <?php get_sidebar('blog'); ?>
            <!-- /Right Sidebar -->
        
        <?php } else if($universalLayout === 'left-sidebar') { ?>
                
        	<!-- Left Sidebar -->
            <?php get_sidebar('blog'); ?>
            <!-- /Left Sidebar -->
        
            <!-- Retrive right sidebar post template -->
            <div class="col-lg-8 col-md-8 col-sm-12 pm-main-posts">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'halfpost' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php //pm_ln_restore_query(); ?> 
            
            </div>
                    
        <?php } else {//default full width layout ?>
        
        	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
            
				<?php if (have_posts ()) { while (have_posts ()) { (the_post()); ?>
                
                    <?php get_template_part( 'content', 'fullpost' ); ?>
                
                <?php }//end of posts ?>
        
                <?php } else { ?>
                     <p><?php _e('No posts were found.', 'viennatheme'); ?></p>
                <?php } ?> 
                
                <?php get_template_part( 'content', 'pagination' ); ?>
                
                <?php //pm_ln_restore_query(); ?>                 
            
            </div>
        
        <?php }  ?>
    
	</div> <!-- /row -->
</div> <!-- /container -->

<?php get_footer(); ?>