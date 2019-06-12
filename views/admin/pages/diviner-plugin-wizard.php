<?php

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Types\Text_Field;

?>


<div class="wrap wrap-diviner wrap-diviner--limited wrap-diviner--default">

	<h2>Select a Diviner Meta Field to Create</h2>

	<p>
		So you have a bunch of photos/videos/documents….but how do you want your audience to be able to find them? Whether it’s by date, location, or subject matter, this is where you simultaneously
	</p>

	<ul>
		<li>
			Design your uploading experience by choosing what information will be assigned to each archive item, and
		</li>
		<li>
			Design the browse page of your archive.
		</li>
	</ul>

	<p>
		<b>
			There are five kinds of fields:
		</b>
	</p>

	<div class="field-select-wrap">
		<h2>Text Field</h2>
		<p>
			<?php _e('Add a text field for information you wish to assign to each archive item. Example: serial number, catalog number, internal title, secondary description etc.', 'diviner-archive-plugin' ); ?>
		</p>
		<p>
			<a href="post-new.php?post_type=<?php echo esc_attr( Diviner_Field::NAME ); ?>&field_type=<?php echo esc_attr( Text_Field::NAME ); ?>" class="button button-primary button-hero">
				Add a New Text Meta Field
			</a>
		</p>
	</div>

</div>
