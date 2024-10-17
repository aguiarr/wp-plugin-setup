<?php

declare(strict_types=1);

namespace WPlugin\Domain\Example\Repositories;

use WPlugin\Application\Example\DTO\Load\Output;
use WPlugin\Domain\Example\Entities\Example;

interface LoadExampleRepository
{
    public function loadExample(Example $entity): Output;
}
