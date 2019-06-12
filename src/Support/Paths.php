<?php
/**
 * Helper class for fetching folder paths
 *
 * @package    NCPR\DivinerArchivePlugin\Support
 * @since      0.2.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Support;

use NCPR\DivinerArchivePlugin\Support\PluginData;

class Paths
{

    /**
     * Get the plugin's root directory Paths
     *
     * @since 0.2.0
     * @return string
     */
    public static function pluginDir()
    {
        if (! function_exists('plugin_dir_path')) {
            require_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        return \plugin_dir_path(PluginData::root());
    }

    /**
     * Get assets folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function assets()
    {
        return self::pluginDir() . 'assets/';
    }

    /**
     * Get config folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function config()
    {
        return self::pluginDir() . 'config/';
    }

    /**
     * Get dist folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function dist()
    {
        return self::pluginDir() . 'dist/';
    }
    /**
     * Get lang folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function lang()
    {
        return self::pluginDir() . 'lang/';
    }

    /**
     * Get src folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function src()
    {
        return self::pluginDir() . 'src/';
    }

    /**
     * Get test folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function test()
    {
        return self::pluginDir() . 'test/';
    }

    /**
     * Get views folder path
     *
     * @since 0.2.0
     * @return string
     */
    public static function views()
    {
        return self::pluginDir() . 'views/';
    }
}
