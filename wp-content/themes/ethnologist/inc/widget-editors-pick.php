<?php
/**
 * Editor's pick widget
 */
class Ethnologist_Widget_EditorsPick extends WP_Widget {

	private $instance_keys = array(
		'title',
		'post_id',
	);

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

		$this->alt_option_name = 'ethnologist_widget_editors_pick';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Show widget
	 *
	 * @see WP_Widget::widget()
	 */
	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'ethnologist_widget_editors_pick', 'widget' );

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

		ethnologist_view( 'widget', 'editors-pick-widget', $instance );

		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'ethnologist_widget_editors_pick', $cache, 'widget' );
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
			$instance[$instance_key] =  strip_tags( $new_instance[$instance_key] );;
		}

        $this->flush_widget_cache();

        return $instance;
	}

	/**
	 * Flush widget cache action
	 */
	function flush_widget_cache() {
		wp_cache_delete( 'ethnologist_widget_editors_pick', 'widget');
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 * @return string Default return is 'noform'.
	 * @see WP_Widget::form()
	 */
	function form( $instance ) {
		// set params
		$params = array();
		foreach ( $this->instance_keys as $instance_key ) {
			$params[$instance_key] = isset( $instance[$instance_key] ) ?
				esc_attr( $instance[$instance_key] ) : '';
		}

		ethnologist_view( 'widget', 'editors-pick-form', $params, $this );
	}
}
