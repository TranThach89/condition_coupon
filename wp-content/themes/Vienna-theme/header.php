<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
	<title>
       <?php
          if (function_exists('is_tag') && is_tag()) {
             single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
          elseif ( is_front_page()) {
             wp_title(''); echo ' Home - '; }
          elseif (is_archive()) {
             wp_title(''); echo ' Archive - '; }
          elseif (is_search()) {
             echo 'Search for &quot;'.esc_html($s).'&quot; - '; }
          elseif (!(is_404()) && (is_single()) || (is_page())) {
             wp_title(''); echo ' - '; }
          elseif (is_404()) {
             echo '404 Error - Page Not Found - '; }
          if (is_home()) {
             bloginfo('name'); echo ' - '; bloginfo('description'); }
          else {
             bloginfo('name'); }
          if ($paged>1) {
             echo ' - page '. $paged; 
		  }
       ?>
	</title>
    
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
    
    <?php 
		
	//Redux options
	global $vienna_options;
		
	$favicon = $vienna_options['opt-favicon'];

	if(is_array($favicon)){
		if( $favicon['url'] !== '' ){
			echo '<link rel="shortcut icon" href="'.$favicon['url'].'" />';
		}
	}
		
	?> 
                        
    <?php wp_head(); ?>
</head>

<?php 

//Options
$getEnableBoxMode = get_theme_mod('enableBoxMode');
$enableBoxMode = $getEnableBoxMode == '' ? 'off' : $getEnableBoxMode;

$getColorSampler = get_theme_mod('colorSampler');
$colorSampler = $getColorSampler == '' ? 'on' : $getColorSampler;

$getEnableStickyNav = get_theme_mod('enableStickyNav');
$enableStickyNav = $getEnableStickyNav == '' ? 'on' : $getEnableStickyNav;

$getEnablePulseSlider = get_theme_mod('enablePulseSlider');
$enablePulseSlider = $getEnablePulseSlider == '' ? 'yes' : $getEnablePulseSlider;

$customSlider = $vienna_options['opt-custom-slider'];

$js_file = get_template_directory_uri() . '/js/wordpress.js'; 

//Pass URL root to JS
wp_register_script( 'urlRoot', $js_file  );
wp_enqueue_script( 'urlRoot' );
$array = array( 
	'urlRoot' => home_url(),
);
wp_localize_script( 'urlRoot', 'urlRootObject', $array );

//Pass template directory to JS
wp_register_script( 'templateDir', $js_file  );
wp_enqueue_script( 'templateDir' );
$array = array( 
	'templateDir' => get_template_directory_uri(),
);
wp_localize_script( 'templateDir', 'templateDirObject', $array );

//Pass stickyNav to JS
wp_register_script( 'stickyNav', $js_file  );
wp_enqueue_script( 'stickyNav' );
$array = array( 
	'stickyNav' => $enableStickyNav,
);
wp_localize_script( 'stickyNav', 'stickyNavObject', $array );

//Pulse slider settings

$getEnableSlideShow = get_theme_mod('enableSlideShow');
$enableSlideShow = $getEnableSlideShow == '' ? 'true' : $getEnableSlideShow;

$getSlideLoop = get_theme_mod('slideLoop');
$slideLoop = $getSlideLoop == '' ? 'true' : $getSlideLoop;

$getEnableControlNav = get_theme_mod('enableControlNav');
$enableControlNav = $getEnableControlNav == '' ? 'true' : $getEnableControlNav;

$getPauseOnHover = get_theme_mod('pauseOnHover');
$pauseOnHover = $getPauseOnHover == '' ? 'true' : $getPauseOnHover;

$getShowArrows = get_theme_mod('showArrows');
$showArrows = $getShowArrows == '' ? 'true' : $getShowArrows;

$getAnimtionType = get_theme_mod('animtionType');
$animtionType = $getAnimtionType == '' ? 'fade' : $getAnimtionType;

$getSlideShowSpeed = get_theme_mod('slideShowSpeed');
$slideShowSpeed = $getSlideShowSpeed == '' ? 8000 : $getSlideShowSpeed;

$getSlideSpeed = get_theme_mod('slideSpeed');
$slideSpeed = $getSlideSpeed == '' ? 500 : $getSlideSpeed;

$getSliderHeight = get_theme_mod('sliderHeight');
$sliderHeight = $getSliderHeight == '' ? 800 : $getSliderHeight;


//Localize Post slider settings for main.js usage
wp_register_script( 'pulseSliderOptions', $js_file );
wp_enqueue_script( 'pulseSliderOptions' );
$array = array( 
	'enableSlideShow' => $enableSlideShow,
	'slideLoop' => $slideLoop,
	'enableControlNav' => $enableControlNav,
	'animtionType' => $animtionType,
	'pauseOnHover' => $pauseOnHover,
	'showArrows' => $showArrows,
	'slideShowSpeed' => $slideShowSpeed,
	'slideSpeed' => $slideSpeed,
	'sliderHeight' => $sliderHeight
);
wp_localize_script( 'pulseSliderOptions', 'pulseSliderOptionsObject', $array );

//Localize PrettyPhoto settings
$ppAnimationSpeed = $vienna_options['ppAnimationSpeed'];
$ppAutoPlay = $vienna_options['ppAutoPlay'];
$ppShowTitle = $vienna_options['ppShowTitle'];
$ppColorTheme = $vienna_options['ppColorTheme'];
$ppSlideShowSpeed = $vienna_options['ppSlideShowSpeed'];
	
//Localize PrettyPhoto settings for main.js usage
wp_register_script( 'ppSettings', $js_file );
wp_enqueue_script( 'ppSettings' );
$array = array( 
	'ppAnimationSpeed' => $ppAnimationSpeed,
	'ppAutoPlay' => $ppAutoPlay,
	'ppShowTitle' => $ppShowTitle,
	'ppColorTheme' => $ppColorTheme,
	'ppSlideShowSpeed' => $ppSlideShowSpeed
);
wp_localize_script( 'ppSettings', 'ppObject', $array );

?>
<body <?php body_class(); ?>>

<?php //get_template_part('content', 'productswitcher'); ?>



<?php if($colorSampler === 'on') { ?>

	<?php get_template_part('content', 'themesampler'); ?>

<?php } ?>



<?php 
	$businessPhone = get_theme_mod('businessPhone');
	$businessAddress = get_theme_mod('businessAddress');
	$businessEmail = get_theme_mod('businessEmail');
	
	$getEnableSearch = get_theme_mod('enableSearch');
	$enableSearch = $getEnableSearch == '' ? 'on' : $getEnableSearch;
	
	$ctaText = get_theme_mod('ctaText');
	$registerLink = get_theme_mod('registerLink');
	$loginLink = get_theme_mod('loginLink');
	
	$getEnableActionButton = get_theme_mod('enableActionButton');
	$enableActionButton = $getEnableActionButton == '' ? 'on' : $getEnableActionButton;
	
	$actionBtnText = get_theme_mod('actionBtnText');	
	$actionBtnURL = get_theme_mod('actionBtnURL');
	$actionBtnIcon = get_theme_mod('actionBtnIcon');
		
?>

<!-- Mobile Menu -->
<?php get_template_part('content', 'mobilemenu'); ?>
<!-- Mobile Menu end -->

<?php if($enableBoxMode === 'on') { ?>
     <div id="pm_layout_wrapper" class="pm-boxed-mode">
<?php } else { ?>
     <div id="pm_layout_wrapper" class="pm-full-mode">
<?php }?>
	    
    <!-- Search form -->
    <?php if($enableSearch == 'on') { ?>
		<?php get_template_part('content', 'searchform'); ?>
    <?php } ?>
    <!-- Search form end -->

    <!-- Sub-Menu -->
    <div class="pm-sub-menu-container">
    
        <div class="container">
        
            <div class="row">
                
                <?php if($enableActionButton == 'on') { ?>
                	<div class="col-lg-5 col-md-5 col-sm-12">
                <?php } else { ?>
                	<div class="col-lg-6 col-md-6 col-sm-12">
                <?php } ?>
                
                    
                    <div class="pm-sub-menu-info">
                        <p class="pm-address"><i class="fa fa-map-marker"></i> <?php echo $businessAddress; ?></p>
                        <p class="pm-contact"><i class="fa fa-mobile-phone"></i> <?php echo $businessPhone; ?></p>
                    </div>
                                            
                </div>
                
                
                <?php if($enableActionButton == 'on') { ?>
                
                	<div class="col-lg-2 col-md-2 col-sm-6 visible-lg visible-md pm-book-event">
                        <div class="pm-sub-menu-book-event">
                            <a href="<?php echo $actionBtnURL; ?>"><?php echo __($actionBtnText,'viennatheme'); ?> <?php echo $actionBtnIcon !== '' ? '<i class="'.$actionBtnIcon.'">' : '' ?> </i></a> 
                        </div>
                    </div>
                
                <?php } ?>
                
                
                <?php if($enableActionButton == 'on') { ?>
                	<div class="col-lg-5 col-md-5 col-sm-6">
                <?php } else { ?>
                	<div class="col-lg-6 col-md-6 col-sm-6">
                <?php } ?>
                
                	<?php
						wp_nav_menu(array(
							'container' => '',
							'container_class' => '',
							'menu_class' => 'pm-sub-navigation',
							'menu_id' => '',
							'theme_location' => 'micro_menu',
							'fallback_cb' => 'pm_ln_micro_menu',
						   )
						);
					?>
                    
                    
                    <?php pm_ln_icl_post_languages(); ?> 
                    
                </div>
                
            </div>
        
        </div>
        
    </div>
    <!-- Sub-Menu -->

    <!-- Main navigation -->
    <?php 
		$getDisplayLogo = get_theme_mod('displayLogo'); 
		$displayLogo = $getDisplayLogo == '' ? 'on' : $getDisplayLogo;
		$companyLogo = get_theme_mod('companyLogo'); 
		$getCompanyLogoAltTag = get_theme_mod('companyLogoAltTag'); 
		$companyLogoAltTag = $getCompanyLogoAltTag == '' ? get_bloginfo('description') : $getCompanyLogoAltTag;
		$companyLogoURL = get_theme_mod('companyLogoURL'); 
	?>
    
    <header>
            
        <div class="container">
        
            <div class="row">
            
            	<?php if($displayLogo === 'on') { ?>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                                            
                        <div class="pm-header-logo-container">
                        
                            <?php if($companyLogo !== '') { ?>
                                <a href="<?php echo $companyLogoURL !== '' ? $companyLogoURL : site_url() ?>"><img src="<?php echo $companyLogo; ?>" class="img-responsive pm-header-logo" alt="<?php echo $companyLogoAltTag; ?>"></a> 
                            <?php } else { ?>
                                <a href="<?php echo $companyLogoURL !== '' ? $companyLogoURL : site_url() ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/vienna-logo.png" class="img-responsive pm-header-logo" alt="<?php echo $companyLogoAltTag; ?>"></a> 
                            <?php }?>
                            
                        </div>
                        
                        <div class="pm-header-mobile-btn-container">
                            <button type="button" class="navbar-toggle pm-main-menu-btn" id="pm-mobile-menu-trigger" ><i class="fa fa-bars"></i></button>
                        </div>
                    
                    </div>
                <?php } ?>
                
                <?php if($displayLogo == 'on') { ?>
                	<div class="col-lg-8 col-md-8 col-sm-8 pm-main-menu">
                <?php } else { ?>
                	<div class="col-lg-12 pm-main-menu">
                <?php } ?>
                
                                    
                        <nav class="navbar-collapse collapse">
                        
                            <?php
                                wp_nav_menu(array(
                                    'container' => '',
                                    'container_class' => '',
                                    'menu_class' => 'sf-menu pm-nav',
                                    'menu_id' => '',
                                    'theme_location' => 'main_menu',
                                    'fallback_cb' => 'pm_ln_main_menu',
                                   )
                                );
                            ?>
                                            
                        </nav>
                                                                  
                    </div>
                    
                <?php if($displayLogo == 'off') { ?>
                    
                    <div class="col-lg-12 pm-header-mobile-btn-container">
                        <button type="button" class="navbar-toggle pm-main-menu-btn" id="pm-mobile-menu-trigger" ><i class="fa fa-bars"></i></button>
                    </div>
                
                <?php } ?>
                
            </div>
        
        </div>
                
    </header>
    <!-- /Main navigation -->
    
    <?php if(is_home() || is_front_page()) {//Display Pulse Slider ?>
    
    	<!-- PULSE SLIDER -->
    	<?php if($enablePulseSlider === 'yes') { ?>
        
        		<?php 
				
				$slides = $vienna_options['opt-pulse-slides']; 
				
				?>
                
                <?php 
				
					$sliderCounter = 0;
				
					if(count($slides) > 0){
						
						echo '<div class="pm-pulse-container" id="pm-pulse-container">';
						
							echo '<div id="pm-pulse-loader"><img src="'.get_template_directory_uri().'/js/pulse/img/ajax-loader.gif" alt="slider loading" /></div>';
							
							echo '<div id="pm-slider" class="pm-slider">';
							
								echo '<div id="pm-slider-progress-bar"></div>';
								
								echo '<ul class="pm-slides-container" id="pm_slides_container">';
								
									foreach($slides as $s) {
										
										$btnText = '';
										$btnUrl = '';
										
										if(!empty($s['url'])){
											$pieces = explode(" - ", $s['url']);
											$btnText = $pieces[0];
											$btnUrl = $pieces[1];
										}
										
										echo '<li data-thumb="'.$s['image'].'" class="pmslide_'.$sliderCounter.'"><img src="'.$s['image'].'" alt="img01" />';
                            
											echo '<div class="pm-holder">';
												echo '<div class="pm-caption">';
													  if( !empty($s['title']) ){
														  echo '<h1><span>'.__($s['title'], 'viennatheme').'</span></h1>';
													  }
													  if( !empty($s['description']) ){
														  echo '<span class="pm-caption-decription">';
															echo __($s['description'], 'viennatheme');
														  echo '</span>';
													  }
													  
													  if($btnText !== ''){
														 echo '<a href="'.$btnUrl.'" class="pm-slide-btn animated">'.__($btnText, 'viennatheme').' <i class="fa fa-chevron-right"></i></a>'; 
													  }
												echo '</div>';
											echo '</div>';
										
										echo '</li>';
										
										$sliderCounter++;
												
									}
																
								echo '</ul>';
							
							echo '</div>';
						
						echo '</div>';
						
					}//end of if
				
				?> 
                
                <!-- PULSE SLIDER end -->
        
        <?php } ?>
        
        <?php 
		
			if($customSlider !== '' && $enablePulseSlider === 'no') { 
        	   echo do_shortcode($customSlider);
        	} 
			
		?>
            
    <?php } else {//display sub-header ?>
	
    	<?php get_template_part('content', 'subheader'); ?>
    
<?php } ?>