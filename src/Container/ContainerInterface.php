<?php
/**
 * Container interface
 *
 * @package    NCPR\DivinerArchivePlugin\Container
 * @since      0.2.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Container;

interface ContainerInterface
{
    /**
     * Get instance of Container
     *
     * @since  0.3.0
     * @param  string  $id  The unique identifier for the parameter or object
     * @return Container
     */
    public static function instance(string $id);

    /**
     * Get item from container
     *
     * @param string $id The unique identifier for the parameter or object
     * @return mixed
     */
    public function get(string $id);

    /**
     * Set item in container
     *
     * @param string $id    The unique identifier for the parameter or object
     * @param mixed $value
     */
    public function set(string $id, $value);

    /**
     * Checks if a parameter or an object is set.
     *
     * @since 0.1.0
     *
     * @param  string $id    The unique identifier for the parameter or object
     * @return bool
     */
    public function has(string $id);

    /**
     * Set item in container with Config dependency
     *
     * @since 0.2.0
     * @param string    $id          The unique identifier for the parameter or object
     * @param string    $class       Fully qualified class name to instantiate
     * @param string    $config_file The name of the config file
     * @param boolean   $setter      (Optional) Constructor or setter injection
     */
    public function setWithConfig(string $id, $class, $config_file, $setter = false);
}
