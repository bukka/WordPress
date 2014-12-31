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
	 */
	protected function update_item( $menu_id, $menu_items, $menu_item_data ) {
		if ( ! empty( $menu_items ) && isset( $menu_items[ $menu_item_data['menu-item-title'] ] ) )
			$menu_item_db_id = $menu_items[ $menu_item_data['menu-item-title'] ]->ID;
		else
			$menu_item_db_id = 0;

		wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $menu_item_data );
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
			if ( $menu_id instanceof WP_Error ) {
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
		) );

		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Gallery', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/gallery'),
			'menu-item-status' => 'publish',
		) );
		$this->update_item( $menu_id, $menu_items, array(
			'menu-item-title' => __( 'Contact Us', 'ethnologist' ),
			'menu-item-type' => 'custom',
			'menu-item-url' => home_url('/contact'),
			'menu-item-status' => 'publish',

		) );
	}
}