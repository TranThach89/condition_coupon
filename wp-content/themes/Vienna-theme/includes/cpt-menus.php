<?php
function cpt_menus(){
	
	/*if(function_exists('ot_get_option')){
		$url_rewrite = ot_get_option('staff_post_type_url');
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'staff-member'; 
		} 
	} else {
		$url_rewrite = 'staff-member';
	}*/

	register_post_type('post_menus',
		array(
			'labels' => array(
				'name' => __( 'Menu', 'viennatheme' ),
				'singular_name' => __( 'Menu', 'viennatheme' ),
				'add_new' => __( 'Add New Menu item', 'viennatheme' ),
				'add_new_item' => __( 'Add New Menu item', 'viennatheme' ),
				'edit' => __( 'Edit', 'viennatheme' ),
				'edit_item' => __( 'Edit Menu item', 'viennatheme' ),
				'new_item' => __( 'New Menu item', 'viennatheme' ),
				'view' => __( 'View', 'viennatheme' ),
				'view_item' => __( 'View Menu item', 'viennatheme' ),
				'search_items' => __( 'Search Menu items', 'viennatheme' ),
				'not_found' => __( 'No Menu items found', 'viennatheme' ),
				'not_found_in_trash' => __( 'No Menu items found in Trash', 'viennatheme' ),
				'parent' => __( 'Parent Menu item', 'viennatheme' )
			),
			'description' => __( 'Easily lets you add new menu items', 'viennatheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => 'menus'),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function tax_menus() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Menu Categories', 'viennatheme' ),
		'singular_name' => __( 'Menu Categories', 'viennatheme' ),
		'search_items' =>  __( 'Search Menu Categories', 'viennatheme' ),
		'popular_items' => __( 'Popular Menu Categories', 'viennatheme' ),
		'all_items' => __( 'All Menu Categories', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Menu Category', 'viennatheme' ),
		'update_item' => __( 'Update Menu Category', 'viennatheme' ),
		'add_new_item' => __( 'Add Menu Category', 'viennatheme' ),
		'new_item_name' => __( 'New Menu Category Name', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Menu Categories with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Menu Categories', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Menu Categories', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'menucats', 'post_menus', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'menu-archive' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function menu_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => __( 'Menu Tags', 'viennatheme' ),
		'singular_name' => __( 'Menu Tags', 'viennatheme' ),
		'search_items' =>  __( 'Search Menu Tags', 'viennatheme' ),
		'popular_items' => __( 'Popular Menu Tags', 'viennatheme' ),
		'all_items' => __( 'All Menu Tags', 'viennatheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Menu Tag', 'viennatheme' ),
		'update_item' => __( 'Update Menu Tag', 'viennatheme' ),
		'add_new_item' => __( 'Add Menu Tag', 'viennatheme' ),
		'new_item_name' => __( 'New Menu Tag', 'viennatheme' ),
		'separate_items_with_commas' => __( 'Separate Menu Tags with commas', 'viennatheme' ),
		'add_or_remove_items' => __( 'Add or remove Menu Tags', 'viennatheme' ),
		'choose_from_most_used' => __( 'Choose from the most used Menu Tags', 'viennatheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'menutags', 'post_menus', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'menu-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_menus');
add_action('init', 'tax_menus');
add_action('init', 'menu_tags');