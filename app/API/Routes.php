<?php

namespace WPlugin\API;
use WPlugin\API\Routes\TestRoute;

class Routes
{
	public function register()
	{
		new TestRoute();
	}
}
