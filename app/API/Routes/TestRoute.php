<?php

namespace WPlugin\API\Routes;

class TestRoute extends Route
{
    public function __construct()
    {
        $this->setNamespace('test');
        $this->registerRoute(
            'hello',
            [$this, 'hello'],
            ['POST']
        );
    }

    public function create(object $data)
    {
        $this->sendJsonResponse(
            "Hello Word!",
            true,
            200
        );

    }
}
