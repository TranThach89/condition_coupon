<?php
/**
 * The default template for displaying a half width post (with sidebars)
 */
?>

<?php 

	 $category = get_the_category(); 
	 $count = get_comments_number();
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 $pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
	 
	 $no_image = false;
	              
?>

<!-- News post -->
<article class="pm-column-spacing" <?php post_class(); ?>>

    <div class="pm-news-post-container">
    
        <?php if($pm_featured_post_image_meta !== '') { ?>
        
            <div class="pm-news-post-image" style="background-image:url(<?php echo $pm_featured_post_image_meta; ?>);">
                <div class="pm-news-post-title half-width">
                    <p><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></p>
                </div>
            </div>
        
        <?php } else if(has_post_thumbnail()) { ?>
        
            <div class="pm-news-post-image" style="background-image:url(<?php echo $image_url[0]; ?>);">            
                <div class="pm-news-post-title half-width">
                    <p><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></p>
                </div>
            </div>
        
        <?php } else { ?>
            <!-- No featured image to display -->
            <div class="pm-news-post-image" style="min-height:40px !important;">
                <div class="pm-news-post-title half-width no-image">
                    <p><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></p>
                </div>
            </div>
            
            <?php $no_image = true; ?>
            
        <?php }  ?>
    
        
        <?php if(!$no_image) { ?>
        	<div class="pm-news-post-meta-container">
        <?php } else { ?>
        	<div class="pm-news-post-meta-container no-image">
        <?php } ?>
        
            <div class="pm-news-post-date">
                <p class="day"><?php the_time( 'd' ); ?></p>
                <p class="month-year"><?php the_time( 'M' ); ?><br /><?php the_time( 'Y' ); ?></p>
            </div>
            <ul class="pm-meta-options-list">
            
            	<?php 
					if(is_sticky()){
						?>
                        <li><i class="fa fa-thumb-tack" style="padding-left:2px;"></i> &nbsp;&nbsp;<?php _e('Featured Post','viennatheme'); ?></li>
                        <?php
					}
				?>
            
                <li><i class="fa fa-comment"></i> &nbsp;<?php  echo get_comments_number();  ?> <?php _e('Comments','viennatheme'); ?></li>
                <li><i class="fa fa-twitter"></i> &nbsp;<a href="https://twitter.com/share?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>" target="_blank"><?php _e('Tweet this','viennatheme'); ?></a></li>
                <li><i class="fa fa-pencil"></i> &nbsp;<a href="<?php echo get_comments_link(); ?>"><?php _e('Post a comment','viennatheme'); ?></a></li>
            </ul>
        </div>
        
        <?php if(!$no_image) { ?>
        	<div class="pm-news-post-desc-container half-width">
        <?php } else { ?>
        	<div class="pm-news-post-desc-container half-width no-image">
        <?php } ?>
                    
            <p class="pm-news-post-excerpt">
                <?php echo get_the_excerpt(); ?>
            </p>
            <p class="pm-news-post-continue"><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading','viennatheme'); ?> &rarr;</a></p>
            
        </div>
        
    </div>

</article>
<!-- News post end -->