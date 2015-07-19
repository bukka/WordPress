<?php

require_once __DIR__ . '/class-ethnologist-single.php';

/**
 * Ethnologist Single Interview class
 */
class Ethnologist_SingleInterview extends Ethnologist_Single
{
	/**
	 * Get content template part
	 *
	 * @return string
	 */
	protected function get_content_template_part() {
		return 'single-interview';
	}
}