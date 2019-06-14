<?php

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Preset_Fields_List_Table;

?>

<div class="wrap wrap-diviner wrap-diviner--default">
	<?php
	$presetFieldTable = new Preset_Fields_List_Table();
	$presetFieldTable->prepare_items();
	?>
	<h2>

		<?php _e( 'Add Fields to Your Archive Items and the Browse Page', 'diviner-archive' ); ?>

		<a href="index.php?page=diviner_wizard" class="button button-primary">

			<?php _e( 'Create a New Meta Field', 'diviner-archive' ); ?>
		</a>
	</h2>


	<?php if ( $presetFieldTable->is_empty() ) { ?>
		<div class="about-text">
			<p>

				<?php printf(
					wp_kses(
						__( 'You have no custom fields currently active on your your archive items. That probably means you have just installed the plugin for the first time and are getting set up. Please refer to the documentation at <a href="%s" target="_blank">%s</a>.', 'diviner-archive' ),
						[ 'a' => [ 'href' => [], 'target' => [] ] ]
					),
					DOCUMENTATION_SITE_URL,
					DOCUMENTATION_SITE_URL
				); ?>
			</p>
			<p>
				<?php _e( 'Click through the below link to add more diviner meta fields to your archive item.', 'diviner-archive' ); ?>
			</p>
		</div>
	<?php } else { ?>
		<div class="about-text">
			<p>
				<?php _e( 'Listed below are the fields you have created and added to your archive items. These fields represent a) the information you wish to be connected to your archive items, and b) how visitors and users of your site will be able to search through your archive items. Activate all fields you wish to appear on the front and back end of your site.', 'diviner-archive' ); ?>

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
			_e( 'Build out your archive item!', 'diviner-archive' );
		} else {
			_e( 'Add meta data to your archive item', 'diviner-archive' );
		} ?>
	</h2>
	<a href="index.php?page=diviner_wizard" class="button button-primary button-hero">
		<?php _e( 'Create a New Meta Field', 'diviner-archive' ); ?>
	</a>
</div>
