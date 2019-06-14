<?php
/**
 * Constants Contract
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.1.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

namespace NCPR\DivinerArchivePlugin\Constants;

interface ConstantsInterface
{

    /**
     * Define the plugin's constants
     *
     * @since  0.1.0
     * @return null
     */
    public function define();

    /**
     * Add additional constants to the default constants array
     *
     * @since 0.1.0
     * @return array    $this->constants    The plugin constants
     */
    public function add(array $constants);
}
