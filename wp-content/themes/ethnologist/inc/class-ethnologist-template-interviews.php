<?php

require_once __DIR__ . '/class-ethnologist-template.php';

/**
 * Ethnologist Template Interviews class
 */
class Ethnologist_TemplateInterviews extends Ethnologist_Template
{
	/**
	 * Get post type
	 *
	 * @return string
	 */
	protected function get_post_type() {
		return 'interview';
	}

	/**
	 * Get message when there are no items
	 *
	 * @return string
	 */
	protected function get_not_found_message() {
		return pll__( 'Sorry, no interviews found.' );
	}
}