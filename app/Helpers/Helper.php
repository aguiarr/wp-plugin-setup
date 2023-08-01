<?php

declare(strict_types=1);

use WPlugin\Core\Config;

if (!function_exists('config')) {
    function config()
    {
        return new Config;
    }
}