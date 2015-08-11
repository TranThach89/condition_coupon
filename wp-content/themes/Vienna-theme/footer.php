<?php 

//Redux options
global $vienna_options;

//Footer Logo
$getEnableTooltip = get_theme_mod('enableTooltip');
$enableTooltip = $getEnableTooltip == '' ? 'on' : $getEnableTooltip;

//Footer Options
$get_toggle_fatfooter = get_theme_mod('toggle_fatfooter');
$toggle_fatfooter = $get_toggle_fatfooter == '' ? 'on' : $get_toggle_fatfooter;

$get_toggle_socialFooter = get_theme_mod('toggle_socialFooter');
$toggle_socialFooter = $get_toggle_socialFooter == '' ? 'on' : $get_toggle_socialFooter;

$get_toggle_footerNav = get_theme_mod('toggle_footerNav');
$toggle_footerNav = $get_toggle_footerNav == '' ? 'on' : $get_toggle_footerNav;
	
$copyrightNotice = get_theme_mod('copyrightNotice');
$returnToTopIcon = get_theme_mod('returnToTopIcon');

//Layout Options
$getFooterLayout = get_theme_mod('footerLayout');
$footerLayout = $getFooterLayout == '' ? 'footer-four-columns' : $getFooterLayout;

$gaCode = $vienna_options['opt-ga-code'];

?>

		<?php if($toggle_fatfooter == 'on') { ?>
            
            <div class="pm-fat-footer">
                
                <div class="container">
                    <div class="row">
                    
                    	<!-- Widget layouts -->   
                        
                        <?php if($footerLayout == 'footer-three-wide-left') { ?>
                    
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-three-wide-right') { ?>
                        
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-one-column') { ?>
                        
                            <div class="col-lg-12 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-two-columns') { ?>
                        
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                                            
                        <?php } ?>
                    
                        <?php if($footerLayout == 'footer-three-columns') { ?>
                        
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pm-widget-footer">
                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                            </div>
                                            
                        <?php } ?>
                        
                        <?php if($footerLayout == 'footer-four-columns') { ?>
                                                        
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3")) ; ?>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pm-widget-footer">
                                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 4")) ; ?>
                                </div>
                        
                        <?php } ?>
                        
                        <!-- Widget layouts end -->                    
                        
                    </div>	
                </div>
                
            </div>
        
        <?php } ?>
    
		<?php if($toggle_socialFooter == 'on') { ?>
        
        	<?php 
				$socialMediaCTA = get_theme_mod('socialMediaCTA');
				$newsletterCTA = get_theme_mod('newsletterCTA');
				
				//Social links
				$facebooklink = get_theme_mod('facebooklink');
				$twitterlink = get_theme_mod('twitterlink');
				$googlelink = get_theme_mod('googlelink');
				$linkedinLink = get_theme_mod('linkedinLink');
				$vimeolink = get_theme_mod('vimeolink');
				$youtubelink = get_theme_mod('youtubelink');
				$dribbblelink = get_theme_mod('dribbblelink');
				$pinterestlink = get_theme_mod('pinterestlink');
				$instagramlink = get_theme_mod('instagramlink');
				$behancelink = get_theme_mod('behancelink');
				$skypelink = get_theme_mod('skypelink');
				$flickrlink = get_theme_mod('flickrlink');
				$tumblrlink = get_theme_mod('tumblrlink');
				
				$redditlink = get_theme_mod('redditlink');
				$digglink = get_theme_mod('digglink');
				$deliciouslink = get_theme_mod('deliciouslink');
				$stumbleuponlink = get_theme_mod('stumbleuponlink');
								
				$businessEmail = get_theme_mod('businessEmail');
				$rssLink = get_theme_mod('rssLink');
				
			?>
        
            <footer>
            
                <div class="container">
                    <div class="row">
                        
                       <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="pm-footer-social-info-container">
                                <?php echo $socialMediaCTA; ?>
                                <ul class="pm-footer-social-icons">
                                
                                	<?php if($twitterlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Twitter', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $twitterlink; ?>" target="_blank"><i class="fa fa-twitter tw"></i></a></li>
                                    <?php } ?>
                                    <?php if($facebooklink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Facebook', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $facebooklink; ?>" target="_blank"><i class="fa fa-facebook fb"></i></a></li>
                                    <?php } ?>
                                	<?php if($googlelink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Google Plus', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $googlelink; ?>" target="_blank"><i class="fa fa-google-plus gp"></i></a></li>
                                    <?php } ?>
                                    <?php if($linkedinLink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Linkedin', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $linkedinLink; ?>" target="_blank"><i class="fa fa-linkedin linked"></i></a></li>
                                    <?php } ?>
                                    <?php if($youtubelink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('YouTube', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $youtubelink; ?>" target="_blank"><i class="fa fa-youtube yt"></i></a></li>
                                    <?php } ?>
                                    <?php if($vimeolink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Vimeo', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $vimeolink; ?>" target="_blank"><i class="fa fa-vimeo-square vimeo"></i></a></li>
                                    <?php } ?>
                                    <?php if($dribbblelink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Dribbble', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $dribbblelink; ?>" target="_blank"><i class="fa fa-dribbble dribbble"></i></a></li>
                                    <?php } ?>
                                    <?php if($pinterestlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Pinterest', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $pinterestlink; ?>" target="_blank"><i class="fa fa-pinterest pinterest"></i></a></li>
                                    <?php } ?>
                                    <?php if($instagramlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Instagram', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $instagramlink; ?>" target="_blank"><i class="fa fa-instagram instagram"></i></a></li>
                                    <?php } ?>
                                    <?php if($behancelink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Behance', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $behancelink; ?>" target="_blank"><i class="fa fa-behance behance"></i></a></li>
                                    <?php } ?>
                                    <?php if($skypelink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Skype', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $skypelink; ?>" target="_blank"><i class="fa fa-skype skype"></i></a></li>
                                    <?php } ?>
                                    <?php if($flickrlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Flickr', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $flickrlink; ?>" target="_blank"><i class="fa fa-flickr flickr"></i></a></li>
                                    <?php } ?>
                                    <?php if($tumblrlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Tumblr', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $tumblrlink; ?>" target="_blank"><i class="fa fa-tumblr tumblr"></i></a></li>
                                    <?php } ?>
                                    <?php if($redditlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Reddit', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $redditlink; ?>" target="_blank"><i class="fa fa-reddit reddit"></i></a></li>
                                    <?php } ?>
                                    <?php if($digglink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Digg', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $digglink; ?>" target="_blank"><i class="fa fa-digg digg"></i></a></li>
                                    <?php } ?>
                                    <?php if($deliciouslink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Delicious', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $deliciouslink; ?>" target="_blank"><i class="fa fa-delicious delicious"></i></a></li>
                                    <?php } ?>
                                    
                                    <?php if($stumbleuponlink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('StumbleUpon', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $stumbleuponlink; ?>" target="_blank"><i class="fa fa-stumbleupon stumbleupon"></i></a></li>
                                    <?php } ?>
                                    
                                    <?php if($businessEmail !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('Email us', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="mailto:<?php echo $businessEmail; ?>" target="_blank"><i class="fa fa-envelope envelope"></i></a></li>
                                    <?php } ?>
                                    <?php if($rssLink !== '') { ?>
                                    	<li <?php echo $enableTooltip == 'on' ? 'title="'. __('RSS Feed', 'viennatheme') .'"' : '' ?> class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>"><a href="<?php echo $rssLink; ?>" target="_blank"><i class="fa fa-rss rss"></i></a></li>
                                    <?php } ?>
                                    
                                    
                                </ul>
                            </div>
                            
                       </div>
                       
                       <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="pm-footer-subscribe-container">
                                <?php echo $newsletterCTA; ?>
                                <div class="pm-footer-subscribe-form-container">
                                
                                	<?php $mailchimpAddress = get_theme_mod('mailchimpAddress'); ?>
                                
                                    <form action="<?php echo htmlentities($mailchimpAddress); ?>" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                    	<input name="MERGE0" type="email" class="pm-footer-subscribe-field" id="MERGE3" placeholder="Email Address">
                                        <input name="subscribe" type="submit" value="&#xf1d8;" class="pm-footer-subscribe-submit-btn">
                                    </form>
                                </div>
                            </div>
                       </div>
                        
                    </div>
                </div>	
    
                    
            </footer>
        
        <?php } ?>
    
		
        <?php if($toggle_footerNav == 'on') { ?>
        <div class="pm-footer-copyright">
            
            <div class="container">
                <div class="row">
                
                    <!-- copyright and navigation -->
                    <div class="col-lg-5 col-md-5 col-sm-12 pm-footer-copyright-col">
                        <p><?php echo $copyrightNotice ?></p>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 pm-footer-navigation-col">
                        <?php
                            wp_nav_menu(array(
                                'container' => '',
                                'container_class' => '',
                                'menu_class' => 'pm-footer-navigation',
                                'menu_id' => 'pm-footer-nav',
                                'theme_location' => 'footer_menu',
                                'fallback_cb' => 'pm_ln_footer_menu',
                               )
                            );
                        ?>
                    </div>        
                    
                </div>
            </div>
            
        </div>
        <?php } ?>
    
	</div><!-- /pm_layout_wrapper -->

        <p id="back-top"> </p>
                
        <?php 
				
		if($gaCode){
            print $gaCode;
        } 
		
		?> 
                
		<?php wp_footer(); ?> 
    </body>
</html>