<?php

namespace WPlugin\Core;

use WPlugin\API\Routes;
use WPlugin\Controllers\Menus;
use WPlugin\Infrastructure\Bootstrap;
use WPlugin\Services\WooCommerce\Core as WooCommerce;

final class Boot
{
    public function __construct()
    {
        add_action('activated_plugin', [$this, 'activationFunction']);
        add_action('admin_init', [$this, 'checkMissingDependencies'], 10);
        add_action('admin_init', [$this, 'desactivationFunction'], 10);
        add_action('woocommerce_init', [$this, 'woocommerce'], 10);
        add_filter('plugin_action_links', [$this, 'setSettingsLink'], 10, 2);
        add_action('rest_api_init', [$this, 'registerRestAPI'], 10);

        add_filter('woocommerce_payment_gateways', [new WooCommerce(), 'registerPaymentGateways'], 10, 1);
        add_action('woocommerce_blocks_loaded', [new WooCommerce(), 'loadWooCommerceBlocks'], 10);

        $this->loadControllers();

        load_plugin_textdomain(wptConfig()->pluginSlug(), false);
    }

    private function loadControllers(): void
    {
        $controllers = [
            'Menus',
            'Blocks',
            'ShortCodes'
        ];

        if (empty(self::getMissingDependencies())) {
            foreach ($controllers as $controller) {
                $namespace = wptConfig()->pluginNamespace() . "\\Controllers\\{$controller}";
                if (class_exists($namespace)) {
                    $class = new $namespace;
                    $class->initialize();
                }
            }
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

        if (!isset($_REQUEST['action']) || !isset($_REQUEST['plugin'])) {
            return;
        }

        $action = filter_var($_REQUEST['action'], FILTER_SANITIZE_SPECIAL_CHARS);
        $plugin = filter_var($_REQUEST['plugin'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($action === 'deactivate' && $plugin === wptConfig()->baseFile()) {
            $uninstall = new Uninstall();
            $uninstall->reset();
        }
    }

    public function checkMissingDependencies(): void
    {
        $missingDependencies = self::getMissingDependencies();

        if (is_array($missingDependencies) && !empty($missingDependencies)) {
            add_action('admin_notices', [
                $this, 'displayDependencyNotice'
            ]);
        }
    }

    public function getMissingDependencies(): array
    {
        $needs = [
            'WooCommerce' => 'WooCommerce',
        ];

        foreach ($needs as $key => $class) {
            if (class_exists($class)) {
                unset($needs[$key]);
            }
        }

        return $needs;
    }

    public function displayDependencyNotice(): void
    {
        $class = 'notice notice-error';
        $title = wptConfig()->pluginName();

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

