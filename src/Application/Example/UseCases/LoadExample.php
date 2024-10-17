<?php

declare(strict_types=1);

namespace WPlugin\Application\Example\UseCases;

use WPlugin\Application\Example\DTO\Load\Input;
use WPlugin\Application\Example\DTO\Load\Output;
use WPlugin\Domain\Example\Repositories\LoadExampleRepository;

final class LoadExample
{
    private LoadExampleRepository $repository;

    public function __construct(LoadExampleRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(Input $inputDTO) : Output
    {
        return $this->repository->loadExample();
    }
}
