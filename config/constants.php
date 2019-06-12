<?php
/**
 * Plugin requirements parameters.
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.1.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

return array(

 /*********************************************************
 * Plugin constants to define
 *
 * Format:
 *    $unique_id => $value
 ********************************************************/

    'PLUGIN_ROOT'        => NCPR\DivinerArchivePlugin\Support\PluginData::root(),
    'PLUGIN_NAME'        => NCPR\DivinerArchivePlugin\Support\PluginData::headerData('Name'),
    'PLUGIN_BASENAME'    => NCPR\DivinerArchivePlugin\Support\PluginData::basename(),
    'PLUGIN_DIR_PATH'    => NCPR\DivinerArchivePlugin\Support\Paths::pluginDir(),
    'PLUGIN_DIR_URL'     => NCPR\DivinerArchivePlugin\Support\URLs::dirURL(),
    'PLUGIN_TEXT_DOMAIN' => NCPR\DivinerArchivePlugin\Support\PluginData::headerData('TextDomain'),
    'PLUGIN_VERSION'     => NCPR\DivinerArchivePlugin\Support\PluginData::headerData('Version'),
);
