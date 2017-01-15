<?php
/**
 * Google AdSense widget
 */
class Ethnologist_Widget_GoogleAdSense extends WP_Widget {

	/**
	 * Instance keys
	 *
	 * @var array
	 */
	protected $instance_keys = array(
		'title',
		'post_id',
	);

	/**
	 * View name
	 *
	 * @var string
	 */
	protected $view_name = 'google-adsense';

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_GoogleAdSense',
			'description' => __( 'Google AdSense.', 'ethnologist' )
		);

		parent::__construct(
			'ethnologist_widget_google_adsense',
			__( 'Ethnologist: Google AdSense', 'ethnologist' ),
			$widget_ops
		);
	}
}
