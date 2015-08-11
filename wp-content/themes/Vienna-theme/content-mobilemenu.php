<?php 
	$getDisplayLogoMobile = get_theme_mod('displayLogoMobile'); 
	$displayLogoMobile = $getDisplayLogoMobile == '' ? 'on' : $getDisplayLogoMobile;
	$companyLogo = get_theme_mod('companyLogo'); 
	$getCompanyLogoAltTag = get_theme_mod('companyLogoAltTag'); 
	$companyLogoAltTag = $getCompanyLogoAltTag == '' ? get_bloginfo('description') : $getCompanyLogoAltTag;
	$companyLogoURL = get_theme_mod('companyLogoURL'); 
	$searchFieldText = get_theme_mod('searchFieldText'); 
	$enableSearch = get_theme_mod('enableSearch');
?>

<div class="pm-mobile-menu-overlay" id="pm-mobile-menu-overlay"></div>

<div class="pm-mobile-global-menu">
                
    <?php if($displayLogoMobile === 'on') { ?>
        <div class="pm-mobile-global-menu-logo">
        
            <?php if($companyLogo !== '') { ?>
                <a href="<?php echo $companyLogoURL !== '' ? $companyLogoURL : site_url() ?>"><img src="<?php echo $companyLogo; ?>" alt="<?php echo $companyLogoAltTag; ?>" class="img-responsive"></a> 
            <?php } else { ?>
                <a href="<?php echo $companyLogoURL !== '' ? $companyLogoURL : site_url() ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/vienna-logo.png" alt="<?php echo $companyLogoAltTag; ?>"></a> 
            <?php }?>
        
        </div>
    <?php } ?>

	<?php if($enableSearch == 'on') { ?>
		<div class="pm-mobile-global-menu-search">
            <form action="<?php echo home_url( '/' ); ?>" method="get" id="pm-searchform" name="searchform">
                <input name="s" type="text" class="pm-search-field-mobile" placeholder="<?php echo __($searchFieldText,'viennatheme'); ?>">
            </form>
        </div>
    <?php } ?>

    <?php pm_ln_icl_post_languages_mobile(); ?> 

	<?php
		wp_nav_menu(array(
			'container' => '',
			'container_class' => '',
			'menu_class' => 'sf-menu pm-nav',
			'menu_id' => '',
			'theme_location' => 'mobile_menu',
			'fallback_cb' => 'pm_ln_mobile_menu',
		   )
		);
	?>

    
    
</div>