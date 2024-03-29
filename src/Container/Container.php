<?php
/**
 * Dependency injection container class which extends Pimple
 *
 * @package    NCPR\DivinerArchivePlugin\Container
 * @since      0.2.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Container;

use NCPR\DivinerArchivePlugin\Config\Config;
use NCPR\DivinerArchivePlugin\File\Loader;
use NCPR\DivinerArchivePlugin\Support\Paths;
use Pimple\Container as Pimple;

class Container extends Pimple implements ContainerInterface
{
    /**
     * Instance of Container
     *
     * @var Container
     */
    public static $instance;

    /**
     * Contructor
     *
     * @since 0.3.0
     */
    public function __construct()
    {
        self::$instance = $this;
    }

    /**
     * Get instance of Container
     *
     * @since    0.3.0
     * @param    string    $id    The unique identifier for the parameter or object
     * @return   Container
     */
    public static function instance(string $id)
    {
        return self::$instance->get($id);
    }

    /**
     * Get item from container
     *
     * @since    0.3.0
     * @param    string    $id    The unique identifier for the parameter or object
     * @return   mixed
     */
    public function get(string $id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Set item in container
     *
     * @param string $id    The unique identifier for the parameter or object
     * @param mixed  $value
     */
    public function set(string $id, $value)
    {
        return $this->offsetSet($id, $value);
    }

    /**
     * Checks if a parameter or an object is set.
     *
     * @since 0.1.0
     *
     * @param  string $id    The unique identifier for the parameter or object
     * @return bool
     */
    public function has(string $id)
    {
        return $this->offsetExists($id);
    }

    /**
     * Set item in container with Config dependency
     *
     * @since 0.2.0
     * @param string    $id          The unique identifier for the parameter or object
     * @param string    $class       Fully qualified class name to instantiate
     * @param string    $config_file The name of the config file
     * @param boolean   $setter      (Optional) Constructor or setter injection
     * @param array     $params      (Optional) Array of parameters to pass to the class
     */
    public function setWithConfig(string $id, $class, $config_file, $setter = false, $params = [])
    {
        $file = Paths::config() . "{$config_file}.php";

        if (! Loader::isFileValid($file)) {
            return;
        }

        $config_id = str_replace('-', '_', $config_file) . '_config';
        $this->set($config_id, new Config($file));

        if (! empty($params) && $setter) {
            $this->set($id, new $class(...$params));
            return $this[ $id ]->setConfig($this[ $config_id ]);
        } elseif ($setter) {
            $this->set($id, new $class());
            return $this[ $id ]->setConfig($this[ $config_id ]);
        } elseif (! empty($params)) {
            array_unshift($params, $this[ $config_id ]);
            return $this->set($id, new $class(...$params));
        } else {
            return $this->set($id, new $class($this[ $config_id ]));
        }
    }
}
