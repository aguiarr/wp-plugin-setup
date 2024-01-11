<?php

declare(strict_types=1);

if (!function_exists('config')) {
    function config()
    {
        return new \WPlugin\Core\Config();
    }
}

if (!function_exists('utils')) {
    function utils()
    {
        return new \WPlugin\Core\Utils();
    }
}
