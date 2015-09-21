<?php

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

function ethnologist_navmenu_register() {
	require_once 'inc/class-ethnologist-nav-menus.php';
	$nav_menus = new Ethnologist_NavMenus();
	$nav_menus->register()->update( true );
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

/*
 * Let Editors manage users, and run this only once.
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

		update_option( 'ethnologist_add_cap_editor_once', 'v1' );
	}
}

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
		'taxonomies'          => array( 'mm' ),
	) );

	//flush_rewrite_rules();
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
		'taxonomies'          => array( 'mm' ),
	) );
}

function ethnologist_init() {
	ethnologist_register_sections();
	ethnologist_register_interviews();
	ethnologist_editor_manage_users();
}
add_action ( 'init', 'ethnologist_init' );

function ethnologist_admin_init() {
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( 'ethnologist_error', 'Sorry, an error occured.', 'ethnologist' );
		pll_register_string( 'ethnologist_title', 'Ethnologist', 'ethnologist' );
		pll_register_string( 'ethnologist_sub_title', 'Welcome to Ethnologist Site', 'ethnologist' );
		pll_register_string( 'ethnologist_blog_latest_title', 'Latest from the Blog', 'ethnologist' );
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
		//pll_register_string( '', '', 'ethnologist' );
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

function ethnologist_register_widgets() {
	require_once __DIR__ . '/inc/widget-contact.php';
	register_widget( 'Ethnologist_Widget_Contact' );

	require_once __DIR__ . '/inc/widget-recent-posts.php';
	register_widget( 'Ethnologist_Widget_RecentPosts' );
}

function ethnologist_widgets_init() {
	ethnologist_register_sidebars();
	ethnologist_register_widgets();
}
add_action ( 'widgets_init', 'ethnologist_widgets_init' );


function ethnologist_enqueue_scripts() {
	wp_enqueue_style( 'ethnologist-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ethnologist-child-style', get_stylesheet_uri(), array( 'parent-style' ) );

	if ( is_page_template( 'template-contact.php' ) ) {
		wp_enqueue_script( 'ethnologist-contact-script', get_stylesheet_directory_uri() . '/js/contact.js', array( 'jquery' ) );
		wp_enqueue_script( 'ethnologist-validate-ck', get_stylesheet_directory_uri() . '/js/jquery.validate-ck.js', array( 'jquery' ) );
		wp_enqueue_script( 'ethnologist-gmap', 'https://maps.google.com/maps/api/js?sensor=false' );
	}
}
add_action( 'wp_enqueue_scripts', 'ethnologist_enqueue_scripts' );

function ethnologist_contact_email_error( $msg, $lang )
{
	$msg = pll_translate_string( $msg, $lang );
	wp_send_json_error( $msg );
}

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
 * @param string $more
 * @return string
 */
function ethnologist_excerpt_more($more) {
	$readmore =  pll__( 'Read More' );
	return ' &hellip; <a href="' . get_permalink() . '">' . $readmore . '</a>';
}
add_filter( 'excerpt_more', 'ethnologist_excerpt_more', 20 );

/**
 * Modify shortlink
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
 * Filter for Polylang lanuguage link to fix author page link for switcher
 * @param string $url
 * @param string $slug
 * @param string $locale
 * @return string
 */
function ethnologist_language_link( $url, $slug, $locale ) {

	if ( preg_match( '#/\w{2}(/author/\w+)#', $url, $matches) ) {
		return "/$slug" . $matches[1];
	}
	return $url;
}
add_filter( 'pll_the_language_link', 'ethnologist_language_link', 10, 3 );

/**
 * Filter for Polylang home redirect
 * @param string $url
 * @return string
 */
function ethnologist_url( $url ) {

	return str_replace(parse_url($url, PHP_URL_HOST), $_SERVER['SERVER_NAME'], $url);
}
add_filter( 'pll_redirect_home', 'ethnologist_url', 10, 1 );
add_filter( 'wpseo_opengraph_url', 'ethnologist_url', 10, 1 );
add_filter( 'post_type_link', 'ethnologist_url', 10, 1 );
add_filter( 'post_link', 'ethnologist_url', 10, 1 );
add_filter( 'page_link', 'ethnologist_url', 10, 1 );

// disable feed links
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version


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
 * Page titles
 */
function ethnologist_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			echo get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			pll_e( 'Latest Posts' );
		}
	} elseif ( is_archive() ) {
		$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
		if ( $term ) {
			echo $term->name;
		} elseif ( is_post_type_archive() ) {
			echo get_queried_object()->labels->name;
		} elseif ( is_day() ) {
			echo pll__( 'Daily Archives:' ) . ' ' . get_the_date();
		} elseif ( is_month() ) {
			echo pll__( 'Monthly Archives:' ) . ' ' . get_the_date('F Y');
		} elseif ( is_year() ) {
			echo pll__( 'Yearly Archives:' ) . ' ' . get_the_date('Y');
		} elseif ( is_author() ) {
			echo pll__( 'Author Archives:' ) . ' ' . get_the_author();
		} else {
			single_cat_title();
		}
	} elseif (is_search()) {
		echo pll__( 'Search Results for' ) . ' ' . get_search_query();
	} elseif (is_404()) {
		pll_e( 'Not Found' );
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
function ethnologist_author_avatar() {
	$author_id = get_the_author_meta( 'ID' );
	if ( ! $author_id ) {
		return;
	}

	$photo = get_field( 'photo', 'user_'. $author_id );
	if ( ! $photo ) {
		echo get_avatar( get_the_author_meta( 'ID' ), 100 );
		return;
	}

	echo '<img class="avatar pull-left media-object avatar-100 photo"' .
			' width="100" height="100" src="' . $photo['url'] . '" alt="' . $photo['alt']. '" />';
}

function ethnologist_author_query_args() {
	return array(
		'post_type' => array( 'post', 'page', 'interview', 'section' ),
		'author_name' => get_query_var('author_name'),
		'posts_per_page' => 1,
		'lang' => get_query_var('lang'),
	);
}
