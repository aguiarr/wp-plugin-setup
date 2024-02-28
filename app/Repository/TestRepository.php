<?php

namespace WPlugin\Repository;

use WPlugin\Infrastructure\Model;
use WPlugin\Infrastructure\Repository;
use WPlugin\Model\TestModel;


final class TestRepository extends Repository
{
	public function __construct()
	{
		parent::__construct('template_plugin');
	}

	protected function fill(\stdClass $row): TestModel
	{
		$entity = new TestModel($row->label);

		$entity->setId($row->id);
		$entity->setUpdatedAt(new \DateTime($row->updated_at));
		$entity->setCreatedAt(new \DateTime($row->created_at));

		return $entity;
	}

	public function remove(Model|TestModel $entity): bool
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

	protected function getEntityData(Model|TestModel $entity): array
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
