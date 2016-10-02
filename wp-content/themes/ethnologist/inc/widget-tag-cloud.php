<?php
/**
 * Tag Cloud Widget
 */
class Ethnologist_Widget_TagCloud extends WP_Widget {

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'Ethnologist_Widget_TagCloud',
			'description' => __( 'This shows tag cloud', 'ethnologist' )
		);
		parent::__construct(
				'ethnologist_widget_tag_cloud',
				__( 'Ethnologist: Tag Cloud', 'ethnologist' ),
				$widget_ops
		);
		$this->alt_option_name = 'ethnologist_widget_tag_cloud';

		add_action( 'save_post', array( $this, 'flush_widget_cache') );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * Show widget
	 *
	 * @see WP_Widget::widget()
	 */
	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'ethnologist_widget_tag_cloud', 'widget' );

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters(
			'widget_title',
			empty($instance['title']) ? __( 'Tag cloud', 'ethnologist' ) : $instance['title'],
			$instance,
			$this->id_base
		);

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo wp_tag_cloud(['taxonomy' => 'category']);

		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'ethnologist_widget_recent_posts', $cache, 'widget' );
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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$this->flush_widget_cache();

		return $instance;
	}

	/**
	 * Flush widget cache
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'ethnologist_widget_tag_cloud', 'widget' );
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 * @return string Default return is 'noform'.
	 * @see WP_Widget::form()
	 */
	public function form( $instance ) {

		$params = array(
			'title'   => isset($instance['title'])   ? esc_attr($instance['title'])   : '',
		);

		ethnologist_view( 'widget', 'tag-cloud-form', $params, $this );
	}
}