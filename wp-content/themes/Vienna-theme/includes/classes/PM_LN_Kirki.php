<?php

/**
* Create the section
*/
function pm_ln_customizer_sections( $wp_customize ) {
	
	/*** Remove default wordpress sections ***/
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');
	
	//TWITTER OPTIONS
	$wp_customize->add_section( 'twitter_api_details', array(
		'title' => __( 'Twitter API Credentials', 'viennatheme' ),
		'priority' => 1
	) );
	
	//HEADER OPTIONS
	$wp_customize->add_section( 'header_options' , array(
		'title'    => __( 'Header Options', 'viennatheme' ),
		'priority' => 2,
	));
	
	//FOOTER OPTIONS
	$wp_customize->add_section( 'footer_options' , array(
		'title'    => __( 'Footer Options', 'viennatheme' ),
		'priority' => 3,
	));
	
	//LAYOUT OPTIONS
	$wp_customize->add_section( 'layout_options' , array(
		'title'    => __( 'Layout Options', 'viennatheme' ),
		'priority' => 4,
	));	
		
	//GLOBAL OPTIONS
	$wp_customize->add_section( 'global_options' , array(
		'title'    => __( 'Global Options', 'viennatheme' ),
		'priority' => 5,
	));
	
	//BUSINESS INFO
	$wp_customize->add_section( 'business_info' , array(
		'title'    => __( 'Business Info', 'viennatheme' ),
		'priority' => 6,
	));
	
	//WOOCOMMERCE OPTIONS
	$wp_customize->add_section( 'woo_options' , array(
		'title'    => __( 'Woocommerce Options', 'viennatheme' ),
		'priority' => 7,
	));
	
	//PULSE SLIDER OPTIONS
	$wp_customize->add_section( 'pulseslider_options' , array(
		'title'    => __( 'Pulse Slider Options', 'viennatheme' ),
		'priority' => 8,
	));
	
	//SHORTCODE OPTIONS
	$wp_customize->add_section( 'shortcode_options' , array(
		'title'    => __( 'Shortcode Options', 'viennatheme' ),
		'priority' => 9,
	));
	
	//ALERT OPTIONS
	$wp_customize->add_section( 'alert_options' , array(
		'title'    => __( 'Alert Options', 'viennatheme' ),
		'priority' => 10,
	));
	
}
	

/**
* Create the setting
*/
function pm_ln_customizer_settings( $controls ) {
	
	//TWITTER OPTIONS
	$controls[] = array(
		'type' => 'text',
		'setting' => 'twitter_consumer_key',
		'label' => __( 'Consumer Key', 'viennatheme' ),
		'section' => 'twitter_api_details',
		'default' => '',
		'priority' => 1,
	);
	
	$controls[] = array(
		'type' => 'text',
		'setting' => 'twitter_consumer_secret',
		'label' => __( 'Consumer Secret', 'viennatheme' ),
		'section' => 'twitter_api_details',
		'default' => '',
		'priority' => 2,
	);
	
	$controls[] = array(
		'type' => 'text',
		'setting' => 'twitter_access_token',
		'label' => __( 'Access Token', 'viennatheme' ),
		'section' => 'twitter_api_details',
		'default' => '',
		'priority' => 3,
	);
	
	$controls[] = array(
		'type' => 'text',
		'setting' => 'twitter_access_token_secret',
		'label' => __( 'Access Token Secret', 'viennatheme' ),
		'section' => 'twitter_api_details',
		'default' => '',
		'priority' => 4,
	);
	
	
	//HEADER OPTIONS
	
	//checkboxes
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableParallax',
		'label'    => __( 'Enable sub-header parallax?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 1,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'displayLogo',
		'label'    => __( 'Display Company Logo?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 2,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'displayLogoMobile',
		'label'    => __( 'Display Company on mobile?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 3,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableStickyNav',
		'label'    => __( 'Sticky Navigation?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 4,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableBreadCrumbs',
		'label'    => __( 'Display Breadcrumbs?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 5,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableSearch',
		'label'    => __( 'Enable Search?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 6,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);

	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableActionButton',
		'label'    => __( 'Enable Action button?', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => 'on',
		'priority' => 7,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	
	//textfields
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'searchFieldText',
		'label'    => __( 'Search Field Text', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => __( 'Type Keywords...', 'textdomain' ),
		'priority' => 8,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'actionBtnText',
		'label'    => __( 'Action Button Text', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => __( 'Book an Event', 'textdomain' ),
		'priority' => 9,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'actionBtnURL',
		'label'    => __( 'Action button URL', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => __( '#', 'textdomain' ),
		'priority' => 10,
	);
	
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'actionBtnIcon',
		'label'    => __( 'Action button icon', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => __( 'fa fa-calendar', 'textdomain' ),
		'priority' => 11,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'companyLogoURL',
		'label'    => __( 'Company Logo URL', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => __( '', 'textdomain' ),
		'priority' => 12,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'companyLogoAltTag',
		'label'    => __( 'Company Logo ALT tag', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => __( 'Vienna Restaurant', 'textdomain' ),
		'priority' => 13,
	);
	
	//upload options
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'companyLogo',
		'label'    => __( 'Company Logo', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '',
		'priority' => 14,
	);
	
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'globalHeaderImage',
		'label'    => __( 'Global Header Image', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '',
		'priority' => 15,
	);
	
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'dropMenuIndicator',
		'label'    => __( 'Drop Menu Indicator', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '',
		'priority' => 16,
	);
	
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'mainMenuBackgroundImage',
		'label'    => __( 'Main Menu Background Image', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '',
		'priority' => 17,
	);
	
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'subMenuBackgroundImage',
		'label'    => __( 'Sub Menu Background Image', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '',
		'priority' => 18,
	);
	
	//colors
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'mainNavColor',
		'label'    => __( 'Main Menu Background Color', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '#000000',
		'priority' => 19,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'dropMenuBackgroundColor',
		'label'    => __( 'Drop Menu Background Color', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '#000000',
		'priority' => 20,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'subMenuBackgroundColor',
		'label'    => __( 'Sub Menu Background Color', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '#000000',
		'priority' => 20,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'subpageHeaderBackgroundColor',
		'label'    => __( 'Subpage Header Background Color', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '#cecece',
		'priority' => 21,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'pageTitleBackgroundColor',
		'label'    => __( 'Page Title Background Color', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '#000000',
		'priority' => 22,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'navButtonColor',
		'label'    => __( 'Navigation Button Color', 'textdomain' ),
		'section'  => 'header_options',
		'default'  => '#f6f6f6',
		'priority' => 23,
	);
	
	
	//LAYOUT OPTIONS
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableBoxMode',
		'label'    => __( '1170 Boxed Mode?', 'textdomain' ),
		'section'  => 'layout_options',
		'default'  => 'off',
		'priority' => 1,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'homepageLayout',
		'label'    => __( 'Sidebar Layout (Default Homepage)', 'textdomain' ),
		'section'  => 'layout_options',
		'default'  => 'no-sidebar',
		'priority' => 2,
		'choices'  => array(
			'no-sidebar' => __( 'No Sidebar', 'textdomain' ),
			'left-sidebar' => __( 'Left Sidebar', 'textdomain' ),
			'right-sidebar' => __( 'Right Sidebar', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'universalLayout',
		'label'    => __( 'Universal Layout (Tag - Archive - Category)', 'textdomain' ),
		'section'  => 'layout_options',
		'default'  => 'no-sidebar',
		'priority' => 3,
		'choices'  => array(
			'no-sidebar' => __( 'No Sidebar', 'textdomain' ),
			'left-sidebar' => __( 'Left Sidebar', 'textdomain' ),
			'right-sidebar' => __( 'Right Sidebar', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'footerLayout',
		'label'    => __( 'Footer Layout', 'textdomain' ),
		'section'  => 'layout_options',
		'default'  => 'footer-four-columns',
		'priority' => 4,
		'choices'  => array(
			'footer-one-column' => __( 'One Column', 'textdomain' ),
			'footer-two-columns' => __( 'Two Columns', 'textdomain' ),
			'footer-three-columns' => __( 'Three Columns', 'textdomain' ),
			'footer-four-columns' => __( 'Four Columns', 'textdomain' ),
			'footer-three-wide-left' => __( 'Three Columns (Wide Left)', 'textdomain' ),
			'footer-three-wide-right' => __( 'Three Columns (Wide Right)', 'textdomain' ),
		),
	);
	
	//FOOTER OPTIONS
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'toggle_fatfooter',
		'label'    => __( 'Fat Footer', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => 'on',
		'priority' => 1,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'toggle_socialFooter',
		'label'    => __( 'Social Footer', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => 'on',
		'priority' => 2,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'toggle_footerNav',
		'label'    => __( 'Main Footer', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => 'on',
		'priority' => 3,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	//textarea fields
	$controls[] = array(
		'type'     => 'textarea',
		'setting'  => 'socialMediaCTA',
		'label'    => __( 'Social Media Call To Action', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => __( '<h6>Join the conversation</h6>', 'textdomain' ),
		'priority' => 4,
	);
	
	$controls[] = array(
		'type'     => 'textarea',
		'setting'  => 'newsletterCTA',
		'label'    => __( 'Newsletter Call To Action', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => __( '<h6>Subscribe to our newsletter</h6>', 'textdomain' ),
		'priority' => 5,
	);
		
	$controls[] = array(
		'type'     => 'textarea',
		'setting'  => 'returnToTopIcon',
		'label'    => __( 'Return To Top Icon', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => __( '\f077', 'textdomain' ),
		'priority' => 6,
	);
	
	$controls[] = array(
		'type'     => 'textarea',
		'setting'  => 'copyrightNotice',
		'label'    => __( 'Copyright Notice', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => __( '© 2014 Vienna. Produced by <a target="_blank" href="http://www.pulsarmedia.ca">Pulsar Media</a>', 'textdomain' ),
		'priority' => 7,
	);
	
	$controls[] = array(
		'type'     => 'textarea',
		'setting'  => 'mailchimpAddress',
		'label'    => __( 'Mailchimp Subscribe URL', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => __( 'http://pulsarmedia.us4.list-manage2.com/subscribe?u=2aa9334fc1bc18c8d05500b41&id=dbcb577c4d', 'textdomain' ),
		'priority' => 8,
	);
	
	//images
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'fatFooterBackgroundImage',
		'label'    => __( 'Fat Footer Background Image', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '',
		'priority' => 9,
	);
	
	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'footerBackgroundImage',
		'label'    => __( 'Footer Background Image', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '',
		'priority' => 10,
	);
	
	//colors
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'newsletterFieldColor',
		'label'    => __( 'Newsletter Field Color', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '#2d2d2d',
		'priority' => 11,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'footerWidgetTitleColor',
		'label'    => __( 'Footer Widget Title Color', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '#ffffff',
		'priority' => 12,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'fatFooterBackgroundColor',
		'label'    => __( 'Fat Footer Background Color', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '#2D2D2D',
		'priority' => 13,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'footerBackgroundColor',
		'label'    => __( 'Footer Background Color', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '#2D2D2D',
		'priority' => 14,
	);

	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'subFooterBackgroundColor',
		'label'    => __( 'Sub Footer Background Color', 'textdomain' ),
		'section'  => 'footer_options',
		'default'  => '#FFFFFF',
		'priority' => 15,
	);	
	
	
	//GLOBAL OPTIONS	
	
	//images
	$controls[] = array(
		'type'         => 'background',
		'setting'      => 'my_setting',
		'label'        => __( 'Background image', 'textdomain' ),
		'description'  =>   __( 'Background Color', 'textdomain' ),
		'section'      => 'global_options',
		'default'      => array(
			'color'    => '#ffffff',
			'image'    => null,
			'repeat'   => 'repeat',
			'size'     => 'inherit',
			'attach'   => 'inherit',
			'position' => 'left-top',
			'opacity'  => 100,
		),
		'priority' => 1,
		'output' => 'body',
	);
	
	//textarea fields
	$controls[] = array(
		'type'     => 'textarea',
		'setting'  => 'searchErrorMessage',
		'label'    => __( 'Invalid Search Message', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => __( '<p>Try to narrow down your search criteria by providing more generalized keywords.</p><p><strong>Related keywords could include:</strong> Technology, programming, training, software development, etc.</p>', 'textdomain' ),
		'priority' => 8,
	);
	
	//radio fields
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableTooltip',
		'label'    => __( 'ToolTip', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => 'on',
		'priority' => 9,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'colorSampler',
		'label'    => __( 'Theme Sampler', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => 'off',
		'priority' => 10,
		'choices'  => array(
			'on' => __( 'ON', 'textdomain' ),
			'off' => __( 'OFF', 'textdomain' ),
		),
	);
	
	//colors
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'primaryColor',
		'label'    => __( 'Primary Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#ef5438',
		'priority' => 11,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'secondaryColor',
		'label'    => __( 'Seconday Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#44619d',
		'priority' => 12,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'dividerColor',
		'label'    => __( 'Divider Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#efefef',
		'priority' => 13,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'tooltipColor',
		'label'    => __( 'ToolTip Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#333333',
		'priority' => 14,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'blockQuoteColor',
		'label'    => __( 'Block Quote Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#ef5438',
		'priority' => 15,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'commentBoxColor',
		'label'    => __( 'Comment Box Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#FFFFFF',
		'priority' => 16,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'isotopeMenuBackground',
		'label'    => __( 'Isotope Menu Background Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#efefef',
		'priority' => 17,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'postMetaIconColor',
		'label'    => __( 'Post Meta Icon Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#ab8c6a',
		'priority' => 18,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'mobileMenuColor',
		'label'    => __( 'Mobile Menu Color', 'textdomain' ),
		'section'  => 'global_options',
		'default'  => '#000000',
		'priority' => 19,
	);
	
	
	//BUSINESS INFO
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'businessPhone',
		'label'    => __( 'Business Number', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( '1-(800)-555-5555', 'textdomain' ),
		'priority' => 1,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'businessAddress',
		'label'    => __( 'Business Address', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( '4 Main Street, New York, NY 02489', 'textdomain' ),
		'priority' => 2,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'businessEmail',
		'label'    => __( 'Email Address', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'info@vienna.com', 'textdomain' ),
		'priority' => 3,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'facebooklink',
		'label'    => __( 'Facebook URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.facebook.com', 'textdomain' ),
		'priority' => 4,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'twitterlink',
		'label'    => __( 'Twitter URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.twitter.com', 'textdomain' ),
		'priority' => 5,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'googlelink',
		'label'    => __( 'Google Plus URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.googleplus.com', 'textdomain' ),
		'priority' => 6,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'linkedinLink',
		'label'    => __( 'Linkedin URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.linkedin.com', 'textdomain' ),
		'priority' => 7,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'vimeolink',
		'label'    => __( 'Vimeo URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.vimeo.com', 'textdomain' ),
		'priority' => 8,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'youtubelink',
		'label'    => __( 'YouTube URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.youtube.com', 'textdomain' ),
		'priority' => 9,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'dribbblelink',
		'label'    => __( 'Dribbble URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.dribbble.com', 'textdomain' ),
		'priority' => 10,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'pinterestlink',
		'label'    => __( 'Pinterest URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.pinterest.com', 'textdomain' ),
		'priority' => 11,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'instagramlink',
		'label'    => __( 'Instagram URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.instagram.com', 'textdomain' ),
		'priority' => 12,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'behancelink',
		'label'    => __( 'Behance URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.behance.com', 'textdomain' ),
		'priority' => 13,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'skypelink',
		'label'    => __( 'Skype Name', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'skype:username?call', 'textdomain' ),
		'priority' => 14,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'flickrlink',
		'label'    => __( 'Flickr URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.flickr.com', 'textdomain' ),
		'priority' => 15,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'tumblrlink',
		'label'    => __( 'Tumblr URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.tumblrlink.com', 'textdomain' ),
		'priority' => 16,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'redditlink',
		'label'    => __( 'Reddit URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.reddit.com', 'textdomain' ),
		'priority' => 17,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'digglink',
		'label'    => __( 'Digg URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.digg.com', 'textdomain' ),
		'priority' => 18,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'deliciouslink',
		'label'    => __( 'Delicious URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.delicious.com', 'textdomain' ),
		'priority' => 19,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'stumbleuponlink',
		'label'    => __( 'Stumbleupon URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( 'http://www.stumbleupon.com', 'textdomain' ),
		'priority' => 20,
	);
	
	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'rssLink',
		'label'    => __( 'RSS URL', 'textdomain' ),
		'section'  => 'business_info',
		'default'  => __( '/rss', 'textdomain' ),
		'priority' => 21,
	);
	
	//WOOCOMMERCE OPTIONS
	$controls[] = array(
		'type'     => 'select',
		'setting'  => 'products_per_page',
		'label'    => __( 'Products Per Page', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => '8',
		'priority' => 1,
		'choices'  => array(
			'4' => __( '4', 'textdomain' ),
			'8' => __( '8', 'textdomain' ),
			'12' => __( '12', 'textdomain' ),
			'16' => __( '16', 'textdomain' ),
			'20' => __( '20', 'textdomain' ),
			'24' => __( '24', 'textdomain' ),
			'28' => __( '28', 'textdomain' ),
			'32' => __( '32', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'select',
		'setting'  => 'hideShopPrices',
		'label'    => __( 'Hide Prices on Shop page?', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => 'no',
		'priority' => 2,
		'choices'  => array(
			'no' => __( 'NO', 'textdomain' ),
			'yes' => __( 'YES', 'textdomain' ),
		),
	);
	
	//uploads
	$controls[] = array(
		'type'     => 'upload',
		'setting'  => 'wooCategoryHeaderImage',
		'label'    => __( 'Category/Tag Page Header Image', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => '',
		'priority' => 3,
	);
	
	//colors
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'product_image_bg_color',
		'label'    => __( 'Product image background color', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => '#EDEDED',
		'priority' => 4,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'sale_box_color',
		'label'    => __( 'Sale / Cart box color', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => '#8ab079',
		'priority' => 5,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'tabs_background',
		'label'    => __( 'Tab system background color', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => '#f7f7f7',
		'priority' => 6,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'form_background',
		'label'    => __( 'Checkout Form background color', 'textdomain' ),
		'section'  => 'woo_options',
		'default'  => '#f4f4f4',
		'priority' => 7,
	);
	
	//PULSE SLIDER OPTIONS
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enablePulseSlider',
		'label'    => __( 'Enable Pulse Slider?', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'yes',
		'priority' => 1,
		'choices'  => array(
			'yes' => __( 'YES', 'textdomain' ),
			'no' => __( 'NO', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableSlideShow',
		'label'    => __( 'Enable SlideShow?', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'true',
		'priority' => 2,
		'choices'  => array(
			'true' => __( 'YES', 'textdomain' ),
			'false' => __( 'NO', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'slideLoop',
		'label'    => __( 'Loop Slides?', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'true',
		'priority' => 3,
		'choices'  => array(
			'true' => __( 'YES', 'textdomain' ),
			'false' => __( 'NO', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'enableControlNav',
		'label'    => __( 'Enable Bullets?', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'true',
		'priority' => 4,
		'choices'  => array(
			'true' => __( 'YES', 'textdomain' ),
			'false' => __( 'NO', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'pauseOnHover',
		'label'    => __( 'Pause on hover?', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'true',
		'priority' => 5,
		'choices'  => array(
			'true' => __( 'YES', 'textdomain' ),
			'false' => __( 'NO', 'textdomain' ),
		),
	);
	
	$controls[] = array(
		'type'     => 'radio',
		'mode'     => 'radio',
		'setting'  => 'showArrows',
		'label'    => __( 'Show slide arrows?', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'true',
		'priority' => 6,
		'choices'  => array(
			'true' => __( 'YES', 'textdomain' ),
			'false' => __( 'NO', 'textdomain' ),
		),
	);
	
	
	//select fields
	$controls[] = array(
		'type'     => 'select',
		'setting'  => 'animtionType',
		'label'    => __( 'Animation Type', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => 'fade',
		'priority' => 7,
		'choices'  => array(
			'fade' => __( 'Fade', 'textdomain' ),
			'slide' => __( 'Slide', 'textdomain' ),
		),
	);
	
	
	//sliders
	$controls[] = array(
		'type'     => 'slider',
		'setting'  => 'slideShowSpeed',
		'label'    => __( 'SlideShow Speed', 'pulsartheme' ),
		'section'  => 'pulseslider_options',
		'default'  => 8000,
		'priority' => 8,
		'choices'  => array(
			'min'  => 1000,
			'max'  => 20000,
			'step' => 3,
		),
	);
	
	$controls[] = array(
		'type'     => 'slider',
		'setting'  => 'slideSpeed',
		'label'    => __( 'Slide Speed', 'pulsartheme' ),
		'section'  => 'pulseslider_options',
		'default'  => 500,
		'priority' => 9,
		'choices'  => array(
			'min'  => 500,
			'max'  => 20000,
			'step' => 2,
		),
	);
	
	$controls[] = array(
		'type'     => 'slider',
		'setting'  => 'sliderHeight',
		'label'    => __( 'Slider Height', 'pulsartheme' ),
		'section'  => 'pulseslider_options',
		'default'  => 800,
		'priority' => 10,
		'choices'  => array(
			'min'  => 100,
			'max'  => 1000,
			'step' => 2,
		),
	);
	
	$controls[] = array(
		'type'     => 'slider',
		'setting'  => 'sliderHeightMobile',
		'label'    => __( 'Slider Height (Mobile)', 'pulsartheme' ),
		'section'  => 'pulseslider_options',
		'default'  => 600,
		'priority' => 11,
		'choices'  => array(
			'min'  => 100,
			'max'  => 1000,
			'step' => 2,
		),
	);
	
	//colors
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'textBackgroundColor',
		'label'    => __( 'Text background color', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => '#000000',
		'priority' => 12,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'buttonColor',
		'label'    => __( 'Button color', 'textdomain' ),
		'section'  => 'pulseslider_options',
		'default'  => '#ef5438',
		'priority' => 13,
	);
		
	//SHORTCODE OPTIONS
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'quote_box_color',
		'label'    => __( 'Quote box color', 'textdomain' ),
		'section'  => 'shortcode_options',
		'default'  => '#ffece8',
		'priority' => 1,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'fancy_title_border',
		'label'    => __( 'Fancy Title border color', 'textdomain' ),
		'section'  => 'shortcode_options',
		'default'  => '#dddddd',
		'priority' => 2,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'testimonial_widget_color',
		'label'    => __( 'Testimonial Widget Background color', 'textdomain' ),
		'section'  => 'shortcode_options',
		'default'  => '#f2f2f2',
		'priority' => 3,
	);
	
	//ALERT OPTIONS
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'alert_success_color',
		'label'    => __( 'Success Color', 'textdomain' ),
		'section'  => 'alert_options',
		'default'  => '#2c5e83',
		'priority' => 1,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'alert_info_color',
		'label'    => __( 'Info Color', 'textdomain' ),
		'section'  => 'alert_options',
		'default'  => '#cbb35e',
		'priority' => 2,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'alert_warning_color',
		'label'    => __( 'Warning Color', 'textdomain' ),
		'section'  => 'alert_options',
		'default'  => '#ea6872',
		'priority' => 3,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'alert_danger_color',
		'label'    => __( 'Danger Color', 'textdomain' ),
		'section'  => 'alert_options',
		'default'  => '#5f3048',
		'priority' => 4,
	);
	
	$controls[] = array(
		'type'     => 'color',
		'setting'  => 'alert_notice_color',
		'label'    => __( 'Notice Color', 'textdomain' ),
		'section'  => 'alert_options',
		'default'  => '#49c592',
		'priority' => 5,
	);
	
	
	
	
	//Return all controls
	return $controls;
	
}


function pm_ln_customizer_config() {
	$args = array(
		// Change the logo image. (URL)
		// If omitted, the default theme info will be displayed.
		// A good size for the logo is 250x50.
		//'logo_image' => get_template_directory_uri() . '/assets/img/logo.png',
		// The color of active menu items, help bullets etc.
		'color_active' => '#2BA8FF',
		// Color used for secondary elements and desable/inactive controls
		'color_light' => '#ffffff',
		// Color used for button-set controls and other elements
		'color_select' => '#34495e',
		// Color used on slider controls and image selects
		'color_accent' => '#FF5740',
		// The generic background color.
		// You should choose a dark color here as we're using white for the text color.
		'color_back' => '#222',
		// If Kirki is embedded in your theme, then you can use this line to specify its location.
		// This will be used to properly enqueue the necessary stylesheets and scripts.
		// If you are using kirki as a plugin then please delete this line.
		'url_path' => get_template_directory_uri() . '/kirki/',
		// If you want to take advantage of the backround control's 'output',
		// then you'll have to specify the ID of your stylesheet here.
		// The "ID" of your stylesheet is its "handle" on the wp_enqueue_style() function.
		// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
		'stylesheet_id' => 'pulsar-style',
	);
	return $args;
} 

add_action( 'customize_register', 'pm_ln_customizer_sections' );
add_filter( 'kirki/controls', 'pm_ln_customizer_settings' ); 
add_filter( 'kirki/config', 'pm_ln_customizer_config' );