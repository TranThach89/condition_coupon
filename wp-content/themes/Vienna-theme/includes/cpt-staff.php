<?php
function cpt_staff(){
	
	/*if(function_exists('ot_get_option')){
		$url_rewrite = ot_get_option('staff_post_type_url');
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'staff-member'; 
		} 
	} else {
		$url_rewrite = 'staff-member';
	}*/

	register_post_type('post_staff',
		array(
			'labels' => array(
				'name' => __( 'Staff', 'viennatheme' ),
				'singular_name' => __( 'Staff', 'viennatheme' ),
				'add_new' => __( 'Add New Staff profile', 'viennatheme' ),
				'add_new_item' => __( 'Add New Staff profile', 'viennatheme' ),
				'edit' => __( 'Edit', 'viennatheme' ),
				'edit_item' => __( 'Edit Staff profile', 'viennatheme' ),
				'new_item' => __( 'New Staff profile', 'viennatheme' ),
				'view' => __( 'View', 'viennatheme' ),
				'view_item' => __( 'View Staff profile', 'viennatheme' ),
				'search_items' => __( 'Search Staff profiles', 'viennatheme' ),
				'not_found' => __( 'No Staff profiles found', 'viennatheme' ),
				'not_found_in_trash' => __( 'No Staff profiles found in Trash', 'viennatheme' ),
				'parent' => __( 'Parent Staff', 'viennatheme' )
			),
			'description' => __( 'Easily lets you add new staff profiles', 'viennatheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'staff-member'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function staff_titles() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Staff Titles', 'viennatheme' ),
		'singular_name' => __( 'Staff Titles', 'viennatheme' ),
		'search_items' =>  __( 'Search Staff Titles', 'viennatheme' ),
		'popular_items' => __( 'Popular Staff Titles', 'viennatheme' ),
		'all_items' => __( 'All Staff Titles', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Staff Title', 'viennatheme' ),
		'update_item' => __( 'Update Staff Title', 'viennatheme' ),
		'add_new_item' => __( 'Add Staff Title', 'viennatheme' ),
		'new_item_name' => __( 'New Staff Title', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Staff Titles with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Staff Title', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Staff Titles', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'staff_titles', 'post_staff', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'staff-title' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_staff');
add_action('init', 'staff_titles');