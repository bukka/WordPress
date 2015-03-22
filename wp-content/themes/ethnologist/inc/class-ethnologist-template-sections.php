<?php

require_once __DIR__ . '/class-ethnologist-template.php';

/**
 * Ethnologist Template Sections class
 */
class Ethnologist_TemplateSections extends Ethnologist_Template
{
	/**
	 * Get post type
	 *
	 * @return string
	 */
	protected function get_post_type() {
		return 'section';
	}

	/**
	 * Get message when there are no items
	 *
	 * @return string
	 */
	protected function get_not_found_message() {
		return __( 'Sorry, no sections found.', 'ethnologist' );
	}
}