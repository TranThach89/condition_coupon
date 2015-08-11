<?php get_header(); ?>

<?php 

	$pm_event_featured_image_meta = get_post_meta(get_the_ID(), 'pm_event_featured_image_meta', true);
	$pm_event_date_meta = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
	$month = date("M", strtotime($pm_event_date_meta));
	$day = date("d", strtotime($pm_event_date_meta));
	$year = date("Y", strtotime($pm_event_date_meta));
	$pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
	$pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);
	              
?>

<div class="container pm-containerPadding80">
    <div class="row">
        
        <div class="col-lg-12">
            
            <div class="pm-event-item-img-container single" style="background-image:url(<?php echo $pm_event_featured_image_meta; ?>);">
                <div class="pm-event-item-date">
                    <p class="pm-event-item-month"><?php echo $month; ?></p>
                    <p class="pm-event-item-day"><?php echo $day; ?></p>
                </div>
            </div>
            
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                   
				<?php the_content(); ?>
                                   
            <?php endwhile; else: ?>
                <p><?php _e('No content was found.', 'viennatheme'); ?></p>
            <?php endif; ?>
            
            <?php if($pm_disable_share_feature === 'no') : ?>
            
            	<!-- Share options -->
                <div class="pm-single-post-share-container full-width">
                    <p><?php _e('Share this with friends', 'viennatheme'); ?></p>
                    <ul class="pm-single-post-share-list full-width">
                        <li class="pm_tip_static_top" title="Facebook"><a href="#" class="fa fa-facebook"></a></li>
                        <li class="pm_tip_static_top" title="Twitter"><a href="#" class="fa fa-twitter"></a></li>
                        <li class="pm_tip_static_top" title="Google Plus"><a href="#" class="fa fa-google-plus"></a></li>
                        <li class="pm_tip_static_top" title="Digg"><a href="#" class="fa fa-digg"></a></li>
                        <li class="pm_tip_static_top" title="Delicious"><a href="#" class="fa fa-delicious"></a></li>
                        <li class="pm_tip_static_top" title="Reddit"><a href="#" class="fa fa-reddit"></a></li>
                        <li class="pm_tip_static_top" title="StumbleUpon"><a href="#" class="fa fa-stumbleupon"></a></li>
                        <li class="pm_tip_static_top" title="Email a friend"><a href="mailto:yourfriend@vienna.com" class="fa fa-envelope"></a></li>
                    </ul>
                </div>
                <!-- Share options end -->
            
            <?php endif; ?>
            
            
            
        </div>
        
    </div>
</div>

<?php get_footer(); ?>