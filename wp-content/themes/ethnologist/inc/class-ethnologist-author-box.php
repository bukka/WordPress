<?php

/**
 * Ethnologist Author Box class
 */
class Ethnologist_AuthorBox
{
	/**
	 * The settings for social icons
	 *
	 * @var array
	 */
	static private $social = [
		'facebook'   => 'Facebook',
		'twitter'    => 'Twitter',
		'instagram'  => 'Instagram',
		'google'     => [
			'title' => 'GooglePlus',
			'icon'  => 'icon-google-plus',
			'class' => 'googlepluslink'
		],
		'flickr'     => [
			'title' => 'Flickr',
			'icon'  => 'icon-flickr2'
		],
		'pinterest'  => 'Pinterest',
		'dribbble'   => 'Dribble',
		'linkedin'   => 'LinkedIn',
		'vimeo'      => 'Vimeo',
	];

	static private $social_processed = false;

	/**
	 * Get social data
	 *
	 * @return array
	 */
	private static function get_social()
	{
		if ( self::$social_processed ) {

			return self::$social;
		}

		foreach ( self::$social as $name => $data ) {
			if ( ! is_array( $data ) ) {
				$data = array( 'title' => $data );
			}

			if ( ! isset( $data['icon'] ) ) {
				$data['icon'] = 'icon-' . $name;
			}

			if ( ! isset( $data['class'] ) ) {
				$data['class'] = $name . 'link';
			}

			self::$social[$name] = $data;
		}

		return self::$social;
	}

	/**
	 * Display authour box
	 */
	public static function display_author_box()
	{
		$params = array(
			'social' => self::get_social(),
		);

		ethnologist_view( 'box', 'author', $params );
	}
}