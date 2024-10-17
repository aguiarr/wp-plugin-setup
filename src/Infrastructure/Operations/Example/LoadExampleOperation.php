<?php

declare(strict_types=1);

namespace WPlugin\Infrastructure\Operations\Example;

use WPlugin\Application\Example\DTO\Load\Input;
use WPlugin\Application\Example\DTO\Load\Output;
use WPlugin\Application\Example\UseCases\LoadExample;
use WPlugin\Domain\Example\Repositories\LoadExampleRepository;

final class LoadExampleOperation
{
    private LoadExampleRepository $repository;
    private Input $inputDTO;

    public function __construct(Input $inputDTO, LoadExampleRepository $repository) {
        $this->repository = $repository;
        $this->inputDTO = $inputDTO;
    }

    public function execute() : Output
    {
        $useCase = new LoadExample($this->repository);
        return $useCase->execute($this->inputDTO);
    }
}
