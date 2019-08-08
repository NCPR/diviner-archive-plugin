<?php

namespace NCPR\DivinerArchivePlugin\CPT\Diviner_Field;

use NCPR\DivinerArchivePlugin\Admin\Settings;

/**
 * Class Admin Modifications
 *
 * @package Diviner\Post_Types\Diviner_Field
 */
class AdminModifications {

	const SLUG_WIZARD = 'diviner_wizard';

	public function hooks() {
	    // Hook on 11 to go after the main options page is hooked.
		add_action( 'admin_menu', [ $this, 'rc_scd_register_menu' ], 12 );
		add_filter( 'admin_body_class', [ $this, 'admin_body_class' ] );
		add_filter( 'gettext', [ $this, 'change_excerpt_text' ], 10, 2 );
		add_action( 'edit_form_after_title', [ $this, 'add_helper_text' ] );
		add_filter( 'post_updated_messages', [ $this, 'post_published' ] );

		// custom field table
		add_filter( 'manage_diviner_field_posts_columns', [ $this, 'set_custom_edit_field_columns' ] );
		add_action( 'manage_diviner_field_posts_custom_column' , [ $this, 'custom_field_column' ], 10, 2 );

		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
		add_action( 'edit_form_after_title', [ $this, 'edit_form_after_title' ] );

	}

	/*
	 *
	 * Outputs field type after title
	 *
	 * @hook edit_form_after_title
	 */
	public function edit_form_after_title() {
		global $post;
		if( !empty($post) && $post->post_type !== Diviner_Field::NAME) {
			return;
		}
		$field_id = get_the_id();
		if (isset($field_id) && $field_id > 0) {
			$field_type = Diviner_Field::get_field_post_meta( $field_id, PostMeta::FIELD_TYPE );
			if (isset($field_type)) {
				$field = Diviner_Field::get_class( $field_type );
				printf(
						'<div class="wrap "><i><b>Field Type:</b> %s</i></div>',
					$field::TITLE
				);
			}
		}
	}


	/*
	 *
	 * Adds the META boxes to the right on the edit creen
	 *
	 * @hook carbon_fields_register_fields
	 */
	public function add_meta_boxes() {

		add_meta_box(
			Diviner_Field::META_BOX_ID,
			__( 'Additional Field Details', 'diviner-archive' ),
			array( $this, 'render_metabox' ),
			Diviner_Field::NAME,
			'side',
			'default'
		);

	}

	/**
	 * Renders the meta boxes.
	 */
	public function render_metabox( $post ) {
		$field_id = get_the_id();
		if (isset($field_id) && $field_id > 0) {
			$field_type = Diviner_Field::get_field_post_meta( $field_id, PostMeta::FIELD_TYPE );
			if (isset($field_type)) {
				$field = Diviner_Field::get_class($field_type);
				$field_post_meta_box_content = call_user_func( [ $field, 'get_meta_box' ], $field, $field_id);
				echo $field_post_meta_box_content;
				return;
			}
		}
		return;
	}

	public function custom_field_column( $column, $post_id ) {
		switch ( $column ) {
			case 'field_active' :
				$field_active = carbon_get_post_meta( $post_id, PostMeta::FIELD_ACTIVE );
				echo ( (int)$field_active === 1 ) ? '✓' : '';
				break;
			case 'field_type' :
				$field_type = carbon_get_post_meta( $post_id, PostMeta::FIELD_TYPE );
				echo Diviner_Field::get_class_title( $field_type );
				break;
			case 'field_placement' :
				echo Diviner_Field::get_field_post_meta( $post_id, PostMeta::FIELD_BROWSE_PLACEMENT );
		}
	}

	public function set_custom_edit_field_columns($columns) {
		$new = [];
		foreach($columns as $key=>$value) {
			if($key=='date') {  // when we find the date column
				$new['field_active'] = __( 'Active', 'diviner-archive' );
				$new['field_type'] = __( 'Field Type', 'diviner-archive' );
				$new['field_placement'] = __( 'Browse Placement', 'diviner-archive' );

			}
			$new[$key]=$value;
		}

		return $new;
	}

	function post_published( $messages ) {
		$post = get_post();
		$messages[Diviner_Field::NAME] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Diviner Field updated.', 'diviner-archive' ),
			2  => __( 'Custom field updated.', 'diviner-archive' ),
			3  => __( 'Custom field deleted.', 'diviner-archive' ),
			4  => __( 'Diviner Field updated.', 'diviner-archive' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Diviner Field restored to revision from %s', 'diviner-archive' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Diviner Field published.', 'diviner-archive' ),
			7  => __( 'Diviner Field saved.', 'diviner-archive' ),
			8  => __( 'Diviner Field submitted.', 'diviner-archive' ),
			9  => sprintf(
				__( 'Diviner Field scheduled for: <strong>%1$s</strong>.', 'diviner-archive' ),
				date_i18n( __( 'M j, Y @ G:i', 'diviner-archive' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Diviner Field draft updated.', 'diviner-archive' )
		);

		return $messages;
	}

	function add_helper_text(){
		global $post;
		if( !empty($post) && $post->post_type !== Diviner_Field::NAME) {
			return;
		}
		printf( '<div>%s</div>', __( 'Label appearing on the Archive item Edit Screen', 'diviner-archive' ) );
	}

	/**
	 * Modify the excerpt header and help text for Divnier Fields admin
	 *
	 * @param  String $translation
	 * @param  String $original
	 * @return String modified strings
	 */
	function change_excerpt_text( $translation, $original ){
		global $post;
		if( !empty($post) && $post->post_type !== Diviner_Field::NAME) {
			return $translation;
		}
		if ( 'Excerpt' == $original ) {
			return __( 'Field Description', 'diviner-archive' ); //Change here to what you want Excerpt box to be called
		} else {
			$pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your');

			if ($pos !== false) {
				return __( 'Appears in the manage fields page of the admin', 'diviner-archive' );
			}
		}
		return $translation;
	}

	/**
	 * Adds one or more classes to the body tag in the dashboard.
	 *
	 * @param  String $classes Current body classes.
	 * @return String          Altered body classes.
	 */
	function admin_body_class( $classes ) {
		global $post;
		global $pagenow;

		$screen = get_current_screen();

		if (!$pagenow || !$post || !$screen) {
			return $classes;
		}

		$classes .= sprintf( ' post-edit--%s', $screen->post_type );

		if ( $screen->post_type !== Diviner_Field::NAME ) {
			return $classes;
		}

		if( in_array( $pagenow, [ 'post.php' ] ) ) {
			// get the type of field
			$type = Diviner_Field::get_field_post_meta( get_the_ID(), PostMeta::FIELD_TYPE );
			$classes .= sprintf( ' post-field-type--%s', $type );
		} else {
			// post-field-type--diviner_date_field
			if ( !empty( $_GET[ 'field_type' ] ) ) {
				$classes .= sprintf( ' post-field-type--%s', $_GET[ 'field_type' ] );
			}
		}
		return $classes;
	}

	function rc_scd_redirect_dashboard() {

		if( is_admin() ) {
			$screen = get_current_screen();

			if( $screen->base == 'dashboard' ) {

				wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );

			}
		}

	}

	function rc_scd_register_menu() {

		add_submenu_page(
			Settings::menu_slug(),
			'Diviner Meta Fields',
			'Manage Diviner Meta Fields',
			'manage_options',
			'diviner-plugin-manage-fields',
			[ $this, 'rc_scd_create_dashboard' ]
		);


	}

	function rc_scd_create_dashboard() {
		?>
		<div class="wrap wrap-diviner wrap-diviner--default">
			<?php
			$presetFieldTable = new Preset_Fields_List_Table();
			$presetFieldTable->prepare_items();
			?>
			<h2>
				Add Fields to Your Archive Items and the Browse Page
				<a href="index.php?page=<?php echo esc_attr( static::SLUG_WIZARD ); ?>" class="button button-primary">
					Create a New Meta Field
				</a>
			</h2>


			<?php if ( $presetFieldTable->is_empty() ) { ?>
				<div class="about-text">
					<p>
						You have not custom fields currently active on your your archive items. That probably means you have just installed the plugin for the first time and are getting set up. Please refer to the documentation at <a href="https://ncpr.github.io/diviner-wp-archive-theme/">https://ncpr.github.io/diviner-wp-archive-theme/</a>.
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
				_e( 'Build out your archive item!', 'diviner-archive' );
			} else {
				_e( 'Add meta data to your archive item', 'diviner-archive' );
			} ?>
			</h2>
			<a href="index.php?page=<?php echo esc_attr( static::SLUG_WIZARD ); ?>" class="button button-primary button-hero">
				Create a New Meta Field
			</a>
		</div>
		<?php
	}

}
