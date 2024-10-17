<?php

declare(strict_types=1);

namespace WPlugin\Application\Example\UseCases;

use WPlugin\Application\Example\DTO\Save\Input;
use WPlugin\Application\Example\DTO\Save\Output;
use WPlugin\Domain\Example\Entities\Example;
use WPlugin\Domain\Example\Repositories\SaveExampleRepository;

final class SaveExample
{
    private SaveExampleRepository $repository;
    public function __construct(SaveExampleRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(Input $inputDTO) : Output
    {
        $entity = new Example($inputDTO->getLabel());

        return $this->repository->saveExample($entity);
    }
}
