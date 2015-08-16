<?php

/**
 * Ethnologist Template Contact class
 */
class Ethnologist_TemplateContact
{
	/**
	 * Default params
	 *
	 * @var array
	 */
	private $default_params = array(
		'map_address'       => 'London, UK',
		'map_zoom'          => 8,
		'form'              => true,
		'email'             => false,
		'email_sent'        => false,
		'captcha_math'      => true,
		'captch_error_msg'  => false,
		'name_error_msg'    => false,
		'email_error_msg'   => false,
		'comment_error_msg' => false,
		'has_error'         => false,
	);

	/**
	 * Get template parameters for view
	 *
	 * @return array
	 */
	protected function get_params() {

		$params = array();

		foreach ( $this->default_params as $key => $value ) {

			$constant_name = 'ETHNOLOGIST_CONTACT_' . strtoupper( $key );
			if ( defined( $constant_name ) ) {
				$value = constant( $constant_name );
			}

			$params[$key] = $value;
		}

		return $params;
	}


	/**
	 * Render template
	 */
	public function render() {
		global $post, $wp_query, $paged;

		get_header();

		$params = $this->get_params();

		if ( $params['captcha_math'] ) {
			$params['captcha_one'] = rand( 5, 50 );
			$params['captcha_two'] = rand( 1, 9 );
			$params['captcha_res'] = md5( $params['captcha_one'] + $params['captcha_two'] );
		}

		$params['comment_value'] = $params['email_value'] = $params['name_value'] = '';

		ethnologist_view( 'page', 'header', array(
			'show_page_header' => false,
			'title_class'      => 'titleclass-nobg',
		) );
		ethnologist_view( 'template', 'contact', $params );

		get_footer();

	}
}