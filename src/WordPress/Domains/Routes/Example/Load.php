<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Routes\Example;

use WPlugin\Application\Example\DTO\Load\Output;
use WPlugin\Domain\Example\Entities\Example;
use WPlugin\Domain\Example\Repositories\LoadExampleRepository;

final class Load implements LoadExampleRepository
{
    public function loadExample(Example $entity): Output
    {
        return new Output('a');
    }
}
