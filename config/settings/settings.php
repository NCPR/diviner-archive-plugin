<?php
/**
 * Custom WordPress administration pages and settings configuration parameters
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.3.0
 * @author     graemehoffman
 * @link       http: //example.com
 * @license    GNU General Public License 2.0+
 */

return array(

    /*********************************************************
    * Top level custom admin pages
    *
    * Format:
    *   array(
    * 'page_title' => $page_title,
    * 'menu_title' => $menu_title,
    * 'capability' => $capability,
    * 'menu_slug'  => $menu_slug,
    * 'callback'   => $callback,
    * 'icon_url'   => $icon_url,
    * 'position'   => $position,
    *   ),
    ********************************************************/

    'pages' => array(
        array(
            'page_title' => __( 'Diviner', 'diviner-archive-plugin' ),
            'menu_title' => __( 'Diviner', 'diviner-archive-plugin' ),
            'capability' => 'manage_options',
            'menu_slug'  => 'diviner-plugin',
            'template'   => 'diviner-plugin',
            'icon_url'   => 'dashicons-star-filled',
            'position'   => 110,
        ),
    ),

    /*********************************************************
    * Custom admin subpages
    *
    * Format:
    *   array(
    * 'parent_slug' => $parent_slug,
    * 'page_title'  => $page_title,
    * 'menu_title'  => $menu_title,
    * 'capability'  => $capability,
    * 'menu_slug'   => $menu_slug,
    * 'callback'    => $callback,
    *   ),
    *
    * The following 'parent_slug' values (case sensitive) may be used to add subpages to the default top-level WordPress settings pages:
    *
    * Dashboard : 'parent_slug' => 'Dashboard',
    * Posts     : 'parent_slug' => 'Posts',
    * Media     : 'parent_slug' => 'Media',
    * Pages     : 'parent_slug' => 'Pages',
    * Comments  : 'parent_slug' => 'Comments',
    * Appearance: 'parent_slug' => 'Appearance',
    * Plugins   : 'parent_slug' => 'Plugins',
    * Users     : 'parent_slug' => 'Users',
    * Tools     : 'parent_slug' => 'Tools',
    * Settings  : 'parent_slug' => 'Settings',
    *
    ********************************************************/

    'subpages' => array(
	    array(
		    'parent_slug' => null,
		    'page_title'  => __( 'Diviner Meta Field Wizard', 'diviner-archive-plugin' ),
		    'menu_title'  => __( 'Diviner Meta Field Wizard', 'diviner-archive-plugin' ),
		    'capability'  => 'manage_options',
		    'menu_slug'   => 'diviner_wizard',
		    'template'    => 'diviner-plugin-wizard',
	    ),
	    array(
		    'parent_slug' => 'diviner-plugin',
		    'page_title'  => __( 'Diviner Meta Fields', 'diviner-archive-plugin' ),
		    'menu_title'  => __( 'Manage Diviner Meta Fields', 'diviner-archive-plugin' ),
		    'capability'  => 'manage_options',
		    'menu_slug'   => 'diviner-plugin-manage-fields',
		    'template'    => 'diviner-plugin-fields',
	    ),
    ),

	/*
	add_submenu_page(
		Settings::menu_slug(),
		'Diviner Meta Fields',
		'Manage Diviner Meta Fields',
		'manage_options',
		'diviner-manage-fields',
		[ $this, 'rc_scd_create_dashboard' ]
	);

add_submenu_page(
	null,           // -> Set to null - will hide menu link
	'Diviner Meta Field Wizard',    // -> Page Title
	'Diviner Meta Field Wizard',   // -> Title that would otherwise appear in the menu
	'manage_options', // -> Capability level
	self::SLUG_WIZARD,   // -> Still accessible via admin.php?page=menu_handle
	[ $this,'rc_scd_create_wizard' ] // -> To render the page
);

	*/
    /*
    'subpages' => array(
        array(
            'parent_slug' => 'starter-plugin',
            'page_title'  => 'CPT Options',
            'menu_title'  => 'CPT',
            'capability'  => 'manage_options',
            'menu_slug'   => 'starter-plugin-cpt',
            'template'    => 'starter-plugin-cpt',
        ),
        array(
            'parent_slug' => 'starter-plugin',
            'page_title'  => 'Taxonomy Options',
            'menu_title'  => 'Taxonomy',
            'capability'  => 'manage_options',
            'menu_slug'   => 'starter-plugin-taxonomy',
            'template'    => 'starter-plugin-taxonomy',
        ),
        array(
            'parent_slug' => 'starter-plugin',
            'page_title'  => 'Other Options',
            'menu_title'  => 'Other',
            'capability'  => 'manage_options',
            'menu_slug'   => 'starter-plugin-other',
            'template'    => 'starter-plugin-other',
        ),
    ),
    */

    /*********************************************************
    * Admin custom sections
    *
    * Format:
    *   array(
    * 'id'       => $id,
    * 'title'    => $title,
    * 'callback' => $callback,
    * 'page'     => $page,
    *   ),
    ********************************************************/

    'sections' => array(
        array(
            'id'       => 'user_profile',
            'title'    => 'User Profile',
            'template' => 'user-profile',
            'page'     => 'starter-plugin',
        ),
        array(
            'id'       => 'user_interests',
            'title'    => 'User Interests',
            'template' => 'user-interests',
            'page'     => 'starter-plugin',
        ),
    ),

    /*********************************************************
    * Admin custom fields
    *
    * Format:
    *   array(
    * 'id'         => $id,
    * 'title'      => $title,
    * 'callback'   => $callback,
    * 'page'       => $page,
    * 'section'    => $section,
    * 'attributes' => $args,
    *   ),
    ********************************************************/

    'settings' => array(
        array(
            'id'          => 'user_bio',
            'title'       => 'User Biography',
            'page'        => 'starter-plugin',
            'section'     => 'user_profile',
            'description' => 'The user should describe themselves here',
            'helper'      => 'This is the helper.',
            'type'        => 'textarea',
            'options'     => array(
                'placeholder' => 'Last name',
            ),
        ),

        array(
            'id'          => 'first_name',
            'title'       => 'First Name',
            'page'        => 'starter-plugin',
            'section'     => 'user_profile',
            'description' => '',
            'helper'      => '',
            'type'        => 'text',
            'options'     => array(
                'placeholder' => 'First name',
                'required'    => true,
            ),
        ),

        array(
            'id'         => 'favorite_movie',
            'title'      => 'Favorite Movie',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'checkbox',
            'options' => array(
                'label'   => 'The Dark Knight',
                'checked' => true,
            ),
        ),

        array(
            'id'         => 'favorite_color',
            'title'      => 'Favorite Color',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'checkbox',
            'options' => array(
                array(
                    'label'   => 'Blue sky',
                    'checked' => true,
                ),
                array(
                    'label'     => 'Red sun',
                ),
                array(
                    'label'     => 'Green grass',
                ),
                array(
                    'label'     => 'White sand',
                ),
            ),
        ),

        array(
            'id'         => 'favorite_foods',
            'title'      => 'Favorite Foods',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'select',
            'options' => array(
                'option_1' => array(
                    'label'     => 'Pizza',
                ),
                'option_2' => array(
                    'label'     => 'Cheeseburgers',
                    'selected' => true,
                ),
                'option_3' => array(
                    'label'     => 'French Fries',
                ),
            ),
        ),

        array(
            'id'         => 'favorite_car',
            'title'      => 'Favorite Car',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'radio',
            'options' => array(
                'option_1' => array(
                    'label'     => 'Ford',
                ),
                'option_2' => array(
                    'label'     => 'Chevy',
                    'checked' => true,
                ),
                'option_3' => array(
                    'label'     => 'Toyota',
                ),
            ),
        ),
        
        array(
            'id'         => 'user_password',
            'title'      => 'Password',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'password',
            'options' => array(
                'placeholder' => 'Must contain 8-12 characters',
                'required'    => true,
            ),
        ),

        array(
            'id'         => 'favorite_sports',
            'title'      => 'Favorite Sports',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'multiselect',
            'options' => array(
                'option_1' => array(
                    'label'     => 'Football',
                ),
                'option_2' => array(
                    'label'     => 'Baseball',
                    'selected' => true,
                ),
                'option_3' => array(
                    'label'     => 'Basketball',
                ),
            ),
        ),

        array(
            'id'         => 'favorite_city',
            'title'      => 'Favorite City',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'select',
            'options' => array(
                'option_1' => array(
                    'label'     => 'New York',
                ),
                'option_2' => array(
                    'label'     => 'Boston',
                ),
                'option_3' => array(
                    'label'     => 'Los Angeles',
                ),
            ),
        ),

        array(
            'id'         => 'custom_option',
            'title'      => 'Custom Option',
            'page'       => 'starter-plugin',
            'section'    => 'user_profile',
            'type'       => 'custom',
            'options' => array(
                'file_name' => 'custom.php',
                'callback' => '',
            ),
        ),
    ),

    /*********************************************************
    * The URL for the plugin's "Settings" link on the WordPress plugins activation page.
    *
    * By default, the "Settings" link URL will be set to the first page defined below in this configuration array. If no page is set, the URL will then default
    * to the first subpage defined below in this configuration array.
    *
    * These defaults will be overrided if a 'settings_url' is defined here.
    *
    * Format:
    * 'settings_url' => $settings_url,
    *
    ********************************************************/

   'settings_link' => 'options.php',

);
