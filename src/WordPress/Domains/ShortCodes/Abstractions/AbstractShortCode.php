<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Menus\Abstractions;

use WPlugin\WordPress\Domains\ShortCodes\Abstractions\InterfaceShortCode;

abstract class AbstractShortCode implements InterfaceShortCode
{
    public function render(string $file, array $data): string
    {
        return wptUtils()->render($file, $data);
    }
}
