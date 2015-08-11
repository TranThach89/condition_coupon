<?php

/*
Plugin Name: Help Tabs
Plugin URI: http://www.pulsarmedia.ca
Description: Adds Help Tabs to Custom post types and Themes Options
Version: 1.0
Author: Leo Nanfara
Author URI: http://www.pulsarmedia.ca
*/

function page_help() {
	
	global $post_ID;
	$screen = get_current_screen();

	if( isset($_GET['post_type']) ) $post_type = $_GET['post_type'];
	else $post_type = get_post_type( $post_ID );

	if( $post_type == 'page'  || $post_type == 'post' || $post_type == 'post_careers' || $post_type == 'post_events' || $post_type == 'post_galleries' || $post_type == 'post_organizers') :
	
		//Column shortcodes
		$columnContent = '
		Use the following column shortcodes to properly format your page layout <br /><br />
		The column shortcode accepts two parameters - <b>span</b> and <b>alignment</b>. You can enter a span value of span1 up to span12 and an alignment value of left, center or right.<br /><br />
		[column span="span12"]<br />
		 Content goes here<br />
		[/column]<br /><br />
		You can also add a full screen column on the home page by wrapping a column inside a columnContainer shortcode first. The columnContainer shortcode accepts two parameters - fullscreen and bgimage.<br /><br />
		[columnContainer fullscreen="on" bgimage="your-background-image.png"]<br />
		[column span="span12"]<br />
		 Content goes here<br />
		[/column]<br />
		[/columnContainer]<br />
		<p>If you would like to add a Featured Panel on the homepage wrap your columnContainer within a featuredPanel shortcode </p>
		<p>The featuredPanel shortcode accepts one of two parameters at any given time - <b>bgcolor</b> or <b>bgimage</b></p>
		[featuredPanel bgcolor="grey"]<br />
		[columnContainer]<br />
		[column span="span12"]<br />
		 Content goes here<br />
		[/column]<br />
		[/columnContainer]<br />
		[/featuredPanel]<br />
		<hr />
		<p><b>Note:</b> The fullscreen columns and featured panels will only work correctly if Sidebars and Containers have been disabled on your page. Also, be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-column-shortcodes', //unique id for the tab
			'title' => 'Column Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $columnContent . '</p>', //actual help text
		));
		
		//Button shortcodes
		$buttonContent = '
		Use the following button shortcodes to add buttons into your posts or pages: <br /><br />
		The button shortcode accepts several parameters - <b>color</b>, <b>type</b>, <b>textcolor</b>, <b>url</b> and <b>target</b>.<br /><br />
		[button type="small" color="red" textcolor="white" url="http://www.google.com" target="_blank"]Button text goes here[/button]<br /><br />
		Available button colors (blue, red, green, purple, orange, grey, brown, black, yellow, pink, teal)
		<br />
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-button-shortcodes', //unique id for the tab
			'title' => 'Button Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $buttonContent . '</p>', //actual help text
		));
		
		//Alert shortcodes
		$alertContent = '
		Use the following alert shortcodes to add special alert messages anywhere in your post or page: <br /><br />
		The alert shortcode accepts one parameter - <b>close</b>.<br /><br />
		[alertdanger close="false"]<br />
		 Alert Danger message here<br />
		[/alertdanger]<br /><br />
		[alertinfo close="false"]<br />
		 Alert Info message here<br />
		[/alertinfo]<br /><br />
		[alertsuccess close="false"]<br />
		 Alert Success message here<br />
		[/alertsuccess]<br /><br />
		[alert close="false"]<br />
		 Alert message here<br />
		[/alert]<br /><br />
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-alert-shortcodes', //unique id for the tab
			'title' => 'Alert Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $alertContent . '</p>', //actual help text
		));
		
		//Social Icon shortcodes
		$socialContent = '
		Use the following shortcodes to add social icons or fontawesome icons anywhere in your post or page: <br /><br />
		The social icon shortcode accepts three parameters - <b>icon</b>, <b>size</b>, <b>color</b>, <b>link</b> and <b>target</b>.<br /><br />
		[socialGroup]<br />
		[socialIcon icon="facebook" size="10" color="#FFFFFF" link="http://www.facebook.com" target="_self"][/socialIcon]<br />
		[/socialGroup]<br /><br />
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-social-shortcodes', //unique id for the tab
			'title' => 'Social Icon Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $socialContent . '</p>', //actual help text
		));
		
		//Video shortcodes
		$videoContent = '
		Use the video shortcodes to add a YouTube or Vimeo video anywhere in your post or page: <br /><br />
		The video shortcode accepts four parameters - <b>id</b>, <b>width</b>, <b>height</b> and <b>responsive</b>.<br /><br />
	    <b>YouTube Shortcode</b><br />
		[youtubeVideo id="WIGIKFu03OM" width="400" height="350"][/youtubeVideo]<br /><br />
		<b>Vimeo Shortcode</b><br />
		[vimeoVideo id="WIGIKFu03OM" width="400" height="350"][/vimeoVideo]<br />
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-video-shortcodes', //unique id for the tab
			'title' => 'Video Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $videoContent . '</p>', //actual help text
		));
		
		
		//Panels and Containers
		$pmContent = '
		<p>Add a panel header anywhere in your content. The Panel header shortcode accepts the following attributes: </p>
		<p><b>icon</b>, <b>tip</b>, <b>link</b>, <b>target</b>, <b>marginbottom</b> and <b>bgcolor</b></p>
	    <p>[panelHeader tip="View a complete list of bootstrap configurations" link="#" icon="icon-cogs" marginBottom="20"]</p>
		<p> This is a panel header</p>
		<p>[/panelHeader]</p>
		<hr />
		<p>Add a single post anywhere in your content or widget. The Single Post shortcode accepts the following attributes: </p>
		<p><b>id (Post ID)</b></p>
		<p>[singlePost id="93" /]</p>
		<hr />
		<p>Add a full width column to your page. The Full Width shortcode accepts the following attributes: </p>
		<p><b>fullscreen</b> and <b>bgimage</b></p>
		<p>[columnContainer fullscreen="on" bgimage="http://wp.pulsarmedia.ca/hope/wp-content/uploads/2013/09/kids-bg.jpg"]</p>
		<p>Columns and content goes here</p>
		<p>[/columnContainer]</p>
		<hr />
		<p>Add an interactive Image to your page. The Interactive image shortcode accepts the following attributes: </p>
		<p><b>title</b>, <b>link</b>, <b>icon</b>, <b>image</b> and <b>tip</b></p>
		<p>[imagePanel title="Donate For Children" tip="Make a donation today!" link="/hope/donations" icon="icon-heart" image="http://wp.pulsarmedia.ca/hope/wp-content/uploads/2013/09/iStock_000012753707_Small1.jpg"]</p>
		<p>Content goes here</p>
		<p>[/imagePanel]</p>
		<hr />
		<p>Add a percentage bar to your page. The percentage bar shortcode accepts the following attributes: </p>
		<p><b>percentage</b></p>
		<p>[progressBar percentage="50%" /]</p>
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-panels-containers-shortcodes', //unique id for the tab
			'title' => 'Panels and Container Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $pmContent . '</p>', //actual help text
		));
		
		//Bootstrap
		$bootstrapContent = '
		<p>Use the following shortcodes to add an Accordion menu anywhere in your page:</p>
		<p>The accordionItem shortcode accepts three parameters - <b>title</b> and <b>icon</b>. </p>
		<p>[accordionGroup]</p>
		<p>[accordionItem title="Bootstrap accordion panel 1" icon="icon-github-alt"]Content goes here[/accordionItem]</p>
		<p>[accordionItem title="Bootstrap accordion panel 2" icon="icon-github-alt"]Content goes here[/accordionItem]</p>
		<p>[accordionItem title="Bootstrap accordion panel 3" icon="icon-github-alt"]Content goes here[/accordionItem]</p>
		<p>[/accordionGroup]</p>
		<hr />
		<p>Use the following shortcodes to add a Tab menu anywhere in your page:</p>
		<p>The tabItem shortcode accepts one parameter - <b>title</b></p>
		<p>[tabGroup]</p>
		<p>[tabItem title="Tab Number One"]Content goes here[/tabItem]</p>
		<p>[tabItem title="Tab Number Two"]Content goes here[/tabItem]</p>
		<p>[tabItem title="Tab Number Three"]Content goes here[/tabItem]</p>
		<p>[/tabGroup]</p>
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-bootstrap-shortcodes', //unique id for the tab
			'title' => 'Bootstrap Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $bootstrapContent . '</p>', //actual help text
		));
		
		//Content Shortcodes
		$contentShortcodes = '
		<p>Use the following shortcodes anywhere in your page or post:</p>
		<p>The callToAction shortcode can be used to add a special message in the body of your page or post</p>
		<p>[callToAction]Message goes here[/callToAction]</p>
		<hr />
		<p><b>Note:</b> Be sure to copy and paste these shortcodes in the Visual editor and not the Text editor.</p>
		';

		$screen->add_help_tab( array(
			'id' => 'pm-content-shortcodes', //unique id for the tab
			'title' => 'Content Shortcodes', //unique visible title for the tab
			'content' => '<p>' . $contentShortcodes . '</p>', //actual help text
		));

	endif;

}

add_action('admin_head', 'page_help');

/*function theme_options_help() {
	
	$screen = get_current_screen();
	
	if( isset($_GET['page']) ){
		
		if($_GET['page'] === 'ot-theme-options'){
			
			$screen->add_help_tab( array(
				'id' => 'pm-theme-options', //unique id for the tab
				'title' => 'Theme Options Help', //unique visible title for the tab
				'content' => '<p>' . __( 'Descriptive content that will show in Theme Options Tab-body goes here.' ) . '</p>', //actual help text
			));
			
		}
		
	}

}

add_action('admin_head', 'theme_options_help');


//add_action('admin_menu', 'pm_add_help_tabs');

//Add Help Tabs to custom Top Level Admin page
function pm_add_help_tabs() {
	
	global $my_support_page;
	
	//create a custom top-level menu
	$my_support_page = add_menu_page( 'Pulsar Framework Documentation', 'Theme Documentation', 'manage_options', __FILE__, 'pm_theme_documentation_page',	plugins_url( '/images/wp-icon.png', __FILE__ ) );
	
	// Adds my_help_tab when my_admin_page loads
    add_action('load-'.$my_support_page, 'my_admin_add_help_tab');
	
	//create sub-menu items
	//add_submenu_page( __FILE__, 'About My Plugin', 'About', 'manage_options', __FILE__.'_about', pm_myplugin_about_page );
	
	//create an options page under Settings tab
	//add_options_page('My API Plugin', 'My API Plugin', 'manage_options', 'pm_myplugin', 'pm_myplugin_option_page');	
}

//Draw the documentation page
function my_admin_add_help_tab(){
	
	global $my_support_page;

	// Get the current screen object
  	$screen = get_current_screen();
	
	if ( $screen->id != $my_support_page )
        return;
	
		
	// Add README Reference help screen tab
	$screen->add_help_tab( array(
		// HTML ID attribute
		'id' 	  => 'pm-readme',
		// Tab title
		'title'   => __( 'README', 'pm' ),
		// Tab content
		'content' => '<p>' . __( 'Descriptive content that will show in My Help Tab-body goes here.' ) . '</p>', //file_get_contents( get_template_directory() . '/help/readme.html' ),
	 ) );
		
	
}//end of my_admin_add_help_tab*/

?>