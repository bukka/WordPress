<?php
/**
 * Google AdSense widget
 */
class Ethnologist_Widget_PayPalDonate extends Ethnologist_Widget_Base {

	/**
	 * Instance keys
	 *
	 * @var array
	 */
	protected $instance_keys = array(
		'title',
		'business',
		'name',
		'number',
		'currency'
	);

	/**
	 * View name
	 *
	 * @var string
	 */
	protected $view_name = 'paypal-donate';

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_PayPalDonate',
			'description' => __( 'PayPal Donate Button.', 'ethnologist' )
		);

		parent::__construct(
			'ethnologist_widget_google_adsense',
			__( 'Ethnologist: PayPal Donate', 'ethnologist' ),
			$widget_ops
		);
	}
}
