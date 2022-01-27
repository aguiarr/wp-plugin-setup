<?php

namespace WPS\Helpers;

/**
 * Name: Hooks
 * Call the actions and filters
 * @package Helper
 * @since 1.0.0
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
