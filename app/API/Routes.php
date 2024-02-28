<?php

namespace WPlugin\API;
use WPlugin\API\Routes\TestRoute;

final class Routes
{
	public function register()
	{
		new TestRoute();
	}
}
