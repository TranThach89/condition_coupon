<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 
	$enableTooltip = get_theme_mod('enableTooltip');
	$pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);              
?>


<div class="pm-single-post-img-container gallery" style="background-image:url(<?php echo $pm_gallery_image_meta; ?>);">
    <a href="<?php echo $pm_gallery_image_meta; ?>" class="pm-rounded-btn small prettyPhoto-btn fa fa-expand lightbox" data-rel="prettyPhoto"></a>
</div>


<div class="pm-single-post-meta-container gallery">
    
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
    
    <?php 
	
		$cats = wp_get_post_terms($post->ID,'gallerycats'); 
		$tags = wp_get_post_terms($post->ID,'gallerytags'); 
	
	?>
    
    <div class="pm-single-tags-container top">
    
    	<?php $tagsLen = count($tags); ?>
            
        <?php if($tagsLen > 0) { ?>
    
            <p class="pm-tags-title"><?php _e('Tags','viennatheme'); ?></p>
        
            <ul class="pm-tags-list">
                <?php 
			
					$tagCounter = 0;
			
					foreach($tags as $tag){ 
					
						$tagCounter++;
					
						$term_link = get_term_link( $tag );
						if($tagsLen > 1){
							
							if($tagCounter >= $tagsLen){
								echo '<li><a href="' . $term_link . '">' . $tag->name . '</a></li>'; 
							} else {
								echo '<li><a href="' . $term_link . '">' . $tag->name . '</a>,</li>'; 
							}
							
							
						} else {
							echo '<li><a href="' . $term_link . '">' . $tag->name . '</a></li>';	
						}
						
						
						
					}
				
				?>
            </ul>
        
        <?php } ?>
        
        <?php $catsLen = count($cats); ?>
        
        <?php if($catsLen > 0) { ?>
        
            <p class="pm-tags-title"><?php _e('Category','viennatheme'); ?></p>
        
            <ul class="pm-tags-list">
            	<?php 
			
					$catCounter = 0;
			
					foreach($cats as $cat){ 
					
						$catCounter++;
					
						$term_link = get_term_link( $cat );
						
						if($catsLen > 1){
							
							if($catCounter >= $catsLen){
								echo '<li><a href="' . $term_link . '">' . $cat->name . '</a></li>'; 
							} else {
								echo '<li><a href="' . $term_link . '">' . $cat->name . '</a>,</li>'; 
							}
							
							
						} else {
							echo '<li><a href="' . $term_link . '">' . $cat->name . '</a></li>';	
						}
						
						
					}
				
				?>
            </ul>
            
        <?php } ?>
    
    </div>
    
    <div class="pm-single-meta-divider"></div>
    
    <?php $likes = get_post_meta(get_the_ID(), 'pm_total_likes', true) ?>
    <p class="pm-likes-title top"><span><?php echo $likes; ?></span> <?php _e('Likes','viennatheme'); ?></p>
    
</div>

<div class="pm-single-post-desc-container full-width gallery">
                
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
            
	<?php $tagsLen = count($tags); ?>
            
        <?php if($tagsLen > 0) { ?>
    
            <p class="pm-tags-title"><?php _e('Tags','viennatheme'); ?></p>
        
            <ul class="pm-tags-list">
                <?php 
			
					$tagCounter = 0;
			
					foreach($tags as $tag){ 
					
						$tagCounter++;
					
						$term_link = get_term_link( $tag );
						if($tagsLen > 1){
							
							if($tagCounter >= $tagsLen){
								echo '<li><a href="' . $term_link . '">' . $tag->name . '</a></li>'; 
							} else {
								echo '<li><a href="' . $term_link . '">' . $tag->name . '</a>,</li>'; 
							}
							
							
						} else {
							echo '<li><a href="' . $term_link . '">' . $tag->name . '</a></li>';	
						}
						
						
						
					}
				
				?>
            </ul>
        
        <?php } ?>
        
        <?php $catsLen = count($cats); ?>
        
        <?php if($catsLen > 0) { ?>
        
            <p class="pm-tags-title"><?php _e('Category','viennatheme'); ?></p>
        
            <ul class="pm-tags-list">
            	<?php 
			
					$catCounter = 0;
			
					foreach($cats as $cat){ 
					
						$catCounter++;
					
						$term_link = get_term_link( $cat );
						
						if($catsLen > 1){
							
							if($catCounter >= $catsLen){
								echo '<li><a href="' . $term_link . '">' . $cat->name . '</a></li>'; 
							} else {
								echo '<li><a href="' . $term_link . '">' . $cat->name . '</a>,</li>'; 
							}
							
							
						} else {
							echo '<li><a href="' . $term_link . '">' . $cat->name . '</a></li>';	
						}
						
						
					}
				
				?>
            </ul>
            
        <?php } ?>

</div>
    
<div class="pm-single-meta-divider bottom"></div>
    
<p class="pm-likes-title bottom"><span>0</span> <?php _e('Likes','viennatheme'); ?></p>

<?php get_template_part('content','sharewithfriends'); ?>