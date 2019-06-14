<?php
/**
 * Custom Post Type configurations.
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.4.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */


return [

	[
        'id' => 'diviner_field',
        'labels'      => [
	        'singular'     => __( 'Diviner Field', 'diviner-archive' ),
	        'plural'       => __( 'Diviner Fields', 'diviner-archive' ),
	        'slug'         => _x( 'diviner-field', 'diviner field slug label', 'diviner-archive' ),
	        'name'         => _x( 'Diviner Fields', 'diviner field general name label', 'diviner-archive' ),
	        'add_new_item' => __( 'Add New Diviner Field', 'diviner-archive' ),
	        'edit_item'    => __( 'Edit Diviner Field', 'diviner-archive' ),
	        'new_item'     => __( 'New Diviner Field', 'diviner-archive' ),
	        'view_item'    => __( 'View Diviner Field', 'diviner-archive' ),
	        'view_items'   => __( 'View Diviner Fields', 'diviner-archive' )
        ],
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => [ 'title', 'excerpt' ],
        'rewrite'            => false,
        'exclude_from_search' => true
    ],

	[
		'id' => 'diviner_archive_item',
		'labels'      => [
			'singular'     => _x( 'Archive Item', 'archive item', 'diviner-archive' ),
			'plural'       => _x( 'Archive Items', 'archive item', 'diviner-archive' ),
			'slug'         => _x( 'archive-item', 'archive item', 'diviner-archive' ),
			'name'         => _x( 'Archive Items', 'archive item', 'diviner-archive' ),
			'add_new_item' => _x( 'Add New Archive Item', 'archive item', 'diviner-archive' ),
			'edit_item'    => _x( 'Edit Archive Item', 'archive item', 'diviner-archive' ),
			// Overrides the “Featured Image” label
			'featured_image'        => _x( 'Thumbnail image', 'archive item', 'diviner-archive' ),
			// Overrides the “Set featured image” label
			'set_featured_image'    => _x( 'Set thumbnail image', 'archive item', 'diviner-archive' ),
			// Overrides the “Remove featured image” label
			'remove_featured_image' => _x( 'Remove thumbnail image', 'archive item', 'diviner-archive' ),
			// Overrides the “Use as featured image” label
			'use_featured_image'    => _x( 'Use as thumbnail image', 'archive item', 'diviner-archive' ),
		],
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => [ 'slug' => 'archive-item' ],
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_icon'          => 'dashicons-star-filled',
		'menu_position'      => null,
		'supports'           => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt' ],
		'map_meta_cap'       => true,
		'show_in_rest'       => true,
		'rest_base'          => 'archival-items',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	],

];
