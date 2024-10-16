<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Menus\Abstractions;

interface InterfaceMenu
{
    public function register(): void;
    public function request(): void;
}
