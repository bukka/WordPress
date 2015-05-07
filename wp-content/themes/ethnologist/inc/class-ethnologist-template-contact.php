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
		'email'             => false,
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
			$constant_value = constant( $constant_name );
			if ( ! is_null( $constant_value ) ) {
				$value = $constant_value;
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

		if ( isset( $_POST['submitted'] ) ) {

			// check captcha
			if ( $params['captcha_math'] ) {
				if ( md5( $_POST['kad_captcha'] ) != $_POST['hval'] ) {
					$params['captch_error_msg'] = pll__( 'Check your math.' );
					$params['has_error'] = true;
				}
			}
			// check name
			if ( trim( $_POST['contactName'] ) === '' ) {
				$params['name_error_msg'] = pll__( 'Please enter your name.' );
				$params['has_error'] = true;
			} else {
				$name = trim( $_POST['contactName'] );
			}
			// check email
			if ( trim( $_POST['email'] ) === '' )  {
				$params['email_error_msg'] = pll__( 'Please enter your email address.' );
				$params['has_error'] = true;
			} else if ( ! preg_match( "/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim( $_POST['email'] ) ) ) {
				$params['email_error_msg'] = pll__( 'You entered an invalid email address.' );
				$params['has_error'] = true;
			} else {
				$email = trim( $_POST['email'] );
			}
			// check comment
			if ( trim( $_POST['comments'] ) === '') {
				$params['comment_error_msg'] = pll__( 'Please enter a message.' );
				$params['has_error'] = true;
			} else {
				if ( function_exists('stripslashes') ) {
					$comments = stripslashes( trim( $_POST['comments'] ) );
				} else {
					$comments = trim( $_POST['comments'] );
				}
			}

			if( ! $params['has_error'] ) {
				if ($params['email']) {
					$emailTo = $params['email'];
				} else {
					$emailTo = get_option('admin_email');
				}
				$sitename = get_bloginfo('name');
				$subject = '['.$sitename . ' ' . __("Contact", "ethnologist").'] '. __("From", "ethnologist") . ' '. $name;
				$body = __('Name', 'ethnologist').": $name \n\nEmail: $email \n\nComments: $comments";
				$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

				wp_mail($emailTo, $subject, $body, $headers);
				$emailSent = true;
			}

		}

		get_footer();

	}
}