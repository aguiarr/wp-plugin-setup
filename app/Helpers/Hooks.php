<?php

namespace WPPluginSetup\Helpers;

/**
 * Name: Hooks
 * Package: Helper
 * Description: Call the actions and filters
 * Version: 1.0.0
 */
add_action( 'admin_menu', [
    'WPHLC\Helpers\Functions',
    'create_admin_menu'
] );

add_action( 'init', [
    'WPHLC\Helpers\Functions',
    'initialize'
] );
