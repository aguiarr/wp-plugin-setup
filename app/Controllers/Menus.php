<?php

namespace WPlugin\Controllers;

final class Menus implements InterfaceController
{
    private array $menus;

    public function initialize(): void
    {
        add_action('admin_menu', [$this, 'registerMenus']);

        $this->menus = [
            'Settings' => __('About me', 'wp-plugin-template')
        ];
    }

    public function registerMenus(): void
    {
        $menus = array_map(function ($controller, $key) {
            $slug = $this->getMenuSlug($key);
            $class = wptConfig()->pluginNamespace() . "\\Controllers\\Menus\\{$key}";

            if (class_exists($class)) {
                return [
                    'title'    => $controller,
                    'slug'     => 'wp-plugin-template-' . $slug,
                    'function' => [new $class, 'request']
                ];
            }
        }, $this->menus, array_keys($this->menus));

        $this->createMenus($menus);
    }

    private function getMenuSlug(string $controller): string
    {
        return strtolower(preg_replace_callback('/[A-Z]/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, lcfirst($controller)));
    }

    private function createMenus(array $menus): void
    {
        $config = wptConfig();
        $menuName = $config->menuName();
        $pluginSlug = $config->pluginSlug();

        add_menu_page(
            $menuName,
            $menuName,
            'read',
            $pluginSlug,
            false,
            'dashicons-carrot'
        );

        foreach ($menus as $menu) {
            add_submenu_page(
                $pluginSlug,
                $menu['title'],
                $menu['title'],
                'manage_options',
                $menu['slug'],
                $menu['function']
            );
        }

        // Remove default submenu
        remove_submenu_page($pluginSlug, $pluginSlug);
    }
}
