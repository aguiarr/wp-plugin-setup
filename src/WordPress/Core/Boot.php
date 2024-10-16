<?php

namespace WPlugin\WordPress\Core;

use WPlugin\WordPress\Persistence\Bootstrap;
use WPlugin\WordPress\Services\Blocks;
use WPlugin\WordPress\Services\Menus;
use WPlugin\WordPress\Services\PostTypes;
use WPlugin\WordPress\Services\Routes;
use WPlugin\WordPress\Services\ShortCodes;

final class Boot
{
    public function initialize()
    {
        add_action('activated_plugin', [$this, 'activationFunction']);
        add_action('admin_init', [$this, 'checkMissingDependencies'], 10);
        add_action('admin_init', [$this, 'desactivationFunction'], 10);
        add_action('init', [$this, 'enqueueGlobalScripts'], 10);
        add_filter('plugin_action_links', [$this, 'setSettingsLink'], 10, 2);

        $this->loadServices();

        load_plugin_textdomain(wptConfig()->pluginSlug(), false);
    }

    private function loadServices(): void
    {
        $services = [
            Menus::class,
            Blocks::class,
            PostTypes::class,
            Routes::class,
            ShortCodes::class
        ];

        if (empty(self::getMissingDependencies())) {
            foreach ($services as $service) {
                if (class_exists($service)) {
                    $class = new $service;
                    $class->initialize();
                }
            }
        }
    }

    public function enqueueGlobalScripts(): void
    {
        wp_enqueue_style('tailwind-css', wptConfig()->distUrl('app.css'));
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
        $needs = [];

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
}

