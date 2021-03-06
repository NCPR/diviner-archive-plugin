<?php


namespace NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types;

use Carbon_Fields\Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\PostMeta as FieldPostMeta;


/**
 * Class CPT Field
 *
 * @package Diviner\Post_Types\Diviner_Field\Types
 */
class CPT_Field extends FieldType {

	const NAME = 'diviner_cpt_field';
	const TITLE = 'Advanced Detail Field';
	const TYPE = 'association';

	/**
	 * Get meta box additional info
	 *
	 * @param  \stdClass $field Field Class.
	 * @param  int $post_id Post Id of field to set up.
	 * @return string
	 */
	static public function get_meta_box( $field, $post_id ) {

		if ($post_id <= 0) {
			return parent::get_meta_box($field, $post_id);
		}
		$field_id = Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_ID );
		if ( isset($field_id) && !empty($field_id)) {
			$output = sprintf(
				'<p>%s</p>',
				__( 'This field defines a new content type in wordpress to which your archive items may be associated. This field allows you to create, edit, and delete new content pages of this new content type.', 'diviner-archive' )
			);
			$pt = get_post_type_object( $field_id );
			if (!empty($pt)) {
				$view_all_link = sprintf( 'edit.php?post_type=%s', $field_id );
				$output .= sprintf(
					'<p><a href="%s" class="button button-primary">%s</a><br></p>',
					$view_all_link,
					$pt->labels->view_items
				);

				$new_link = sprintf( 'post-new.php?post_type=%s', $field_id );
				$output .= sprintf(
					'<p><a href="%s" class="button button-primary">%s</a><br></p>',
					$new_link,
					$pt->labels->add_new_item
				);
			}
			$output .= parent::get_meta_box($field, $post_id);
			return $output;
		} else {
			return parent::get_meta_box($field, $post_id);
		}
	}

	static public function setup ( $post_id ) {
		// set up CPT
		$field_id = Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_ID );
		$field_label = Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_LABEL );
		$field_slug = Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_SLUG );

		if ( empty($field_id) || empty($field_label) || empty($field_slug)) {
			return '';
		}

		// default values
		if ( empty( $field_id ) ) {
			$field_id = sprintf('div_cpt_name_%s', $post_id );
		}
		if ( empty( $field_label ) ) {
			$field_label = 'Advanced Detail Item';
		}
		$field_labels = sprintf('%ss', $field_label);
		if ( empty( $field_slug ) ) {
			$field_slug = sanitize_title( $field_label );
		}
		// ToDo: make some of the other cpt labels/config editable
		// has_archive etc etc
		// registering the custom post type
		$args = [
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'diviner_general_settings_slug',
			'query_var'          => true,
			'rewrite'            => [ 'slug' => $field_slug ],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_icon'          => 'dashicons-video',
			'menu_position'      => null,
			'supports'           => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt' ],
			'map_meta_cap'       => true
		];
		$labels = [
			'labels' => [
				'singular'     => $field_label,
				'plural'       => $field_labels,
				'view_items'   => sprintf('View %s', $field_labels ) ,
				'menu_name'    => sprintf('%s (<i>Advanced Detail Field</i>)', $field_labels),
				'name'         => $field_labels,
				'add_new_item' => sprintf( 'Add New %s', $field_label ),
			]
		];
		$args = wp_parse_args( $args, $labels );
		register_post_type( $field_id, $args );

	}

	/**
	 * Return field value
	 *
	 * 	  [0]=>
	 * 		array(4) {
	 * 			["value"]=>
	 * 				string(21) "post:photographer:135"
	 * 			["type"]=>
	 * 				string(4) "post"
	 * 			["subtype"]=>
	 * 				string(12) "photographer"
	 * 			["id"]=>
	 * 				string(3) "135"
	 *
	 * @param  int $post_id Post Id of archive item.
	 * @param  string $field_name ID of field to get value of
	 * @param  int $field_post_id Field Id
	 * @return string
	 */
	static public function get_value( $post_id, $field_name, $field_post_id ) {
		$raw_value = carbon_get_post_meta( $post_id, $field_name );

		$value = null;
		if (is_array($raw_value)) {
			$outputs = [];
			foreach($raw_value as $next_raw_value) {
				$cpt_post = get_post($next_raw_value['id']);
				if ( isset($cpt_post) ) {
					$outputs[] = sprintf('<a href="%s">%s</a>',
						get_permalink($cpt_post),
						get_the_title($cpt_post)
					);
				}
				$value = implode(", ", $outputs);
			}
		}

		return $value;
	}

	/**
	 * Decorate the ep sync args per field type
	 *
	 * @param  array $additional_meta additional meta.
	 * @param  int $post_id Post Id of field to set up.
	 * @param  array $field
	 * @param  array $field_id
	 * @return array
	 */
	static public function decorate_ep_post_sync_args( $additional_meta, $post_id, $field, $field_id ) {
		$field_values = carbon_get_post_meta( $post_id, $field_id );
		$text = '';
		foreach($field_values as $field_value) {
			if ( !empty($field_value)) {
				$text .= get_the_title($field_value['id']) . " ";
			}
		}
		$additional_meta[$field_id] = $text;

		return $additional_meta;
	}

	/**
	 * Builds the field and returns it
	 *
	 * @param  int $post_id Post Id of field to set up.
	 * @param  string $id Field id
	 * @param  string $field_label Label
	 * @param  string $helper field helper text
	 * @return object
	 */
	static public function render( $post_id, $id, $field_label, $helper = '') {
		$field_cpt_id = Diviner_Field::get_field_post_meta( $post_id,FieldPostMeta::FIELD_CPT_ID );
		if ( empty($field_cpt_id) ) {
			return null;
		}

		$field = Field::make(static::TYPE, $id, $field_label)
			->set_types([
				[
					'type' => 'post',
					'post_type' => $field_cpt_id,
				],
			] );

		if ( ! empty( $helper ) ) {
			$field->help_text($helper);
		}
		return $field;
	}

	/**
	 * Return basic blueprint for this field
	 *
	 * @param  int $post_id Post Id of field to set up.
	 * @return array
	 */
	static public function get_blueprint( $post_id ) {
		$blueprint = parent::get_blueprint( $post_id );
		$additional_vars = [
			'cpt_field_id'  => Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_ID ),
			'cpt_field_label'  => Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_LABEL ),
			'cpt_field_slug'  => Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_CPT_SLUG ),
		];
		return array_merge($blueprint, $additional_vars);
	}
}
