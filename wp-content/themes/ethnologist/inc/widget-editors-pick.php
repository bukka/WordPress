<?php
/**
 * Editor's pick widget
 */
class Ethnologist_Widget_EditorsPick extends Ethnologist_Widget_Base {

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
	protected $view_name = 'editors-pick';


	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_EditorsPick',
			'description' => __( 'Editor\'s pick.', 'ethnologist' )
		);

		parent::__construct(
			'ethnologist_widget_editors_pick',
			__( 'Ethnologist: Editor\'s pick', 'ethnologist' ),
			$widget_ops
		);
	}

	/**
	 * Instance params filter for widget
	 *
	 * @param array $params
	 * @return array
	 */
	protected function filter_widget_params( $params )
	{
		$params['post'] = empty( $params['post_id'] ) ? false : get_post( $params['post_id'] );

		return $params;
	}

	/**
	 * Instance params filter for form
	 *
	 * @param array $params
	 * @return array
	 */
	protected function filter_form_params( $params )
	{
		$params['query_args'] = array(
			'post_type'      => array('post', 'section', 'interview'),
			'posts_per_page' => 50,
		);

		return $params;
	}
}
