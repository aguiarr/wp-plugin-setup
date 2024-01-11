<?php

namespace WPlugin\Core;

use WPlugin\API\Routes;
use WPlugin\Services\WooCommerce\WooCommerce;
use WPlugin\Controllers\Menus;

class Functions
{
    public static function initialize(): void
    {
        load_plugin_textdomain(WP_PLUGIN_SLUG, false);
    }


    public static function createAdminMenu(): void
    {
        if (empty(self::getMissingDependencies())) {
            $menus = new Menus();
            $menus->initializeMenus();
        }
    }


    public static function woocommerce(): void
    {
        if (class_exists('WooCommerce')) {
            $woocommerce = new WooCommerce;
            $woocommerce->inicializeWooommerce();
        }
    }


    public static function setSettingsLink(array $arr, string $name): array
    {
        if ($name === config()->baseFile()) {

            $label = sprintf(
                '<a href="admin.php?page=wc-plugin-template-settings" id="deactivate-wc-plugin-template" aria-label="%s">%s</a>',
                __('Settings', 'wc-plugin-template'),
                __('Settings', 'wc-plugin-template')
            );

            $arr['settings'] = $label;
        }

        return $arr;
    }

    public static function activationFunction(string $plugin): void
    {
        if (config()->baseFile() === $plugin) {
            $boot = new \WPlugin\Model\Bootstrap();
            $boot->initialize();
        }
    }

    public static function desactivationFunction(): void
    {
        if (!current_user_can('activate_plugins')) {
            return;
        }

        $action = $_REQUEST['action'] ?? false;
        $plugin = $_REQUEST['plugin'] ?? false;

        if ($action === 'deactivate' && $plugin === config()->baseFile()) {
            $uninstall = new Uninstall;
            $uninstall->reset();
        }
    }

    public static function checkMissingDependencies(): void
    {
        $missingDependencies = self::getMissingDependencies();

        if (is_array($missingDependencies) && !empty($missingDependencies)) {
            add_action('admin_notices', [
                Functions::class, 'displayDependencyNotice'
            ]);
        }
    }

    public static function getMissingDependencies(): array
    {
        $plugins = wp_get_active_and_valid_plugins();

        $neededs = [
            'WooCommerce' => config()->dynamicDir( __DIR__, 3 ) . '/woocommerce/woocommerce.php'
        ];

        foreach ($neededs as $key => $needed ) {
            if ( in_array( $needed, $plugins ) ) {
                unset( $neededs[$key] );
            }
        }

        return $neededs;
    }

    public static function displayDependencyNotice(): void
    {
        $class = 'notice notice-error';
        $title = __('WordPress Plugin Template', 'wc-plugin-template');

        $message = __(
            'This plugin needs the following plugins to work properly:',
            'wc-plugin-template'
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

    public static function registerRestAPI(): void
    {
        $routes = new Routes();
        $routes->register();
    }
}
