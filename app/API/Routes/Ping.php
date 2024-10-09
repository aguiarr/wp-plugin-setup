<?php

namespace WPlugin\API\Routes;

use Exception;
use WP_REST_Request;
use WP_HTTP_Response;

final class News extends AbstractRoute
{
    public function initialize(): void
    {
        $this->setNamespace();
        $this->registerRoute(
            'ping',
            ['GET'],
        );
    }

    public function handle(WP_REST_Request $request): WP_HTTP_Response
    {
        try {
            return new WP_HTTP_Response([
                'status' => 'success',
                'message' => __('Pong', 'wp-plugin-template')
            ], 200);

        } catch (Exception $e) {
            return new WP_HTTP_Response(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }
}
