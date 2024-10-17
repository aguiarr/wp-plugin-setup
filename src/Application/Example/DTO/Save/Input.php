<?php

declare(strict_types=1);

namespace WPlugin\Application\Example\DTO\Save;

final class Input
{
    private string $label;

    public function __construct(string $label) {
        $this->label = $label;
    }

    public function getLabel() : string
    {
        return $this->label;
    }
}