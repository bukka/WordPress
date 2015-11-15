<?php

/**
 * Ethnologist Front Page class
 */
class Ethnologist_FrontPage
{
	const LIST_ITEMS_COUNT = 3;

	/**
	 * Possible grid styels (key is items count
	 */
	private $grid_styles = array(
		2 => 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12',
		3 => 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12',
		4 => 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12',
	);

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
				$this->get_list( 'Latest from the Blog', 'post' ),
				$this->get_list( 'Latest from the Interviews', 'interview' ),
				$this->get_list( 'Latest from the Sections', 'section' ),
			)
		);

		ethnologist_view( 'front', 'page', $params );

		get_footer();
	}

	private function get_list( $title, $post_type ) {
		return array(
			'title'      => pll__( $title ),
			'animate'    => 0,
			'grid_style' => $this->grid_styles[self::LIST_ITEMS_COUNT],
			'query_args' => array(
				'posts_per_page' => self::LIST_ITEMS_COUNT,
				'post_type'      => $post_type,
			),
		);
	}
}