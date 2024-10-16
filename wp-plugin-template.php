<?php

/**
 * Plugin Name:       WP Plugin Template
 * Plugin URI:        https://github.com/devaguia/wp-plugin-template
 * Description:       Template for WordPress Plugin
 * Author:            Matheus Aguiar
 * Author URI:        https://github.com/devaguia
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Requires at least: 6.0
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Requires Plugins:
 *
 * @link    https://github.com/devaguia
 * @since   1.0.0
 * @package WPlugin
 */


if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';


if (version_compare(phpversion(), '7.4') < 0) {
    wp_die(
        sprintf(
            "%s <p>%s</p>",
            __(
                "O plugin WP Plugin Template para WooCommerce não é compatível com a sua versão do PHP. ",
                'wp-plugin-template'
            ),
            __('A versão do PHP precisar maior ou igual a 7.4!', 'wp-plugin-template')
        ),
        'WP Plugin Template para WooCommerce -- Error',
        ['back_link' => true]
    );
}

$boot = new WPlugin\WordPress\Core\Boot;
$boot->initialize();
