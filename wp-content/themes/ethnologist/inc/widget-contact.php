<?php
/**
 * Contact widget
 */
class Ethnologist_Widget_Contact extends Ethnologist_Widget_Base {

	/**
	 * Instance keys
	 *
	 * @var array
	 */
	protected $instance_keys = array(
		'title',
		'company',
		'name',
		'street_address',
		'locality',
		'region',
		'postal_code',
		'tel',
		'fixedtel',
		'email',
	);

	/**
	 * View name
	 *
	 * @var string
	 */
	protected $view_name = 'contact';

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_Contact',
			'description' => __( 'Use this widget to add a Vcard to your site', 'ethnologist' )
		);

		parent::__construct(
			'ethnologist_widget_contact',
			__( 'Ethnologist: Contact/Vcard', 'ethnologist' ),
			$widget_ops
		);
	}
}