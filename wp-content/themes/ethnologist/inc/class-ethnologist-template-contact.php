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

		if ( isset( $_POST['submitted'] ) ) {

			// check captcha
			if ( $params['captcha_math'] && md5( $_POST['kad_captcha'] ) != $_POST['hval'] ) {
				$params['captch_error_msg'] = pll__( 'Check your math.' );
				$params['has_error'] = true;
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
				if ( $params['email'] ) {
					$email_to = $params['email'];
				} else {
					$email_to = get_option( 'admin_email' );
				}

				// email subject
				$subject = sprintf("[%s %s] %s %s", get_bloginfo( 'name' ),
						__( "Contact", "ethnologist" ), __( "From", "ethnologist" ), $name);
				// email body
				$body_parts = array();
				$body_parts[] = __( 'Name',  'ethnologist' ) . ': ' . $name;
				$body_parts[] = __( 'Email', 'ethnologist' ) . ': ' . $email;
				$body_parts[] = __( 'Name',  'ethnologist' ) . ': ' . $comments;
				$body = implode( "\n\n", $body_parts );
				// email headers
				$headers = 'From: ' . $name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email;
				// send email
				wp_mail($emailTo, $subject, $body, $headers);
				$params['email_sent'] = true;
			} else {
				$params['name_value'] = $name;
				$params['email_value'] = $email;
				$params['comment_value'] = $comments;
			}

		} else {
			$params['comment_value'] = $params['email_value'] = $params['name_value'] = '';
		}

		get_template_part('templates/page', 'header');

		ethnologist_view( 'template', 'contact', $params );

		get_footer();

	}
}