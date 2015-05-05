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
		'map_address' => 'London, UK',
		'map_zoom'    => 8,
		'email'       => false,
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

		$pageemail = get_post_meta( $post->ID, '_kad_contact_form_email', true );
		$form_math = get_post_meta( $post->ID, '_kad_contact_form_math', true );

		if(isset($_POST['submitted'])) {
			if(isset($form_math) && $form_math == 'yes') {
				if(md5($_POST['kad_captcha']) != $_POST['hval']) {
					$kad_captchaError = pll__( 'Check your math.' );
					$hasError = true;
				}
			}
			if(trim($_POST['contactName']) === '') {
				$nameError = pll__( 'Please enter your name.' );
				$hasError = true;
			} else {
				$name = trim($_POST['contactName']);
			}

			if(trim($_POST['email']) === '')  {
				$emailError = pll__('Please enter your email address.' );
				$hasError = true;
			} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
				$emailError = pll__( 'You entered an invalid email address.' );
				$hasError = true;
			} else {
				$email = trim($_POST['email']);
			}

			if(trim($_POST['comments']) === '') {
				$commentError = pll__( 'Please enter a message.' );
				$hasError = true;
			} else {
				if(function_exists('stripslashes')) {
					$comments = stripslashes(trim($_POST['comments']));
				} else {
					$comments = trim($_POST['comments']);
				}
			}

			if(!isset($hasError)) {
				if (isset($pageemail)) {
					$emailTo = $pageemail;
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