<?php

namespace WPT\Hooks;

/**
 * Name: Hooks
 * Call the actions and filters
 * @package Hooks
 * @since 1.0.0
 */

add_action( 'admin_menu', [ 
    Functions::class,
    'create_admin_menu' 
] );

add_action( 'init', [ 
    Functions::class, 
    'initialize' 
] );

