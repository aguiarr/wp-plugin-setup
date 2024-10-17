<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Routes\Example;

use Exception;
use WP_REST_Request;
use WP_HTTP_Response;
use WPlugin\Application\Example\DTO\Save\Input;
use WPlugin\Infrastructure\Operations\Example\SaveExampleOperation;
use WPlugin\WordPress\Domains\Routes\Abstractions\AbstractRoute;

final class ExampleRoute extends AbstractRoute
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
            switch ($request->get_method()) {
                case 'POST':
                    $this->save($request);
                    break;

                default:
                    return $this->load($request);
            }

            throw new Exception('Something went wrong!');

        } catch (Exception $e) {
            return new WP_HTTP_Response(
                ['message' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    private function save(WP_REST_Request $request): WP_HTTP_Response
    {
        $repository = new Save();
        $input      = new Input($request->get_param('label'));
        $operation  = new SaveExampleOperation($input, $repository);
        $operation->execute();

        return new WP_HTTP_Response([
            'label'   => 'test',
            'status'  => 'success',
            'message' => __('Pong', 'wp-plugin-template')
        ], 200);
    }

    private function load(WP_REST_Request $request): WP_HTTP_Response
    {
        return new WP_HTTP_Response([
            'label'   => 'test',
            'status'  => 'success',
            'message' => __('Pong', 'wp-plugin-template')
        ], 200);
    }
}
