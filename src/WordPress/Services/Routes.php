<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Services;

use WPlugin\WordPress\Domains\Routes\Example\ExampleRoute;

final class Routes implements InterfaceService
{
	public function initialize(): void
	{
        add_action('rest_api_init', [$this, 'registerDomains'], 10);
	}

    public function registerDomains(): void
    {
        $routes = [
            ExampleRoute::class
        ];

		foreach ($routes as $route) {
			if (class_exists($route)) {
				$class = new $route;
				$class->register();
			}
		}
    }
}
