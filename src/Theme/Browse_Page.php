<?php


namespace NCPR\DivinerArchivePlugin\Theme;

use NCPR\DivinerArchivePlugin\Admin\Settings;
use NCPR\DivinerArchivePlugin\Support\PluginData;
use NCPR\DivinerArchivePlugin\Plugin;
use NCPR\DivinerArchivePlugin\Theme\JS_Config;

/**
 * Setting up the Browse page at startup
 *
 * @package NCPR\DivinerArchivePlugin\Theme\Browse_Page
 */
class Browse_Page {

	const DIV_OPTION_REWRITE_RULES = "div_option_rewrite_rules";
	const SHORTCODE  = "diviner_browse_page";

	const IMAGE_SIZE_BROWSE_POPUP = 'image_size_browse_popup';
	const IMAGE_SIZE_BROWSE_GRID = 'image_size_browse_grid';

	static $image_sizes = [
		self::IMAGE_SIZE_BROWSE_POPUP => [
			'width'  => 600,
			'height' => 0,
			'crop'   => true,
		],
		self::IMAGE_SIZE_BROWSE_GRID => [
			'width'  => 600,
			'height' => 600,
			'crop'   => true,
		],
	];


	public function hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_filter( 'diviner_js_config', [ $this, 'filter_diviner_js_config' ] );
		add_filter( 'after_setup_theme', [ $this, 'add_image_sizes' ] );

		add_shortcode(static::SHORTCODE, [ $this, 'get_browse_page_shortcode' ] );
	}

	public function add_image_sizes() {
		foreach ( static::$image_sizes as $key => $attributes ) {
			add_image_size( $key, $attributes[ 'width' ], $attributes[ 'height' ], $attributes[ 'crop' ] );
		}

	}

	/**
	 * Browse Page shortcode
	 *
	 */
	function get_browse_page_shortcode() {
		echo '<div id="browse-app"></div>';
	}

	/**
	 * Browse Page Localization
	 *
	 */
	function get_browse_page_localization() {
		return [
			'popup_permission_statement' => __( 'Permissions Statement', 'ncpr-diviner' ),
			'popup_view_details' => __( 'View Details', 'ncpr-diviner' ),
			'popup_previous' => __( 'Previous', 'ncpr-diviner' ),
			'popup_next' => __( 'Next', 'ncpr-diviner' ),
			'grid_default' => __( 'Happy searching!!', 'ncpr-diviner' ),
			'grid_loading' => __( 'Loading', 'ncpr-diviner' ),
			'grid_no_results' => __( 'No Results Found', 'ncpr-diviner' ),
			'paginate_previous' => __( 'Previous', 'ncpr-diviner' ),
			'paginate_next' => __( 'Next', 'ncpr-diviner' ),
			'search_header' => __( 'Search Archive', 'ncpr-diviner' ),
			'search_placeholder' => __( 'Ex: cheese factory, grocery store, mine...', 'ncpr-diviner' ),
			'search_cta' => __( 'Go', 'ncpr-diviner' ),
			'facets_header' => __( 'Narrow Results By:', 'ncpr-diviner' ),
			'facets_sort_label' => __( 'Sort By:', 'ncpr-diviner' ),
			'facets_sort_clear' => __( 'Clear Order', 'ncpr-diviner' ),
			'facets_reset' => __( 'Reset Search Filters','ncpr-diviner' )
		];
	}

	/**
	 * Filter config js data
	 *
	 */
	function filter_diviner_js_config( $data ) {
		$permalink = get_permalink();
		$permalink_structure = get_option( 'permalink_structure' );

		$new_data = [
			'base_browse_url' => '/' . basename( $permalink ),
			'permalink_structure' => $permalink_structure,
			'browse_page_title' => get_the_title(),
			'browse_page_localization' => $this->get_browse_page_localization()
		];
		return array_merge($new_data, $data);
	}

	static function is_browse_page() {
		global $post;
		return has_shortcode( $post->post_content, static::SHORTCODE );
	}

	/**
	 * Enqueue scripts if the shortcode is present
	 *
	 */
	function enqueue_scripts() {
		global $post;
		if( static::is_browse_page() ) {
			$version = PluginData::headerData('Version');
			$app_scripts    = plugin_dir_url(PluginData::basename()).'browse-app/dist/master.js';

			// plugin_dir_path($this->plugin_root_file) . 'config/';

			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG === true ) {
				$app_scripts = apply_filters( 'browse_js_dev_path', $app_scripts );
			}
			wp_register_script( 'core-app-browse', $app_scripts );
			$js_config = new JS_Config();
			wp_localize_script( 'core-app-browse', 'diviner_config', $js_config->get_data() );
			wp_enqueue_script( 'core-app-browse', $app_scripts, [  ], $version, true );
		}

	}


}
