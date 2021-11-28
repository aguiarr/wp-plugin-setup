<?php

namespace WPPluginSetup\Helpers;

/**
 * Name: Hooks
 * @package Helper
 * Description: Call the actions and filters
 * @since 0.0.1
 */
add_action( 'admin_menu', [
    'WPHLC\Helpers\Functions',
    'create_admin_menu'
] );

add_action( 'init', [
    'WPHLC\Helpers\Functions',
    'initialize'
] );
