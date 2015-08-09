<?php

require_once __DIR__ . '/class-ethnologist-template-listing.php';

/**
 * Ethnologist Template Sections class
 */
class Ethnologist_TemplateSections extends Ethnologist_TemplateListing
{
	/**
	 * Get query params
	 *
	 * @return array
	 */
	protected function get_query_params() {
		return array_merge(parent::get_query_params(), array(
			'post_parent' => 0,
			'orderby'     => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
		));
	}

	/**
	 * Get post type
	 *
	 * @return string
	 */
	protected function get_post_type() {
		return 'section';
	}

	/**
	 * Get content template part
	 *
	 * @return string
	 */
	protected function get_content_template_part() {
		return 'fullwidth-section';
	}

	/**
	 * Get message when there are no items
	 *
	 * @return string
	 */
	protected function get_not_found_message() {
		return pll__( 'Sorry, no sections found.' );
	}
}