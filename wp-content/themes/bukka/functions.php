<?php
/**
 * Bukka functions and definitions.
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 940;

/**
 * Initialize post type and other theme connected stuff.
 */
function bukka_init() {
	// labels for project post type
	$labels = array(
		'name'                 => _x( 'Projects', 'project general name', 'bukka' ),
		'singular_name'        => _x( 'Project', 'project singular name', 'bukka' ),
		'add_new'              => _x( 'Add New', 'project', 'bukka' ),
		'add_new_item'         => __( 'Add New project', 'bukka' ),
		'edit_item'            => __( 'Edit project', 'bukka' ),
		'new_item'             => __( 'New project', 'bukka' ),
		'all_items'            => __( 'All projects', 'bukka' ),
		'view_item'            => __( 'View project', 'bukka' ),
		'search_items'         => __( 'Search projects', 'bukka' ),
		'not_found'            => __( 'No projects found', 'bukka' ),
		'not_found_in_trash'   => __( 'No projects found in Trash', 'bukka' ),
		'parent_item_colon'    => '',
		'menu_name'            => __( 'Projects', 'bukka' )

	);
	// register project post type
	register_post_type( 'project',  array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'rewrite'             => array( 'slug' => _x( 'project', 'URL slug', 'bukka' ), 'with_front' => false ),
		'capability_type'     => 'page',
		'has_archive'         => true,
		'hierarchical'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes', 'comments' ),
		'taxonomies'          => array( 'category' ),
	) );
}
add_action( 'init', 'bukka_init' );

/**
 * Hook for adding projects to the default query listing 
 * @param WP_Query $query
 */
function bukka_pre_get_posts( $query ) {
	$q = $query->query;
	if (!isset($q['page']) && !isset($q['s']) && !isset($q['post_type'])) {
		$query->query_vars['post_type'] = array( 'post', 'project' );
	}
}
add_action( 'pre_get_posts', 'bukka_pre_get_posts' );

/**
 * Sets up theme defaults for Bukka supports.
 */
function bukka_setup() {
	/*
	 * Makes Bukka available for translation (possibly Czech version in the future).
	 */
	// load_theme_textdomain( 'bukka', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'bukka' ) );
}
add_action( 'after_setup_theme', 'bukka_setup' );

/**
 * Enqueues scripts and styles for front-end.
 */
function bukka_scripts_styles() {
	/*
	 * Loads the main stylesheet.
	 */
	wp_enqueue_style( 'bukka-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'bukka_scripts_styles' );

/**
 * Registers a widget area.
 */
function bukka_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'bukka' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appers on the front (news) page', 'bukka' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'bukka_widgets_init' );

/**
 * Get bukka param.
 * @param string $param
 * @param bool $show
 */
function bukka_param( $param, $show = true ) {
	global $bukka_params;
	if ( empty( $bukka_params ) ) {
		$bukka_params['menu'] = wp_nav_menu( array( 
				'theme_location' => 'primary',
				'menu_class' => 'nav-menu', 
				'echo' => false,
		) );
		if ( ! isset( $bukka_params['title'] ) ) {
			if ( isset( $_GET['s'] ) ) {
				$bukka_params['title'] = 'Search result';
			} else {
				global $post;
				$bukka_params['title'] = $post->post_title;
			}
		}
	}
	$result = isset( $bukka_params[$param] ) ? $bukka_params[$param] : "";
	if ( $show )
		echo $result;
	else
		return $result;
}

/**
 * Filter for setting site title from menu items.
 * @param array $items
 * @return array Menu items
 */
function bukka_set_title_from_menu( $items ) {
	global $bukka_params;
	if ( empty( $bukka_params ) ) {
		foreach ( $items as $item ) {
			if ( $item->current )
				$bukka_params['title'] = $item->title;
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects',  'bukka_set_title_from_menu' );

/**
 * Displays navigation to next/previous pages when applicable.
 */
function bukka_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'bukka' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bukka' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bukka' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}

/**
 * Displays project page content
 * @param string $category
 */
function bukka_project_page( $category ) {
	global $wp_query;
	
	get_header();
	$args = array(
		'post_type' => 'project',
		'category_name' => $category,
		'paged' => $wp_query->query_vars['page'],
	);
	query_posts( $args );
	get_template_part( 'content', 'posts' );
	get_sidebar();
	get_footer();
}

/**
 * Displays pagination
 */
function bukka_pagination() {
	global $wp_query;
	
	$total = $wp_query->max_num_pages;
	if ( $total < 2 )
		return;
	
	$args = array(
		'prev_text' => __('&lt; Previous'),
		'next_text' => __('Next &gt;'),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $total,
	);
	
	if ( isset( $wp_query->query['category_name'] ) ) {
		$args['base'] = "/" . $wp_query->query['category_name'] . '/%_%';
		$args['format'] = '%#%/';
	} else {
		$args['base'] = '/%_%';
		$args['format'] = 'page/%#%/';
	}
	
	echo '<div class="pagination">';
	echo paginate_links( $args );
	echo '</div>';
}
