<?php

/**
 * Ethnologist Facebook class
 */
class Ethnologist_Facebook
{
	const CONST_API_ID = "ETHNOLOGIST_FACEBOOK_API_ID";

	public static function display_header_script()
	{
		if ( defined( self::CONST_API_ID ) ) {

			switch (pll_current_language()) {
				case 'cs':
					$lang = 'cs_CZ';
					break;
				default:
					$lang = 'en_GB';
					break;
			}

			ethnologist_view( 'facebook', 'header-script', array(
				'api_id' => constant( self::CONST_API_ID ),
				'lang'   => $lang,
			) );
		}

	}

	public static function display_like_box( $args )
	{
		$args = wp_parse_args( $args, array(
			'href'       => get_the_permalink(),
			'layout'     => 'standard',
			'show-faces' => true,
		) );

		ethnologist_view( 'facebook', 'like-button', $args );
	}
}