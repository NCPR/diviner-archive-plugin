<?php

/**
 *
 * @link              https://ncpr.github.io/diviner-wp-archive-theme/
 * @since             0.1.0
 * @package           Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Diviner Archive Plugin
 * Plugin URI:        https://ncpr.github.io/diviner-wp-archive-theme/
 * Description:       Provides a set of tools for wordpress sites with archives. Developed wth North Country Public Radio
 * Version:           1.0.0
 * Author:            Graeme Hoffman
 * Author URI:        http://graemehoffman.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       diviner-archive-plugin
 * Domain Path:       /resources/lang/
 */

use NCPR\DivinerArchivePlugin\Plugin;
use NCPR\DivinerArchivePlugin\Container\Container;
use NCPR\DivinerArchivePlugin\Setup\Activation;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
     die;
}

$autoloader = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloader)) {
    include_once $autoloader;
}

// $results = $autoloader->findFile("\MyNamespace\MyClassName");
// print "Found file for class at: $results";

Activation::register(__FILE__);

add_action('plugins_loaded', function () {
    $container = container();
    $container->set('plugin', new Plugin($container, __FILE__));
    $container->get('plugin')->init();
});


/**
 * Get plugin's container
 *
 * @since  0.2.0
 * @return Container
 */
function container() : Container
{
    static $container;
    if (! $container) {
        $container = new Container();
    }
    return $container;
}
