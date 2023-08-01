<?php

namespace WPlugin\Core;

class Config
{
    public function distUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . self::getfileBase() . "/dist/$relative";
    }

    public function imageUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . self::getfileBase() . "/assets/images/$relative";
    }

    public function assetsUrl(string $relative = ''): string
    {
        return plugins_url() . '/' . self::getfileBase() . "/assets/$relative";
    }

    public function getassetsUrl(string $relative = ''): string
    {
        return self::dinamicDir() . "/app/Views/$relative";
    }

    public function dinamicDir(string $dir = __DIR__, int $level = 2): string
    {
        return dirname($dir, $level);
    }

    public function mainFile(): string
    {
        return self::dinamicDir() . '/' . WP_PLUGIN_SLUG . ".php";
    }

    public function fileBase(): string
    {
        return self::getfileBase() . '/' . WP_PLUGIN_SLUG . ".php";
    }

    public function getfileBase(): string
    {
        $dir = explode('/', self::dinamicDir());
        return $dir[count($dir) - 1];
    }
}
