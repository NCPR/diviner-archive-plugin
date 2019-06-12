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
	        'singular'     => __( 'Diviner Field', 'diviner-archive-plugin' ),
	        'plural'       => __( 'Diviner Fields', 'diviner-archive-plugin' ),
	        'slug'         => _x( 'diviner-field', 'diviner field slug label', 'diviner-archive-plugin' ),
	        'name'         => _x( 'Diviner Fields', 'diviner field general name label', 'diviner-archive-plugin' ),
	        'add_new_item' => __( 'Add New Diviner Field', 'diviner-archive-plugin' ),
	        'edit_item'    => __( 'Edit Diviner Field', 'diviner-archive-plugin' ),
	        'new_item'     => __( 'New Diviner Field', 'diviner-archive-plugin' ),
	        'view_item'    => __( 'View Diviner Field', 'diviner-archive-plugin' ),
	        'view_items'   => __( 'View Diviner Fields', 'diviner-archive-plugin' )
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

];
