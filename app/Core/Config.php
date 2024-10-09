<?php

namespace WPlugin\Core;

final class Config
{
    public function distUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . $this->baseFolder() . "/dist/$relative";
    }

    public function distDir(string $relative = ''): string
    {
        return $this->dynamicDir() . "/dist/$relative";
    }

    public function imageUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . $this->baseFolder() . "/assets/images/$relative";
    }

    public function assetsUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . $this->baseFolder() . "/assets/$relative";
    }

    public function viewsDir(string $relative = ''): string
    {
        return $this->dynamicDir() . "/app/Views/$relative";
    }

    public function dynamicDir(string $dir = __DIR__, int $level = 2): string
    {
        return dirname($dir, $level);
    }

    public function mainFileDir(): string
    {
        return $this->dynamicDir() . '/' . wptConfig()->pluginSlug() . ".php";
    }

    public function baseFile(): string
    {
        return $this->baseFolder() . '/' . wptConfig()->pluginSlug() . ".php";
    }

    public function baseFolder(): string
    {
        $dir = explode('/', $this->dynamicDir());
        return $dir[count($dir) - 1];
    }

    public function menuName(): string
    {
        return __('Plugin Template', 'wp-plugin-template');
    }

    public function pluginName(): string
    {
        return __('WP Plugin Template', 'wp-plugin-template');
    }

    public function pluginSlug(): string
    {
        return 'wp-plugin-template';
    }

    public function pluginNamespace(): string
    {
        return 'WPlugin';
    }

    public function pluginPrefix(): string
    {
        return 'wpt';
    }

    public function pluginVersion(): string
    {
        return '1.0.0';
    }
}
