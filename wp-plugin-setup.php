<?php
/**
 * Plugin Name: WP Plugin Setup
 * Plugin URI:  https://github.com/aguiarrdev/
 * Description: Initial setup for wordpress plugin
 * Author:      Matheus Aguiar
 * Author URI:  https://github.com/aguiarrdev/
 *
 * @link    https://github.com/aguiarrdev/
 * @since   0.0.1
 * @package WPS
 */

require __DIR__ . '/vendor/autoload.php';
if ( version_compare( phpversion(), '5.6' ) < 0  ) {
	wp_die( "The WP Plugin Setup isn't compatible to your PHP version. <p>The PHP version has to be a less 5.7</p>",
		'The WP Plugin Setup -- Error',
		[ 'back_link' => true ]
	);
}

require_once __DIR__ . '/app/index.php';