<?php

namespace WPlugin\Core;

use WPlugin\API\Routes;
use WPlugin\Services\WooCommerce\WooCommerce;
use WPlugin\Controllers\Menus;
use WPlugin\Infrastructure\Bootstrap;

final class Functions
{
    public function initialize(): void
    {
        load_plugin_textdomain(wptConfig()->pluginSlug(), false);
    }


    public function createAdminMenu(): void
    {
        if (empty(self::getMissingDependencies())) {
            $menus = new Menus();
            $menus->initializeMenus();
        }
    }


    public function woocommerce(): void
    {
        if (class_exists('WooCommerce')) {
            $woocommerce = new WooCommerce;
            $woocommerce->inicializeWooommerce();
        }
    }


    public function setSettingsLink(array $arr, string $name): array
    {
        if ($name === wptConfig()->baseFile()) {

            $label = sprintf(
                '<a href="admin.php?page=wp-plugin-template-settings" id="deactivate-wp-plugin-template" aria-label="%s">%s</a>',
                __('Settings', 'wp-plugin-template'),
                __('Settings', 'wp-plugin-template')
            );

            $arr['settings'] = $label;
        }

        return $arr;
    }

    public function activationFunction(string $plugin): void
    {
        if (wptConfig()->baseFile() === $plugin) {
            $boot = new Bootstrap;
            $boot->initialize();
        }
    }

    public function desactivationFunction(): void
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }

        $action = $_REQUEST['action'] ?? false;
        $plugin = $_REQUEST['plugin'] ?? false;

        if ($action === 'deactivate' && $plugin === wptConfig()->baseFile()) {
            $uninstall = new Uninstall;
            $uninstall->reset();
        }
    }

    public function checkMissingDependencies(): void
    {
        $missingDependencies = self::getMissingDependencies();

        if (is_array($missingDependencies) && !empty($missingDependencies)) {
            add_action('admin_notices', [
                Functions::class, 'displayDependencyNotice'
            ]);
        }
    }

    public function getMissingDependencies(): array
    {
        $plugins = wp_get_active_and_valid_plugins();

        $neededs = [
            'WooCommerce' => wptConfig()->dynamicDir( __DIR__, 3 ) . '/woocommerce/woocommerce.php'
        ];

        foreach ($neededs as $key => $needed ) {
            if ( in_array( $needed, $plugins ) ) {
                unset( $neededs[$key] );
            }
        }

        return $neededs;
    }

    public function displayDependencyNotice(): void
    {
        $class = 'notice notice-error';
        $title = __('WordPress Plugin Template', 'wp-plugin-template');

        $message = __(
            'This plugin needs the following plugins to work properly:',
            'wp-plugin-template'
        );

        $keys = array_keys(self::getMissingDependencies());
        printf(
            '<div class="%1$s"><p><strong>%2$s</strong> - %3$s <strong>%4$s</strong>.</p></div>',
            esc_attr($class),
            esc_html($title),
            esc_html($message),
            esc_html(implode(', ', $keys))
        );
    }

    public function registerRestAPI(): void
    {
        $routes = new Routes();
        $routes->register();
    }
}
