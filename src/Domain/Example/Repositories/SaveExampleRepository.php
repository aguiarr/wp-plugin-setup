<?php

declare(strict_types=1);

namespace WPlugin\Domain\Example\Repositories;

use WPlugin\Application\Example\DTO\Save\Output;
use WPlugin\Domain\Example\Entities\Example;

interface SaveExampleRepository
{
    public function saveExample(Example $entity): Output;
}
