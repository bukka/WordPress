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

			ethnologist_view( 'facebook', 'header-script', array(
				'api_id' => constant( self::CONST_API_ID ),
				'lang'   => 'en_US',
			) );
		}

	}

	public static function display_like_box()
	{

	}
}