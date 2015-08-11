<?php
/**
 * The default template for displaying staff posts on the staff template.
 */
?>

<?php 
            
	$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
	$pm_staff_message_meta = get_post_meta(get_the_ID(), 'pm_staff_message_meta', true);
	
	
	$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
	$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);
	$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
		
	
?>

<?php 
$terms = get_the_terms($post->ID, 'staff_titles' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- staff item -->
<div class="pm-isotope-item col-lg-4 col-md-4 col-sm-6 pm-column-spacing <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">
    <div class="pm-staff-item-container">
        <div class="pm-staff-item-img-container" style="background-image:url(<?php echo $pm_staff_image_meta; ?>);">
            <span></span>
            <div class="pm-staff-item-img-quote">
                <p><?php echo $pm_staff_message_meta; ?></p>
            </div>
            <div class="pm-staff-item-img-read-more">
                <a href="<?php the_permalink(); ?>"><?php _e('View Profile', 'viennatheme'); ?> &raquo;</a>
            </div>
        </div>
        
        <div class="pm-staff-item-desc">
        
            <p class="pm-staff-item-name"><?php the_title(); ?></p>
            <p class="pm-staff-item-title"><?php echo $pm_staff_title_meta; ?></p>
            
            <div class="pm-divider"></div>
            
            <p class="pm-staff-item-excerpt">
            	<?php  
				  $excerpt = get_the_excerpt();
				  echo pm_ln_string_limit_words($excerpt,20).'...'; 
				?>
            </p>
            
            <div class="pm-divider"></div>
            
            <ul class="pm-staff-social-icons">
            	<?php 
				
					if($pm_staff_twitter_meta !== ''){
						echo '<li><a href="'.$pm_staff_twitter_meta.'" class="fa fa-twitter" target="_blank"></a></li>';
					}
					if($pm_staff_facebook_meta !== ''){
						echo '<li><a href="'.$pm_staff_facebook_meta.'" class="fa fa-facebook" target="_blank"></a></li>';	
					}
					if($pm_staff_linkedin_meta !== ''){
						echo '<li><a href="'.$pm_staff_linkedin_meta.'" class="fa fa-linkedin" target="_blank"></a></li>';	
					}
					if($pm_staff_gplus_meta !== ''){
						echo '<li><a href="'.$pm_staff_gplus_meta.'" class="fa fa-google-plus" target="_blank"></a></li>';	
					}
				
				?>
                
                
            </ul>
            
        </div>
    </div>
    
</div><!-- /.col-lg-4 -->
<!-- /staff item -->
