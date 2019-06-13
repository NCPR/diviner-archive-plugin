<?php
/**
 * Admin controller
 *
 *
 * @package    NCPR\DivinerArchivePlugin\Controller
 * @since      0.3.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Controller;

use NCPR\DivinerArchivePlugin\Settings\Settings;
use NCPR\DivinerArchivePlugin\Events\EventManager;
use NCPR\DivinerArchivePlugin\Controller\Controller;
use NCPR\DivinerArchivePlugin\Container\ContainerInterface;

use const NCPR\DivinerArchivePlugin\PLUGIN_BASENAME;

class AdminController extends Controller
{
    /**
     * Constructor
     *
     * @since    0.3.0
     * @param    ContainerInterface    $container
     * @param    Settings              $settings
     */
    public function __construct(ContainerInterface $container, Settings $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Load the admin pages, settings and settings link
     *
     * @since  0.3.0
     * @return
     */
    public function load()
    {
        $this->addAdminSettings();
        $this->registerSettingsLink();
    }

    /**
     * Add the Admin pages configuration and register them with WordPress
     *
     * @since 0.3.0
     * @return
     */
    protected function addAdminSettings()
    {
        $this->settings->withSubPage('Diviner Dashboard');

        if (! empty($this->settings->pages) || ! empty($this->settings->subpages)) {
            EventManager::addAction('admin_menu', array($this->settings, 'createAdminPages'));
        }

        if (! empty($this->settings->settings)) {
            EventManager::addAction('admin_init', array($this->settings, 'registerSettings'));
        }
    }

    /**
     * Register the "Settings" link on the plugin activation page with WordPress
     *
     * @since  0.3.0
     * @return
     */
    protected function registerSettingsLink()
    {
        // $settings_link = $this->container->get('settings_link');
        // $settings_link->setSettingsURL($this->config['settings_url']);
        // EventManager::addFilter('plugin_action_links_' . PLUGIN_BASENAME, array($settings_link, 'createSettingsLink'));
    }
}
