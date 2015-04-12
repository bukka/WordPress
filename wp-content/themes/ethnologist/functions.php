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

function ethnologist_admin_init() {
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( 'ethnologist_title', 'Ethnologist', 'ethnologist' );
		pll_register_string( 'ethnologist_sub_title', 'Welcome to Ethnologist Site', 'ethnologist' );
		pll_register_string( 'ethnologist_blog_latest_title', 'Latest from the Blog', 'ethnologist' );
		pll_register_string( 'ethnologist_no_entries', 'Sorry, no entries found.', 'ethnologist' );
		pll_register_string( 'ethnologist_no_sections', 'Sorry, no sections found.', 'ethnologist' );
		pll_register_string( 'ethnologist_posts_newer', 'Newer posts &rarr;', 'ethnologist' );
		pll_register_string( 'ethnologist_posts_older', '&larr; Older posts', 'ethnologist' );
	}
}
add_action ( 'admin_init', 'ethnologist_admin_init' );


function ethnologist_register_sidebar( $options ) {

	register_sidebar( array_merge( $options, array(
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) ) );
}

function ethnologist_register_sidebars() {
	// kadence sidebars
	unregister_sidebar('sidebar-primary');
	unregister_sidebar('footer_1');
	unregister_sidebar('footer_1');
	unregister_sidebar('footer_1');
	unregister_sidebar('footer_1');

	$sidebars = array(
		array(
			'name' => __( 'Primary Sidebar', 'ethnologist' ),
			'id'   => 'sidebar-primary',
		),
		array(
			'name' => __( 'Footer Column 1', 'ethnologist' ),
			'id'   => 'footer_1',
		),
		array(
			'name' => __( 'Footer Column 2', 'ethnologist' ),
			'id'   => 'footer_2',
		),
		array(
			'name' => __( 'Footer Column 3', 'ethnologist' ),
			'id'   => 'footer_3',
		),
		array(
			'name' => __( 'Footer Column 4', 'ethnologist' ),
			'id'   => 'footer_4',
		),
	);

	foreach ( $sidebars as $sidebar_options ) {
		ethnologist_register_sidebar( $sidebar_options );
	}
}

function ethnologist_widgets_init() {
	ethnologist_register_sidebars();
}
add_action ( 'widgets_init', 'ethnologist_widgets_init' );


function ethnologist_enqueue_styles() {
	wp_enqueue_style( 'ethnologist-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ethnologist-child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'ethnologist_enqueue_styles' );

// kadence actions clean up
remove_action( 'init', 'kadence_sidebar_list' );
remove_action( 'widgets_init', 'kadence_register_sidebars' );
