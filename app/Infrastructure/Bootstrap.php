<?php

namespace WPlugin\Infrastructure;

use WPlugin\Repository\TestRepository;

final class Bootstrap
{
	public array $tables;

	public function __construct()
	{
		$this->tables = [
            TestRepository::class,
		];
	}

	public function initialize(): void
	{
		$this->tables();
	}

	public function uninstall(): void
	{
		foreach ($this->tables as $table) {
			if ( class_exists( $table ) ) {
				$t = new $table;
				$t->down();
			}
		}
	}

	private function tables() : void
	{
		foreach ($this->tables as $table) {
			if ( class_exists( $table ) ) {
				$t = new $table;
				$t->up();
			}
		}
	}
}

