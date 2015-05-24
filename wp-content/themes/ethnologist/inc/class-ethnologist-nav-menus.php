<?php

/**
 * Ethnologist Nav Menus
 */
class Ethnologist_NavMenus
{
	const TOP_MENU_NAME = 'ethnologist-top';

	/**
	 * Supported languages
	 *
	 * @var array
	 */
	protected $languages = array('en', 'cs');

	/**
	 * Navigation menus
	 *
	 * @var array
	 */
	protected $menus = array(
		'home' => array(
			'title' => array(
				'en' => 'Home',
				'cs' => 'Úvod',
			),
			'slug' => array(
				'en' => 'en',
				'cs' => 'cs',
			),
		),
		'sections' => array(
			'title' => array(
				'en' => 'Sections',
				'cs' => 'Sekce',
			),
			'slug' => array(
				'en' => 'sections',
				'cs' => 'sekce',
			),
			'submenu' => array(
				'post_type' => 'section',
			),
		),
		'interviews' => array(
			'title' => array(
				'en' => 'Interviews',
				'cs' => 'Rozhovory',
			),
			'slug' => array(
				'en' => 'interviews',
				'cs' => 'rozhovory',
			),
			'submenu' => array(
				'post_type' => 'interview',
			),
		),
		'blog' => array(
			'title' => array(
				'en' => 'Blog',
				'cs' => 'Blog',
			),
			'slug' => array(
				'en' => 'blog',
				'cs' => 'blog-cs',
			),
		),
		'gallery' => array(
			'title' => array(
				'en' => 'Gallery',
				'cs' => 'Galerie',
			),
			'slug' => array(
				'en' => 'gallery',
				'cs' => 'galerie',
			),
		),
		'contact' => array(
			'title' => array(
				'en' => 'Contact Us',
				'cs' => 'Kontakt',
			),
			'slug' => array(
				'en' => 'contact',
				'cs' => 'kontakt',
			),
		),
		'language' => array(
			'type'  => 'lang',
			'title' => array(
				'en' => 'Language',
				'cs' => 'Jazyk',
			)
		),

	);

	/**
	 * Get top menu name
	 *
	 * @param string $lang
	 * @return string
	 */
	protected function get_top_menu_name($lang) {
		return self::TOP_MENU_NAME . '-' . $lang;
	}

	/**
	 * Register nav menus
	 *
	 * @return Ethnologist_NavMenus
	 */
	public function register() {

		$menu_desc_prefix = __( 'Top Navigation', 'ethnologist' );

		$nav_menus = array();
		foreach ( $this->languages as $lang ) {
			$nav_menus[ $this->get_top_menu_name( $lang ) ] = $menu_desc_prefix . ' ' . strtoupper( $lang );
		}

		// register menus
		register_nav_menus( $nav_menus );

		return $this;
	}

	/**
	 * Get menu items indexed by class
	 *
	 * @param string $menu Menu name, ID, or slug.
	 */
	protected function get_menu_items( $menu ) {
		$items_list = wp_get_nav_menu_items( $menu );
		$items = array();

		foreach ( $items_list as $item ) {
			$items[$item->title] = $item;
		}

		return $items;
	}

	/**
	 * Update menu item
	 *
	 * @param int $menu_id
	 * @param array $menu_items
	 * @param array $menu_item_data
	 * @return int|WP_Error The menu item's database ID or WP_Error object on failure.
	 */
	protected function update_item( $menu_id, $menu_items, $menu_item_data ) {
		if ( ! empty( $menu_items ) && isset( $menu_items[ $menu_item_data['menu-item-title'] ] ) ) {
			$menu_item_db_id = $menu_items[ $menu_item_data['menu-item-title'] ]->ID;
			$menu_items[ $menu_item_data['menu-item-title'] ]->_used_in_menu = true;
		} else {
			$menu_item_db_id = 0;
		}

		return wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $menu_item_data );
	}

	/**
	 * Clean up unused menu items
	 *
	 * @param array $menu_items
	 */
	protected function clean_up_items( $menu_items ) {
		foreach ( $menu_items as $menu_item ) {
			if ( ! isset($menu_item->_used_in_menu ) && $menu_item->url !== '#pll_switcher' ) {
				wp_delete_post( $menu_item->ID );
			}
		}
	}

	/**
	 * Return posts for post_type and lang
	 *
	 * @param string $post_type
	 * @param string $lang
	 * @return array
	 */
	protected function get_posts( $post_type, $lang ) {
		$query = new WP_Query();
		$query->query(array(
			'numberposts' => -1,
			'post_type'  => $post_type,
			'lang'       => $lang,
		));
		$posts = array();
		while ( $query->have_posts() ) {
			$posts[] = $query->next_post();
		}
		return $posts;
	}

	/**
	 * Update nav menu for language
	 *
	 * @param string $lang
	 * @param boolean $create_only If true only create an item (do not update existing items)
	 * @return boolean|WP_Error
	 */
	public function update_nav_menu( $lang, $create_only ) {
		// Get menu name
		$menu_name = $this->get_top_menu_name( $lang );

		// Check if Top menu exists and make it if not
		if ( ! is_nav_menu( $menu_name  ) ) {
			$menu_id = wp_create_nav_menu( $menu_name );
			if ( is_wp_error( $menu_id ) ) {
				return $menu_id;
			}
			$menu_items = array();
		} elseif ( $create_only ) {
			return true;
		} else {
			$menu = wp_get_nav_menu_object( $menu_name );
			$menu_id =  (int) $menu->term_id;
			$menu_items = $this->get_menu_items( $menu_id );
		}

		$pos = 1;
		foreach ( $this->menus as $slug => $menu ) {
			$type = isset( $menu['type'] ) ? $menu['type'] : 'link';
			$url = ( $type === 'link' ) ? home_url( $menu['slug'][$lang] . '/' ) : '#';

			$menu_db_id = $this->update_item( $menu_id, $menu_items, array(
				'menu-item-title'    => $menu['title'][$lang],
				'menu-item-type'     => 'custom',
				'menu-item-url'      => $url,
				'menu-item-status'   => 'publish',
				'menu-item-position' => $pos,
			) );

			if ( isset( $menu['submenu'] ) ) {
				$submenu_posts = $this->get_posts( $menu['submenu']['post_type'], $lang );
				$submenu_pos = 0;
				foreach ( $submenu_posts as $submenu_post ) {
					$this->update_item( $menu_id, $menu_items, array(
						'menu-item-title' => $submenu_post->post_title,
						'menu-item-type' => 'custom',
						'menu-item-url' => get_permalink( $submenu_post->ID ),
						'menu-item-classes' => 'ethnologist-nav-section-item',
						'menu-item-status' => 'publish',
						'menu-item-position' => ++$submenu_pos,
						'menu-item-parent-id' => $menu_db_id,
					) );
				}
			} /* elseif ( $type === 'lang' ) {
				$this->update_item( $menu_id, $menu_items, array(
					'menu-item-title' => __('Language switcher', 'polylang'),
					'menu-item-url' => '#pll_switcher',
					'menu-item-status' => 'publish',
					'menu-item-parent-id' => $menu_db_id,
				) );
			} */

			++$pos;
		}

		$this->clean_up_items( $menu_items );
	}

	/**
	 * Update menu items
	 *
	 * @param boolean $create_only If true only create an item (do not update existing items)
	 * @return boolean|WP_Error
	 */
	public function update( $create_only = false ) {

		foreach ( $this->languages as $lang ) {
			$this->update_nav_menu( $lang, $create_only );
		}
	}
}