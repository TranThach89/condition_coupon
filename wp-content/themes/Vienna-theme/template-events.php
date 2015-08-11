<?php /* Template Name: Events Template */ ?>
<?php get_header(); ?>

<?php 
	global $vienna_options;
	$event_posts_per_load = $vienna_options['event-posts-per-load'];
?>

<?php if($content = $post->post_content) { ?>

    <div class="container pm-containerPadding-top-80">
        <div class="row">
            <div class="col-lg-12">
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    
                    <?php the_content(); ?>
                
                <?php endwhile; else: ?>
                     
                <?php endif; ?> 
            
            </div>
        </div>
    </div>

<?php } ?>


<?php 
	$terms = get_terms('event_categories');
?>

<!-- Events filter system -->
<?php if($content = $post->post_content) { ?>
	<div class="container pm-containerPadding-top-60 pm-containerPadding-bottom-60">
<?php } else { ?>
	<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-60">
<?php } ?>

    <div class="row">
    
        <div class="col-lg-12 pm-containerPadding-bottom-40">
            
            <div class="pm-featured-header-container">
            
           		<?php 
				
					global $vienna_options;
					
					$events_panel_title = $vienna_options['events-panel-title']; 
					$events_panel_message = $vienna_options['events-panel-message']; 
					$events_panel_image = $vienna_options['events-panel-image']; 
				
				?>
            
                <!-- Featured panel header -->
                <div class="pm-featured-header-title-container" style="background-image:url(<?php echo $events_panel_image['url'] ?>);">
                    <p class="pm-featured-header-title"><?php echo $events_panel_title; ?></p>
                    <p class="pm-featured-header-message"><?php echo $events_panel_message; ?></p>
                </div>
                <!-- Featured panel header end -->
                
                <!-- Filter menu -->
                <div class="pm-isotope-filter-container">
                    <ul class="pm-isotope-filter-system">
                        <li class="pm-isotope-filter-system-expand"><?php _e('Expand', 'viennatheme'); ?> <i class="fa fa-angle-down"></i></li>
                        <li><a href="#" class="current" id="all"><?php _e('View all', 'viennatheme'); ?></a></li>
                        <?php
							foreach ($terms as $term) {
								echo '<li><a href="#" id="'.$term->slug.'">'.ucfirst($term->name).'</a></li>';	
							}
						?>
                    </ul>
                </div>
                <!-- Filter menu end -->
            
            </div>
            
        </div><!-- /.col-lg-12 -->
        
        <?php
			//global $paged;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
			$arguments = array(
				'post_type' => 'post_event',
				'post_status' => 'publish',
				'paged' => $paged,
				//'posts_per_page' => -1,
				'posts_per_page' => $event_posts_per_load,
				//'tag' => get_query_var('tag')
			);
		
			$blog_query = new WP_Query($arguments);
		
			pm_ln_set_query($blog_query);
			
			$count_posts = wp_count_posts('post_event');
			$published_posts = $count_posts->publish;
			
		?>
        
        <div id="pm-isotope-item-container">
        
        	<?php if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
        		
				<?php get_template_part( 'content', 'eventpost' ); ?>
            
            <?php endwhile; else: ?>
                 <p><?php _e('No events were found.', 'viennatheme'); ?></p>
            <?php endif; ?>
                        
            <?php pm_ln_restore_query(); ?> 
        
        </div>
        
        
                        
    </div>
</div>
<!-- Staff filter system end -->

<!-- Load more -->
<?php if($published_posts > $event_posts_per_load) { ?>

	<div class="container pm-containerPadding-bottom-60 pm-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="pm-load-more-container">
                	<div class="pm-load-more-container-count">
                    	<p><?php _e('Viewing', 'viennatheme') ?> <span class="pm-load-more-container-current-count"><?php echo $event_posts_per_load; ?></span> <?php _e('of', 'viennatheme') ?> <?php echo $published_posts; ?></p>
                    </div>  
                    <div class="pm-load-more-container-icon">
                        <a href="#" class="pm-rounded-btn" id="pm-load-more" name="event"><span><?php _e('Load More', 'viennatheme') ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Load more end -->

<?php get_footer(); ?>