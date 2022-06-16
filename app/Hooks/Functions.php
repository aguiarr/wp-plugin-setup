<?php

namespace WPT\Hooks;

use WPT\Controllers\Menus;
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
        wp_enqueue_style( 'fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" );
    }

    /**
     * Load theme scripts
     * @since 1.0.0
     * @return void
     */
    public static function enqueue_theme_scripts() 
    {
        if ( ! is_admin() ) {
            wp_enqueue_script( 'theme', Config::__dist( 'theme.js' ) );
            wp_enqueue_style( 'theme', Config::__dist( 'theme.css' ) );
        }
    }

    /**
     * Initialize plugin
     * @since 1.0.0
     * @return void
     */
    public static function initialize()
    {
        load_plugin_textdomain( WPT_PLUGIN_SLUG , false );
        self::enqueue_theme_scripts();
    }
}