<?php

namespace WPlugin\API\Routes;

final class TestRoute extends Route
{
    public function __construct()
    {
        $this->setNamespace();
        $this->registerRoute(
            'ping',
            [$this, 'pong'],
        );
    }

    public function pong(object $data)
    {
        $this->sendJsonResponse(
            "pong!",
        );

    }
}
