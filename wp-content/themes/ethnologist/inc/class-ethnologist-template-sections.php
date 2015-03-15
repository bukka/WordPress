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
}