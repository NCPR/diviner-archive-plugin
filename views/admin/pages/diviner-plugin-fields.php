<?php

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Preset_Fields_List_Table;

?>

<div class="wrap wrap-diviner wrap-diviner--default">
	<?php
	$presetFieldTable = new Preset_Fields_List_Table();
	$presetFieldTable->prepare_items();
	?>
	<h2>
		Add Fields to Your Archive Items and the Browse Page
		<a href="index.php?page=diviner_wizard" class="button button-primary">
			Create a New Meta Field
		</a>
	</h2>


	<?php if ( $presetFieldTable->is_empty() ) { ?>
		<div class="about-text">
			<p>
				You have no custom fields currently active on your your archive items. That probably means you have just installed the plugin for the first time and are getting set up. Please refer to the documentation at <a href="https://ncpr.github.io/diviner-wp-archive-theme/">https://ncpr.github.io/diviner-wp-archive-theme/</a>.
			</p>
			<p>
				Click through the below link to add more diviner meta fields to your archive item.
			</p>
		</div>
	<?php } else { ?>
		<div class="about-text">
			<p>
				Listed below are the fields you have created and added to your archive items. These fields represent a) the information you wish to be connected to your archive items, and b) how visitors and users of your site will be able to search through your archive items. Activate all fields you wish to appear on the front and back end of your site.
			</p>
		</div>
		<div>
			<form id="diviner-fields" method="get">
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
				<?php $presetFieldTable->display(); ?>
			</form>
		</div>
	<?php } ?>
</div>
<div class="wrap wrap-diviner wrap-diviner--auto-width wrap-diviner--light">
	<h2>
		<?php if ( $presetFieldTable->is_empty() ) {
			_e( 'Build out your archive item!', 'diviner-archive-plugin' );
		} else {
			_e( 'Add meta data to your archive item', 'diviner-archive-plugin' );
		} ?>
	</h2>
	<a href="index.php?page=diviner_wizard" class="button button-primary button-hero">
		Create a New Meta Field
	</a>
</div>
