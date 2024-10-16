<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Menus;

use WPlugin\WordPress\Domains\Menus\Abstractions\AbstractMenu;

final class Settings extends AbstractMenu
{
    private string $title;
    private string $slug;

    public function __construct()
    {
        $this->title = __('Settings', 'wp-plugin-template');
        $this->slug  = 'example';
    }

    public function register(): void
    {
        add_submenu_page(
            wptConfig()->pluginSlug(),
            $this->title,
            $this->title,
            'manage_options',
            wptConfig()->pluginSlug() . "-{$this->slug}",
            [$this, 'request']
        );
    }

    public function enqueue(): void
    {
        $this->enqueueScripts([
            'name' => 'wpt-menu-settings',
            'file' => 'react/pages/settings/index.js',
            'dependencies' => ['wp-blocks', 'wp-element', 'wp-editor']
        ]);
    }

    public function request(): void
    {
        $this->enqueue();

        echo '<div id="wpt-menu-settings"></div>';
    }
}
