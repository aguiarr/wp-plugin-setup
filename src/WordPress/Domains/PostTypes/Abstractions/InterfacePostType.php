<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\PostTypes\Abstractions;

interface InterfacePostType
{
    public function register(): void;
}
