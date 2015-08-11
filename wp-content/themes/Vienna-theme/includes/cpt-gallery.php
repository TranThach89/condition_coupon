<?php
function cpt_gallery(){
	
	/*if(function_exists('ot_get_option')){
		$url_rewrite = ot_get_option('staff_post_type_url');
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'staff-member'; 
		} 
	} else {
		$url_rewrite = 'staff-member';
	}*/

	register_post_type('post_galleries',
		array(
			'labels' => array(
				'name' => __( 'Gallery', 'viennatheme' ),
				'singular_name' => __( 'Gallery', 'viennatheme' ),
				'add_new' => __( 'Add New Gallery item', 'viennatheme' ),
				'add_new_item' => __( 'Add New Gallery item', 'viennatheme' ),
				'edit' => __( 'Edit', 'viennatheme' ),
				'edit_item' => __( 'Edit Gallery item', 'viennatheme' ),
				'new_item' => __( 'New Gallery item', 'viennatheme' ),
				'view' => __( 'View', 'viennatheme' ),
				'view_item' => __( 'View Gallery item', 'viennatheme' ),
				'search_items' => __( 'Search Gallery items', 'viennatheme' ),
				'not_found' => __( 'No Gallery items found', 'viennatheme' ),
				'not_found_in_trash' => __( 'No Gallery items found in Trash', 'viennatheme' ),
				'parent' => __( 'Parent Staff', 'viennatheme' )
			),
			'description' => __( 'Easily lets you add new gallery items', 'viennatheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'gallery'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function gallery_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Gallery Categories', 'viennatheme' ),
		'singular_name' => __( 'Gallery Categories', 'viennatheme' ),
		'search_items' =>  __( 'Search Gallery Categories', 'viennatheme' ),
		'popular_items' => __( 'Popular Gallery Categories', 'viennatheme' ),
		'all_items' => __( 'All Gallery Categories', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Gallery Category', 'viennatheme' ),
		'update_item' => __( 'Update Gallery Category', 'viennatheme' ),
		'add_new_item' => __( 'Add Gallery Category', 'viennatheme' ),
		'new_item_name' => __( 'New Gallery Category Name', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Gallery Categories with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Gallery Categories', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Gallery Categories', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerycats', 'post_galleries', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function gallery_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Gallery Tags', 'viennatheme' ),
		'singular_name' => __( 'Gallery Tags', 'viennatheme' ),
		'search_items' =>  __( 'Search Gallery Tags', 'viennatheme' ),
		'popular_items' => __( 'Popular Gallery Tags', 'viennatheme' ),
		'all_items' => __( 'All Gallery Tags', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Gallery Category', 'viennatheme' ),
		'update_item' => __( 'Update Gallery Category', 'viennatheme' ),
		'add_new_item' => __( 'Add Gallery Category', 'viennatheme' ),
		'new_item_name' => __( 'New Gallery Category Name', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Gallery Tags with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Gallery Tags', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Gallery Tags', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerytags', 'post_galleries', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_gallery');
add_action('init', 'gallery_categories');
add_action('init', 'gallery_tags');