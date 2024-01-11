<?php

declare(strict_types=1);

if (!function_exists('wptConfig')) {
    function wptConfig()
    {
        return new \WPlugin\Core\Config();
    }
}

if (!function_exists('wptUtils')) {
    function wptUtils()
    {
        return new \WPlugin\Core\Utils();
    }
}
