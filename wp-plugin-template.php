<?php
/**
 * Plugin Name: WordPress Plugin Template
 * Plugin URI:  https://github.com/aguiarrdev/
 * Description: Initial setup for wordpress plugin
 * Author:      Matheus Aguiar
 * Author URI:  https://github.com/aguiarrdev/
 *
 * @link    https://github.com/aguiarrdev/
 * @since   1.0.0
 * @package WPT
 */

require __DIR__ . '/vendor/autoload.php';
if ( version_compare( phpversion(), '5.6' ) < 0  ) {
	wp_die( "The WordPress Plugin Template isn't compatible to your PHP version. <p>The PHP version has to be a less 5.7</p>",
		'The WordPress Plugin Template -- Error',
		[ 'back_link' => true ]
	);
}

require_once __DIR__ . '/app/index.php';