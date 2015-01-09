<?php

/**
 * Ethnologist Nav Menus
 */
class Ethnologis_NavMenus
{
	const TOP_MENU_NAME = 'ethnologist-top';

	public function register() {
		register_nav_menus( array(
			self::TOP_MENU_NAME => __( 'Top Navigation', 'ethnologist' ),
		) );

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
	 * Update item
	 *
	 * @param int $menu_id
	 * @param array $menu_items
	 * @param array $menu_item_data
	 * @return int|WP_Error The menu item's database ID or WP_Error object on failure.
	 */
	protected function update_item( $menu_id, $menu_items, $menu_item_data ) {
		if ( ! empty( $menu_items ) && isset( $menu_items[ $menu_item_data['menu-item-title'] ] ) )
			$menu_item_db_id = $menu_items[ $menu_item_data['menu-item-title'] ]->ID;
		else
			$menu_item_db_id = 0;

		return wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $menu_item_data );
	}

	/**
	 * Update menu items
	 *
	 * @param string $create_only If true only create an item (do not update existing items)
	 * @return boolean|WP_Error
	 */
	public function update( $create_only = false ) {
		// Check if Top menu exists and make it if not
		if ( ! is_nav_menu( self::TOP_MENU_NAME  ) ) {
			$menu_id = wp_create_nav_menu( self::TOP_MENU_NAME );
			if ( is_wp_error( $menu_id ) ) {
				return $menu_id;
			}
			$menu_items = array();
		} elseif ( $create_only ) {
			return true;
		} else {
			$menu = wp_get_nav_menu_object( self::TOP_MENU_NAME );
			$menu_id =  (int) $menu->term_id;
			$menu_items = $this->get_menu_items( $menu_id );
		}

		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Home', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/'),
			'menu-item-classes' => 'ethnologist-nav-home',
			'menu-item-status' => 'publish',
			'menu-item-position' => 1,
		) );
		$section_menu_db_id = $this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Sections', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/sections'),
			'menu-item-classes' => 'ethnologist-nav-sections',
			'menu-item-status' => 'publish',
			'menu-item-position' => 2,
		) );
		if ( !  is_wp_error( $section_menu_db_id ) ) {
			$section_posts = get_posts(array(
				'post_type' => 'section',
				'numberposts' => -1,
			));
			$section_pos = 0;
			foreach ( $section_posts as $section_post ) {
				$this->update_item( $menu_id, $menu_items, array(
					'menu-item-title' => $section_post->post_title,
					'menu-item-type' => 'custom',
					'menu-item-url' => get_permalink( $sction_post->ID ),
					'menu-item-classes' => 'ethnologist-nav-section-item',
					'menu-item-status' => 'publish',
					'menu-item-position' => ++$section_pos,
					'menu-item-parent-id' => $section_menu_db_id,
				) );
			}
		}
		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Interviews', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/interviews'),
			'menu-item-classes' => 'ethnologist-nav-interviews',
			'menu-item-status' => 'publish',
			'menu-item-position' => 3,
		) );
		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Gallery', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/gallery'),
			'menu-item-status' => 'publish',
			'menu-item-position' => 4,
		) );
		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Blog', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/blog'),
			'menu-item-classes' => 'ethnologist-nav-blog',
			'menu-item-status' => 'publish',
			'menu-item-position' => 5,
		) );
		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Contact Us', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/contact'),
			'menu-item-status' => 'publish',
			'menu-item-position' => 6,

		) );
	}
}