<?php

//News posts meta options
add_action( 'add_meta_boxes', 'add_post_metaoptions' );

//Page meta options
add_action( 'add_meta_boxes', 'add_page_metaoptions' );

//Staff meta options
add_action( 'add_meta_boxes', 'add_staff_metaoptions' );

//Event meta options
add_action( 'add_meta_boxes', 'add_event_metaoptions' );

//Gallery meta options
add_action( 'add_meta_boxes', 'add_gallery_metaoptions' );

//Menu meta options
add_action( 'add_meta_boxes', 'add_menu_metaoptions' );


//Woocommerce meta options
add_action( 'add_meta_boxes', 'add_woocommerce_metaoptions' );

//Save custom post/page data
add_action( 'save_post', 'save_postdata' );

/*** MENU META OPTIONS & FUNCTIONS *****/
function add_menu_metaoptions() {
	
	//Menu item image
	add_meta_box( 
		'pm_menu_image_meta', //ID
		'Menu item image',  //label
		'pm_menu_image_meta_function' , //function
		'post_menus', //Post type
		'normal', 
		'high' 
	);
	
	//Menu item price
	add_meta_box( 
		'pm_menu_item_price_meta', //ID
		'Menu item price - W*P*L*O*C*K*E*R*.*C*O*M',  //label
		'pm_menu_item_price_meta_function' , //function
		'post_menus', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_menu_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_menu_image_meta = get_post_meta( $post->ID, 'pm_menu_image_meta', true );
	//echo $pm_menu_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 900x400px','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_menu_image_meta; ?>" name="pm_menu_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-staff-preview"></div>
    
    <?php
	
}

function pm_menu_item_price_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_menu_item_price_meta = get_post_meta( $post->ID, 'pm_menu_item_price_meta', true );
	//echo $pm_menu_item_price_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo $pm_menu_item_price_meta; ?>" name="pm_menu_item_price_meta" class="pm-admin-text-field" />
    <?php
	
}

/*** GALLERY META OPTIONS & FUNCTIONS *****/
function add_gallery_metaoptions() {
	
	//Post layout
	add_meta_box( 
		'pm_post_layout_meta', //ID
		'Post Layout',  //label
		'pm_post_layout_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Gallery image
	add_meta_box( 
		'pm_gallery_image_meta', //ID
		'Gallery Image',  //label
		'pm_gallery_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Message
	add_meta_box( 
		'pm_gallery_item_caption_meta', //ID
		'Caption',  //label
		'pm_gallery_item_caption_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_gallery_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_header_image_meta = get_post_meta( $post->ID, 'pm_gallery_header_image_meta', true );
	//echo $post->ID . $pm_gallery_header_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 1920x500px or 1920x800px for parallax mode','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_gallery_header_image_meta; ?>" name="pm_gallery_header_image_meta" id="img-uploader-field" class="pm-admin-staff-header-upload-field" />
		<input id="upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-staff-header-image-preview"></div>
    
    <?php
	
}

function pm_gallery_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_image_meta = get_post_meta( $post->ID, 'pm_gallery_image_meta', true );
	//echo $pm_gallery_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 900x400px','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_gallery_image_meta; ?>" name="pm_gallery_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-staff-preview"></div>
    
    <?php
	
}

function pm_gallery_item_caption_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_item_caption_meta = get_post_meta( $post->ID, 'pm_gallery_item_caption_meta', true );
	//echo $pm_gallery_item_caption_meta;
		

	//HTML code
	?>
    	<p><?php _e('Enter a caption for your gallery image.','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_gallery_item_caption_meta; ?>" name="pm_gallery_item_caption_meta" class="pm-admin-text-field" />
    <?php
	
}


/*** EVENTS META OPTIONS & FUNCTIONS *****/
function add_event_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event featured image
	add_meta_box( 
		'pm_event_featured_image_meta', //ID
		'Featured Event Image',  //label
		'pm_event_featured_image_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event date
	add_meta_box( 
		'pm_event_date_meta', //ID
		'Event Date',  //label
		'pm_event_date_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Event Fan Page
	add_meta_box( 
		'pm_event_fan_page_meta', //ID
		'Event Fan Page URL',  //label
		'pm_event_fan_page_meta_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post_event', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_disable_share_feature_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_disable_share_feature = get_post_meta( $post->ID, 'pm_disable_share_feature', true );
	//echo $pm_post_layout_meta;
	
	?>
        <select id="pm_disable_share_feature" name="pm_disable_share_feature" class="pm-admin-select-list">  
            <option value="no" <?php selected( $pm_disable_share_feature, 'no' ); ?>><?php _e('No', 'viennatheme') ?></option>
            <option value="yes" <?php selected( $pm_disable_share_feature, 'yes' ); ?>><?php _e('Yes', 'viennatheme') ?></option>
        </select>
            
    <?php
	
}

function pm_event_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_header_image_meta = get_post_meta( $post->ID, 'pm_event_header_image_meta', true );
	//echo $post->ID . $pm_event_header_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 1920x500px or 1920x800px for parallax mode','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_event_header_image_meta; ?>" name="pm_event_header_image_meta" id="img-uploader-field" class="pm-admin-staff-header-upload-field" />
		<input id="upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-staff-header-image-preview"></div>
    
    <?php
	
}

function pm_event_featured_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_featured_image_meta = get_post_meta( $post->ID, 'pm_event_featured_image_meta', true );
	//echo $pm_event_featured_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 900x400px','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_event_featured_image_meta; ?>" name="pm_event_featured_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-staff-preview"></div>
    
    <?php
	
}

function pm_event_date_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_date_meta = get_post_meta( $post->ID, 'pm_event_date_meta', true );
	//echo $pm_event_date_meta;
		

	//HTML code
	?>
    	<p><?php _e('Enter the date of this event.', 'viennatheme'); ?></p>	
		<input type="date" id="datepicker" name="pm_event_date_meta" value="<?php echo $pm_event_date_meta; ?>" class="pm-admin-date-field" />
    
    <?php
	
}

function pm_event_fan_page_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_event_fan_page_meta = get_post_meta( $post->ID, 'pm_event_fan_page_meta', true );
	//echo $pm_event_fan_page_meta;
		

	//HTML code
	?>
    	<p><?php _e('Enter a Facebook fan page URL','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_event_fan_page_meta; ?>" name="pm_event_fan_page_meta" class="pm-admin-text-field" />
    <?php
	
}

/*** WOOCOMMERCE META OPTIONS & FUNCTIONS *****/
function add_woocommerce_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_woocom_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_woocom_header_image_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);

	//Sidebar layout
	add_meta_box( 
		'pm_woocom_post_layout_meta', //ID
		'Sidebar Layout',  //label
		'pm_woocom_post_layout_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);
	
	//Header Message
	add_meta_box( 
		'pm_woocom_header_message_meta', //ID
		'Page Header Message',  //label
		'pm_woocom_header_message_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);

		
}

function pm_woocom_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_header_image_meta = get_post_meta( $post->ID, 'pm_woocom_header_image_meta', true );
	//echo $post->ID . $pm_woocom_header_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 1920x500px or 1920x800px for parallax mode','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_woocom_header_image_meta; ?>" name="pm_woocom_header_image_meta" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-field-preview"></div>
    
    <?php
	
}

function pm_woocom_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_woocom_post_layout_meta = get_post_meta( $post->ID, 'pm_woocom_post_layout_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php _e('Select your desired layout for this post.','viennatheme'); ?></p>
        <select id="pm_woocom_post_layout_meta" name="pm_woocom_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'no-sidebar' ); ?>><?php _e('No Sidebar', 'viennatheme'); ?></option>
            <option value="left-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'left-sidebar' ); ?>><?php _e('Left Sidebar', 'viennatheme'); ?></option>
            <option value="right-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'right-sidebar' ); ?>><?php _e('Right Sidebar', 'viennatheme'); ?></option>
        </select>
            
    <?php
	
}

function pm_woocom_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_header_message_meta = get_post_meta( $post->ID, 'pm_woocom_header_message_meta', true );
	//echo $pm_woocom_header_message_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo $pm_woocom_header_message_meta; ?>" name="pm_woocom_header_message_meta" class="pm-admin-text-field" />
    <?php
	
}


/*** STAFF META OPTIONS & FUNCTIONS *****/
function add_staff_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);

	//Staff Image
	add_meta_box( 
		'pm_staff_image_meta', //ID
		'Staff Profile Image',  //label
		'pm_staff_image_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Staff Title
	add_meta_box( 
		'pm_staff_title_meta', //ID
		'Staff Title',  //label
		'pm_staff_title_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Staff member message
	add_meta_box( 
		'pm_staff_message_meta', //ID
		'Personal Message',  //label
		'pm_staff_message_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Twitter Address
	add_meta_box( 
		'pm_staff_twitter_meta', //ID
		'Twitter Address',  //label
		'pm_staff_twitter_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Facebook Address
	add_meta_box( 
		'pm_staff_facebook_meta', //ID
		'Facebook Address',  //label
		'pm_staff_facebook_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Google Plus Address
	add_meta_box( 
		'pm_staff_gplus_meta', //ID
		'Google Plus Address',  //label
		'pm_staff_gplus_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Linkedin Address
	add_meta_box( 
		'pm_staff_linkedin_meta', //ID
		'Linkedin Address',  //label
		'pm_staff_linkedin_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_staff_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_header_image_meta = get_post_meta( $post->ID, 'pm_staff_header_image_meta', true );
	//echo $post->ID . $pm_woocom_header_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 1920x500px or 1920x800px for parallax mode','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_staff_header_image_meta; ?>" name="pm_staff_header_image_meta" id="img-uploader-field" class="pm-admin-staff-header-upload-field" />
		<input id="upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-staff-header-image-preview"></div>
    
    <?php
	
}

function pm_staff_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_image_meta = get_post_meta( $post->ID, 'pm_staff_image_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_staff_image_meta; ?>" name="pm_staff_image_meta" id="featured-img-uploader-field" class="pm-staff-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-staff-preview"></div>
    
    <?php
	
}

function pm_staff_title_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_title_meta = get_post_meta( $post->ID, 'pm_staff_title_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_staff_title_meta; ?>" name="pm_staff_title_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_message_meta = get_post_meta( $post->ID, 'pm_staff_message_meta', true );
	//echo $pm_staff_message_meta;
		

	//HTML code
	?>
        
		<input type="text" value="<?php echo $pm_staff_message_meta; ?>" name="pm_staff_message_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_twitter_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_twitter_meta = get_post_meta( $post->ID, 'pm_staff_twitter_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_staff_twitter_meta; ?>" name="pm_staff_twitter_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_facebook_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_facebook_meta = get_post_meta( $post->ID, 'pm_staff_facebook_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_staff_facebook_meta; ?>" name="pm_staff_facebook_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_gplus_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_gplus_meta = get_post_meta( $post->ID, 'pm_staff_gplus_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_staff_gplus_meta; ?>" name="pm_staff_gplus_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_linkedin_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_linkedin_meta = get_post_meta( $post->ID, 'pm_staff_linkedin_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_staff_linkedin_meta; ?>" name="pm_staff_linkedin_meta" class="pm-admin-text-field" />
    
    <?php
	
}

/*** POST META OPTIONS & FUNCTIONS *****/
function add_post_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Post Header Image',  //label
		'pm_header_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Featured Post Image
	add_meta_box( 
		'pm_featured_post_image_meta', //ID
		'Featured Post Image',  //label
		'pm_featured_post_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_post_layout_meta', //ID
		'Post Layout',  //label
		'pm_post_layout_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Share options
	add_meta_box( 
		'pm_disable_share_feature', //ID
		'Disable Share feature?',  //label
		'pm_disable_share_feature_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Featured Post
	/*add_meta_box( 
		'pm_post_featured_meta', //ID
		'Feature in Presentation carousel?',  //label
		'pm_post_featured_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);*/
	
	//Post Visibility
	/*add_meta_box(
		'pm_post_visibility', // Unique ID
		esc_html__( 'Post Type Visibility', 'viennatheme' ), // Title
		'pm_post_visibility_function', // Callback function
		'post', // Admin page (or post type)
		'side', // Context
		'default' // Priority
	);*/
	
	
}

function pm_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_image_meta = get_post_meta( $post->ID, 'pm_header_image_meta', true );
	//echo $post->ID . $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 1920x500px or 1920x800px for parallax mode','viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_header_image_meta; ?>" name="post-header-image" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-field-preview"></div>
    
    <?php
	
}

function pm_featured_post_image_meta_function ($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_featured_post_image_meta = get_post_meta( $post->ID, 'pm_featured_post_image_meta', true );
	//echo $post->ID . $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php _e('Recommended size: 1170x400px', 'viennatheme'); ?></p>
		<input type="text" value="<?php echo $pm_featured_post_image_meta; ?>" name="pm_featured_post_image_meta" id="featured-img-uploader-field" class="pm-featured-image-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php _e('Media Library Image', 'viennatheme'); ?>" class="button-secondary" />
        <div class="pm-featured-image-preview"></div>
    
    <?php
	
}

function pm_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_message_meta = get_post_meta( $post->ID, 'pm_header_message_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo $pm_header_message_meta; ?>" name="post-header-message" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_layout_meta = get_post_meta( $post->ID, 'pm_post_layout_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php _e('Select your desired layout for this post.', 'viennatheme'); ?></p>
        <select id="pm_post_layout_meta" name="pm_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_post_layout_meta, 'no-sidebar' ); ?>><?php _e('No Sidebar', 'viennatheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_post_layout_meta, 'left-sidebar' ); ?>><?php _e('Left Sidebar', 'viennatheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_post_layout_meta, 'right-sidebar' ); ?>><?php _e('Right Sidebar', 'viennatheme') ?></option>
        </select>
        
        
    
    <?php
	
}

function pm_post_featured_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_featured_meta = get_post_meta( $post->ID, 'pm_post_featured_meta', true );
	//echo $pm_post_featured_meta;
	
	?>
    	<p><?php _e('Setting this to', 'viennatheme'); ?> <strong><?php _e('"ON"', 'viennatheme'); ?></strong> <?php _e('will display this post on the homepage post slider carousel.', 'viennatheme'); ?></p>
    	<div id="pm_post_featured_switch"></div>
        <input name="pm_post_featured_meta" type="hidden" value="<?php echo $pm_post_featured_meta !== '' ? $pm_post_featured_meta : 'off' ?>" id="pm_post_featured_meta" />
        
    
    <?php
		
}

/* Display the post meta box. */
function pm_post_visibility_function($post) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'post_meta_nonce' ); ?>
    
    <?php 
	
	//Retrieve the meta value if it exists
	$pm_post_visibility = get_post_meta( $post->ID, 'pm_post_visibility', true ); 
	//echo $pm_post_visibility;
	
	?>

	<p>
    
    	<input name="pm_post_visibility" type="radio" value="public" <?php checked( $pm_post_visibility, 'public' ); ?> />
		<label for="pm-ln-post-type"><?php _e( "Public", 'viennatheme' ); ?></label>
        
		<br />
        <input name="pm_post_visibility" type="radio" value="members" <?php checked( $pm_post_visibility, 'members' ); ?> />
        <label for="pm-ln-post-type"><?php _e( "Members Only", 'viennatheme' ); ?></label>
        
        <br />
        		
	</p>
    
<?php }

/*** PAGE META OPTIONS & FUNCTIONS *****/
function add_page_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		'Page Header Image',  //label
		'pm_header_image_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_page_layout_meta', //ID
		'Page Layout',  //label
		'pm_page_layout_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
		
	//Disable Container
	add_meta_box( 
		'pm_page_disable_container_meta', //ID
		'Disable Bootstrap container for full width content?',  //label
		'pm_page_disable_container_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Print and Share
	add_meta_box( 
		'pm_page_print_share_meta', //ID
		'Enable Print and Share options?',  //label
		'pm_page_print_share_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Disable Header?
	/*add_meta_box( 
		'pm_display_header_meta', //ID
		'Display Header?',  //label
		'pm_display_header_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);*/
	
	
	//Header Message
	add_meta_box( 
		'pm_header_message_meta', //ID
		'Page Header Message',  //label
		'pm_header_message_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	
}

function pm_page_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_layout_meta = get_post_meta( $post->ID, 'pm_page_layout_meta', true );
	//echo $pm_page_layout_meta;
	
	?>
            
        <select id="pm_page_layout_meta" name="pm_page_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_page_layout_meta, 'no-sidebar' ); ?>><?php _e('No Sidebar', 'viennatheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_page_layout_meta, 'left-sidebar' ); ?>><?php _e('Left Sidebar', 'viennatheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_page_layout_meta, 'right-sidebar' ); ?>><?php _e('Right Sidebar', 'viennatheme') ?></option>
        </select>
    
    <?php
	
}

function pm_page_disable_container_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_disable_container_meta = get_post_meta( $post->ID, 'pm_page_disable_container_meta', true );
	//echo $pm_post_disable_container_meta;
	
	?>
            
        <select id="pm_page_disable_container_meta" name="pm_page_disable_container_meta" class="pm-admin-select-list"> 
        	<option value="no" <?php selected( $pm_page_disable_container_meta, 'no' ); ?>><?php _e('No', 'viennatheme') ?></option> 
            <option value="yes" <?php selected( $pm_page_disable_container_meta, 'yes' ); ?>><?php _e('Yes', 'viennatheme') ?></option>
        </select>
    
    <?php
	
}

function pm_page_print_share_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_print_share_meta = get_post_meta( $post->ID, 'pm_page_print_share_meta', true );
	//echo $pm_post_disable_container_meta;
	
	?>
            
        <select id="pm_page_print_share_meta" name="pm_page_print_share_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_page_print_share_meta, 'on' ); ?>><?php _e('ON', 'viennatheme') ?></option> 
            <option value="off" <?php selected( $pm_page_print_share_meta, 'off' ); ?>><?php _e('OFF', 'viennatheme') ?></option>
        </select>
    
    <?php
	
}

/*function pm_display_header_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_display_header_meta = get_post_meta( $post->ID, 'pm_display_header_meta', true );
	//echo $pm_display_header_meta;
	
	?>
            
        <select id="pm_display_header_meta" name="pm_display_header_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_display_header_meta, 'on' ); ?>><?php _e('ON', 'viennatheme') ?></option> 
            <option value="off" <?php selected( $pm_display_header_meta, 'off' ); ?>><?php _e('OFF', 'viennatheme') ?></option>
        </select>
    
    <?php
	
}*/

/* When the post is saved, saves our custom data */
function save_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['post_meta_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['post_meta_nonce'], plugin_basename( __FILE__ ) ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
			
			
		//Check for post values
		if(isset($_POST['post-header-image'])){
			$postHeaderImage = $_POST['post-header-image'];
			update_post_meta($post_id, "pm_header_image_meta", $postHeaderImage);
		}
		if(isset($_POST['pm_featured_post_image_meta'])){
			$pmFeaturedPostImageMeta = $_POST['pm_featured_post_image_meta'];
			update_post_meta($post_id, "pm_featured_post_image_meta", $pmFeaturedPostImageMeta);
		}		
		if(isset($_POST['post-header-message'])){
			$postHeaderImage = $_POST['post-header-message'];
			update_post_meta($post_id, "pm_header_message_meta", $postHeaderImage);
		}
	 
	 	if(isset($_POST['pm_post_layout_meta'])){
			$pmPostLayoutMeta = $_POST['pm_post_layout_meta'];
			update_post_meta($post_id, "pm_post_layout_meta", $pmPostLayoutMeta);
		}
		
		if(isset($_POST['pm_post_featured_meta'])){
			$pmPostFeaturedMeta = $_POST['pm_post_featured_meta'];
			update_post_meta($post_id, "pm_post_featured_meta", $pmPostFeaturedMeta);
		}
		
		if(isset($_POST['pm_post_visibility'])){
			$pmPostVisibility = $_POST['pm_post_visibility'];
			update_post_meta($post_id, "pm_post_visibility", $pmPostVisibility);
		}
		
		
		//Check for page values
		if(isset($_POST['pm_header_image_meta'])){
			$pmPageHeaderImageMeta = $_POST['pm_header_image_meta'];
			update_post_meta($post_id, "pm_header_image_meta", $pmPageHeaderImageMeta);
		}
		
		if(isset($_POST['pm_page_layout_meta'])){
			$pmPageLayoutMeta = $_POST['pm_page_layout_meta'];
			update_post_meta($post_id, "pm_page_layout_meta", $pmPageLayoutMeta);
		}
		
		if(isset($_POST['pm_page_disable_container_meta'])){
			$pmPageDisableContainerMeta = $_POST['pm_page_disable_container_meta'];
			update_post_meta($post_id, "pm_page_disable_container_meta", $pmPageDisableContainerMeta);
		}
		
		if(isset($_POST['pm_page_print_share_meta'])){
			$pmPagePrintShareMeta = $_POST['pm_page_print_share_meta'];
			update_post_meta($post_id, "pm_page_print_share_meta", $pmPagePrintShareMeta);
		}
		
		if(isset($_POST['pm_display_header_meta'])){
			$pmDisplayHeaderMeta = $_POST['pm_display_header_meta'];
			update_post_meta($post_id, "pm_display_header_meta", $pmDisplayHeaderMeta);
		}
		
				
		//Check for staff values
		if(isset($_POST['pm_staff_header_image_meta'])){
			$pmStaffHeaderImageMeta = $_POST['pm_staff_header_image_meta'];
			update_post_meta($post_id, "pm_staff_header_image_meta", $pmStaffHeaderImageMeta);
		}
		
		if(isset($_POST['pm_staff_image_meta'])){
			$pmStaffImageMeta = $_POST['pm_staff_image_meta'];
			update_post_meta($post_id, "pm_staff_image_meta", $pmStaffImageMeta);
		}
		
		if(isset($_POST['pm_staff_title_meta'])){
			$pmStaffTitleMeta = $_POST['pm_staff_title_meta'];
			update_post_meta($post_id, "pm_staff_title_meta", $pmStaffTitleMeta);
		}
		
		if(isset($_POST['pm_staff_message_meta'])){
			$pmStaffMessageMeta = $_POST['pm_staff_message_meta'];
			update_post_meta($post_id, "pm_staff_message_meta", $pmStaffMessageMeta);
		}
		
		if(isset($_POST['pm_staff_twitter_meta'])){
			$pmStaffTwitterMeta = $_POST['pm_staff_twitter_meta'];
			update_post_meta($post_id, "pm_staff_twitter_meta", $pmStaffTwitterMeta);
		}
		
		if(isset($_POST['pm_staff_facebook_meta'])){
			$pmStaffFacebookMeta = $_POST['pm_staff_facebook_meta'];
			update_post_meta($post_id, "pm_staff_facebook_meta", $pmStaffFacebookMeta);
		}
		
		if(isset($_POST['pm_staff_gplus_meta'])){
			$pmStaffGoogleMeta = $_POST['pm_staff_gplus_meta'];
			update_post_meta($post_id, "pm_staff_gplus_meta", $pmStaffGoogleMeta);
		}
		
		if(isset($_POST['pm_staff_linkedin_meta'])){
			$pmStaffLinkedinMeta = $_POST['pm_staff_linkedin_meta'];
			update_post_meta($post_id, "pm_staff_linkedin_meta", $pmStaffLinkedinMeta);
		}
		
		
		//Check for Woocommerce values
		if(isset($_POST['pm_woocom_header_image_meta'])){
			$pmWoocomHeaderImageMeta = $_POST['pm_woocom_header_image_meta'];
			update_post_meta($post_id, "pm_woocom_header_image_meta", $pmWoocomHeaderImageMeta);
		}
		if(isset($_POST['pm_woocom_post_layout_meta'])){
			$pmWoocomPostLayoutMeta = $_POST['pm_woocom_post_layout_meta'];
			update_post_meta($post_id, "pm_woocom_post_layout_meta", $pmWoocomPostLayoutMeta);
		}
		if(isset($_POST['pm_woocom_header_message_meta'])){
			$pmWoocomHeaderMessageMeta = $_POST['pm_woocom_header_message_meta'];
			update_post_meta($post_id, "pm_woocom_header_message_meta", $pmWoocomHeaderMessageMeta);
		}
		if(isset($_POST['pm_woocom_course_icon_meta'])){
			$pmWoocomCourseIconMeta = $_POST['pm_woocom_course_icon_meta'];
			update_post_meta($post_id, "pm_woocom_course_icon_meta", $pmWoocomCourseIconMeta);
		}
		
		//Check for Event values
		if(isset($_POST['pm_event_header_image_meta'])){
			$pmEventHeaderImageMeta = $_POST['pm_event_header_image_meta'];
			update_post_meta($post_id, "pm_event_header_image_meta", $pmEventHeaderImageMeta);
		}
		
		if(isset($_POST['pm_event_featured_image_meta'])){
			$pmEventFeaturedImageMeta = $_POST['pm_event_featured_image_meta'];
			update_post_meta($post_id, "pm_event_featured_image_meta", $pmEventFeaturedImageMeta);
		}
		
		if(isset($_POST['pm_event_date_meta'])){
			$pmEventDateMeta = $_POST['pm_event_date_meta'];
			update_post_meta($post_id, "pm_event_date_meta", $pmEventDateMeta);
		}
		
		if(isset($_POST['pm_event_fan_page_meta'])){
			$pmEventFanPageMeta = $_POST['pm_event_fan_page_meta'];
			update_post_meta($post_id, "pm_event_fan_page_meta", $pmEventFanPageMeta);
		}
		
		if(isset($_POST['pm_disable_share_feature'])){
			$pmEventDisableShareFeature = $_POST['pm_disable_share_feature'];
			update_post_meta($post_id, "pm_disable_share_feature", $pmEventDisableShareFeature);
		}
		
		
		
		//Gallery values
		if(isset($_POST['pm_gallery_header_image_meta'])){
			$pmGalleryHeaderImageMeta = $_POST['pm_gallery_header_image_meta'];
			update_post_meta($post_id, "pm_gallery_header_image_meta", $pmGalleryHeaderImageMeta);
		}
		
		if(isset($_POST['pm_gallery_image_meta'])){
			$pmGalleryImageMeta = $_POST['pm_gallery_image_meta'];
			update_post_meta($post_id, "pm_gallery_image_meta", $pmGalleryImageMeta);
		}
		
		if(isset($_POST['pm_gallery_item_caption_meta'])){
			$pmGalleryItemCaptionMeta = $_POST['pm_gallery_item_caption_meta'];
			update_post_meta($post_id, "pm_gallery_item_caption_meta", $pmGalleryItemCaptionMeta);
		}
		
		//Menu values
		if(isset($_POST['pm_menu_image_meta'])){
			$pmMenuImageMeta = $_POST['pm_menu_image_meta'];
			update_post_meta($post_id, "pm_menu_image_meta", $pmMenuImageMeta);
		}
		
		if(isset($_POST['pm_menu_item_price_meta'])){
			$pmMenuItemPriceMeta = $_POST['pm_menu_item_price_meta'];
			update_post_meta($post_id, "pm_menu_item_price_meta", $pmMenuItemPriceMeta);
		}
		
			
	} else {
		return;
	}	
    
}



?>