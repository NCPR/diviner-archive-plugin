<?php
/**
 * Service Providers
 *
 * @package    NCPR\DivinerArchivePlugin
 * @since      0.3.0
 * @author     graemehoffman
 * @link       https://ncpr.github.io/diviner-wp-archive-theme/
 * @license    GNU General Public License 2.0+
 */

return [
    'loader' => [
        'class' => NCPR\DivinerArchivePlugin\File\Loader::class,
    ],
    'constants' => [
        'class' => NCPR\DivinerArchivePlugin\Constants\Constants::class,
        'dependencies' => [
            'constants-config',
        ],
    ],
    'controller' => [
        'class' => NCPR\DivinerArchivePlugin\Controller\Controller::class,
        'dependencies' => [
            'container',
        ],
    ],
    'enqueue_controller' => [
        'class' => NCPR\DivinerArchivePlugin\Controller\EnqueueController::class,
        'dependencies' => [
            'container',
        ],
    ],
    'events' => [
        'class' => NetRivet\WordPress\EventEmitter::class,
    ],
    'plugin_I18n' => [
        'class' => NCPR\DivinerArchivePlugin\Setup\I18n::class,
    ],
    'attributes' => [
        'class' => NCPR\DivinerArchivePlugin\Forms\Attributes::class,
    ],
    'options' => [
        'class' => NCPR\DivinerArchivePlugin\Forms\Options::class,
    ],
    'forms' => [
        'class' => NCPR\DivinerArchivePlugin\Forms\Forms::class,
        'dependencies' => [
            'loader',
            'attributes',
            'options',
        ],
    ],
    'settings_config' => [
        'class' => NCPR\DivinerArchivePlugin\Settings\SettingsConfig::class,
        'params' => [
            NCPR\DivinerArchivePlugin\Support\Paths::config() . 'settings/settings.php',
            NCPR\DivinerArchivePlugin\Support\Paths::config() . 'settings/settings-defaults.php',
        ],
    ],
    'settings_callbacks' => [
        'class' => NCPR\DivinerArchivePlugin\Settings\SettingsCallbacks::class,
        'dependencies' => [
            'loader',
            'forms',
        ],
    ],
    'settings' => [
        'class' => NCPR\DivinerArchivePlugin\Settings\Settings::class,
        'dependencies' => [
            'settings_config',
            'settings_callbacks',
        ],
    ],
    'settings_api' => [
        'class' => NCPR\DivinerArchivePlugin\Settings\SettingsAPI::class,
        'dependencies' => [
            'settings_config',
            'settings_callbacks',
        ],
    ],
    'settings_pages' => [
        'class' => NCPR\DivinerArchivePlugin\Settings\SettingsPages::class,
        'dependencies' => [
            'settings_config',
            'settings_callbacks',
        ],
    ],
    'settings_link' => [
        'class' => NCPR\DivinerArchivePlugin\Settings\SettingsLink::class,
    ],
    'admin_controller' => [
        'class' => NCPR\DivinerArchivePlugin\Controller\AdminController::class,
        'dependencies' => [
            'container',
            'settings',
        ],
    ],
    'enqueue_manager' => [
        'class' => NCPR\DivinerArchivePlugin\Enqueue\EnqueueManager::class,
        'dependencies' => [
            'enqueue-config',
        ],
    ],
    'admin_enqueue_manager' => [
        'class' => NCPR\DivinerArchivePlugin\Enqueue\EnqueueManager::class,
        'dependencies' => [
            'admin-enqueue-config',
        ],
    ],
    'compatibility' => [
        'class' => NCPR\DivinerArchivePlugin\Setup\Compatibility::class,
        'dependencies' => [
            'requirements-config',
            'loader',
        ],
    ],
    'cpt' => [
        'class' => NCPR\DivinerArchivePlugin\CPT\CPT::class,
    ],
    'cpt_controller' => [
        'class' => NCPR\DivinerArchivePlugin\Controller\CPTController::class,
        'dependencies' => [
            'container',
        ],
    ],

	'carbonfields.helper' => [
		'class' => NCPR\DivinerArchivePlugin\CarbonFields\Helper::class,
	],

    'carbonfields.boot' => [
	    'class' => NCPR\DivinerArchivePlugin\CarbonFields\Boot::class,
    ],
    'post_types.diviner_field.diviner_field' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field::class,
    ],
    'post_types.diviner_field.postmeta' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Diviner_Field\PostMeta::class,
    ],
    'post_types.diviner_field.admin' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Diviner_Field\AdminModifications::class,
    ],
    'admin.settings' => [
	    'class' => NCPR\DivinerArchivePlugin\Admin\Settings::class,
    ],
    'post_types.archive_item.postmeta' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Archive_Item\Post_Meta::class,
    ],
    'post_types.archive_item.theme' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Archive_Item\Theme::class,
    ],
    'post_types.archive_item.admin' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Archive_Item\AdminModifications::class,
    ],
    'post_types.archive_item.rest' => [
	    'class' => NCPR\DivinerArchivePlugin\CPT\Archive_Item\Rest::class,
    ],
    'theme.browse_page' => [
	    'class' => NCPR\DivinerArchivePlugin\Theme\Browse_Page::class,
    ],
    'theme.js_config' => [
	    'class' => NCPR\DivinerArchivePlugin\Theme\JS_Config::class,
    ],
];
