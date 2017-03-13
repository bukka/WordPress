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
	static $social = [
		'facebook'   => 'Facebook',
		'twitter'    => 'Twitter',
		'instagram'  => 'Instagram',
		'google'     => [
			'name' => 'GooglePlus',
			'icon' => 'icon-google-plus',
			'class' => 'googlepluslink'
		],
		'flickr'     => [
			'name' => 'Flickr',
			'icon' => 'icon-flickr2'
		],
		'pinterest'  => 'Pinterest',
		'dribbble'   => 'Dribble',
		'linkedin'   => 'LinkedIn',
		'vimeo'      => 'Vimeo',
	];

	/**
	 * Display authour box
	 */
	public static function display_author_box()
	{
		ethnologist_view('box', 'author');
	}
}