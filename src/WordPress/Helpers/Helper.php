<?php

declare(strict_types=1);

if (!function_exists('wptConfig')) {
    function wptConfig()
    {
        return new \WPlugin\WordPress\Core\Config();
    }
}

if (!function_exists('wptUtils')) {
    function wptUtils()
    {
        return new \WPlugin\WordPress\Core\Utils();
    }
}
