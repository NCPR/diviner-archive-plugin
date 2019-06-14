<?php

use const NCPR\DivinerArchivePlugin\DOCUMENTATION_SITE_URL;

?>
<div class="wrap wrap-diviner wrap-diviner--limited wrap-diviner--default">

	<h2>
		<?php _e( 'Diviner Archiving Plugin', 'diviner-archive' ); ?>
	</h2>

	<p>
		<?php _e( 'Thank you for installing the Diviner Archiving Plugin. This wordpress plugin allows small institutions and media organizations to create a public-facing, custom archive interface for a themed collection of media.', 'diviner-archive' ); ?>
	</p>

	<p><?php _e( 'The main features of this project are', 'diviner-archive' ); ?></p>
	<ul>
		<li><?php _e( 'Small scale archiving tool for a wide array of media materials (audio, video, documents, articles)', 'diviner-archive' ); ?></li>
		<li><?php _e( 'Dublin Core-like meta data fields', 'diviner-archive' ); ?></li>
	</ul>

	<p>
		<?php printf(
			wp_kses(
				__( 'Read more about this plugin on the <a href="%s" target="_blank">documentation website</a>.', 'diviner-archive' ),
				[ 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			DOCUMENTATION_SITE_URL
		); ?>

	</p>

	<p>
		<?php _e( 'Start by reviewing the general settings of your archive.', 'diviner-archive' ); ?>
	</p>

	<p>
		<a href="admin.php?page=crb_carbon_fields_container_general_diviner_settings.php" class="button button-primary">
			<?php _e( 'General Diviner Settings', 'diviner-archive' ); ?>
		</a>
	</p>

	<p>
		<?php _e( 'Next, create new meta data fields for your archive items.', 'diviner-archive' ); ?>
	</p>

	<p>
		<a href="index.php?page=diviner_wizard" class="button button-primary">
			<?php _e( 'Create New Diviner Meta Field', 'diviner-archive' ); ?>
		</a>
	</p>

	<p>
		<?php _e( 'Note: This plugin will evolve overtime. We will be adding more field types (date, custom post type, taxonomy, and select) as well as real-time search experience.', 'diviner-archive' ); ?>
	</p>



</div>