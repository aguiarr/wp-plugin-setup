<?php

namespace WPlugin\WordPress\Domains\Routes;

use Exception;
use WP_REST_Request;
use WP_HTTP_Response;
use WPlugin\WordPress\Domains\Routes\Abstractions\AbstractRoute;

final class Example extends AbstractRoute
{
    public function register(): void
    {
        $this->setNamespace();
        $this->registerRoute(
            'example',
            ['GET', 'POST'],
        );
    }

    public function handle(WP_REST_Request $request): WP_HTTP_Response
    {
        try {
            return new WP_HTTP_Response([
                'label'   => 'test',
                'status'  => 'success',
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
