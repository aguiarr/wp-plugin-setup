<?php

declare(strict_types=1);

namespace WPlugin\Domain\Example\Entities;

final class Example
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
