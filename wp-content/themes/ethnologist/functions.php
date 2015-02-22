<?php

require_once 'inc/class-ethnologist-nav-menus.php';

function ethnologist_navmenu_register() {
	$nav_menus = new Ethnologist_NavMenus();
	$nav_menus->register()->update();
}

function ethnologist_after_setup_theme() {
	global $pinnacle;
	// setup pinnacle
	$pinnacle['single_post_header_title'] = 'posttitle';
	$pinnacle['home_pagetitle_background'] = array();

	// register nav menus
	ethnologist_navmenu_register();
}

add_action( 'after_setup_theme', 'ethnologist_after_setup_theme' );

function ethnologist_register_sections() {
	// labels for section post type
	$labels = array(
		'name'                 => _x( 'Sections', 'Section general name', 'ethnologist' ),
		'singular_name'        => _x( 'Section', 'section singular name', 'ethnologist' ),
		'add_new'              => _x( 'Add New', 'section', 'ethnologist' ),
		'add_new_item'         => __( 'Add New Section', 'ethnologist' ),
		'edit_item'            => __( 'Edit Section', 'ethnologist' ),
		'new_item'             => __( 'New Section', 'ethnologist' ),
		'all_items'            => __( 'All Sections', 'ethnologist' ),
		'view_item'            => __( 'View Section', 'ethnologist' ),
		'search_items'         => __( 'Search Sections', 'ethnologist' ),
		'not_found'            => __( 'No sections found', 'ethnologist' ),
		'not_found_in_trash'   => __( 'No sections found in Trash', 'ethnologist' ),
		'parent_item_colon'    => '',
		'menu_name'            => __( 'Sections', 'ethnologist' )
	);
	// capabilities for accessing vection post type
	$capabilities = array(
		'edit_post'               => 'edit_vection',
		'read_post'               => 'read_vection',
		'delete_post'             => 'delete_section',
		'edit_posts'              => 'edit_sections',
		'edit_others_posts'       => 'edit_others_sections',
		'publish_posts'           => 'publish_sections',
		'read_private_posts'      => 'read_private_sections',
		'read'                    => 'read',
		'delete_posts'            => 'delete_sections',
		'delete_private_posts'    => 'delete_private_sections',
		'delete_published_posts'  => 'delete_published_sections',
		'delete_others_posts'     => 'delete_others_sections',
		'edit_private_posts'      => 'edit_private_sections',
		'edit_published_posts'    => 'edit_published_sections',
	);
	// register section post type
	register_post_type( 'section',  array(
	'labels'              => $labels,
	'public'              => true,
	'publicly_queryable'  => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'menu_position'       => 5,
	'capability_type'     => 'page',
	'capabilities'        => $capabilities,
	'has_archive'         => true,
	'hierarchical'        => false,
	'supports'            => array( 'title', 'thumbnail', 'editor' ),
	'taxonomies'          => array( 'mm' ),
	) );
}

function ethnologist_register_interviews() {
	// labels for interview post type
	$labels = array(
		'name'                 => _x( 'Interviews', 'Interview general name', 'ethnologist' ),
		'singular_name'        => _x( 'Interview', 'interview singular name', 'ethnologist' ),
		'add_new'              => _x( 'Add New', 'interview', 'ethnologist' ),
		'add_new_item'         => __( 'Add New Interview', 'ethnologist' ),
		'edit_item'            => __( 'Edit Interview', 'ethnologist' ),
		'new_item'             => __( 'New Interview', 'ethnologist' ),
		'all_items'            => __( 'All Interviews', 'ethnologist' ),
		'view_item'            => __( 'View Interview', 'ethnologist' ),
		'search_items'         => __( 'Search Interviews', 'ethnologist' ),
		'not_found'            => __( 'No interviews found', 'ethnologist' ),
		'not_found_in_trash'   => __( 'No interviews found in Trash', 'ethnologist' ),
		'parent_item_colon'    => '',
		'menu_name'            => __( 'Interviews', 'ethnologist' )
	);
	// capabilities for accessing vection post type
	$capabilities = array(
		'edit_post'               => 'edit_vection',
		'read_post'               => 'read_vection',
		'delete_post'             => 'delete_interview',
		'edit_posts'              => 'edit_interviews',
		'edit_others_posts'       => 'edit_others_interviews',
		'publish_posts'           => 'publish_interviews',
		'read_private_posts'      => 'read_private_interviews',
		'read'                    => 'read',
		'delete_posts'            => 'delete_interviews',
		'delete_private_posts'    => 'delete_private_interviews',
		'delete_published_posts'  => 'delete_published_interviews',
		'delete_others_posts'     => 'delete_others_interviews',
		'edit_private_posts'      => 'edit_private_interviews',
		'edit_published_posts'    => 'edit_published_interviews',
	);
	// register interview post type
	register_post_type( 'interview',  array(
	'labels'              => $labels,
	'public'              => true,
	'publicly_queryable'  => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'menu_position'       => 6,
	'capability_type'     => 'page',
	'capabilities'        => $capabilities,
	'has_archive'         => true,
	'hierarchical'        => false,
	'supports'            => array( 'title', 'thumbnail', 'editor' ),
	'taxonomies'          => array( 'mm' ),
	) );
}

function ethnologist_init() {
	ethnologist_register_sections();
	ethnologist_register_interviews();
}
add_action ( 'init', 'ethnologist_init' );


function ethnologist_enqueue_styles() {
	wp_enqueue_style( 'ethnologist-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ethnologist-child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'ethnologist_enqueue_styles' );
