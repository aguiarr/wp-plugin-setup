<?php

namespace WPS\Helpers;

/**
 * Name: Hooks
 * @package Helper
 * Description: Call the actions and filters
 * @since 0.0.1
 */
add_action( 'admin_menu', [
    'WPS\Helpers\Functions',
    'create_admin_menu'
] );

add_action( 'init', [
    'WPS\Helpers\Functions',
    'initialize'
] );

add_action( 'init', [
    'WPS\Helpers\Functions',
    'handle_actions'
] );
