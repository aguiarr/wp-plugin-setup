<?php

namespace WPlugin\API;

final class Routes
{
	public function register()
	{
		$routes = ['Test'];

		foreach ($routes as $route) {
            $namespace = wptConfig()->pluginNamespace() . "\\API\\Routes\\$route";

			if (class_exists($namespace)) {
				$class = new $namespace;
				$class->initialize();
			}
		}
	}
}
