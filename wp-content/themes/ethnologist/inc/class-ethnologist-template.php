<?php

/**
 * Ethnologist Template class
 */
class Ethnologist_Template
{
	/**
	 * Render template
	 */
	public function render() {
		global $post, $wp_query, $paged;

		get_header();
		get_template_part('templates/page', 'header');

		$params = array();

		if ( kadence_display_sidebar() ) {
			$params['display_sidebar'] = true;
			$fullclass = '';
		} else {
			$params['disaplay_sidebar'] = false;
			$fullclass = 'fullwidth';
		}

		if( get_post_meta( $post->ID, '_kad_blog_summery', true ) == 'full' ) {
			$params['summery'] = 'full';
			$postclass = "single-article fullpost";
		} else {
			$params['summery']= 'normal';
			$postclass = 'postlist';
		}

		$params['main_class'] = kadence_main_class() . ' ' . $postclass . ' ' . $fullclass;
		$params['query'] = new WP_Query(array(
			'paged'          => $paged,
			'posts_per_page' => 10,
			'post_type'      => $this->get_post_type(),
		) );
		$params['not_found_msg'] = $this->get_not_found_message();

		ethnologist_view( 'template', 'content', $params );

		get_footer();

	}

	/**
	 * Get post type
	 *
	 * @return string
	 */
	protected function get_post_type() {
		return 'post';
	}

	/**
	 * Get message when there are no items
	 *
	 * @return string
	 */
	protected function get_not_found_message() {
		return pll__( 'Sorry, no entries found.' );
	}
}