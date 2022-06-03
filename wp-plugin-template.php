<?php
/**
 * Plugin Name: WordPress Plugin Template
 * Plugin URI:  https://github.com/codebakery/
 * Description: Initial setup for wordpress plugin
 * Author:      Code Bakery
 * Author URI:  https://github.com/codebakery/
 *
 * @link    https://github.com/codebakery/
 * @since   1.0.0
 * @package WPT
 */

require __DIR__ . '/vendor/autoload.php';
if ( version_compare( phpversion(), '7.4' ) < 0  ) {
	wp_die( "The WordPress Plugin Template isn't compatible to your PHP version. <p>The PHP version has to be a less 7.4</p>",
		'The WordPress Plugin Template -- Error',
		[ 'back_link' => true ]
	);
}

require_once __DIR__ . '/app/index.php';