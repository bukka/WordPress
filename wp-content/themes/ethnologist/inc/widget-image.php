<?php
/**
 * Image widget
 */
class Ethnologist_Widget_Image extends WP_Widget {

	/**
	 * Widget constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ethnologist_Widget_Image',
			'description' => __( 'Image and a simple about text.', 'ethnologist' )
		);

		parent::__construct(
			'ethnologist_widget_image',
			__( 'Ethnologist: Image', 'ethnologist' ),
			$widget_ops
		);

		$this->alt_option_name = 'ethnologist_widget_image';

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
		extract( $args );

		if ( ! empty( $instance['image_link_open'] ) && $instance['image_link_open'] == "none") {
			$uselink = false;
			$link = '';
			$linktype = '';
		} else if ( empty( $instance['image_link_open'] ) || $instance['image_link_open'] == "lightbox") {
			$uselink = true;
			$link = esc_url( $instance['image_uri'] );
			$linktype = 'rel="lightbox"';
		} else if ( $instance['image_link_open'] == "_blank" ) {
			$uselink = true;
			$link = empty($instance['image_link']) ? esc_url( $instance['image_uri'] ) : $instance['image_link'];
			$linktype = 'target="_blank"';
		} else if ($instance['image_link_open'] == "_self") {
			$uselink = true;
			$link = empty($instance['image_link']) ? esc_url( $instance['image_uri'] ) : $instance['image_link'];
			$linktype = 'target="_self"';
		}

		$params = array(
			'uselink'    => $uselink,
			'link'       => $link,
			'link_type'  => $linktype,
			'image_href' => esc_url( $instance['image_uri'] ),
			'text'       => $instance['text'],
		);

		$title = 'Logo';

		echo $before_widget;
		if ( $title ) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}

		ethnologist_view( 'widget', 'image-widget', $params );

		echo $after_widget;
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
        $instance['text'] = strip_tags( $new_instance['text'] );
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
        $instance['image_link'] = $new_instance['image_link'];
        $instance['image_link_open'] = $new_instance['image_link_open'];
        $this->flush_widget_cache();

        return $instance;
	}

	/**
	 * Flush widget cache action
	 */
	function flush_widget_cache() {
		wp_cache_delete( 'ethnologist_widget_image', 'widget');
	}

	/**
	 * Output the settings update form.
	 *
	 * @param array $instance Current settings.
	 * @return string Default return is 'noform'.
	 * @see WP_Widget::form()
	 */
	function form( $instance ) {
		$image_uri = isset( $instance['image_uri'] ) ? esc_attr($instance['image_uri']) : '';
		$image_link = isset( $instance['image_link'] ) ? esc_attr($instance['image_link']) : '';
		$image_link_open = isset($instance['image_link_open']) ? esc_attr($instance['image_link_open']) : 'lightbox';
		$text = isset($instance['text']) ? esc_attr($instance['text']) : '';

		$link_options = array();
		$link_options_array = array();
		$link_options[] = array("slug" => "lightbox", "name" => __('Lightbox', 'ethnologist'));
		$link_options[] = array("slug" => "_blank", "name" => __('New Window', 'ethnologist'));
		$link_options[] = array("slug" => "_self", "name" => __('Same Window', 'ethnologist'));
		$link_options[] = array("slug" => "none", "name" => __('No Link', 'ethnologist'));

		foreach ($link_options as $link_option) {
			$selected = ( $image_link_open == $link_option['slug'] )  ? ' selected="selected"' : '';
			$link_options_array[] = '<option value="' . $link_option['slug'] .'"' . $selected . '>' . $link_option['name'] . '</option>';
		}

		$params = array(
			'link_options_array' => $link_options_array,
			'image_uri'          => $image_uri,
			'image_link'         => $image_link,
			'image_link_open'    => $image_link_open,
			'text'               => $text,
		);

		ethnologist_view( 'widget', 'image-form', $params, $this );
	}
}
