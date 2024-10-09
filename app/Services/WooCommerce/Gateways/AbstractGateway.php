<?php

namespace WPlugin\Services\WooCommerce\Gateways;

use Exception;
use WPlugin\Services\WooCommerce\Checkout\ProcessPayment;
use WPlugin\Services\WooCommerce\Logs\Logger;
use WC_Payment_Gateway;

abstract class AbstractGateway extends WC_Payment_Gateway
{
    protected string $paymentMethod;
    protected Logger $logger;

    public function __construct()
    {
        $this->has_fields = true;
        $this->title = $this->get_option("title");
        $this->description = $this->get_option("description");
        $this->enabled = $this->get_option("enabled");
        $this->supports = [
            "products"
        ];

        $this->method_title = sprintf(
            __('Payment Method - %s', 'wp-plugin-template'),
            $this->paymentMethod
        );

        $this->method_description = sprintf(
            __('Payment Method - %s', 'wp-plugin-template'),
            $this->paymentMethod
        );

        $this->logger = new Logger();

        $this->init_form_fields();
        $this->init_settings();

        add_action('woocommerce_thankyou_' . $this->id, [$this, 'renderThankyouPage'], 10, 1);
        add_action('woocommerce_order_details_after_order_table', [$this, 'renderOrderDetails'], 10, 1);

        if (is_admin()) {
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
        }
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function init_form_fields(): void
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        $fields = [
            'enabled' => [
                'title' => __('Active', 'wp-plugin-template'),
                'label' => __('Active payment method.', 'wp-plugin-template'),
                'type' => 'checkbox',
                'description' => __('Check this option to enable this payment method', 'wp-plugin-template'),
                'default' => 'no',
                'desc_tip' => true
            ],
            'title' => [
                'title' => __('Title', 'wp-plugin-template'),
                'type' => 'text',
                'description' => __(
                    'This field controls the payment method title at checkout.',
                    'wp-plugin-template'
                ),
                'default' => $this->paymentMethod,
                'desc_tip' => true
            ],
            'description' => [
                'title' => __('Description', 'wp-plugin-template'),
                'type' => 'textarea',
                'description' => __(
                    'This option controls the payment method description at checkout.',
                    'wp-plugin-template'
                ),
                'default' => sprintf(
                    __('Template - Pay with %s', 'wp-plugin-template'),
                    $this->paymentMethod
                ),
                'desc_tip' => true
            ]
        ];

        $this->form_fields = array_merge($fields, $this->setCustomSettingsFields());
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function payment_fields(): void
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        $fields = [];
        $fields['description'] = $this->description;
        $fields['gateway'] = $this->id;

        $fields = apply_filters('wp-plugin-template_before_render_checkout_fields', $fields);

        $this->renderPartsFilesBefore($fields);
        $this->renderPaymentFields($fields);
    }

    private function renderPartsFilesBefore(array $fields = []): void
    {
        echo wptUtils()->render('Pages/checkout/parts/description.php', $fields, false);
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function process_payment($orderId)
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        $order = wc_get_order($orderId);
        do_action('wp-plugin-template_before_process_payment', $order);

        try {
            $processPayment = new ProcessPayment($order, $this);
            $process = $processPayment->process();

            if ($process) {
                do_action('wp-plugin-template_after_process_payment_success', $order);
                return $this->finishProcessOrder($order);
            }

            throw new Exception(
                __('Unable to complete the order.', 'wp-plugin-template'),
                422
            );

        } catch (\Exception $e) {
            do_action('wp-plugin-template_after_process_payment_error', $order, $e->getMessage());

            $this->logger->add([
                'message' => $e->getMessage(),
                'info' => __(
                    'Check the request logs (wp-plugin-template-request)
                    for information about the requests made by the plugin.',
                    'wp-plugin-template'
                )
            ], 'error');

            throw new Exception($e->getMessage());
        }
    }

    private function finishProcessOrder(object $order): array
    {
        $order->update_status(
            'on-hold',
            sprintf(
                '<strong>%s: </strong>',
                wptConfig()->pluginName()
            ),
            true
        );

        $order->add_order_note(
            sprintf(
                "<strong>%s:</strong> %s",
                wptConfig()->pluginName(),
                __('Awaiting payment confirmation..', 'wp-plugin-template')
            ),
            true
        );

        wc_reduce_stock_levels($order->get_id());

        return [
            'result' => 'success',
            'redirect' => $this->get_return_url($order)
        ];
    }

    public function getPostVars(string $name)
    {
        if (isset($_POST[$name]) && !empty($_POST[$name])) {
            return filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return false;
    }

    public function renderOrderDetails(object $order): void
    {
        if ($order->get_payment_method() === $this->id) {
            $this->renderThankyouPage($order->get_id());
        }
    }

    abstract protected function renderPaymentFields(array $fields): void;
    abstract protected function setCustomSettingsFields(): array;
    abstract protected function customTransactionData(array $data): array;
    abstract public function getGatewayData(&$data): void;
    abstract public function renderThankyouPage(int $orderId): void;
}
