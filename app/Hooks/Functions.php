<?php

namespace WPT\Hooks;

use WPT\Model\Database\Bootstrap;
use WPT\Controllers\Menus;
use WPT\Helpers\Uninstall;
use WPT\Helpers\Config;

/**
 * Name: Function
 * Handle the hooks functions
 * @package Hooks
 * @since 1.0.0
 */
class Functions
{
    /**
     * Create admin menu
     * @since 1.0.0
     * @return void
     */
    public static function create_admin_menu()
    {
        add_menu_page(
            WPT_PLUGIN_NAME, 
            WPT_PLUGIN_NAME,
            'read',
            WPT_PLUGIN_SLUG,
            false,
            'dashicons-buddicons-community'
        );

        new Menus();

        register_deactivation_hook( __FILE__, self::desactive() );
    }

    /**
     * Initialize plugin
     * @since 1.0.0
     * @return void
     */
    public static function initialize()
    {
        load_plugin_textdomain( WPT_PLUGIN_SLUG , false );
    }

    /**
     * Activate plugin
     * @since 1.0.0
     * @return void|bool
     */
    public static function activate( $plugin )
    {
        if ( Config::__base() === $plugin ) {
            new Bootstrap;
        }
    }

    /**
     * Desactive the plugin
     * @since 1.0.0
     * @return void
     */
    public static function desactive() {
        new Uninstall;
    }
}