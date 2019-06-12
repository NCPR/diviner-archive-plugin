<?php
/**
 * CSS and Javascript files to enqueue with WordPress.
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.2.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */


return array(

    /*********************************************************
    * Front-end stylesheets and scripts to enqueue
    *
    * Format:
    * 'stylesheets' => array(
    *     'plugin-name' => array(
    *         'file_name'    => 'plugin-name',
    *         'dependencies' => array(),
    *         'media'        => 'all',
    *     ),
    * ),
    * 'scripts' => array(
    *     'plugin-name' => array(
    *         'file_name'    => 'plugin-name',
    *         'dependencies' => array(),
    *         'in_footer'    => true,
    *     ),
    * ),
    ********************************************************/

    'stylesheets' => array(
        array(
            'file_name'    => 'diviner-archive',
            'dependencies' => array(),
            'media'        => 'all',
        ),
        // array(
        //     'file_name'    => 'other-name',
        //     'dependencies' => array(),
        //     'media'        => 'all',
        // ),
    ),
    'scripts' => array(
        array(
            'file_name'    => 'diviner-archive',
            'dependencies' => array(),
            'in_footer'    => true,
        ),
        // array(
        //     'file_name'    => 'other-name',
        //     'dependencies' => array(),
        //     'in_footer'    => true,
        // ),
    ),
);
