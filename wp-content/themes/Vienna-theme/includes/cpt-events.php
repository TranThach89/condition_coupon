<?php
function cpt_events(){
	
	/*if(function_exists('ot_get_option')){
		$url_rewrite = ot_get_option('staff_post_type_url');
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'staff-member'; 
		} 
	} else {
		$url_rewrite = 'staff-member';
	}*/

	register_post_type('post_event',
		array(
			'labels' => array(
				'name' => __( 'Events', 'viennatheme' ),
				'singular_name' => __( 'Events', 'viennatheme' ),
				'add_new' => __( 'Add New Event', 'viennatheme' ),
				'add_new_item' => __( 'Add New Event', 'viennatheme' ),
				'edit' => __( 'Edit', 'viennatheme' ),
				'edit_item' => __( 'Edit Event', 'viennatheme' ),
				'new_item' => __( 'New Event', 'viennatheme' ),
				'view' => __( 'View', 'viennatheme' ),
				'view_item' => __( 'View Event', 'viennatheme' ),
				'search_items' => __( 'Search Events', 'viennatheme' ),
				'not_found' => __( 'No Events found', 'viennatheme' ),
				'not_found_in_trash' => __( 'No Events found in Trash', 'viennatheme' ),
				'parent' => __( 'Parent Staff', 'viennatheme' )
			),
			'description' => __( 'Easily lets you add new events', 'viennatheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'events'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function event_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Event Categories', 'viennatheme' ),
		'singular_name' => __( 'Event Categories', 'viennatheme' ),
		'search_items' =>  __( 'Search Event Categories', 'viennatheme' ),
		'popular_items' => __( 'Popular Event Categories', 'viennatheme' ),
		'all_items' => __( 'All Event Categories', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Event Category', 'viennatheme' ),
		'update_item' => __( 'Update Event Category', 'viennatheme' ),
		'add_new_item' => __( 'Add Event Category', 'viennatheme' ),
		'new_item_name' => __( 'New Event Category', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Event Categories with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Event Categories', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Event Categories', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'event_categories', 'post_event', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'event-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function event_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Event Tags', 'viennatheme' ),
		'singular_name' => __( 'Event Tags', 'viennatheme' ),
		'search_items' =>  __( 'Search Event Tags', 'viennatheme' ),
		'popular_items' => __( 'Popular Event Tags', 'viennatheme' ),
		'all_items' => __( 'All Event Tags', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Event Tag', 'viennatheme' ),
		'update_item' => __( 'Update Event Tag', 'viennatheme' ),
		'add_new_item' => __( 'Add Event Tag', 'viennatheme' ),
		'new_item_name' => __( 'New Event Tag', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Event Tags with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Event Tags', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Event Tags', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'eventtags', 'post_event', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'event-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_events');
add_action('init', 'event_categories');
add_action('init', 'event_tags');