<?php
/**
 * Base widget that is a parent for all Ethnologist widgets
 */
class Ethnologist_Widget_Base extends WP_Widget {

	/**
	 * Instance keys
	 *
	 * @var array
	 */
	protected $instance_keys = array();


	/**
	 * View name
	 *
	 * @var string
	 */
	protected $view_name;


	/**
	 * PHP5 constructor.
	 *
	 * @param string $id_base         Optional Base ID for the widget, lowercase and unique. If left empty,
	 *                                a portion of the widget's class name will be used Has to be unique.
	 * @param string $name            Name for the widget displayed on the configuration page.
	 * @param string $template_name    Name of the template
	 * @param array  $widget_options  Optional. Widget options. See wp_register_sidebar_widget() for information
	 *                                on accepted arguments. Default empty array.
	 */
	public function __construct( $id_base, $name, $widget_options = array() ) {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_Contact',
			'description' => __( 'Use this widget to add a Vcard to your site', 'ethnologist' )
		);

		parent::__construct( $id_base, $name, $widget_options );

		$this->alt_option_name = $id_base;

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Instance params filter for widget
	 *
	 * @param array $params
	 * @return array
	 */
	protected function filter_widget_params( $params )
	{
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
		return $params;
	}

	/**
	 * Show widget
	 *
	 * @see WP_Widget::widget()
	 */
	public function widget( $args, $instance ) {
		$cache = wp_cache_get( $this->id_base, 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = null;
		}

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args, EXTR_SKIP );

		foreach ( $this->instance_keys as $instance_key ) {
			if ( ! isset( $instance[$instance_key] ) ) {
				$instance[$instance_key] = '';
			}
		}

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title ) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}

		if ( $this->view_name !== null ) {
			ethnologist_view( 'widget', $this->view_name . '-widget', $this->filter_widget_params( $instance ) );
		}

		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( $this->id_base, $cache, 'widget' );
	}

	/**
	 * Update widget
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            {@see WP_Widget::form()}.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 * @see WP_Widget::update()
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		foreach ( $this->instance_keys as $instance_key ) {
			$instance[$instance_key] =  strip_tags( $new_instance[$instance_key] );
		}

		$this->flush_widget_cache();

    	return $instance;
	}

	/**
	 * Flush widget cache action
	 */
	function flush_widget_cache() {
		wp_cache_delete( $this->id_base, 'widget' );
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 * @return string Default return is 'noform'.
	 * @see WP_Widget::form()
	 */
	function form($instance) {

		// set params
		$params = array();
		foreach ( $this->instance_keys as $instance_key ) {
			$params[$instance_key] = isset( $instance[$instance_key] ) ?
				esc_attr( $instance[$instance_key] ) : '';
		}

		if ( $this->view_name !== null ) {
			ethnologist_view( 'widget', $this->view_name . '-form', $this->filter_form_params( $params ), $this );
		}
	}
}