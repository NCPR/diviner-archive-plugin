<?php
/**
 * The core plugin class.
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.1.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin;

use NCPR\DivinerArchivePlugin\Config\Config;
use NCPR\DivinerArchivePlugin\Container\Container;

use const NCPR\DivinerArchivePlugin\PLUGIN_ROOT;
use const NCPR\DivinerArchivePlugin\PLUGIN_BASENAME;

final class Plugin
{

    /**
     * Container instance
     * @var Container
     */
    public $container;

    /**
     * The plugin root file
     *
     * @var string
     */
    public $plugin_root_file;

    /**
     * The plugin top level namespace
     *
     * @var string
     */
    public $namespace;

    /**
     * Flag to track if the plugin is loaded.
     *
     * @var bool
     */
    private $loaded = false;

    /**
     * Constructor.
     *
     * @since 0.1.0
     * @param string    plugin_root_folder    Root folder of the plugin
     */
    public function __construct(Container $container, $plugin_root_file)
    {
        $this->container = $container;
        $this->plugin_root_file = $plugin_root_file;
        $this->namespace = __NAMESPACE__;
    }

    /**
     * Add default services to our Container
     *
     * @since 0.2.0
     */
    public function registerServices()
    {
        $service_providers = $this->container->get('service-providers-config')->config;

        foreach ($service_providers as $key => $value) {
            $args = [];

            if (array_key_exists('dependencies', $value)) {
                $args = $this->filterDependencies($value['dependencies']);
            }

            if (array_key_exists('params', $value)) {
                $args = array_merge($args, $value['params']);
            }

            if (!empty($args)) {
                $this->container->set($key, new $value['class'](...$args));
            } else {
                $this->container->set($key, new $value['class']());
            }
        }

        return $this;
    }

    protected function filterDependencies(array $dependencies)
    {
        foreach ($dependencies as $key => $value) {
            if ($value == 'container') {
                $dependencies[$key] = $this->container;
                continue;
            }
            $dependencies[$key] = $this->container->get($value);
        }

        return $dependencies;
    }

    /**
     * Initialize the plugin. Executes all initial tasks necessary to prepare the plugin to perform its objective(s).
     *
     * @since  0.1.0
     * @return object   $this   Instance of this object.
     */
    public function init()
    {
        if ($this->loaded) {
            return;
        }

        $this->registerConfigs();
        $this->registerServices();
        $this->container->get('constants')->define();
        $this->container->get('compatibility')->check();
        $this->container->get('plugin_I18n')->loadPluginTextDomain();
        $this->container->get('enqueue_controller')->enqueueAssets();
        $this->container->get('enqueue_controller')->enqueueAdminAssets();
        $this->container->get('admin_controller')->load();
        $this->container->get('cpt_controller')->addCustomPostTypes();

	    $this->container->get('carbonfields.boot')->boot_carbon_fields();
	    $this->container->get('post_types.diviner_field.diviner_field')->hooks();
	    $this->container->get('post_types.diviner_field.postmeta')->hooks();
	    $this->container->get('post_types.diviner_field.admin')->hooks();
	    $this->container->get('admin.settings')->hooks();
	    $this->container->get('post_types.archive_item.postmeta')->hooks();
	    $this->container->get('post_types.archive_item.theme')->hooks();
	    $this->container->get('post_types.archive_item.admin')->hooks();
	    $this->container->get('post_types.archive_item.rest')->hooks();
	    $this->container->get('theme.browse_page')->hooks();

	    $this->loaded = true;

        return $this;
    }

    /**
     * Register and instantiate the plugin configuration objects
     *
     * @since 0.3.0
     * @return void
     */
    protected function registerConfigs()
    {
        $config_dir_path = plugin_dir_path($this->plugin_root_file) . 'config/';
        $config_dir = scandir($config_dir_path);

        $config_files = $this->filterConfigDir($config_dir);

        foreach ($config_files as $config_id => $config_file) {
            $config_file = $config_dir_path . $config_file;
            $this->container->set($config_id . '-config', new Config($config_file));
        }

        return $this;
    }

    protected function filterConfigDir($config_dir)
    {
        foreach ($config_dir as $key => $value) {
            if (in_array($value, array('.','..','index.php')) || strpos($value, '.php') == false) {
                unset($config_dir[$key]);
            }
        }

        foreach ($config_dir as $config_file) {
            $config_id = str_replace('.php', '', $config_file);
            $config[$config_id] = $config_file;
        }

        return $config;
    }
}
