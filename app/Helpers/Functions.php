<?php

namespace WPS\Helpers;

use WPS\Controllers\Menus;
use WPS\Helpers\Utils;

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
     * @return Void
     */
    public static function create_admin_menu()
    {
        add_menu_page(
            WP_PLUGIN_NAME, 
            WP_PLUGIN_NAME,
            'read',
            WP_PLUGIN_SLUG,
            false,
            'dashicons-editor-code'
        );

        new Menus();

        self::enqueue_admin_scripts();
    }

    /**
     * Load admin scripts
     * @since 1.0.0
     * @return Void
     */
    public static function enqueue_admin_scripts() 
    {
        wp_enqueue_script( 'admin', WP_PLUGIN_DIST . '/admin.js');
        wp_enqueue_style( 'admin', WP_PLUGIN_DIST . '/admin.css');
    }

    /**
     * Initialize plugin
     * @since 1.0.0
     * @return Void
     */
    public static function initialize()
    {
        load_plugin_textdomain( WP_PLUGIN_SLUG , false );
    }

    /**
     * handle plugins actions
     * @since 1.0.0
     * @return Void
     */
    public static function handle_actions()
    {
        $action_name = WP_PLUGIN_PREFIX . '_action';
        $vars = isset( $_REQUEST[$action_name] ) ? (array) $_REQUEST : array();

        if ( is_array( $vars ) && isset( $vars[$action_name] ) ) {
            $controller = Utils::parse_controller( $vars[$action_name] );

            new $controller( $vars );
        }
    }
}