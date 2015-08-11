<?php get_header(); ?>

<div class="container pm-containerPadding80">
    <div class="row">
		
        <div class="col-lg-12"> 

            <p class="pm-global-title"><?php _e("The page you we're looking could not be found.", 'viennatheme'); ?></p>
            <p><?php _e("Check the URL entered and ensure it is correct.", 'viennatheme'); ?></p>
            <a href="<?php echo site_url(); ?>" class="pm-rounded-btn"><?php _e("Return home", 'viennatheme'); ?></a>
        
		</div>
        
	</div>
</div>

<?php get_footer(); ?>