<?php

namespace WPlugin\Model\Repository;

use WPlugin\Model\InterfaceRepository;
use WPlugin\Model\Repository;
use WPlugin\Model\Entity;

class Settings extends Repository implements InterfaceRepository
{
    public function find(string $key = ""): array
    {
        return [];
    }

    public function remove(Entity $settings): bool
    {
        return true;
    }

    public function save(Entity $settings): bool
    {
        return true;
    }
}
