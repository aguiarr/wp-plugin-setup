<?php

namespace WPlugin\Core;

class Config
{
    public function distUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . self::baseFolder() . "/dist/$relative";
    }

    public function imageUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . self::baseFolder() . "/assets/images/$relative";
    }

    public function assetsUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . self::baseFolder() . "/assets/$relative";
    }

    public function viewsDir(string $relative = ''): string
    {
        return self::dynamicDir() . "/app/Views/$relative";
    }

    public function dynamicDir(string $dir = __DIR__, int $level = 2): string
    {
        return dirname($dir, $level);
    }

    public function mainFileDir(): string
    {
        return self::dynamicDir() . '/' . WP_PLUGIN_SLUG . ".php";
    }

    public function baseFile(): string
    {
        return self::baseFolder() . '/' . WP_PLUGIN_SLUG . ".php";
    }

    public function baseFolder(): string
    {
        $dir = explode('/', self::dynamicDir());
        return $dir[count($dir) - 1];
    }
}
