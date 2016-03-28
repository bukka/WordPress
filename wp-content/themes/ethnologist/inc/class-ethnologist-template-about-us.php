<?php

require_once __DIR__ . '/class-ethnologist-grid.php';

/**
 * Ethnologist Template About Us class
 */
class Ethnologist_TemplateAboutUs extends Ethnologist_Grid
{
	/**
	 * Render single page
	 */
	public function render() {
		get_header();
		get_template_part( 'templates/blog', 'post-header' );

		$list = $this->get_list( 'About Us', 'aboutus' );
		ethnologist_view( 'template', 'aboutus', array( 'list' => $list ) );

		get_footer();
	}

	/**
	 * Get grid template part name
	 *
	 * @return string
	 */
	protected function get_grid_template() {
		return 'grid-aboutus';
	}
}