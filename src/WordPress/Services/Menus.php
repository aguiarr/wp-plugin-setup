<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Services;

use WPlugin\WordPress\Domains\Menus\Settings;

final class Menus implements InterfaceService
{
    public function initialize(): void
    {
        add_action('admin_menu', [$this, 'registerDomains']);
    }

    public function registerDomains(): void
    {
        $this->createAdminMenu();

        $menus = [
            Settings::class
        ];

		foreach ($menus as $menu) {
			if (class_exists($menu)) {
				$class = new $menu;
				$class->register();
			}
		}

        $this->removeDefaultSubmenu();
    }

    private function createAdminMenu(): void
    {
        $menuName = wptConfig()->menuName();

        add_menu_page(
            $menuName,
            $menuName,
            'read',
            wptConfig()->pluginSlug(),
            false,
            'dashicons-lightbulb'
        );
    }

    private function removeDefaultSubmenu(): void
    {
        $pluginSlug = wptConfig()->pluginSlug();
        remove_submenu_page($pluginSlug, $pluginSlug);
    }
}
