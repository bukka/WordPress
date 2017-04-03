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
	static private $social = array(
		'facebook'   => 'Facebook',
		'twitter'    => array(
			'title'      => 'Twitter',
			'url_prefix' => 'https://twitter.com/',
		),
		'instagram'  => 'Instagram',
		'google'     => array(
			'title' => 'GooglePlus',
			'icon'  => 'icon-google-plus',
			'class' => 'googlepluslink'
		),
		'flickr'     => array(
			'title' => 'Flickr',
			'icon'  => 'icon-flickr2'
		),
		'pinterest'  => 'Pinterest',
		'dribbble'   => 'Dribble',
		'linkedin'   => 'LinkedIn',
		'vimeo'      => 'Vimeo',
	);

	/**
	 * @var bool
	 */
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
		global $authordata;

		$query = new WP_Query( array(
			'author'         => $authordata->ID,
			'post_type'      => array('post', 'section', 'interview'),
			'posts_per_page' => 3,
		) );

		$params = array(
			'query'          => $query,
			'social'         => self::get_social(),
			'display_follow' => true,
		);

		ethnologist_view( 'box', 'author', $params );
	}
}