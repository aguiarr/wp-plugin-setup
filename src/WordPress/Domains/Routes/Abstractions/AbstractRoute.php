<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Routes\Abstractions;

use WP_REST_Request;
use WP_HTTP_Response;

abstract class AbstractRoute implements InterfaceRoute
{
    private string $namespace;

    protected function registerRoute(string $route, array $methods = ['GET'], array $args = []): void
    {
        register_rest_route($this->namespace, $route, [
            'args'     => $args,
            'methods'  => $methods,
            'callback' => [$this, 'handle'],
            'permission_callback' => '__return_true',
        ]);
    }

    protected function getNamespace(): string
    {
        return $this->namespace;
    }

    protected function setNamespace(string $namespace = ''): void
    {
        $this->namespace = wptConfig()->pluginSlug();

        if ($namespace) {
            $this->namespace .= "/$namespace";
        }
    }
}
