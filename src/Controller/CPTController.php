<?php
/**
 * Custom Post Type controller
 *
 *
 * @package    NCPR\DivinerArchivePlugin\Controller
 * @since      0.4.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Controller;

use NCPR\DivinerArchivePlugin\CPT\CPT;
use NCPR\DivinerArchivePlugin\Events\EventManager;
use NCPR\DivinerArchivePlugin\Controller\Controller;
use NCPR\DivinerArchivePlugin\Container\ContainerInterface;

class CPTController extends Controller
{
    /**
     * Constructor
     *
     * @since    0.4.0
     * @param    ContainerInterface    $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * Add the custom post types
     *
     * @since 0.4.0
     * @return void
     */
    public function addCustomPostTypes()
    {
        EventManager::addAction('init', array(CPT::class, 'register'));
    }
}
