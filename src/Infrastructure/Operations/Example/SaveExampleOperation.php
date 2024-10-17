<?php

declare(strict_types=1);

namespace WPlugin\Infrastructure\Operations\Example;

use WPlugin\Application\Example\DTO\Save\Input;
use WPlugin\Application\Example\DTO\Save\Output;
use WPlugin\Application\Example\UseCases\SaveExample;
use WPlugin\Domain\Example\Repositories\SaveExampleRepository;

final class SaveExampleOperation
{
    private SaveExampleRepository $repository;
    private Input $inputDTO;

    public function __construct(Input $inputDTO, SaveExampleRepository $repository) {
        $this->repository = $repository;
        $this->inputDTO = $inputDTO;
    }

    public function execute() : Output
    {
        $useCase = new SaveExample($this->repository);
        return $useCase->execute($this->inputDTO);
    }
}
