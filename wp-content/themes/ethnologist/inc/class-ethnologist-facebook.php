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

			if ( is_author() ) {
				$user_id = get_the_author_meta( 'ID' );
				$url = get_author_posts_url( $user_id );
				var_dump(get_the_author_meta());
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
				'url'    => $url,
			) );
		}

	}

	public static function display_like_box( $args )
	{
		if ( ! isset( $args['href'] ) && is_author() ) {
			 $args['href'] = get_author_posts_url( get_the_author_meta( 'ID' ) );
		}
		$args = wp_parse_args( $args, array(
			'href'       => get_the_permalink(),
			'layout'     => 'standard',
			'show-faces' => true,
			'share'      => true,
		) );

		ethnologist_view( 'facebook', 'like-button', $args );
	}
}