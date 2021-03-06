<?php


namespace NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types;

use Carbon_Fields\Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\PostMeta as FieldPostMeta;
use Diviner\CarbonFields\Helper;

/**
 * Class Date Field
 *
 * @package Diviner\Post_Types\Diviner_Field\Types
 */
class Date_Field extends FieldType  {

	const NAME  = 'diviner_date_field';
	const TITLE = 'Date Field';
	const TYPE  = 'date';

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
		$field =  Field::make( static::TYPE, $id, $field_label );
		if ( ! empty( $helper ) ) {
			$field->help_text($helper);
		}
		return $field;
	}

	/**
	 * Return field value
	 *
	 * @param  int $post_id Post Id of archive item.
	 * @param  string $field_name ID of field to get value of
	 * @param  int $field_post_id Field Id
	 * @return string
	 */
	static public function get_value( $post_id, $field_name, $field_post_id ) {
		$raw_date = carbon_get_post_meta( $post_id, $field_name ); // in YYYY-MM-DD
		// output date based on type
		$type = Diviner_Field::get_field_post_meta( $field_post_id, FieldPostMeta::FIELD_DATE_TYPE);
		$date_output = mysql2date( get_option( 'date_format' ), $raw_date );
		$date_parsed = date_parse($raw_date);
		$year = $date_parsed['year'];
		if ($type === FieldPostMeta::FIELD_DATE_TYPE_CENTURY) {
			// display the century
			$date_output = floor($year/100)*100;
		} else if ($type === FieldPostMeta::FIELD_DATE_TYPE_DECADE) {
			$date_output = floor($year/10)*10;
		} else if ($type === FieldPostMeta::FIELD_DATE_TYPE_YEAR) {
			$date_output = $year;
		}
		return $date_output;
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
			'date_field_type'  => Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_DATE_TYPE),
			'date_field_start' => Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_DATE_START),
			'date_field_end'   => Diviner_Field::get_field_post_meta( $post_id, FieldPostMeta::FIELD_DATE_END),
		];
		return array_merge($blueprint, $additional_vars);
	}

	/**
	 * Decorate query vars for rest
	 *
	 * @param  array $args  Args to pass to WP query.
	 * @param  array $sort_args  array of sort gtom pipe SORT|<type>|<field>|ASC
	 * @return array
	 */
	static public function decorate_query_args ( $args, $sort_args ) {
		$args[ 'order' ] = ( $sort_args[3] == 'ASC' ) ? 'ASC' : 'DESC';
		$args[ 'meta_key' ] = Helper::get_real_field_name( $sort_args[2] );
		$args[ 'meta_type' ] = 'DATE';
		$args[ 'orderby' ] = 'meta_value';
		return $args;
	}

	/**
	 * Return array of sort options
	 *
	 * @param  int $post_id Post Id of field to set up.
	 * @return array
	 */
	static public function get_sort_options( $field_id ) {
		$options = [];
		// Ascending
		$label = sprintf(
			__( '%s Old to New (no date first)', 'diviner-archive' ),
			get_the_title($field_id)
		);
		$value = sprintf(
			'SORT|%s|%s|ASC',
			static::NAME,
			Diviner_Field::get_field_post_meta( $field_id, FieldPostMeta::FIELD_ID )
		);
		$options[] = [
			'value' => $value,
			'label' => $label,
		];
		// Descending
		$label = sprintf(
			__( '%s New To Old (no date last)', 'diviner-archive' ),
			get_the_title($field_id)
		);
		$value = sprintf(
			'SORT|%s|%s|DESC',
			static::NAME,
			Diviner_Field::get_field_post_meta( $field_id, FieldPostMeta::FIELD_ID )
		);
		$options[] = [
			'value' => $value,
			'label' => $label,
		];
		return $options;
	}

}
