<?php

use const NCPR\DivinerArchivePlugin\DOCUMENTATION_SITE_URL;

?>
<div class="wrap wrap-diviner wrap-diviner--limited wrap-diviner--default">

	<h2><?php _e( 'Diviner Archiving Theme', 'diviner-archive-plugin' ); ?></h2>

	<p>
		<?php _e( 'Thank you for installing the Diviner Archiving Theme. This wordpress theme allows small institutions and media organizations to create a public-facing, custom archive interface for a themed collection of media.', 'diviner-archive-plugin' ); ?>
	</p>

	<p><?php _e( 'The main features of this project are', 'diviner-archive-plugin' ); ?></p>
	<ul>
		<li><?php _e( 'Small scale archiving tool for a wide array of media materials (audio, video, documents, articles)', 'diviner-archive-plugin' ); ?></li>
		<li><?php _e( 'Dublin Core-like meta data fields', 'diviner-archive-plugin' ); ?></li>
		<li><?php _e( 'Customizable multi-faceted search mechanism', 'diviner-archive-plugin' ); ?></li>
	</ul>

	<p>
		<?php printf(
			wp_kses(
				__( 'Read more about this theme on the <a href="%s" target="_blank">documentation website</a>.', 'diviner-archive-plugin' ),
				[ 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			DOCUMENTATION_SITE_URL
		); ?>

	</p>

	<p>
		<?php _e( 'Start by reviewing the general settings of your archive.', 'diviner-archive-plugin' ); ?>
	</p>

	<p>
		<a href="admin.php?page=<?php echo esc_attr( 'ToDo:$theme_options->get_page_file()' ); ?>" class="button button-primary">
			<?php _e( 'General Diviner Settings', 'diviner-archive-plugin' ); ?>
		</a>
	</p>

	<p>
		<?php _e( 'Next, create new meta data fields for your archive items.', 'diviner-archive-plugin' ); ?>
	</p>

	<p>
		<a href="index.php?page=" class="button button-primary">
			<?php _e( 'Create New Diviner Meta Field', 'diviner-archive-plugin' ); ?>
		</a>
	</p>



</div>