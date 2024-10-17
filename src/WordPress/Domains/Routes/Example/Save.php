<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Routes\Example;

use WPlugin\Application\Example\DTO\Save\Output;
use WPlugin\Domain\Example\Repositories\SaveExampleRepository;
use WPlugin\Domain\Example\Entities\Example;

final class Save implements SaveExampleRepository
{
    public function saveExample(Example $entity): Output
    {
        return new Output('a');
    }
}
