<?php

namespace NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types;

use NCPR\DivinerArchivePlugin\CPT\Archive_Item\Archive_Item;
use Carbon_Fields\Field;

/**
 * Class Related Field
 *
 * @package Diviner\Post_Types\Diviner_Field\Types
 */
class Related_Field extends FieldType  {

	const NAME = 'diviner_related_field';
	const TITLE = 'Related Items Field';
	const TYPE = 'association';

	/**
	 * Builds the field and returns it
	 *
	 * @param  int $post_id Post Id of field to set up (ignored bc not dynamic currently)
	 * @param  string $id Field id
	 * @param  string $field_label Label
	 * @param  string $helper field helper text
	 * @return object
	 */
	static public function render( $post_id, $id, $field_label, $helper = '') {

		$field = Field::make(static::TYPE, $id, $field_label)
			->set_types( [
				[
					'type' => 'post',
					'post_type' => Archive_Item::NAME,
				],
			] );

		if ( ! empty( $helper ) ) {
			$field->help_text($helper);
		}
		return $field;
	}


}
