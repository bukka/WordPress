<?php

require_once __DIR__ . '/class-ethnologist-grid.php';

/**
 * Ethnologist Front Page class
 */
class Ethnologist_FrontPage extends Ethnologist_Grid
{
	const LIST_ITEMS_COUNT = 3;

	/**
	 * Render single page
	 */
	public function render() {
		get_header();

		if ( ethnologist_is_mobile() )
			get_template_part( 'templates/mobile_home/page-title', 'mhome' );
		else
			get_template_part( 'templates/home/page-title', 'home' );

		$params = array(
			'lists' => array(
				$this->get_list( 'Latest from the Blog', 'post', self::LIST_ITEMS_COUNT ),
				$this->get_list( 'Latest from the Interviews', 'interview', self::LIST_ITEMS_COUNT ),
				$this->get_list( 'Latest from the Sections', 'section', self::LIST_ITEMS_COUNT ),
			)
		);

		ethnologist_view( 'front', 'page', $params );

		get_footer();
	}
}