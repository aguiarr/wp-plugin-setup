<?php

namespace WPPluginSetup\Helpers;

/**
 * Name: Hooks
 * @package Helper
 * Description: Call the actions and filters
 * @since 0.0.1
 */
add_action( 'admin_menu', [
    'WPPluginSetup\Helpers\Functions',
    'create_admin_menu'
] );

add_action( 'init', [
    'WPPluginSetup\Helpers\Functions',
    'initialize'
] );

add_action( 'init', [
    'WPPluginSetup\Helpers\Functions',
    'handle_actions'
] );
