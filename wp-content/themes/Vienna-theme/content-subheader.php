<!-- SUBHEADER AREA -->

<?php 
		
	//Sub-header options
	$getEnableParallax = get_theme_mod('enableParallax');
	$enableParallax = $getEnableParallax == '' ? 'on' : $getEnableParallax;
	
	$globalHeaderImage = get_theme_mod('globalHeaderImage');
	
	$pageHeaderMessage = get_post_meta(get_the_ID(), 'pm_header_message_meta', true); 

?>

<!-- SUB-HEADER area
<div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
    
    <div class="pm-sub-header-title-container">
        <p class="pm-sub-header-title"><span>Title goes here</span></p>
        <p class="pm-sub-header-message">Page message goes here</p>
    </div>
    
</div>
SUB-HEADER area end -->
        
<!-- Subpage Header layouts -->
<?php if( function_exists( 'is_shop' ) ) {//woocommerce installed ?>

        <?php if( is_shop() ) { //Load Woocommerce shop header ?>
        
                <?php 
                    global $woocommerce;
                    $pageid = get_option('woocommerce_shop_page_id');
                    $pm_woocom_header_image_meta = get_post_meta($pageid, 'pm_header_image_meta', true); 
                ?>
                
                <?php if($pm_woocom_header_image_meta !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $pm_woocom_header_image_meta; ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo $pm_woocom_header_image_meta; ?>'); background-position:center top;">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
                
        <?php } elseif( is_product() ) {//Load Woocommerce product header ?>
        
                <?php 
                    global $woocommerce;
                    $pm_woocom_header_image_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_image_meta', true); 
                ?>
                
                <?php if($pm_woocom_header_image_meta !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $pm_woocom_header_image_meta; ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo $pm_woocom_header_image_meta; ?>'); background-position:center top;">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } elseif( is_product_category() || is_product_tag() ) {//Load Woocommerce archive header ?>
        
                <?php 
                    $wooCategoryHeaderImage = get_theme_mod('wooCategoryHeaderImage'); 
                ?>
                
                <?php if($wooCategoryHeaderImage !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $wooCategoryHeaderImage; ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo $wooCategoryHeaderImage; ?>'); background-position:center top;">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } elseif( is_404() || is_search() || is_tag() || is_category() || is_archive() ) { ?>
        
                <?php if($globalHeaderImage !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $globalHeaderImage; ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo $globalHeaderImage; ?>'); background-position:center top;">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
            
        <?php } else { ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $pageHeaderImage; ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo $pageHeaderImage; ?>'); background-position:center top;">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } ?>

<?php } else {//woocommerce not installed ?>

        <?php if( is_404() || is_search() || is_tag() || is_category() || is_archive() ) {//Display Global header image on these pages ?>
        
            <?php if($globalHeaderImage !== '') { ?>
            
                <?php if($enableParallax == 'on') { ?>
    
                    <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $globalHeaderImage; ?>')">
                
                <?php } else { ?>
                
                    <div class="pm-sub-header-container" style="background-image:url('<?php echo $globalHeaderImage; ?>'); background-position:center top;">
                
                <?php } ?>
            
            <?php } else { ?>
            
                    <div class="pm-sub-header-container">
            
            <?php } ?>
        
        <?php } else {//Display Page header on pages ?>
        
                <?php
                    $pageHeaderImage = get_post_meta(get_the_ID(), 'pm_header_image_meta', true); 
                ?>
        
                <?php if($pageHeaderImage !== '') { ?>
            
                    <?php if($enableParallax == 'on') { ?>
        
                        <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $pageHeaderImage; ?>')">
                    
                    <?php } else { ?>
                    
                        <div class="pm-sub-header-container" style="background-image:url('<?php echo $pageHeaderImage; ?>'); background-position:center top;">
                    
                    <?php } ?>
                
                <?php } else { ?>
                
                        <div class="pm-sub-header-container">
                
                <?php } ?>
        
        <?php } ?>

<?php } ?>
  
    
    <!-- Header Page Title --> 
    <?php if( function_exists('is_shop') ) {//Woocommerce enabled ?>
    
            <?php if( is_search() && is_shop() ) { ?>
    
                    <div class="pm-sub-header-title-container">
                                        
                    	<p class="pm-sub-header-title"><?php _e('Search Results for:', 'viennatheme'); ?></p>
        				<p class="pm-sub-header-message">"<?php echo get_search_query(); ?>"</p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                    </div>
            
            <?php } else if( is_shop() ) { ?>
                            
                    <div class="pm-sub-header-title-container">
                    	
                    	<p class="pm-sub-header-title"><?php woocommerce_page_title(); ?></p>
                        
                        <?php 
							global $woocommerce;
							$pageid = get_option('woocommerce_shop_page_id');
							$pm_header_message_meta = get_post_meta($pageid, 'pm_header_message_meta', true); 
							//$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
						?>
						
                        <p class="pm-sub-header-message"><?php echo $pm_header_message_meta; ?></p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if( is_product() ) { ?>
        
					<?php 
                        $pm_woocom_header_message_meta = get_post_meta(get_the_id(), 'pm_woocom_header_message_meta', true); 
                        //$pm_woocom_header_message_meta = get_post_meta(get_the_ID(), 'pm_woocom_header_message_meta', true); 
                    ?>
                    
                    <div class="pm-sub-header-title-container">
                        
                        <p class="pm-sub-header-title"><?php the_title(); ?></p>
                    	<p class="pm-sub-header-message"><?php echo $pm_woocom_header_message_meta; ?></p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>                    
                    
            <?php } else if(  is_product_category() || is_product_tag()  ) { ?>      
                   
                   <div class="pm-sub-header-title-container">
                        
                        <p class="pm-sub-header-title"><?php the_title(); ?></p>
                   		<p class="pm-sub-header-message">"<?php woocommerce_page_title(); ?>"</p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                   
                   </div>                   
            
            <?php } else if( is_404() ) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><span><?php _e('404 Error', 'viennatheme'); ?></span></p>
                        <p class="pm-sub-header-message"><?php _e('Page not found', 'viennatheme'); ?></p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>
            
            <?php } else if( is_search() ) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><?php _e('Search Results for:', 'viennatheme'); ?></p>
                        <p class="pm-sub-header-message">"<?php echo get_search_query(); ?>"</p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_tag()) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><?php _e('News tagged with:', 'viennatheme'); ?></p>
                    	<p class="pm-sub-header-message">"<?php echo get_query_var('tag'); ?>"</p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_category()) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><?php _e('News filed in:', 'viennatheme'); ?></p>
                    	<p class="pm-sub-header-message">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>
                    
            <?php } else if(is_tax('gallerycats') ) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><?php single_tag_title("Gallery posts filed in &quot;"); echo '&quot; '; ?></p>
                        
                        
                    </div>
                    
            <?php } else if(is_tax('gallerytags') ) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><?php single_tag_title("Gallery posts tagged in &quot;"); echo '&quot; '; ?></p>
                                                
                    </div>
                    
            <?php } else if( is_archive() ) { ?>
            
                    <div class="pm-sub-header-title-container">
                    
                    	<p class="pm-sub-header-title"><?php _e('Archive for', 'viennatheme'); ?></p>
                        <p class="pm-sub-header-message">
						<?php 
                        
                            if (is_day()) {
                                the_time('F jS, Y');
                            }
                            elseif (is_month()) {
                                the_time('F, Y');
                            }
                            elseif (is_year()) {
                                the_time('Y');
                            }
                            elseif (is_author()) {
                                echo"<li>Author Archive"; echo'</li>';
                            }
                        
                        ?>
                        </p>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                    </div>
                    
            <?php } else if( is_single() ) { ?>
        
        		<div class="pm-sub-header-title-container">
                                
                    <p class="pm-sub-header-title post"><?php the_title(); ?></p>
                    
                    <?php get_template_part('content', 'postnavigation'); ?>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
            
            <?php } else { ?>
            
                    <div class="pm-sub-header-title-container">
                    	                    
                    	<p class="pm-sub-header-title"><span><?php the_title(); ?></span></p>
                        
                    	<?php if($pageHeaderMessage !== ''){ ?>
                            <p class="pm-sub-header-message"><?php echo $pageHeaderMessage; ?></p>
                        <?php } ?>
                        
                        <?php get_template_part('content', 'breadcrumbs'); ?>
                        
                    </div>
            
            <?php } ?>
            
    
    <?php } else {//Woocommerce not enabled ?>

        
        <?php if( is_404() ) { ?>
        
                <div class="pm-sub-header-title-container">
                
                	<p class="pm-sub-header-title"><span><?php _e('404 Error', 'viennatheme'); ?></span></p>
                	<p class="pm-sub-header-message"><?php _e('Page not found', 'viennatheme'); ?></p>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
        
        <?php } else if( is_search() ) { ?>
        
                <div class="pm-sub-header-title-container">
                
                    <p class="pm-sub-header-title"><?php _e('Search Results for:', 'viennatheme'); ?></p>
                    <p class="pm-sub-header-message">"<?php echo get_search_query(); ?>"</p>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
                
        <?php } else if(is_tag()) { ?>
        
                <div class="pm-sub-header-title-container">
                
                    <p class="pm-sub-header-title"><?php _e('News tagged with:', 'viennatheme'); ?></p>
                    <p class="pm-sub-header-message">"<?php echo get_query_var('tag'); ?>"</p>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
                
        <?php } else if(is_category()) { ?>
        
                <div class="pm-sub-header-title-container">
                                
                    <p class="pm-sub-header-title"><?php _e('News filed in:', 'viennatheme'); ?></p>
                    <p class="pm-sub-header-message">"<?php $cat = get_category( get_query_var( 'cat' ) ); echo $cat->name; ?>"</p>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
                
        <?php } else if( is_archive() ) { ?>
        
                <div class="pm-sub-header-title-container">
                	                
                    <p class="pm-sub-header-title"><?php _e('Archive for', 'viennatheme'); ?></p>
                    <p class="pm-sub-header-message">
					<?php 
                    
                        if (is_day()) {
                            the_time('F jS, Y');
                        }
                        elseif (is_month()) {
                            the_time('F, Y');
                        }
                        elseif (is_year()) {
                            the_time('Y');
                        }
                        elseif (is_author()) {
                            echo"<li>Author Archive"; echo'</li>';
                        }
                    
                    ?>
                    </p>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
                
        <?php } else if( is_single() ) { ?>
        
        		<div class="pm-sub-header-title-container">
                                
                    <p class="pm-sub-header-title post"><?php the_title(); ?></p>
                    
                    <?php get_template_part('content', 'postnavigation'); ?>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
        
        <?php } else { ?>
        
                <div class="pm-sub-header-title-container">
                                
                    <p class="pm-sub-header-title"><span><?php the_title(); ?></span></p>
                    <?php if($pageHeaderMessage !== ''){ ?>
                        <p class="pm-sub-header-message"><?php echo $pageHeaderMessage; ?></p>
                    <?php } ?>
                    
                    <?php get_template_part('content', 'breadcrumbs'); ?>
                    
                </div>
        
        <?php } ?>
    
    <?php } ?>
            
                                        
</div>
<!-- SUBHEADER AREA end -->