<?php

namespace WPPluginSetup;

// Define names
define( 'WP_PLUGIN_NAME', 'WP Plugin Setup' );
define( 'WP_PLUGIN_SLUG', 'wp-plugin-setup' );

// Define paths
define( 'WP_PLUGIN_PATH', WP_PLUGIN_DIR . '/'. WP_PLUGIN_SLUG );
define( 'WP_PLUGIN_IMAGES',  plugins_url() . '/' . WP_PLUGIN_SLUG . '/resources/images' ) ;
define( 'WP_PLUGIN_DIST', plugins_url() . '/' . WP_PLUGIN_SLUG . '/dist');

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'add_action' ) ) exit;

require 'Helpers/Hooks.php';