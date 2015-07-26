<?php

/**
 * Ethnologist Single class
 */
class Ethnologist_Single
{
	/**
	 * Render single page
	 */
	public function render() {
		get_header();
		get_template_part( 'templates/blog', 'post-header' );

		$params = $this->get_params();

		ethnologist_view( 'single', 'content', $params );

		get_footer();
	}

	/**
	 * Get parameters for view
	 */
	protected function get_params() {
		return array(
			'content_template_part' => $this->get_content_template_part()
		);
	}

	/**
	 * Get content template part
	 *
	 * @return string
	 */
	protected function get_content_template_part() {
		return 'single';
	}
}