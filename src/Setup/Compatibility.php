<?php
/**
 * Class that checks if all system requirements are met to run this plugin.
 *
 * @package    NCPR\DivinerArchivePlugin\Setup
 * @since      0.1.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Setup;

use NCPR\DivinerArchivePlugin\File\Loader;
use NCPR\DivinerArchivePlugin\Support\Paths;
use NCPR\DivinerArchivePlugin\Container\Container;
use NCPR\DivinerArchivePlugin\Events\EventManager;
use NCPR\DivinerArchivePlugin\File\LoaderInterface;
use const NCPR\DivinerArchivePlugin\PLUGIN_BASENAME;
use NCPR\DivinerArchivePlugin\Config\ConfigInterface;

class Compatibility
{

    /**
     * Current version of WordPress
     *
     * @var string
     */
    public $wp_version;

    /**
     * Minimum version of WordPress required to run plugin
     *
     * @var string
     */
    public $min_wp_version;

    /**
     * Current version of PHP
     *
     * @var string
     */
    public $php_version;

    /**
     * Minimum version of PHP required to run plugin
     *
     * @var string
     */
    public $min_php_version;

    public function __construct(ConfigInterface $config, LoaderInterface $loader)
    {
        $this->wp_version = get_bloginfo('version');
        $this->min_wp_version = $config['min_wp_version'];
        $this->php_version = phpversion();
        $this->min_php_version = $config['min_php_version'];
        $this->loader = $loader;
    }

    /**
     * Check if requirements are met to activate and run plugin
     *
     * @since  0.1.0
     * @return null
     */
    public function check()
    {
        if ($this->allCompatible()) {
            return;
        } else {
            $this->addAdminEvents();
        }
    }

    /**
     * Check if all requirements are met
     *
     * @since  0.1.0
     * @return bool
     */
    public function allCompatible()
    {
        return $this->isCompatible($this->wp_version, $this->min_wp_version) &&
               $this->isCompatible($this->php_version, $this->min_php_version);
    }

    /**
     * Check if specific requirement is met
     *
     * @since  0.1.0
     * @param  string    $current Current version
     * @param  string    $minimum Minimum required version
     * @return bool
     */
    public function isCompatible($current, $minimum)
    {
        return version_compare($current, $minimum, '>=');
    }

    /**
     * Disable the plugin and hide the default "Plugin activated" notice
     *
     * @since  0.1.0
     * @return null
     */
    public function disablePlugin()
    {
        if (current_user_can('activate_plugins') && is_plugin_active(PLUGIN_BASENAME)) {
            deactivate_plugins(PLUGIN_BASENAME);

            // Hide the default "Plugin activated" notice
            if (isset($_GET[ 'activate' ])) {
                unset($_GET[ 'activate' ]);
            }
        }
    }

    /**
     * Render the "Requirements not met" error notice
     *
     * @since  0.1.0
     * @return null
     */
    public function renderNotice()
    {
        $notice = Paths::views() . 'errors/compatibility-notice.php';
        printf($this->loader->loadOutputFile($notice, $this));
    }

    /**
     * Render the dashicon in the "Requirements not met" error notice
     *
     * @since  0.1.0
     * @param  string    $current Current version
     * @param  string    $minimum Minimum required version
     * @return null
     */
    public function renderDashicon($current, $minimum)
    {
        $this->isCompatible($current, $minimum) ? ($dashicon = 'yes' and $color = '#46b450') : ($dashicon = 'no' and $color = '#dc3232');

        printf('<span class="dashicons dashicons-%s" style="color:%s"></span>', $dashicon, $color);
    }

    /**
     * Add admin event listeners
     *
     * @since 0.1.0
     */
    private function addAdminEvents()
    {
        EventManager::addAction('admin_init', array($this, 'disablePlugin'));
        EventManager::addAction('admin_notices', array($this, 'renderNotice'));
    }
}
