<?php
/**
 * The default template for displaying staff posts on the staff template.
 */
?>

<?php 
            
	$pm_menu_image_meta = get_post_meta(get_the_ID(), 'pm_menu_image_meta', true);
	$pm_menu_item_price_meta = get_post_meta(get_the_ID(), 'pm_menu_item_price_meta', true);
	
?>

<?php 
$terms = get_the_terms($post->ID, 'menucats' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- menu item -->
<div class="pm-isotope-item col-lg-4 col-md-4 col-sm-6 pm-column-spacing <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">
    <div class="pm-menu-item-container">
        <div class="pm-menu-item-img-container" style="background-image:url(<?php echo $pm_menu_image_meta; ?>);">
        	
            <?php if($pm_menu_item_price_meta !== '') { ?>
            	<div class="pm-menu-item-price"><p><?php echo $pm_menu_item_price_meta; ?></p></div>
            <?php } ?>
            
        </div>
        
        <div class="pm-menu-item-desc">
            <p class="pm-menu-item-title"><?php the_title(); ?></p>
            
            	<?php  
				  //$excerpt = get_the_excerpt();
				  //echo $excerpt;
				  the_content();
				?>
            
        </div>
    </div>
</div><!-- /.col-lg-4 -->
<!-- /menu item -->