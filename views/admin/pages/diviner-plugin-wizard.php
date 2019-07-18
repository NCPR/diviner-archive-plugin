<?php

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Text_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Date_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Select_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\CPT_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Taxonomy_Field;

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

	<div class="field-select-wrap">
		<h2>Select Field</h2>
		<p>
			<?php _e('Add a select field to assign a piece of information that comes from a very small list of pre-set choices to each of your archive item. Examples: Art Format, with the choices being Painting, Sculpture, or Digital.', 'diviner-archive' ); ?>
		</p>
		<p>
			<a href="post-new.php?post_type=<?php echo esc_attr( Diviner_Field::NAME ); ?>&field_type=<?php echo esc_attr( Select_Field::NAME ); ?>" class="button button-primary button-hero">
				Add a New Select Meta Field
			</a>
		</p>

	</div>

	<div class="field-select-wrap">
		<h2>Advanced Detail Field</h2>
		<p>
			<?php _e('For categories with many choices (20+) and which you would like to be able to elaborate on and attach auxiliary information, use the Advanced Detail Field. A good example would be if you wished to sort your materials by their creator (photographer, author, etc.) – for each creator, this type of field allows you to create an “entry” for that creator. Other examples: donor, institution. Internally, this field manages what is typically called a custom post type in wordpress vernacular.', 'diviner-archive' ); ?>
		</p>
		<p>
			<a href="post-new.php?post_type=<?php echo esc_attr( Diviner_Field::NAME ); ?>&field_type=<?php echo esc_attr( CPT_Field::NAME ); ?>" class="button button-primary button-hero">
				Add a New Advanced Detail Field
			</a>
		</p>

	</div>

	<div class="field-select-wrap">
		<h2>Taxonomy (Category/Tags/Keywords)</h2>
		<p>
			<?php _e('Add a taxonomy field for categories you want to sort your materials by (ex: by location, such as by county, by neighborhood, or by room in a museum). You will have to create the choices in this category (ex: by county; Clinton, Essex, Warren, and Jefferson). Taxonomy fields are best suited to a category with fewer than twenty choices, which do not need further explanation to a viewer.', 'diviner-archive' ); ?>
		</p>
		<p>
			<a href="post-new.php?post_type=<?php echo esc_attr( Diviner_Field::NAME ); ?>&field_type=<?php echo esc_attr( Taxonomy_Field::NAME ); ?>" class="button button-primary button-hero">
				Add a New Taxonomy Meta Field
			</a>
		</p>
	</div>
	
	<p>
		<?php _e( 'Note: This plugin will evolve overtime. We will be adding more field types (date, custom post type, taxonomy, and select) as well as real-time search experience.', 'diviner-archive' ); ?>
	</p>


</div>
