<?php

/**
 * Ethnologist Template Journal class
 */
class Ethnologist_TemplateJournal
{
	/**
	 * Render single page
	 */
	public function render() {
		get_header();
		get_template_part( 'templates/blog', 'post-header' );

		ethnologist_view( 'template', 'journal' );

		get_footer();
	}
}