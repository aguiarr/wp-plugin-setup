<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Persistence\Repositories;

use WPlugin\WordPress\Persistence\Repositories\Abstractions\AbstractRepository;


final class TestRepository extends AbstractRepository
{
	public function __construct()
	{
		parent::__construct('template_plugin');
	}

	protected function fill(\stdClass $row): object
	{
		return $row;
	}

	public function remove(object $entity): bool
	{
		if (!$entity->getId()) {
			return false;
		}

		$query = $this->db->delete(
			$this->table,
			['ID' => $entity->getId()]
		);

		if (!$query) {
			return false;
		}

		return true;
	}

	protected function getEntityData(object $entity): array
	{
		return [
			'label' => $entity->getLabel()
		];
	}

	public function up(): void
	{
		$this->create([
			'id'             => ['INT AUTO_INCREMENT primary key NOT NULL' ],
			'label'          => ['VARCHAR(100) NOT NULL'],
			'created_at'     => ['DATETIME DEFAULT CURRENT_TIMESTAMP' ],
			'updated_at'     => ['DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP' ]
		]);
	}

}
