<?php

namespace WPT;

// Define names
define( 'WPT_PLUGIN_NAME', 'WordPress Plugin Template' );
define( 'WPT_PLUGIN_SLUG', 'wp-plugin-template' );
define( 'WPT_PLUGIN_PREFIX', 'wpt' );
define( 'WPT_PLUGIN_NAMESPACE', 'WPT' );

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'add_action' ) ) exit;

require 'Hooks/Hooks.php';