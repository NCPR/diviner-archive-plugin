<?php
/**
 * CSS and Javascript files to enqueue for the WordPress admin.
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.2.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */


return array(

    /*********************************************************
    * Admin stylesheets and scripts to enqueue
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
        /*
    	array(
            'file_name'    => 'diviner-archive',
            'dependencies' => array(),
            'media'        => 'all',
        ),
        */
	    array(
	    	'file_name'    => 'diviner-archive-admin',
		    'dependencies' => array(),
		    'media'        => 'all',
	    ),
    ),
    'scripts' => array(
        /*
    	array(
            'file_name'    => 'diviner-archive',
            'dependencies' => array(),
            'in_footer'    => true,
        ),
        */
	    array(
	    	'file_name'    => 'diviner-archive-admin',
		    'dependencies' => array(),
		    'in_footer'    => true,
        ),
    ),
);
