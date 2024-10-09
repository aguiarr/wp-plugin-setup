<?php

namespace WPlugin\Services\WooCommerce\Gateways\Blocks;

final class Template extends AbstractBlockGateway
{
    protected $name = 'wp-plugin-template';

    public function getGatewayCustomFields(): array
    {
        return apply_filters('wp-plugin-template_billet_block_checkout_fields', []);
    }
}
