<?php
/**
 * Social Icons widget
 */
class Ethnologist_Widget_SocialIcons extends WP_Widget {

	/**
	 * Sacial types
	 *
	 * @var array
	 */
	public $types = array(
		'facebook'   => 'Facebook',
		'twitter'    => 'Twitter',
		'instagram'  => 'Instagram',
		'googleplus' => 'GooglePlus',
		'flickr'     => 'Flickr',
		'vimeo'      => 'Vimeo',
		'youtube'    => 'YouTube',
		'pinterest'  => 'Pinterest',
		'dribbble'   => 'Dribble',
		'linkedin'   => 'LinkedIn',
		'tumblr'     => 'Tumblr',
		'vk'         => 'VK',
		'rss'        => 'RSS',
	);

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_SocialIcons',
			'description' => __( 'Simple way to add Social Icons', 'ethnologist' )
		);

		parent::__construct(
			'ethnologist_widget_social_icons',
			__( 'Ethnologist: Social Icons', 'ethnologist' ),
			$widget_ops
		);

		$this->alt_option_name = 'ethnologist_widget_social_icons';

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
		$cache = wp_cache_get( 'ethnologist_widget_social_icons', 'widget' );

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

		$title = apply_filters(
				'widget_title',
				!isset($instance['title']) ? '' : $instance['title'],
				$instance,
				$this->id_base
		);
		foreach ( $this->types as $type_ident => $type_name ) {
			if ( ! isset( $instance[$type_ident] ) ) {
				$instance[$type_ident] = '';
			}
		}

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		echo $before_widget;
		if ( $title ) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}

		$params = array('instance' => $instance, 'types' => $this->types );
		ethnologist_view( 'widget', 'social-icons-widget', $params );

		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'ethnologist_widget_social_icons', $cache, 'widget' );
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
		foreach ( $this->types as $type_ident => $type_name ) {
			$instance[$type_ident] = strip_tags( $new_instance[$type_ident] );
		}

		$this->flush_widget_cache();

    	return $instance;
	}

	/**
	 * Flush widget cache action
	 */
	function flush_widget_cache() {
		wp_cache_delete( 'ethnologist_widget_social_icons', 'widget');
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
		$params['title'] = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		foreach ( $this->types as $type_ident => $type_name ) {
			$params[$type_ident] = isset( $instance[$type_ident] ) ?
				esc_attr( $instance[$type_ident] ) : '';
		}

		ethnologist_view( 'widget', 'social-icons-form', $params, $this );
	}
}
