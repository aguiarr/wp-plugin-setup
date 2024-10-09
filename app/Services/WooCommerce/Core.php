<?php

namespace WPlugin\Services\WooCommerce;

use WPlugin\Services\WooCommerce\Gateways\Blocks\Template as GatewayBlockTemplate;
use WPlugin\Services\WooCommerce\Gateways\Template as GatewayTemplate;
use WPlugin\Services\WooCommerce\Settings\Template as Settings;

final class Core
{
    public function inicializeWooommerce(): void
    {
        add_filter('woocommerce_locate_template', [$this, 'setOverwrittenWoocommerceTemplates'], 10, 3);
        add_filter('wc_get_template_part', [$this, 'overrideWoocommerceTemplatePart'], 10, 3);

        new Settings;
    }

    public function setOverwrittenWoocommerceTemplates($template, $templateName, $template_path)
    {
        $templateDir = wptConfig()->viewsDir() . 'WooCommerce/';

        $path = $templateDir . $templateName;

        return file_exists($path) ? $path : $template;
    }

    public function overrideWoocommerceTemplatePart($template, $slug, $name)
    {
        $template_directory = wptConfig()->viewsDir() . 'WooCommerce/';
        $path = $name ? $template_directory . "{$slug}-{$name}.php" : $template_directory . "{$slug}.php";

        return file_exists($path) ? $path : $template;
    }

    public function registerPaymentGateways(array $gateways): array
    {
        $gateways[] = GatewayTemplate::class;

        return $gateways;
    }

    public function loadWooCommerceBlocks(): void
    {
        add_action('woocommerce_blocks_payment_method_type_registration', [$this, 'registerBlockGateway'], 10, 1);
    }


    public function registerBlockGateway(object $paymentMethodRegistry): void
    {
        $paymentMethodRegistry->register(new GatewayBlockTemplate());
    }
}
