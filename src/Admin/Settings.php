<?php

namespace NCPR\DivinerArchivePlugin\Admin;

use Carbon_Fields\Container;
use Carbon_Fields\Field;


/**
 * Class Settings
 *
 * Functions for Settings
 *
 * @package Diviner\Admin
 */
class Settings {

	const PIMPLE_CONTAINER_NAME = 'admin.settings';

	const FIELD_GENERAL_PERMISSIONS = 'diviner_field_general_permissions';

	const GENERAL_SETTINGS_SLUG = 'diviner-plugin';

	/**
	 * The built instance of the theme options container.
	 *
	 * @var \Carbon_Fields\Container\Theme_Options_Container
	 */
	protected static $theme_options;

	public function hooks() {
		add_action( 'carbon_fields_register_fields', [$this, 'crb_attach_theme_options'], 1, 0 );
	}

	/**
	 * Returns the menu slug of the theme options main page.
	 *
	 * This is the slug that should be used as `parent_slug` to
	 * add sub-menus to the main theme options page or to hide it.
	 *
	 * @since TBD
	 *
	 * @return string The main theme options page slug.
	 */
	public static function menu_slug() {
		return static::GENERAL_SETTINGS_SLUG;
	}

	/**
	 * Setup Basic plugin settings
	 * This function creates submenu too which must be modified above in the modify_menus function.
	 */
	public function crb_attach_theme_options() {
		// We can save the result of an instance call in a static property as it will be called once per HTTP request.
		static::$theme_options = Container::make(
			'theme_options',
			__( 'General Diviner Settings', 'ncpr-diviner' )
		)
			->set_page_parent( static::GENERAL_SETTINGS_SLUG )
			->add_fields(
			[
				$this->permissions_field(),
			]
		);
	}

	public function permissions_field() {
		return Field::make( 'rich_text', static::FIELD_GENERAL_PERMISSIONS, __( 'Permissions/Rights Note on Archive item', 'ncpr-diviner' ) )
			->set_help_text( __( 'This statement will appear on all archive items if you choose to add one. This is the primary way to communicate to your audience who owns/has the copyright to media (photos, videos, documents, etc.) in your archive', 'ncpr-diviner' ) );
	}


}
