<?php

require_once __DIR__ . '/class-ethnologist-template-listing.php';

/**
 * Ethnologist Template Interviews class
 */
class Ethnologist_TemplateInterviews extends Ethnologist_TemplateListing
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
	 * Get content template part
	 *
	 * @return string
	 */
	protected function get_content_template_part() {
		return 'fullwidth-interview';
	}


	/**
	 * Get message when there are no items
	 *
	 * @return string
	 */
	protected function get_not_found_message() {
		return etn__( 'Sorry, no interviews found.' );
	}
}