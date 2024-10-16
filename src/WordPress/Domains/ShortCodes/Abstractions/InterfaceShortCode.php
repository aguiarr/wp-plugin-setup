<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\ShortCodes\Abstractions;

interface InterfaceShortCode
{
    public function register(): void;
    public function request(): void;
}
