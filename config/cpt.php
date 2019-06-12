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
        'id' => 'custom',
        'labels'      => [
            'name'               => _x('Customs', 'post type general name', 'diviner-archive-plugin'),
            'singular_name'      => _x('Custom', 'post type singular name', 'diviner-archive-plugin'),
            'menu_name'          => _x('Customs', 'admin menu', 'diviner-archive-plugin'),
            'name_admin_bar'     => _x('Manufacturer', 'add new on admin bar', 'diviner-archive-plugin'),
            'add_new'            => _x('Add New', 'custom', 'diviner-archive-plugin'),
            'add_new_item'       => __('Add New Custom', 'diviner-archive-plugin'),
            'new_item'           => __('New Custom', 'diviner-archive-plugin'),
            'edit_item'          => __('Edit Custom', 'diviner-archive-plugin'),
            'view_item'          => __('View Custom', 'diviner-archive-plugin'),
            'all_items'          => __('All Customs', 'diviner-archive-plugin'),
            'search_items'       => __('Search Customs', 'diviner-archive-plugin'),
            'parent_item_colon'  => __('Parent Customs:', 'diviner-archive-plugin'),
            'not_found'          => __('No customs found.', 'diviner-archive-plugin'),
            'not_found_in_trash' => __('No customs found in Trash.', 'diviner-archive-plugin')
        ],
        'post_type'   => 'page',
        'public'      => true,
        'supports'    => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'has_archive' => false,
        'rewrite'     => array('slug' => 'customs'),   // my custom slug
    ],

];
