<?php

namespace WCCoreios;

// Define global constants
define('WP_PLUGIN_NAME', __('Plugin Template', 'wp-plugin-template'));
define('WP_PLUGIN_SLUG', 'wp-plugin-template');
define('WP_PLUGIN_NAMESPACE', 'WPlugin');
define('WP_PLUGIN_PREFIX', 'wpt');

defined('ABSPATH') || exit;

if (!function_exists('add_action')) {
    exit;
}

require_once 'Core/Actions.php';
