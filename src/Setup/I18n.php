<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    NCPR\DivinerArchivePlugin\Setup
 * @since      0.1.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Setup;

use NCPR\DivinerArchivePlugin\Support\Paths;
use const NCPR\DivinerArchivePlugin\PLUGIN_TEXT_DOMAIN;

class I18n
{
    /**
     * The domain specified for this plugin.
     *
     * @since    0.1.0
     * @access   private
     * @var      string    $domain    The domain identifier for this plugin.
     */
    private $domain;

    /**
     * Load the plugin text domain for translation.
     *
     * @since    0.1.0
     */
    public function loadPluginTextDomain()
    {
        \load_plugin_textdomain(
            PLUGIN_TEXT_DOMAIN,
            false,
            Paths::lang()
        );
    }
}
