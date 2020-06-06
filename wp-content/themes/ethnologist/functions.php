<?php

// Disable E_DEPRACATED warnings due to old constructors in use
error_reporting(E_ALL & ~E_DEPRECATED);

/**
 * Version of the Ethnologist style
 *
 * @var int
 */
define( 'ETHNOLOGIST_STYLE_VERSION', 18 );

/**
 * Translate a string
 *
 * @param string $string
 * @return string
 */
function etn__( $string, $identificator = null ) {
	return pll__( $string );
}

/**
 * Echoes a translated string
 *
 * @param string $string
 */
function etn_e( $string, $identificator = null ) {
	pll_e( $string );
}

/**
 * Include view for ethnologist
 *
 * @param string $type
 * @param string $name
 * @param mixed  $params
 * @param mixed  $context
 */
function ethnologist_view( $type, $name, $params = array(), $context = null ) {
	include __DIR__ . "/views/" . $type . "/" . $name . ".php";
}

/**
 * Register navigation menu
 */
function ethnologist_navmenu_register() {
	require_once 'inc/class-ethnologist-nav-menus.php';
	$nav_menus = new Ethnologist_NavMenus();
	$nav_menu_create_only = ! defined( 'ETHNOLOGIST_MENU_CREATE_ONLY' ) ||
		constant( 'ETHNOLOGIST_MENU_CREATE_ONLY' );
	$nav_menus->register()->update( $nav_menu_create_only );
}

/**
 * Rewrite some pinnacle default setting and register menu
 *
 * Action callback - after_setup_theme
 */
function ethnologist_after_setup_theme() {
	global $pinnacle;
	// setup pinnacle
	$pinnacle['single_post_header_title'] = 'posttitle';
	$pinnacle['home_pagetitle_background'] = array();

	// register nav menus
	ethnologist_navmenu_register();

	/**
	 * Add support for Gutenberg.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	 */
	add_theme_support( 'gutenberg', array(
		// Theme supports wide images, galleries and videos.
		'wide-images' => true
	) );
}
add_action( 'after_setup_theme', 'ethnologist_after_setup_theme' );

/**
 * Give editor privilege to manage users (extra setting in the map)
 *
 * Filter callback - map_meta_cap
 *
 * @param array  $caps
 * @param string $cap
 * @param int    $user_id
 * @param mixed  $args
 */
function ethnologist_map_meta_cap( $caps, $cap, $user_id, $args )
{
	foreach ( $caps as $key => $capability ) {

		if( $capability != 'do_not_allow' )
			continue;

		switch ( $cap ) {
			case 'edit_user':
			case 'edit_users':
				$caps[$key] = 'edit_users';
				break;
			case 'delete_user':
			case 'delete_users':
				$caps[$key] = 'delete_users';
				break;
			case 'create_users':
				$caps[$key] = $cap;
				break;
		}
	}

	return $caps;
}
add_filter( 'map_meta_cap', 'ethnologist_map_meta_cap', 10, 4 );

/**
 * Let Editors manage users, and run this only once
 */
function ethnologist_editor_manage_users() {

	if ( get_option( 'ethnologist_add_cap_editor_once' ) != 'v1' ) {

		// let editor manage users
		$edit_editor = get_role('editor'); // Get the user role
		$edit_editor->add_cap('edit_users');
		$edit_editor->add_cap('list_users');
		$edit_editor->add_cap('promote_users');
		$edit_editor->add_cap('create_users');
		$edit_editor->add_cap('add_users');
		$edit_editor->add_cap('delete_users');

		// other editors extra caps
		$edit_editor->add_cap('customize');

		update_option( 'ethnologist_add_cap_editor_once', 'v1' );
	}

	if ( get_option( 'ethnologist_add_cap_author_once' ) != 'v1' ) {

		$edit_editor = get_role('author'); // Get the user role
		$edit_editor->add_cap('edit_pages');
		$edit_editor->add_cap('edit_published_pages');

		update_option( 'ethnologist_add_cap_author_once', 'v1' );
	}
}

/**
 * Register sections post type
 */
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
	// capabilities for accessing vection post type (not used)
	$capabilities = array(
		'edit_post'               => 'edit_section',
		'read_post'               => 'read_section',
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
		'capabilities'        => array(),
		'has_archive'         => true,
		'hierarchical'        => true,
		'supports'            => array( 'title', 'thumbnail', 'editor', 'author', 'page-attributes', 'revisions' ),
		'taxonomies'          => array( 'category' ),
	) );

	//flush_rewrite_rules();
}

/**
 * Register interviews post type
 */
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
	// capabilities for accessing interview post type (not used)
	$capabilities = array(
		'edit_post'               => 'edit_interview',
		'read_post'               => 'read_interview',
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
		'capabilities'        => array(),
		'has_archive'         => true,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'thumbnail', 'editor', 'author', 'revisions' ),
		'taxonomies'          => array( 'category' ),
	) );
}

/**
 * Register interviews post type
 */
function ethnologist_register_aboutus() {
	// labels for aboutus post type
	$labels = array(
			'name'                 => _x( 'About Us', 'About Us general name', 'ethnologist' ),
			'singular_name'        => _x( 'About Us entry', 'About Us singular name', 'ethnologist' ),
			'add_new'              => _x( 'Add New', 'New About Us Entry', 'ethnologist' ),
			'add_new_item'         => __( 'Add New Entry', 'ethnologist' ),
			'edit_item'            => __( 'Edit Entry', 'ethnologist' ),
			'new_item'             => __( 'New Entry', 'ethnologist' ),
			'all_items'            => __( 'All Entries', 'ethnologist' ),
			'view_item'            => __( 'View About Us Entry', 'ethnologist' ),
			'search_items'         => __( 'Search About Us Entry', 'ethnologist' ),
			'not_found'            => __( 'No entries found', 'ethnologist' ),
			'not_found_in_trash'   => __( 'No entries found in Trash', 'ethnologist' ),
			'parent_item_colon'    => '',
			'menu_name'            => __( 'About Us', 'ethnologist' )
	);
	// capabilities for accessing aboutus post type (not used)
	$capabilities = array(
			'edit_post'               => 'edit_aboutus',
			'read_post'               => 'read_aboutus',
			'delete_post'             => 'delete_aboutus',
			'edit_posts'              => 'edit_aboutus',
			'edit_others_posts'       => 'edit_others_aboutus',
			'publish_posts'           => 'publish_aboutus',
			'read_private_posts'      => 'read_private_aboutus',
			'read'                    => 'read',
			'delete_posts'            => 'delete_aboutus',
			'delete_private_posts'    => 'delete_private_aboutus',
			'delete_published_posts'  => 'delete_published_aboutus',
			'delete_others_posts'     => 'delete_others_aboutus',
			'edit_private_posts'      => 'edit_private_aboutus',
			'edit_published_posts'    => 'edit_published_aboutus',
	);
	// register aboutus post type
	register_post_type( 'aboutus',  array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'capability_type'     => 'page',
			'capabilities'        => array(),
			'has_archive'         => true,
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail', 'editor', 'author', 'revisions' ),
			'taxonomies'          => array(),
	) );
}

/**
 * Initialiaze all
 *
 * Action callback - init
 */
function ethnologist_init() {
	ethnologist_register_sections();
	ethnologist_register_interviews();
	ethnologist_register_aboutus();
	ethnologist_editor_manage_users();
}
add_action ( 'init', 'ethnologist_init' );

/**
 * Initialize admin by registering string translations
 *
 * Action callback - admin_init
 */
function ethnologist_admin_init() {
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( 'ethnologist_error', 'Sorry, an error occured.', 'ethnologist' );
		pll_register_string( 'ethnologist_title', 'Ethnologist', 'ethnologist' );
		pll_register_string( 'ethnologist_sub_title', 'Welcome to Ethnologist Site', 'ethnologist' );
		pll_register_string( 'ethnologist_blog_latest_title', 'Latest from the Blog', 'ethnologist' );
		pll_register_string( 'ethnologist_interviews_latest_title', 'Latest from the Interviews', 'ethnologist' );
		pll_register_string( 'ethnologist_section_latest_title', 'Latest from the Sections', 'ethnologist' );
		pll_register_string( 'ethnologist_no_entries', 'Sorry, no entries found.', 'ethnologist' );
		pll_register_string( 'ethnologist_no_sections', 'Sorry, no sections found.', 'ethnologist' );
		pll_register_string( 'ethnologist_posts_newer', 'Newer posts &rarr;', 'ethnologist' );
		pll_register_string( 'ethnologist_posts_older', '&larr; Older posts', 'ethnologist' );
		pll_register_string( 'ethnologist_post_next', 'Next  Post', 'ethnologist' );
		pll_register_string( 'ethnologist_post_prev', 'Previous Post', 'ethnologist' );
		pll_register_string( 'ethnologist_singe_link_pages', 'Pages:', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_form_title', 'Send us an email', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_required_field', 'This field is required.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_enter_valid_email', 'Please enter a valid email address.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_enter_email', 'Please enter your email address.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_email_success', 'The email has been successfully delivered.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_email_error', 'The email sending failed. Please email us directly.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_captcha_math', 'Check your math.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_enter_name', 'Please enter your name.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_email_invalid', 'You entered an invalid email address.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_enter_message', 'Please enter a message.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_email_sent', 'Thanks, your email was sent successfully.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_email_failed', 'Sending email failed.', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_label_email', 'Email', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_label_name', 'Name', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_label_message', 'Message', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_label_location', 'Location', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_label_phone', 'Phone', 'ethnologist' );
		pll_register_string( 'ethnologist_contact_submit_email', 'Send Email', 'ethnologist' );
		pll_register_string( 'ethnologist_post_by', 'by', 'ethnologist' );
		pll_register_string( 'ethnologist_post_with', 'with', 'ethnologist' );
		pll_register_string( 'ethnologist_post_on', 'on', 'ethnologist' );
		pll_register_string( 'ethnologist_post_date', 'ethnologist_post_date', 'ethnologist' );
		pll_register_string( 'ethnologist_post_read_more', 'Read More', 'ethnologist' );
		pll_register_string( 'ethnologist_search', 'Search', 'ethnologist' );
		pll_register_string( 'ethnologist_rights', 'All rights reserved', 'ethnologist' );
		pll_register_string( 'ethnologist_404_top_msg', 'Sorry, but the page you were trying to view does not exist.', 'ethnologist' );
		pll_register_string( 'ethnologist_404_reason_title', 'It looks like this was the result of either:', 'ethnologist' );
		pll_register_string( 'ethnologist_404_reason_1', 'a mistyped address', 'ethnologist' );
		pll_register_string( 'ethnologist_404_reason_2', 'an out-of-date link', 'ethnologist' );
		pll_register_string( 'ethnologist_404_reason_3', 'internal page error', 'ethnologist' );
		pll_register_string( 'ethnologist_404_search', 'Please return back to the homepage or try searching bellow.', 'ethnologist' );
		pll_register_string( 'ethnologist_tag_cloud_title', 'Categories', 'ethnologist' );
		pll_register_string( 'ethnologist_authorbox_tab_about', 'About Author', 'ethnologist' );
		pll_register_string( 'ethnologist_authorbox_tab_posts', 'Latest Posts', 'ethnologist' );
		pll_register_string( 'ethnologist_authorbox_follow', 'Follow', 'ethnologist' );
		pll_register_string( 'ethnologist_authorbox_on', 'on the social', 'ethnologist' );
		pll_register_string( 'ethnologist_authorbox_desc_posts', 'Latest posts from', 'ethnologist' );
		//pll_register_string( 'ethnologist_', '', 'ethnologist' );
	}
}
add_action ( 'admin_init', 'ethnologist_admin_init' );

/**
 * Register a single sidebar
 *
 * @param array $options
 */
function ethnologist_register_sidebar( $options ) {

	register_sidebar( array_merge( $options, array(
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) ) );
}

/**
 * Register all sidebars
 */
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

/**
 * Regester widgets
 */
function ethnologist_register_widgets() {
	require_once __DIR__ . '/inc/widget-base.php';

	require_once __DIR__ . '/inc/widget-contact.php';
	register_widget( 'Ethnologist_Widget_Contact' );

	require_once __DIR__ . '/inc/widget-editors-pick.php';
	register_widget( 'Ethnologist_Widget_EditorsPick' );

	require_once __DIR__ . '/inc/widget-image.php';
	register_widget( 'Ethnologist_Widget_Image' );

	require_once __DIR__ . '/inc/widget-pay-pal-donate.php';
	register_widget( 'Ethnologist_Widget_PayPalDonate' );

	require_once __DIR__ . '/inc/widget-recent-posts.php';
	register_widget( 'Ethnologist_Widget_RecentPosts' );

	require_once __DIR__ . '/inc/widget-social-icons.php';
	register_widget( 'Ethnologist_Widget_SocialIcons' );

	require_once __DIR__ . '/inc/widget-tag-cloud.php';
	register_widget( 'Ethnologist_Widget_TagCloud' );

	// unregister pinnacle widget as we don't need them
	unregister_widget( 'kad_contact_widget' );
	unregister_widget( 'kad_social_widget' );
	unregister_widget( 'kad_recent_posts_widget' );
	unregister_widget( 'kad_post_grid_widget' );
	unregister_widget( 'kad_image_widget' );
}

/**
 * Initialize widget
 *
 * Actions callback - widget_init
 */
function ethnologist_widgets_init() {
	ethnologist_register_sidebars();
	ethnologist_register_widgets();
}
add_action( 'widgets_init', 'ethnologist_widgets_init', 20 );

/**
 * Enqueue styles and scripts
 *
 * Actions callback - wp_enqueue_scripts
 */
function ethnologist_enqueue_scripts() {
	// enqueue ethnologist original pinnacle style
	wp_enqueue_style( 'ethnologist-parent-style', get_template_directory_uri() . '/style.css' );
	// enqueue ethnologist style
	wp_enqueue_style(
		'ethnologist-child-style',
		get_stylesheet_uri(),
		array( 'ethnologist-parent-style' ),
		ETHNOLOGIST_STYLE_VERSION
	);
	// remove duplicated ethnologist style
	wp_dequeue_style( 'pinnacle_child' );

	if ( is_page_template( 'template-contact.php' ) ) {
		wp_enqueue_script( 'ethnologist-contact-script', get_stylesheet_directory_uri() . '/js/contact.js', array( 'jquery' ) );
		wp_enqueue_script( 'ethnologist-validate-ck', get_stylesheet_directory_uri() . '/js/jquery.validate-ck.js', array( 'jquery' ) );
		wp_enqueue_script( 'ethnologist-gmap', 'https://maps.google.com/maps/api/js?sensor=false' );
	}
	if ( is_single() ) {
		wp_enqueue_script( 'ethnologist-youtube-fix', get_stylesheet_directory_uri() . '/js/youtube-fix.js', array( 'jquery' ), 5 );
	}
}
add_action( 'wp_enqueue_scripts', 'ethnologist_enqueue_scripts', 100000 );

// FACEBOOK

require_once __DIR__ . '/inc/class-ethnologist-facebook.php';
add_action( 'wp_head', 'Ethnologist_Facebook::display_header_script' );

// GOOGLE

// AdSense
require_once __DIR__ . '/inc/class-ethnologist-google-ad-sense.php';
add_action( 'wp_head', 'Ethnologist_GoogleAdSense::display_header_script' );

/**
 * Wrapper for like box
 */
function ethnologist_facebook_like_button( $args = array() ) {
	Ethnologist_Facebook::display_like_box( $args );
}

// CONTACT

/**
 * Error for contact email
 * @param string $msg
 * @param string $lang
 */
function ethnologist_contact_email_error( $msg, $lang )
{
	$msg = pll_translate_string( $msg, $lang );
	wp_send_json_error( $msg );
}

/**
 * Send contact email
 *
 * Action callback - wp_ajax_ethnologist_contact_email, wp_ajax_nopriv_ethnologist_contact_email
 */
function ethnologist_contact_email() {
	check_ajax_referer( 'ethnologist_contact_form' );

	$lang = isset( $_POST['lang'] ) ? $_POST['lang'] : 'en';

	// check captcha
	if ( isset( $_POST['kad_captcha'] ) && md5( $_POST['kad_captcha'] ) != $_POST['hval'] ) {
		ethnologist_contact_email_error( 'Check your math.', $lang );
	}

	// check name
	if ( trim( $_POST['contactName'] ) === '' ) {
		ethnologist_contact_email_error( 'Please enter your name.', $lang );
	}

	$name = trim( $_POST['contactName'] );

	// check email
	if ( trim( $_POST['email'] ) === '' )  {
		ethnologist_contact_email_error( 'Please enter your email address.', $lang );
	}
	if ( ! preg_match( "/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim( $_POST['email'] ) ) ) {
		ethnologist_contact_email_error( 'You entered an invalid email address.', $lang );
	}
	$email = trim( $_POST['email'] );

	// check comment
	if ( trim( $_POST['comments'] ) === '') {
		ethnologist_contact_email_error( 'Please enter a message.', $lang );
	}
	$comments = stripslashes( trim( $_POST['comments'] ) );

	if ( defined( 'ETHNOLOGIST_CONTACT_EMAIL' ) ) {
		$email_to = constant( 'ETHNOLOGIST_CONTACT_EMAIL' );
	} else {
		$email_to = get_option( 'admin_email' );
	}

	// email subject
	$subject = sprintf("[%s %s] %s %s", get_bloginfo( 'name' ),
			__( "Contact", "ethnologist" ), __( "From", "ethnologist" ), $name);
	// email body
	$body_parts = array();
	$body_parts[] = __( 'Name',  'ethnologist' ) . ': ' . $name;
	$body_parts[] = __( 'Email', 'ethnologist' ) . ': ' . $email;
	$body_parts[] = __( 'Name',  'ethnologist' ) . ': ' . $comments;
	$body = implode( "\n\n", $body_parts );
	// email headers
	$headers = 'From: ' . $name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email;
	// send email
	if ( ! wp_mail( $email_to, $subject, $body, $headers ) ) {
		ethnologist_contact_email_error( 'Sending email failed.', $lang );
	}

	wp_send_json_success( WP_DEBUG ? array(
			'email_to' => $email_to,
			'subject'  => $subject,
			'body'     => $body,
			'headers'  => $headers,
		) : null );
}
add_action( 'wp_ajax_ethnologist_contact_email', 'ethnologist_contact_email' );
add_action( 'wp_ajax_nopriv_ethnologist_contact_email', 'ethnologist_contact_email' );

/**
 * Set more message
 *
 * Filter callback - excerpt_more
 *
 * @param string $more
 * @return string
 */
function ethnologist_excerpt_more(  ) {
	$readmore =  etn__( 'Read More' );
	return ' &hellip; <a href="' . get_permalink() . '">' . $readmore . '</a>';
}
add_filter( 'excerpt_more', 'ethnologist_excerpt_more', 20 );

/**
 * Modify shortlink
 *
 * Filter callback - get_shortlink
 *
 * @param string  $shortlink
 * @param int     $id
 * @param string  $context
 * @param boolean $allow_slugs
 */
function ethnologist_get_shortlink( $shortlink, $id, $context, $allow_slugs ) {
	if ( $context === 'query' ) {
		return null;
	}
}
add_filter( 'get_shortlink', 'ethnologist_get_shortlink', 20, 4 );

// kadence actions clean up
remove_action( 'init', 'kadence_sidebar_list' );
remove_action( 'widgets_init', 'kadence_register_sidebars' );
// kadence filters clean up
remove_filter('excerpt_length', 'kadence_excerpt_length');
remove_filter('excerpt_more', 'kadence_excerpt_more');

/**
 * Filter for Polylang link translation URL to fix author page link for switcher
 *
 * Filter callback - pll_the_language_link
 *
 * @param string $url
 * @param string $slug
 * @return string
 */
function ethnologist_translation_url( $url, $slug ) {

	if ( empty( $url ) && preg_match( '#/\w{2}(/author/\w+)#', $_SERVER['REQUEST_URI'], $matches ) ) {

		return "/$slug" . $matches[1];
	}

	return $url;
}
add_filter( 'pll_translation_url', 'ethnologist_translation_url', 10, 2 );

/**
 * Filter for Polylang home redirect
 *
 * Filter callback - pll_redirect_home, pll_translation_url, wpseo_opengraph_url,
 *                   post_type_link, post_link, page_link, home_url
 *
 * @param string $url
 * @return string
 */
function ethnologist_url( $url ) {

	return str_replace( parse_url( $url, PHP_URL_HOST ), $_SERVER['SERVER_NAME'], $url );
}
add_filter( 'pll_redirect_home', 'ethnologist_url', 10, 1 );
add_filter( 'pll_translation_url', 'ethnologist_url', 10, 1 );
add_filter( 'wpseo_opengraph_url', 'ethnologist_url', 10, 1 );
add_filter( 'post_type_link', 'ethnologist_url', 10, 1 );
add_filter( 'post_link', 'ethnologist_url', 10, 1 );
add_filter( 'page_link', 'ethnologist_url', 10, 1 );
//add_filter( 'attachment_link', 'ethnologist_url', 10, 1 );
add_filter( 'home_url', 'ethnologist_url', 10, 1 );


/*
 *  disable feed links
 */
// Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links_extra', 3 );
// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'feed_links', 2 );
// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );
// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wlwmanifest_link' );
// Display the index link.
remove_action( 'wp_head', 'index_rel_link' );
// Display the prev link.
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Display the start link.
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
// Display the XHTML generator that is generated on the wp_head hook, WP version.
remove_action( 'wp_head', 'wp_generator' );


/**
 * Filter error warning for deprecated constructor
 */
function ethnologist_deprecated_constructor_trigger_error() {

	$const_name = "ETHNOLOGIST_SHOW_DEPRECATED_WIDGET_CONSTRUCTOR_ERROR";
	if ( ( defined( $const_name ) && constant( $const_name ) ) ) {
		echo "<pre>";
		print_r(debug_backtrace());
		echo "</pre>";

		return true;
	}

	return false;
}
add_filter( 'deprecated_constructor_trigger_error',
		'ethnologist_deprecated_constructor_trigger_error' );


require_once __DIR__ . '/inc/class-ethnologist-author-box.php';

/**
 * Print author box
 */
function ethnologist_author_box() {
	Ethnologist_AuthorBox::display_author_box();
}

/**
 * Print author content
 */
function ethnologist_author_content() {
	global $wp_query;

	$field_name = 'content_' . pll_current_language();
	$author_id = get_the_author_meta( 'ID' );
	echo get_field( $field_name, 'user_' . $author_id );
}

/**
 * Get author link (content of href for author)
 *
 * @return string
 */
function ethnologist_author_href() {

	return esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
}

/**
 * Whether to show if post should show date
 */
function ethnologist_post_with_date() {

	if ( get_post_type() !== 'section' ) {

		return true;
	}

	return ! get_field( 'subhead_hide_date' );
}

/**
 * Page titles
 */
function ethnologist_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			echo get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			etn_e( 'Latest Posts' );
		}
	} elseif ( is_archive() ) {
		$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
		if ( $term ) {
			echo $term->name;
		} elseif ( is_post_type_archive() ) {
			echo get_queried_object()->labels->name;
		} elseif ( is_day() ) {
			echo etn__( 'Daily Archives:' ) . ' ' . get_the_date();
		} elseif ( is_month() ) {
			echo etn__( 'Monthly Archives:' ) . ' ' . get_the_date('F Y');
		} elseif ( is_year() ) {
			echo etn__( 'Yearly Archives:' ) . ' ' . get_the_date('Y');
		} elseif ( is_author() ) {
			echo etn__( 'Author Archives:' ) . ' ' . get_the_author();
		} else {
			single_cat_title();
		}
	} elseif (is_search()) {
		echo etn__( 'Search Results for' ) . ' ' . get_search_query();
	} elseif (is_404()) {
		etn_e( 'Not Found' );
	} else {
		the_title();
	}
}

/**
 * Page subtitles
 */
function ethnologist_subtitle() {
	global $post;

	$before = '<div class="subtitle">';
	$after = '</div>';

	if ( is_page() ) {
		$bsub = get_post_meta( $post->ID, '_kad_subtitle', true );
	} else if ( is_category() ) {
		$bsub = category_description();
	} else if ( is_tag() ) {
		$bsub = tag_description();
	} else {
		return;
	}

	echo $before . $bsub . $after;
}

/**
 * Print author avatar
 */
function ethnologist_author_avatar( $size = 100) {
	$author_id = get_the_author_meta( 'ID' );
	if ( ! $author_id ) {
		return;
	}

	$photo = get_field( 'photo', 'user_'. $author_id );
	if ( ! $photo ) {
		echo get_avatar( get_the_author_meta( 'ID' ), $size);
		return;
	}

	echo '<img class="avatar pull-left media-object avatar-100 photo"' .
			' width="' . $size . '" height="' . $size . '" src="' .
			$photo['url'] . '" alt="' . $photo['alt']. '" />';
}

/**
 * Get author query args
 *
 * @return array
 */
function ethnologist_author_query_args() {
	return array(
		'post_type'      => array( 'post', 'page', 'interview', 'section' ),
		'author_name'    => get_query_var( 'author_name' ),
		'posts_per_page' => 1,
		'lang'           => get_query_var( 'lang' ),
	);
}

/**
 * Check if page has sidebar
 *
 * @todo Rid of kadence checks
 */
function ethnologist_sidebar_page() {
	if ( is_page() &&
			!is_page_template('template-sidebar-page.php') &&
			!is_page_template('template-portfolio-grid.php') &&
			!is_page_template('template-journal.php') &&
			!is_page_template('template-contact.php') ) {
		global $post;

		$postsidebar = get_post_meta( $post->ID, '_kad_page_sidebar', true );

		return $postsidebar != 'yes';
	} else {
		return false;
	}
}

/**
 * Check which pages should not have sidebar
 *
 * @todo Rid of kadence calls and all unused stuff (e.g. portfolio)
 */
function ethnologist_display_sidebar() {

	if ( ethnologist_sidebar_page() ||
			kadence_sidebar_on_post() ||
			is_404() ||
			kadence_sidebar_on_home_page() ||
			is_singular( 'portfolio' ) ||
			is_singular( 'kadslider' ) ||
			is_tax( 'portfolio-type' ) ||
			is_page_template( 'template-portfolio-grid.php' ) ||
			is_page_template( 'template-contact.php' ) ) {

		return false;
	}

	return true;
}

/**
 * Get main ethnologist class
 *
 * @return string
 */
function ethnologist_main_class() {
	if ( ethnologist_display_sidebar() ) {
		// with sidebar
		return 'col-lg-9 col-md-8 kt-sidebar';
	}

	// without sidebar
	return 'col-md-12 kt-nosidebar';
}

/**
 * Get sidebar classes
 *
 * @return string
 */
function ethnologist_sidebar_class() {

	return 'col-lg-3 col-md-4';
}

/**
 * Whether ethnologist is displayed on mobile
 *
 * @return boolean
 */
function ethnologist_is_mobile() {

	require_once __DIR__ . '/inc/class-ethnologist-mobile-detect.php';

	if ( defined( 'ETHNOLOGIST_USE_MOBILE' ) && constant( 'ETHNOLOGIST_USE_MOBILE' ) ) {
		$mobile_detecte = new Ethnologist_Mobile_Detect();

		return $detect->isMobile() && !$detect->isTablet();
	}

	return false;
}

/**
 * Get src for ethnologist post thumbnail
 *
 * @param int $width
 * @param int $height
 */
function ethnologist_thumbnail_src( $width, $height ) {
	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		$image_width = 382;
		$image_height = 255;
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$thumbnailURL = $image_url[0];
		$image = aq_resize( $thumbnailURL, $image_width, $image_height, true );
		if ( empty($image) ) {
			$image = $thumbnailURL;
		}
	} else {
		$image = pinnacle_img_placeholder();
	}

	return esc_attr( $image );
}
