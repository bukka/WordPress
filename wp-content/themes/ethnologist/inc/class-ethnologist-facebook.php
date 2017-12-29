<?php

/**
 * Ethnologist Facebook class
 */
class Ethnologist_Facebook
{
	const CONST_API_ID = "ETHNOLOGIST_FACEBOOK_API_ID";
	const CONST_HTTPS_FROM = "ETHNOLOGIST_HTTPS_FROM";

	/**
	 * Display script in the page header
	 */
	public static function display_header_script() {
		if ( ! defined( self::CONST_API_ID ) ) {
			return;
		}

		switch (pll_current_language()) {
			case 'cs':
				$lang = 'cs_CZ';
				break;
			default:
				$lang = 'en_GB';
				break;
		}

		if ( is_author() ) {
			$user_id = get_the_author_meta( 'ID' );
			$url = get_author_posts_url( $user_id );
			$title = get_the_author_meta( 'first_name', $user_id ) . ' '
					. get_the_author_meta( 'last_name', $user_id );
		} else {
			$url = get_the_permalink();
			$title = get_the_title();
		}

		ethnologist_view( 'facebook', 'header-script', array(
			'api_id' => constant( self::CONST_API_ID ),
			'lang'   => $lang,
			'type'   => 'website',
			'title'  => $title,
			'url'    => self::transform_url( $url ),
		) );

	}

	/**
	 * Display Facebook LikeBox
	 *
	 * @param array $args
	 */
	public static function display_like_box( $args ) {
		if ( ! isset( $args['href'] ) && is_author() ) {
			 $args['href'] = get_author_posts_url( get_the_author_meta( 'ID' ) );
		}
		$args = wp_parse_args( $args, array(
			'href'       => self::transform_url( get_the_permalink() ),
			'layout'     => 'standard',
			'show-faces' => true,
			'share'      => true,
		) );

		ethnologist_view( 'facebook', 'like-button', $args );
	}

	/**
	 * Transform URL
	 *
	 * @param string $url
	 * @return string
	 */
	private static function transform_url( $url ) {

		if ( ! defined( self::CONST_HTTPS_FROM ) || get_the_date('U') < constant( self::CONST_HTTPS_FROM ) ) {
			$search = 'https://';
			$replace = 'http://';
		} else {
			$search= 'http://';
			$replace= 'https://';
		}

		return str_replace( $search, $replace, $url );
	}

}