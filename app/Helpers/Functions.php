<?php

namespace WPHLC\Helpers;

use WPPluginSetup\Controllers\Menus;

class Functions
{
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

    public static function enqueue_admin_scripts() 
    {
        wp_enqueue_script( 'admin', WP_PLUGIN_DIST . '/admin.js');
        wp_enqueue_style( 'admin', WP_PLUGIN_DIST . '/admin.css');
    }

    public static function initialize()
    {
        load_plugin_textdomain( WP_PLUGIN_SLUG , false );
    }
}