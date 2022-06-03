<?php

namespace WPT\Hooks;

use WPT\Controllers\Menus;
use WPT\Helpers\Config;
use WPT\Helpers\Utils;

/**
 * Name: Function
 * Handle the hooks functions
 * @package Helper
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
            'dashicons-editor-code'
        );

        new Menus();

        self::enqueue_admin_scripts();
    }

    /**
     * Load admin scripts
     * @since 1.0.0
     * @return void
     */
    public static function enqueue_admin_scripts() 
    {
        wp_enqueue_script( 'admin', Config::__dist( 'admin.js' ) );
        wp_enqueue_style( 'admin', Config::__dist( 'admin.css' ) );
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
     * handle plugins actions
     * @since 1.0.0
     * @return void
     */
    public static function handle_actions()
    {
        $action_name = WPT_PLUGIN_PREFIX . '_action';
        $vars = isset( $_REQUEST[$action_name] ) ? (array) $_REQUEST : array();

        if ( is_array( $vars ) && isset( $vars[$action_name] ) ) {
            $controller = Utils::parse_controller( $vars[$action_name] );

            new $controller( $vars );
        }
    }
}