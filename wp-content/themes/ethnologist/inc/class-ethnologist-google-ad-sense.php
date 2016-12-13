<?php

/**
 * Ethnologist Google AdSense class
 */
class Ethnologist_GoogleAdSense
{
	const CONST_AD_CLIENT = "ETHNOLOGIST_GOOGLE_AD_CLIENT";

	public static function display_header_script() {
		if ( defined( self::CONST_AD_CLIENT ) ) {

			ethnologist_view( 'google', 'adsense-header-script', array(
				'google_ad_client' => constant( self::CONST_AD_CLIENT )
			) );
		}
	}
}