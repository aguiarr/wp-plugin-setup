<?php
/**
 * Plugin Name: WordPress Plugin Template
 * Plugin URI:  https://github.com/devaguia/
 * Description: Initial setup for wordpress plugin
 * Author:      Matheus Aguiar
 * Author URI:  https://github.com/devaguia/
 *
 * @link    https://github.com/devaguia/
 * @since   1.0.0
 * @package WPlugin
 */


require_once __DIR__ . '/vendor/autoload.php';

if (version_compare(phpversion(), '7.4') < 0) {
	wp_die(
		sprintf(
			"%s <p>%s</p>",
			__("The WordPress Plugin Template isn't compatible to your PHP version. ", 'wp-plugin-template'),
			__('The PHP version has to be a less 7.4!', 'wp-plugin-template')
		),
		'The WordPress Plugin Template -- Error',
		['back_link' => true]
	);
}

require_once __DIR__ . '/app/index.php';
