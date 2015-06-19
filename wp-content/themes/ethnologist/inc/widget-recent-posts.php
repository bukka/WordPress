<?php
/**
 * Recent Posts Widget
 */
class Ethnologist_Widget_RecentPosts extends WP_Widget {

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'kadence_recent_posts',
			'description' => __( 'This shows the most recent posts on your site with a thumbnail', 'ethnologist' )
		);
		parent::__construct(
				'kadence_recent_posts',
				__('Ethnologist: Recent Posts', 'ethnologist'),
				$widget_ops
		);
		$this->alt_option_name = 'ethnologist_widget_recent_posts';

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
		$cache = wp_cache_get( 'ethnologist_widget_recent_posts', 'widget' );

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
			empty($instance['title']) ? __( 'Recent Posts', 'ethnologist' ) : $instance['title'],
			$instance,
			$this->id_base
		);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;

		$query = new WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'category_name'       => $instance['thecate'],
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true
				)
			)
		);

		if ( $query->have_posts() ) {
			echo $before_widget;

			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			ethnologist_view( 'widget', 'recent-posts-widget', array( 'query' => $query ) );

			echo $after_widget;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		}

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
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thecate'] = $new_instance['thecate'];
		$this->flush_widget_cache();

		return $instance;
	}

	/**
	 * Flush widget cache
	 */
	function flush_widget_cache() {
		wp_cache_delete( 'ethnologist_widget_recent_posts', 'widget' );
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 * @return string Default return is 'noform'.
	 * @see WP_Widget::form()
	 */
	function form( $instance ) {

		$params = array(
			'title'   => isset($instance['title'])   ? esc_attr($instance['title'])   : '',
			'number'  => isset($instance['number'])  ? absint($instance['number'])    : 5,
			'thecate' => isset($instance['thecate']) ? esc_attr($instance['thecate']) : '',
		);

		ethnologist_view( 'widget', 'recent-posts-form', $params, $this );
	}
}