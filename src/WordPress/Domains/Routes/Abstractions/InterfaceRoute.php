<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Routes\Abstractions;

use WP_REST_Request;
use WP_HTTP_Response;


interface InterfaceRoute
{
    public function register(): void;
    public function handle(WP_REST_Request $request): WP_HTTP_Response;
}
