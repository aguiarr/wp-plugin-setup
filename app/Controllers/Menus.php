<?php

namespace WPlugin\Controllers;

class Menus {
    
    private function defineMenus(): array
    {
        return [
            ['Settings', __('About me', 'wc-plugin-template')]
        ];
    }

    public function initializeMenus(): void
    {
        $controllers = $this->defineMenus();
        $menus = [];

        foreach ($controllers as $key => $controller) {

            $slug     = $this->getMenuSlug($controller[0]);
            $function = WP_PLUGIN_NAMESPACE . "\\Controllers\\Menus\\$controller[0]";
            $menu     = [
                'title'    => $controller[1],
                'slug'     => 'wc-plugin-template-' . $slug,
                'function' => [new $function, 'request'],
                'position' => $key
            ];

            array_push($menus, $menu);
        }

        $this->createMenus($menus);
    }

    public function getMenuSlug(string $controller): string
    {
        $split = str_split($controller);
        $slug = '';
        $count = 0;

        foreach ($split as $letter) {
            if (ctype_upper($letter)) {
                if ($count == 0) {
                    $slug .= strtolower($letter);
                } else {
                    $slug .= '_' . strtolower($letter);
                }
            } else {
                $slug .= $letter;
            }
            $count++;
        }

        return $slug;
    }

    private function createMenus(array $menus): void
    {
        add_menu_page(
            WP_PLUGIN_NAME,
            WP_PLUGIN_NAME,
            'read',
            WP_PLUGIN_SLUG,
            false,
            'dashicons-carrot'
        );
        
        foreach ( $menus as $menu ) {
            add_submenu_page(
                WP_PLUGIN_SLUG ,
                $menu['title'],
                $menu['title'],
                'manage_options',
                $menu['slug'],
                $menu['function'],
                $menu['position']
            );
        }

        ## Remove default submenu
        remove_submenu_page(WP_PLUGIN_SLUG ,WP_PLUGIN_SLUG);
    }
}