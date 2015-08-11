<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		
		/**** Twitter API Options ****/
		 
		$wp_customize->add_section( 'api_details' , array(
			'title'    => __( 'Twitter API Details', 'viennatheme' ),
			'priority' => 10,
		));
		
		//Settings
		$wp_customize->add_setting( 'twitter_consumer_key' );
		$wp_customize->add_setting( 'twitter_consumer_secret' );
		$wp_customize->add_setting( 'twitter_access_token' );
		$wp_customize->add_setting( 'twitter_access_token_secret' );
		$wp_customize->add_setting( 'google_api_key' );

		//Controls
		$wp_customize->add_control(
			'twitter_consumer_key',
			 array(
				'label' => __( 'Consumer Key', 'viennatheme' ),
			 	'section' => 'api_details',
				'priority' => 10,
			 )
		);
		$wp_customize->add_control(
			'twitter_consumer_secret',
			 array(
				'label' => __( 'Consumer Secret', 'viennatheme' ),
			 	'section' => 'api_details',
				'priority' => 20,
			 )
		);
		$wp_customize->add_control(
			'twitter_access_token',
			 array(
				'label' => __( 'Access Token', 'viennatheme' ),
			 	'section' => 'api_details',
				'priority' => 30,
			 )
		);
		$wp_customize->add_control(
			'twitter_access_token_secret',
			 array(
				'label' => __( 'Access Token Secret', 'viennatheme' ),
			 	'section' => 'api_details',
				'priority' => 40,
			 )
		);
		 
		
		/**** Header Options ****/
		$wp_customize->add_section( 'header_options' , array(
			'title'    => __( 'Header Options', 'viennatheme' ),
			'priority' => 20,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableParallax', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('enableParallax', array(
			'label'      => __('Enable sub-header parallax?', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'enableParallax',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayLogo', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('displayLogo', array(
			'label'      => __('Display Company Logo?', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'displayLogo',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayLogoMobile', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('displayLogoMobile', array(
			'label'      => __('Display Company Logo on mobile?', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'displayLogoMobile',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		
		$wp_customize->add_setting('enableStickyNav', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('enableStickyNav', array(
			'label'      => __('Sticky Navigation', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'enableStickyNav',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
					
		$wp_customize->add_setting('enableBreadCrumbs', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('enableBreadCrumbs', array(
			'label'      => __('Breadcrumbs', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'enableBreadCrumbs',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		
		$wp_customize->add_setting('enableSearch', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('enableSearch', array(
			'label'      => __('Enable Search?', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSearch',
			'priority' => 11,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableActionButton', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('enableActionButton', array(
			'label'      => __('Enable Action button?', 'viennatheme'),
			'section'    => 'header_options',
			'settings'   => 'enableActionButton',
			'priority' => 12,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		//Slider
		$wp_customize->add_setting(
			'dropMenuOpacity', array(
				'default' => 80
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'dropMenuOpacity', 
				array(
					'label'   => __( 'Drop Menu Opacity', 'viennatheme' ),
					'section' => 'header_options',
					'settings'   => 'dropMenuOpacity',
					'priority' => 20,
					'choices'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'headerPadding', array(
				'default' => 40
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'headerPadding', 
				array(
					'label'   => __( 'Header Padding', 'viennatheme' ),
					'section' => 'header_options',
					'settings'   => 'headerPadding',
					'priority' => 21,
					'choices'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'headerHeight', array(
				'default' => 170
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'headerHeight', 
				array(
					'label'   => __( 'Header Height', 'viennatheme' ),
					'section' => 'header_options',
					'settings'   => 'headerHeight',
					'priority' => 22,
					'choices'  => array(
						'min'  => 50,
						'max'  => 300,
						'step' => 2,
					),
				) 
			) 
		);
		
		//Textfields
		$wp_customize->add_setting(
			'searchFieldText', array(
				'default' => __( 'Type Keywords...', 'viennatheme' )
			)
		);

		$wp_customize->add_control(
			'searchFieldText',
			 array(
				'label' => __( 'Search field text', 'viennatheme' ),
			 	'section' => 'header_options',
				'priority' => 90,
			 )
		);
		
		$wp_customize->add_setting(
			'actionBtnText', array(
				'default' => __( 'Book an Event', 'viennatheme' )
			)
		);

		$wp_customize->add_control(
			'actionBtnText',
			 array(
				'label' => __( 'Action button text', 'viennatheme' ),
			 	'section' => 'header_options',
				'priority' => 100,
			 )
		);
		
		$wp_customize->add_setting(
			'actionBtnURL', array(
				'default' => __( '#', 'viennatheme' )
			)
		);

		$wp_customize->add_control(
			'actionBtnURL',
			 array(
				'label' => __( 'Action button URL', 'viennatheme' ),
			 	'section' => 'header_options',
				'priority' => 110,
			 )
		);
		
		$wp_customize->add_setting(
			'actionBtnIcon', array(
				'default' => __( 'fa fa-calendar', 'viennatheme' )
			)
		);

		$wp_customize->add_control(
			'actionBtnIcon',
			 array(
				'label' => __( 'Action button icon', 'viennatheme' ),
			 	'section' => 'header_options',
				'priority' => 120,
			 )
		);
		
		$wp_customize->add_setting(
			'companyLogoURL', array(
				'default' => ""
			)
		);

		$wp_customize->add_control(
			'companyLogoURL',
			 array(
				'label' => __( 'Company Logo URL', 'viennatheme' ),
			 	'section' => 'header_options',
				'priority' => 130,
			 )
		);	
		
		$wp_customize->add_setting(
			'companyLogoAltTag', array(
				'default' => "Vienna Restaurant"
			)
		);

		$wp_customize->add_control(
			'companyLogoAltTag',
			 array(
				'label' => __( 'Company Logo ALT tag', 'viennatheme' ),
			 	'section' => 'header_options',
				'priority' => 140,
			 )
		);
		
		$wp_customize->add_setting(
			'menuSeperator', array(
				'default' => '\f069'
			)
		);
				
		$wp_customize->add_control( 'menuSeperator', array(
			'label'   => __('Menu Seperator', 'viennatheme'),
			'section' => 'header_options',
			'settings' => 'menuSeperator',
			'priority' => 150,
			'type'    => 'text',
		) );
		
		//Upload Options
		$wp_customize->add_setting( 'companyLogo' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'companyLogo', 
			array(
				'label'    => __( 'Company Logo', 'viennatheme' ),
				'section'  => 'header_options',
				'settings' => 'companyLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => __( 'Global Header Image', 'viennatheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'dropMenuIndicator' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'dropMenuIndicator', 
			array(
				'label'    => __( 'Drop Menu Indicator', 'viennatheme' ),
				'section'  => 'header_options',
				'settings' => 'dropMenuIndicator',
				'priority' => 3,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'mainMenuBackgroundImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'mainMenuBackgroundImage', 
			array(
				'label'    => __( 'Main Menu Background Image', 'viennatheme' ),
				'section'  => 'header_options',
				'settings' => 'mainMenuBackgroundImage',
				'priority' => 4,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'subMenuBackgroundImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'subMenuBackgroundImage', 
			array(
				'label'    => __( 'Sub Menu Background Image', 'viennatheme' ),
				'section'  => 'header_options',
				'settings' => 'subMenuBackgroundImage',
				'priority' => 5,
				) 
			) 
		);
		
		//Header Option Colors
		$headerOptionColors = array();
		
		$headerOptionColors[] = array(
			'slug'=>'mainNavColor', 
			'default' => '#000000',
			'label' => __('Main Menu Background Color', 'viennatheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'dropMenuBackgroundColor', 
			'default' => '#000000',
			'label' => __('Drop Menu Background Color', 'viennatheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'subMenuBackgroundColor', 
			'default' => '#000000',
			'label' => __('Sub Menu Background Color', 'viennatheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'subpageHeaderBackgroundColor', 
			'default' => '#cecece',
			'label' => __('Subpage Header Background Color', 'viennatheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'pageTitleBackgroundColor', 
			'default' => '#000000',
			'label' => __('Page Title Background Color', 'viennatheme')
		);
		$headerOptionColors[] = array(
			'slug'=>'navButtonColor', 
			'default' => '#f6f6f6',
			'label' => __('Navigation button Color', 'viennatheme')
		);
		
		
		$priority_counter = 13;
		
		foreach( $headerOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
						'label' => $color['label'], 
						'section' => 'header_options',
						'settings' => $color['slug'],
						'priority' => $priority_counter,
					)
				)
			);
			
			$priority_counter++;
			
		}//end of foreach
		
		
			
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => __( 'Layout Options', 'viennatheme' ),
			'priority' => 60,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableBoxMode',  array(
			'default' => 'off'
		));
		
		$wp_customize->add_control('enableBoxMode', array(
			'label'      => __('1170 Boxed Mode', 'viennatheme'),
			'section'    => 'layout_options',
			'settings'   => 'enableBoxMode',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		
		
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'no-sidebar'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => __( 'Homepage Layout', 'viennatheme' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		$wp_customize->add_setting(
			'universalLayout', array(
				'default' => 'no-sidebar'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'universalLayout', 
				array(
					'label'   => __( 'Universal Layout (Tag - Archive - Category)', 'viennatheme' ),
					'section' => 'layout_options',
					'settings'   => 'universalLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => __( 'Footer Layout', 'viennatheme' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'footer-one-column' => get_template_directory_uri() . '/css/img/layouts/footer-one-column.png',
						'footer-two-columns' => get_template_directory_uri() . '/css/img/layouts/footer-two-columns.png',
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
	
		
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => __( 'Footer Options', 'viennatheme' ),
			'priority' => 70,
			'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize the footer area of the theme.', 'viennatheme'), //Descriptive tooltip
		));
			
		//Radio Options
		$wp_customize->add_setting('toggle_fatfooter', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('toggle_fatfooter', array(
			'label'      => __('Fat Footer', 'viennatheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_fatfooter',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggle_socialFooter', 
			array(
				'default' => 'on',
				'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            	'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            	//'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);
		
		$wp_customize->add_control('toggle_socialFooter', array(
			'label'      => __('Social Footer', 'viennatheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_socialFooter',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggle_footerNav', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('toggle_footerNav', array(
			'label'      => __('Main Footer', 'viennatheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerNav',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
				
		
		//Textfields
		$wp_customize->add_setting(
			'socialMediaCTA', array(
				'default' => '<h6>Join the conversation</h6>'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( 
			$wp_customize, 'socialMediaCTA', array(
				'label'   => __( 'Social Media Call To Action', 'viennatheme' ),
				'section' => 'footer_options',
				'settings'   => 'socialMediaCTA',
			) ) 
		);
		
		$wp_customize->add_setting(
			'newsletterCTA', array(
				'default' => '<h6>Subscribe to our newsletter</h6>'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( 
			$wp_customize, 'newsletterCTA', array(
				'label'   => __( 'Newsletter Call To Action', 'viennatheme' ),
				'section' => 'footer_options',
				'settings'   => 'newsletterCTA',
			) ) 
		);
			
		
		$wp_customize->add_setting(
			'returnToTopIcon', array(
				'default' => '\f077'
			)
		);
				
		$wp_customize->add_control( 'returnToTopIcon', array(
			'label'   => __('Return To Top Icon', 'viennatheme'),
			'section' => 'footer_options',
			'settings' => 'returnToTopIcon',
			'priority' => 80,
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting(
			'copyrightNotice', array(
				'default' => '© 2014 Vienna. Produced by <a target="_blank" href="http://www.pulsarmedia.ca">Pulsar Media</a>'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( $wp_customize, 'copyrightNotice', array(
			'label'   => __( 'Copyright Notice', 'viennatheme' ),
			'section' => 'footer_options',
			'settings'   => 'copyrightNotice',
		) ) );
		
		$wp_customize->add_setting(
			'mailchimpAddress', array(
				'default' => 'http://pulsarmedia.us4.list-manage2.com/subscribe?u=2aa9334fc1bc18c8d05500b41&id=dbcb577c4d'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( $wp_customize, 'mailchimpAddress', array(
			'label'   => __( 'Mailchimp Subscribe URL', 'viennatheme' ),
			'section' => 'footer_options',
			'settings'   => 'mailchimpAddress',
		) ) );
		
		//Images	
		$wp_customize->add_setting( 'fatFooterBackgroundImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => __( 'Fat Footer Background Image', 'viennatheme' ),
				'section'  => 'footer_options',
				'priority'  => 1,
				'settings' => 'fatFooterBackgroundImage',
				) 
			) 
		);
		
		$wp_customize->add_setting( 'footerBackgroundImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerBackgroundImage', 
			array(
				'label'    => __( 'Footer Background Image', 'viennatheme' ),
				'section'  => 'footer_options',
				'priority'  => 2,
				'settings' => 'footerBackgroundImage',
				) 
			) 
		);
		
		$FooterColors = array();
	
		$FooterColors[] = array(
			'slug'=>'newsletterFieldColor', 
			'default' => '#2d2d2d',
			'label' => __('Newsletter Field Color', 'viennatheme')
		);
		$FooterColors[] = array(
			'slug'=>'footerWidgetTitleColor', 
			'default' => '#ffffff',
			'label' => __('Footer Widget Title Color', 'viennatheme')
		);
		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#2D2D2D',
			'label' => __('Fat Footer Background Color', 'viennatheme')
		);
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#2D2D2D',
			'label' => __('Footer Background Color', 'viennatheme')
		);
		$FooterColors[] = array(
			'slug'=>'subFooterBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => __('Sub Footer Background Color', 'viennatheme')
		);
		
		foreach( $FooterColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'footer_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		/**** Global Options ****/
		
		$wp_customize->add_section( 'global_options' , array(
			'title'    => __( 'Global Options', 'viennatheme' ),
			'priority' => 80,
		));
		
		$wp_customize->add_setting( 'pageBackgroundImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => __( 'Background image', 'viennatheme' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
				
		$wp_customize->add_setting(
			'searchErrorMessage', array(
				'default' => '<p>Try to narrow down your search criteria by providing more generalized keywords.</p><p><strong>Related keywords could include:</strong> Technology, programming, training, software development, etc.</p>'
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( $wp_customize, 'searchErrorMessage', array(
			'label'   => __( 'Invalid Search Message', 'viennatheme' ),
			'section' => 'global_options',
			'settings'   => 'searchErrorMessage',
		) ) );
		
		
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#ef5438',
			'label' => __('Primary Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#44619d',
			'label' => __('Secondary Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#ffffff',
			'label' => __('Background Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'dividerColor', 
			'default' => '#efefef',
			'label' => __('Divider/Border Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#333333',
			'label' => __('ToolTip Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'blockQuoteColor', 
			'default' => '#ef5438',
			'label' => __('Blockquote Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'commentBoxColor',  //.pm-single-blog-post-author-box
			'default' => '#FFFFFF',
			'label' => __('Comment Box Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'isotopeMenuBackground',  //.pm-single-blog-post-author-box-share
			'default' => '#efefef',
			'label' => __('Isotope Menu Background Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'postMetaIconColor',  //.pm-single-blog-post-author-box-share
			'default' => '#ab8c6a',
			'label' => __('Post Meta Icon Color', 'viennatheme')
		);
		$GlobalColors[] = array(
			'slug'=>'mobileMenuColor',  //.pm-single-blog-post-author-box-share
			'default' => '#000000',
			'label' => __('Mobile Menu Color', 'viennatheme')
		);
		
		$priority = 0;
		
		foreach( $GlobalColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'global_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach
		
		//Radio Options
		$wp_customize->add_setting('enableTooltip', array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('enableTooltip', array(
			'label'      => __('ToolTip', 'viennatheme'),
			'section'    => 'global_options',
			'settings'   => 'enableTooltip',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('colorSampler',  array(
			'default' => 'on'
		));
		
		$wp_customize->add_control('colorSampler', array(
			'label'      => __('Theme Sampler', 'viennatheme'),
			'section'    => 'global_options',
			'settings'   => 'colorSampler',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'no-repeat'
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => __('Repeat Background', 'viennatheme'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
				'no-repeat'   => 'No Repeat',
			),
		));
		
				
		/**** Business Info ****/
		
		$wp_customize->add_section( 'business_info' , array(
			'title'    => __( 'Business Info', 'viennatheme' ),
			'priority' => 100,
		));
		
		//Textfields
		$wp_customize->add_setting(
			'businessPhone', array(
				'default' => '1 -(800)-555-5555'
			)
		);
				
		$wp_customize->add_control( 'businessPhone', array(
			'label'   => __( 'Business Number', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'businessPhone',
			'type'    => 'text',
		) );
		
		
		$wp_customize->add_setting(
			'businessAddress', array(
				'default' => '4 Main Street, New York, NY 02489'
			)
		);
				
		$wp_customize->add_control( 'businessAddress', array(
			'label'   => __( 'Business Address', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'businessAddress',
			'type'    => 'text',
		) );

		
		$wp_customize->add_setting(
			'businessEmail', array(
				'default' => 'info@vienna.com'
			)
		);
				
		$wp_customize->add_control( 'businessEmail', array(
			'label'   => __( 'Email Address', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'businessEmail',
			'type'    => 'text',
		) );
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => 'http://www.facebook.com'
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => __( 'Facebook URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => 'http://www.twitter.com'
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => __( 'Twitter URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'type'    => 'text',
		) );
		
		//G Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => 'http://www.googleplus.com'
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => __( 'Google Plus URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => 'http://www.linkedin.com'
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => __( 'Linkedin URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => 'http://www.vimeo.com'
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => __( 'Vimeo URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => 'http://www.youtube.com'
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => __( 'YouTube URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => 'http://www.dribbble.com'
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => __( 'Dribbble URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => 'http://www.pinterest.com'
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => __( 'Pinterest URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => 'http://www.instagram.com'
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => __( 'Instagram URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'type'    => 'text',
		) );
		
		//Behance Icon
		$wp_customize->add_setting(
			'behancelink', array(
				'default' => 'http://www.behance.com'
			)
		);
				
		$wp_customize->add_control( 'behancelink', array(
			'label'   => __( 'Behance URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'behancelink',
			'type'    => 'text',
		) );
		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => 'http://www.skype.com'
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => __( 'Skype Name', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => 'http://www.flickr.com'
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => __( 'Flickr URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'type'    => 'text',
		) );
		
		//Tumblr Icon
		$wp_customize->add_setting(
			'tumblrlink', array(
				'default' => 'http://www.tumblr.com'
			)
		);
				
		$wp_customize->add_control( 'tumblrlink', array(
			'label'   => __( 'Tumblr URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'tumblrlink',
			'type'    => 'text',
		) );
		
		//Reddit Icon
		$wp_customize->add_setting(
			'redditlink', array(
				'default' => 'http://www.reddit.com'
			)
		);
				
		$wp_customize->add_control( 'redditlink', array(
			'label'   => __( 'Reddit URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'redditlink',
			'type'    => 'text',
		) );
		
		//Digg Icon
		$wp_customize->add_setting(
			'digglink', array(
				'default' => 'http://www.digg.com'
			)
		);
				
		$wp_customize->add_control( 'digglink', array(
			'label'   => __( 'Digg URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'digglink',
			'type'    => 'text',
		) );
		
		//Delicious Icon
		$wp_customize->add_setting(
			'deliciouslink', array(
				'default' => 'http://www.delicious.com'
			)
		);
				
		$wp_customize->add_control( 'deliciouslink', array(
			'label'   => __( 'Delicious URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'deliciouslink',
			'type'    => 'text',
		) );
		
		//Stumbleupon Icon
		$wp_customize->add_setting(
			'stumbleuponlink', array(
				'default' => 'http://www.stumbleupon.com'
			)
		);
				
		$wp_customize->add_control( 'stumbleuponlink', array(
			'label'   => __( 'Stumbleupon URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'stumbleuponlink',
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '/rss'
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => __( 'RSS URL', 'viennatheme' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'type'    => 'text',
		) );
		
		/**** Woocommerce Options ****/
		 
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => __( 'Woocommerce Options', 'viennatheme' ),
			'priority' => 110,
		));
		
		$wp_customize->add_setting('products_per_page',
			array(
				'default' => '8',
			)
		);
		
		$wp_customize->add_control('products_per_page',
			array(
				'type' => 'select',
				'label' => __( 'Products Per Page', 'viennatheme' ),
				'section' => 'woo_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'20' => '20',
					'24' => '24',
					'28' => '28',
					'32' => '32',
				),
			)
		);
		
		$wp_customize->add_setting('hideShopPrices', array(
			'default' => 'no'
		));
		
		$wp_customize->add_control('hideShopPrices', array(
			'label'      => __('Hide Prices on Shop page?', 'viennatheme'),
			'section'    => 'woo_options',
			'settings'   => 'hideShopPrices',
			'type'       => 'radio',
			'choices'    => array(
				'yes'   => 'YES',
				'no'  => 'NO',
			),
		));		
		
		//Upload Options
		$wp_customize->add_setting( 'wooCategoryHeaderImage' );
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => __( 'Category/Tag Page Header Image', 'viennatheme' ),
				'section'  => 'woo_options',
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);
		
		$woocommColors = array();
		
		$woocommColors[] = array(
			'slug'=>'product_image_bg_color', 
			'default' => '#EDEDED',
			'label' => __('Product image background color', 'viennatheme'),
		);
		
		$woocommColors[] = array(
			'slug'=>'sale_box_color', 
			'default' => '#8ab079',
			'label' => __('Sale / Cart box color', 'viennatheme'),
		);
		
		$woocommColors[] = array(
			'slug'=>'tabs_background', 
			'default' => '#f7f7f7',
			'label' => __('Tab system background color', 'viennatheme'),
		);
		
		$woocommColors[] = array(
			'slug'=>'form_background', 
			'default' => '#f4f4f4',
			'label' => __('Checkout Form background color', 'viennatheme'),
		);
		
		
		foreach( $woocommColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'woo_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}//end of foreach
		
		
		/**** Pulse Slider Options ****/
		$wp_customize->add_section( 'presentation_options' , array(
			'title'    => __( 'Pulse Slider Options', 'viennatheme' ),
		));
		
		
		
		$wp_customize->add_setting('enablePulseSlider', array(
			'default' => 'yes'
		));
		
		$wp_customize->add_control('enablePulseSlider', array(
			'label'      => __('Enable Pulse Slider?', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'enablePulseSlider',
			'type'       => 'radio',
			'choices'    => array(
				'yes'   => 'ON',
				'no'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableSlideShow', array(
			'default' => 'true'
		));
		
		$wp_customize->add_control('enableSlideShow', array(
			'label'      => __('Enable SlideShow?', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'enableSlideShow',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('slideLoop', array(
			'default' => 'true'
		));
		
		$wp_customize->add_control('slideLoop', array(
			'label'      => __('Loop Slides?', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'slideLoop',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('enableControlNav', array(
			'default' => 'true'
		));
		
		$wp_customize->add_control('enableControlNav', array(
			'label'      => __('Enable Bullets?', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'enableControlNav',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('pauseOnHover', array(
			'default' => 'true'
		));
		
		$wp_customize->add_control('pauseOnHover', array(
			'label'      => __('Pause on hover?', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'pauseOnHover',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('showArrows', array(
			'default' => 'true'
		));
		
		$wp_customize->add_control('showArrows', array(
			'label'      => __('Display arrows?', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'showArrows',
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));

		$wp_customize->add_setting('animtionType', array(
			'default' => 'fade'
		));
		
		$wp_customize->add_control('animtionType', array(
			'label'      => __('Animation Type', 'viennatheme'),
			'section'    => 'presentation_options',
			'settings'   => 'animtionType',
			'type'       => 'radio',
			'choices'    => array(
				'fade'   => 'Fade',
				'slide'  => 'Slide',
			),
		));

		
		
		$wp_customize->add_setting(
			'slideShowSpeed', array(
				'default' => 8000
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'slideShowSpeed', 
				array(
					'label'   => __( 'Slide Show Speed', 'viennatheme' ),
					'section' => 'presentation_options',
					'settings'   => 'slideShowSpeed',
					'choices'  => array(
						'min'  => 1000,
						'max'  => 10000,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'slideSpeed', array(
				'default' => 500
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'slideSpeed', 
				array(
					'label'   => __( 'Slide Speed', 'viennatheme' ),
					'section' => 'presentation_options',
					'settings'   => 'slideSpeed',
					'choices'  => array(
						'min'  => 500,
						'max'  => 1000,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'sliderHeight', array(
				'default' => 800
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'sliderHeight', 
				array(
					'label'   => __( 'Slider Height', 'viennatheme' ),
					'section' => 'presentation_options',
					'settings'   => 'sliderHeight',
					'choices'  => array(
						'min'  => 300,
						'max'  => 1000,
						'step' => 2,
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'sliderHeightMobile', array(
				'default' => 600
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'sliderHeightMobile', 
				array(
					'label'   => __( 'Slider Height (Mobile)', 'viennatheme' ),
					'section' => 'presentation_options',
					'settings'   => 'sliderHeightMobile',
					'choices'  => array(
						'min'  => 300,
						'max'  => 1000,
						'step' => 2,
					),
				) 
			) 
		);
		
		//Slider
		$wp_customize->add_setting(
			'textBackgroundOpacity', array(
				'default' => 80
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Sliderui_Control( 
			$wp_customize, 'textBackgroundOpacity', 
				array(
					'label'   => __( 'Text background opacity', 'viennatheme' ),
					'section' => 'presentation_options',
					'settings'   => 'textBackgroundOpacity',
					'choices'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				) 
			) 
		);
		
				
		$PresentationColors = array();
		
		$PresentationColors[] = array(
			'slug'=>'textBackgroundColor', 
			'default' => '#000000',
			'label' => __('Text background color', 'viennatheme')
		);
		
		$PresentationColors[] = array(
			'slug'=>'buttonColor', 
			'default' => '#ef5438',
			'label' => __('Button color', 'viennatheme')
		);
		
		foreach( $PresentationColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'presentation_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		/**** Shortcode Options ****/
		$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => __( 'Shortcode Options', 'viennatheme' ),
		));
				
		//Shortcode Option Colors
		$shortcodeOptionColors = array();

		$shortcodeOptionColors[] = array(
			'slug'=>'quote_box_color', 
			'default' => '#ffece8',
			'label' => __('Quote box color', 'viennatheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'fancy_title_border', 
			'default' => '#dddddd',
			'label' => __('Fancy Title border color', 'viennatheme')
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'testimonial_widget_color', 
			'default' => '#f2f2f2',
			'label' => __('Testimonial Widget Background color', 'viennatheme')
		);

				
		foreach( $shortcodeOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'shortcode_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		/**** Alert Options ****/
		$wp_customize->add_section( 'alert_options' , array(
			'title'    => __( 'Alert Options', 'viennatheme' ),
		));
				
		$alertColors = array();
		
		$alertColors[] = array(
			'slug'=>'alert_success_color', 
			'default' => '#2c5e83',
			'label' => __('Success Color', 'viennatheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_info_color', 
			'default' => '#cbb35e',
			'label' => __('Info Color', 'viennatheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_warning_color', 
			'default' => '#ea6872',
			'label' => __('Warning Color', 'viennatheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_danger_color', 
			'default' => '#5f3048',
			'label' => __('Danger Color', 'viennatheme')
		);
		$alertColors[] = array(
			'slug'=>'alert_notice_color', 
			'default' => '#49c592',
			'label' => __('Notice Color', 'viennatheme')
		);
		
		$priority = 0;
		
		foreach( $alertColors as $color ) {
			
			$priority = $priority + 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'alert_options',
					'settings' => $color['slug'],
					'priority' => $priority,
					)
				)
			);
		}//end of foreach
		
		
   }//end of function
   
}//end of class


//Extend Theme Customizer with custom classes
if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
				<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
					<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
				<?php } ?>
			</span>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}


	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
						<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
					<?php } ?>
				</span>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Textarea Class
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );

?>