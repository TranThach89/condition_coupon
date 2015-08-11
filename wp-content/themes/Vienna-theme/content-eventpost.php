<?php
/**
 * The default template for displaying staff posts on the staff template.
 */
?>

<?php 
            
	$pm_event_featured_image_meta = get_post_meta(get_the_ID(), 'pm_event_featured_image_meta', true);
	$pm_event_date_meta = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
	$month = date("M", strtotime($pm_event_date_meta));
	$day = date("d", strtotime($pm_event_date_meta));
	$year = date("Y", strtotime($pm_event_date_meta));
	$pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
	
?>

<?php 
$terms = get_the_terms($post->ID, 'event_categories' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>


<!-- event item -->
<div class="pm-isotope-item col-lg-4 col-md-4 col-sm-6 pm-column-spacing <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">

    <div class="pm-event-item-container">
        <div class="pm-event-item-img-container" style="background-image:url(<?php echo $pm_event_featured_image_meta; ?>);">
            <div class="pm-event-item-date">
                <p class="pm-event-item-month"><?php echo $month; ?></p>
                <p class="pm-event-item-day"><?php echo $day; ?></p>
            </div>
        </div>
        
        <div class="pm-event-item-desc">
            <p class="pm-event-item-title"><?php the_title(); ?></p>
            <div class="pm-event-item-divider"></div>
            <p class="pm-event-item-excerpt">
            	<?php  
				  $excerpt = get_the_excerpt();
				  echo pm_ln_string_limit_words($excerpt,20).' <a href="'.get_the_permalink().'">{...}</a>'; 
				?>
            </p>
            <div class="pm-event-item-divider"></div>
            <ul class="pm-event-item-btns">
                <li><a href="<?php the_permalink(); ?>" class="pm-rounded-btn small"><?php _e('More Info','viennatheme'); ?></a></li>
                <?php if($pm_event_fan_page_meta !== '') { ?>
                	<li><a href="<?php echo $pm_event_fan_page_meta; ?>" class="pm-rounded-btn small event-fan-page" target="_blank"><i class="fa fa-facebook"></i> &nbsp;<?php _e('Fan Page','viennatheme'); ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    
</div><!-- /.col-lg-4 -->
<!-- /event item -->