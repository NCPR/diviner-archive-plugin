<?php
/**
 * Base controller class
 *
 *
 * @package    NCPR\DivinerArchivePlugin\Controller
 * @since      0.3.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Controller;

use NCPR\DivinerArchivePlugin\Container\ContainerInterface;

class Controller
{
    /**
     * Container instance
     * @var Container
     */
    public $container;

    /**
     * Constructor
     *
     * @since 0.3.0
     * @param ContainerInterface    $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
