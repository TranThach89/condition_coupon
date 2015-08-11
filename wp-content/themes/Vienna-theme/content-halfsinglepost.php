<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $enableTooltip = get_theme_mod('enableTooltip');

	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
	 
	 $postStatus = get_post_meta(get_the_ID(), 'pm_post_visibility', true);
	 
	 $pm_disable_share_feature = get_post_meta(get_the_ID(), 'pm_disable_share_feature', true);

		              
?>


<?php if($pm_featured_post_image_meta !== '') { ?>
        <div class="pm-single-post-img-container" style="background-image:url(<?php echo $pm_featured_post_image_meta; ?>);">
             <div class="pm-single-post-title half-width">
                <p><?php the_title(); ?></p>
            </div>
        </div>
<?php } else if(has_post_thumbnail()) { ?>
        <div class="pm-single-post-img-container" style="background-image:url(<?php echo $image_url[0]; ?>);">
             <div class="pm-single-post-title half-width">
                <p><?php the_title(); ?></p>
            </div> 
        </div>
<?php } else { ?>
        <!-- No featured image to display -->
<?php } ?>


<div class="pm-single-post-meta-container">
    
    <div class="pm-single-post-date">
        <p class="day"><?php the_time( 'd' ); ?></p>
        <p class="month-year"><?php the_time( 'M' ); ?><br /><?php the_time( 'Y' ); ?></p>
    </div>
    <ul class="pm-single-meta-options-list">
        <li><i class="fa fa-user"></i> by <?php the_author(); ?></li>
        
        <?php 
		
		$num_comments = get_comments_number(); 
		
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
								
				echo '<li><i class="fa fa-comment"></i> '.$num_comments.' '. __('Comments','viennatheme') .'</li>';
				
			} elseif ( $num_comments > 1 ) {
				echo '<li><i class="fa fa-comment"></i> '.$num_comments.' '. __('Comments','viennatheme') .'</li>';
			} else {
				echo '<li><i class="fa fa-comment"></i> '.$num_comments.' '. __('Comment','viennatheme') .'</li>';
			}
		} else {
			//no comments to display
		}
		
		?>
        
        
        <li><i class="fa fa-heart"></i> <a href="#" class="pm-like-this-btn" id="<?php echo get_the_ID(); ?>"><?php _e('Like this','viennatheme'); ?></a></li>
        <li><i class="fa fa-twitter"></i> <a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><?php _e('Tweet this','viennatheme'); ?></a></li>
    </ul>
    
    <div class="pm-single-meta-divider top"></div>
    
    <div class="pm-single-tags-container top">
            
        <?php if(has_tag()) { ?>
    
            <p class="pm-tags-title"><?php _e('Tags','viennatheme'); ?></p>
        
            <ul class="pm-tags-list">
                <li><?php the_tags('', ',</li><li>', ''); ?></li>
            </ul>
        
        <?php } ?>
        
        <?php if(has_category()) { ?>
        
             <p class="pm-tags-title"><?php _e('Category','viennatheme'); ?></p>
        
            <ul class="pm-tags-list">
                <li><?php the_category(',</li><li>'); ?></li>
            </ul>
            
        <?php } ?>
    
    </div>
    
    <div class="pm-single-meta-divider"></div>
    <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true) ?>
    <p class="pm-likes-title top"><span><?php echo $likes; ?></span> <?php _e('Likes','viennatheme'); ?></p>
    
</div>

<div class="pm-single-post-desc-container half-width">
                
    <?php the_content(); ?>
    <?php 
    
    $pag_defaults = array(
            'before'           => '<p>' . __( 'READ MORE:', 'viennatheme' ),
            'after'            => '</p>',
            'link_before'      => '',
            'link_after'       => '',
            'next_or_number'   => 'number',
            'separator'        => ' ',
            'nextpagelink'     => '',
            'previouspagelink' => '',
            'pagelink'         => '%',
            'echo'             => 1
        );
    
    wp_link_pages($pag_defaults); 
    
    ?>
    
</div>

<div class="pm-single-meta-divider bottom"></div>
    
<div class="pm-single-tags-container bottom">
            
	<?php if(has_tag()) { ?>
    
    	<p class="pm-tags-title"><?php _e('Tags','viennatheme'); ?></p>
    
        <ul class="pm-tags-list">
            <li><?php the_tags('', ',</li><li>', ''); ?></li>
        </ul>
    
    <?php } ?>
    
    <?php if(has_category()) { ?>
    
         <p class="pm-tags-title"><?php _e('Category','viennatheme'); ?></p>
    
        <ul class="pm-tags-list">
            <li><?php the_category(',</li><li>'); ?></li>
        </ul>
        
    <?php } ?>

</div>
    
<div class="pm-single-meta-divider bottom"></div>
    
<?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true) ?>
<p class="pm-likes-title bottom"><span><?php echo $likes; ?></span> <?php _e('Likes','viennatheme'); ?></p>

<?php if($pm_disable_share_feature === 'no') : ?>
	<?php get_template_part('content','sharewithfriends'); ?>
<?php endif; ?>
