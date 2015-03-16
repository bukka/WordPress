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
}