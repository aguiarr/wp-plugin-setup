<?php

namespace WPlugin\Services\WooCommerce\Gateways;

use WPlugin\Services\WooCommerce\Gateways\AbstractGateway;

final class Template extends AbstractGateway
{
    public function __construct()
    {
        $this->id = "wp-plugin-template";
        $this->paymentMethod = __('Template', 'wp-plugin-template');

        parent::__construct();
    }

    protected function setCustomSettingsFields(): array
    {
        return [];
    }

    protected function renderPaymentFields(array $fields): void
    {
        echo wvpUtils()->render(
            'Pages/checkout/template.php',
            apply_filters('wp-plugin-template_checkout_fields', $fields)
        );
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function validate_fields(): bool
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        return true;
    }

    public function getGatewayData(&$data): void
    {
    }

    public function renderThankyouPage(int $orderId): void
    {
        $fields = [
            'title' => $this->method_title,
        ];

        echo wvpUtils()->render(
            'Pages/order/template.php',
            apply_filters('wp-plugin-template_thankyou_fields', $fields)
        );
    }

    protected function customTransactionData(array $data): array
    {
        return [];
    }
}
