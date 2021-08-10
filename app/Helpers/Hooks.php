<?php

namespace WPPluginSetup\Helpers;

use WPPluginSetup\Controllers\Menus;

/**
 * Name: Hooks
 * Package: Helper
 * Description: Call the actions and filters
 * Version: 1.0.0
 */
add_action( 'admin_menu', function (){
        add_menu_page(
            WP_PLUGIN_NAME, 
            WP_PLUGIN_NAME,
            'read',
            WP_PLUGIN_SLUG,
            false,
            'dashicons-editor-code'
        );

        new Menus();

        wp_enqueue_script( 'admin', WP_PLUGIN_DIST . '/admin.js');
        wp_enqueue_style( 'admin', WP_PLUGIN_DIST . '/admin.css');
    }
);
