<?php

namespace NCPR\DivinerArchivePlugin\CPT\Archive_Item;

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\PostMeta as FieldPostMeta;

/**
 * Class Admin Modifications
 *
 * @package Diviner\Post_Types\Archive_Item
 */
class AdminModifications {

	const DIV_COL_TYPE = 'div_col_type';

	public function hooks() {
		add_action( 'admin_menu', [ $this,'register_menu_links' ] );
		add_filter( 'admin_body_class', [ $this,'admin_body_class' ] );
		add_filter( 'manage_edit-diviner_archive_item_columns', [ $this, 'archival_item_columns' ] );
		add_action( 'manage_diviner_archive_item_posts_custom_column', [ $this, 'manage_diviner_archive_item_posts_custom_column' ], 10, 2 );
		add_action( 'carbon_fields_register_fields', [ $this, 'active_field_setup' ], 3, 0 );
	}

	/**
	 * Copies over the feature image to the thumbnail is there is one
	 *
	 * @param int $post_id The post ID.
	 * @param post $post The post object.
	 * @param bool $update Whether this is an existing post being updated or not.
	 */
	function save_ai_meta( $post_id, $post, $update ) {
		// only on new creations
		if (!$update) return;
		// only for archive singles
		if (get_post_type($post_id) !== Archive_Item::NAME ) return;
		$thumb_id = get_post_thumbnail_id($post_id);
		// only do this when there is no value in the thumbnail already
		if (empty($thumb_id)) {
			$feature_photo = carbon_get_post_meta( $post_id, Post_Meta::FIELD_PHOTO );
			if (!empty($feature_photo)) {
				set_post_thumbnail( $post_id, $feature_photo );
			}
		}
	}

	/**
	 * Runs the setup functions on all active fields
	 *
	 */
	function active_field_setup(  ) {
		$field_posts_ids = Diviner_Field::get_active_fields();
		foreach($field_posts_ids as $field_post_id) {
			$field_type = Diviner_Field::get_field_post_meta($field_post_id, FieldPostMeta::FIELD_TYPE );
			$field = Diviner_Field::get_class($field_type);
			if( is_callable( [ $field, 'setup' ] ) ){
				call_user_func( [ $field, 'setup' ], $field_post_id);
			}
		}
	}

	/**
	 * Injecting the type value into the type column
	 *
	 * @param string $colname
	 * @param string $id
	 */
	function manage_diviner_archive_item_posts_custom_column( $colname, $id  ) {
		if ( $colname == static::DIV_COL_TYPE && !empty( $id ) ) {
			$type = carbon_get_post_meta( $id, Post_Meta::FIELD_TYPE );
			if ( ! empty($type) ){
				echo Post_Meta::get_type_label_from_id($type);
			}
		}
	}

	/**
	 * Adding the type column
	 *
	 * @param array $columns
	 * @return array
	 */
	function archival_item_columns( $columns ) {
		$columns[ static::DIV_COL_TYPE ] = "Type";
		return $columns;
	}

	/**
	 * Adds one or more classes to the body tag in the dashboard.
	 *
	 * @param  String $classes Current body classes.
	 * @return String          Altered body classes.
	 */
	function admin_body_class( $classes ) {
		global $post;
		global $pagenow;

		if (!$pagenow || !$post) {
			return $classes;
		}
		// what type of class is this
		if ( get_post_type() !== Archive_Item::NAME ) {
			return $classes;
		}

		$type = carbon_get_post_meta( get_the_ID(), Post_Meta::FIELD_TYPE );
		$classes .= ' archive-item-edit';
		if ( ! empty( $type ) ) {
			$classes .= sprintf( ' archive-item-edit--%s', $type );
		}

		return $classes;
	}

	function register_menu_links() {

		add_submenu_page(
			'edit.php?post_type=diviner_archive_item',
			__('Add New Photo','diviner-archive'),
			__('Add New Photo','diviner-archive'),
			'edit_posts',
			'post-new.php?post_type=diviner_archive_item&type=photo'
		);
		add_submenu_page(
			'edit.php?post_type=diviner_archive_item',
			__('Add New Audio','diviner-archive'),
			__('Add New Audio','diviner-archive'),
			'edit_posts',
			'post-new.php?post_type=diviner_archive_item&type=audio'
		);
		add_submenu_page(
			'edit.php?post_type=diviner_archive_item',
			__('Add New Video','diviner-archive'),
			__('Add New Video','diviner-archive'),
			'edit_posts',
			'post-new.php?post_type=diviner_archive_item&type=video'
		);
		add_submenu_page(
			'edit.php?post_type=diviner_archive_item',
			__('Add New Document','diviner-archive'),
			__('Add New Document','diviner-archive'),
			'edit_posts',
			'post-new.php?post_type=diviner_archive_item&type=document'
		);
		add_submenu_page(
			'edit.php?post_type=diviner_archive_item',
			__('Add New Mixed Media','diviner-archive'),
			__('Add New Mixed Media','diviner-archive'),
			'edit_posts',
			'post-new.php?post_type=diviner_archive_item&type=mixed'
		);

		remove_submenu_page( 'edit.php?post_type=diviner_archive_item', 	'post-new.php?post_type=diviner_archive_item' );
	}

}
