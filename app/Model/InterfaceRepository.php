<?php

namespace WPlugin\Model;

interface InterfaceRepository
{
    public function find(string $key): array;
    public function save(Entity $entity): bool;
    public function remove(Entity $entity): bool;
}
