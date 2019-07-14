<?php

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Text_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Date_Field;

?>


<div class="wrap wrap-diviner wrap-diviner--limited wrap-diviner--default">

	<h2>
		<?php _e( 'Select a Diviner Meta Field to Create', 'diviner-archive' ); ?>
	</h2>

	<p>
		<?php _e( 'So you have a bunch of photos/videos/documents….but how do you want your audience to be able to find them? Whether it’s by date, location, or subject matter, this is where you design your uploading experience by choosing what information will be assigned to each archive item.', 'diviner-archive' ); ?>

	</p>


	<p>
		<b>
			<?php _e( 'There is currently one type of field:', 'diviner-archive' ); ?>
		</b>
	</p>

	<div class="field-select-wrap">
		<h2>
			<?php _e( 'Text Field', 'diviner-archive' ); ?>

		</h2>
		<p>
			<?php _e('Add a text field for information you wish to assign to each archive item. Example: serial number, catalog number, internal title, secondary description etc.', 'diviner-archive' ); ?>
		</p>
		<p>
			<a href="post-new.php?post_type=<?php echo esc_attr( Diviner_Field::NAME ); ?>&field_type=<?php echo esc_attr( Text_Field::NAME ); ?>" class="button button-primary button-hero">
				<?php _e( 'Add a New Text Meta Field', 'diviner-archive' ); ?>
			</a>
		</p>
	</div>

	<div class="field-select-wrap">
		<h2>Date</h2>
		<p>
			<?php _e('Add a date field if you would like your audience to be able to filter by a date range, by year, decade, or by century. Ex: if you want to sort a collection of a thousand photos from the 20th century into decades.', 'diviner-archive' ); ?>
		</p>
		<p>
			<a href="post-new.php?post_type=<?php echo esc_attr( Diviner_Field::NAME ); ?>&field_type=<?php echo esc_attr( Date_Field::NAME ); ?>" class="button button-primary button-hero">
				Add a New Date Meta Field
			</a>
		</p>
	</div>

	<p>
		<?php _e( 'Note: This plugin will evolve overtime. We will be adding more field types (date, custom post type, taxonomy, and select) as well as real-time search experience.', 'diviner-archive' ); ?>
	</p>


</div>
