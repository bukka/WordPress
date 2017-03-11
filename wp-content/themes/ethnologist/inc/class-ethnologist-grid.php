<?php

/**
 * Ethnologist Grid class
 */
class Ethnologist_Grid
{
	/**
	 * Possible grid styels (key is items count
	 */
	private $grid_styles = array(
		2 => 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12',
		3 => 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12',
		4 => 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12',
	);

	/**
	 * Get list info
	 *
	 * @param string $title
	 * @param string $post_type
	 * @param int $items_count
	 * @param int $grid_style
	 */
	protected function get_list( $title, $post_type, $items_count = -1, $grid_style = 3 ) {

		return array(
			'title'      => etn__( $title ),
			'template'   => $this->get_grid_template(),
			'animate'    => 0,
			'grid_style' => $this->grid_styles[$grid_style],
			'query_args' => array(
				'posts_per_page' => $items_count,
				'post_type'      => $post_type,
			),
		);
	}

	/**
	 * Get grid template part name
	 *
	 * @return string
	 */
	protected function get_grid_template() {
		return 'grid-post';
	}
}