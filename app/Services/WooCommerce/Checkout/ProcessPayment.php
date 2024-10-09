<?php

namespace WPlugin\Services\WooCommerce\Checkout;

use WPlugin\Services\WooCommerce\Gateways\AbstractGateway;
use WPlugin\Services\WooCommerce\Logs\Logger;
use WC_Order;

class ProcessPayment
{
    private WC_Order $order;
    private Logger $logger;
    private AbstractGateway $gateway;

    public function __construct(WC_Order $order, AbstractGateway $gateway)
    {
        $this->order = $order;
        $this->gateway = $gateway;
        $this->logger = new Logger();
    }

    public function buildRequestBody(): array
    {
        $body = [];
        return apply_filters('wp-plugin-template_transaction_request_body', $body);
    }

    public function process()
    {
        return false;
    }


    private function getCustomerIp(): string
    {
        $ip = '';

        if (isset($_SERVER["REMOTE_ADDR"]) && !empty($_SERVER["REMOTE_ADDR"])) {
            $ip = filter_input(INPUT_SERVER, $_SERVER["REMOTE_ADDR"], FILTER_VALIDATE_IP);
        }

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) && !empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = filter_input(INPUT_SERVER, $_SERVER["HTTP_CF_CONNECTING_IP"], FILTER_VALIDATE_IP);
        }

        return $ip ?? '';
    }

    private function getOrderDiscounts(): float
    {
        $total = 0;

        foreach ($this->order->get_items('fee') as $item) {
            $fee = (float) $item->get_total();

            if ($fee > 0) {
                $total += $fee;
            }
        }

        return $total + (float) $this->order->get_total_discount();
    }

    private function getOrderFees(): float
    {
        $total = 0;
        foreach ($this->order->get_items('fee') as $item) {
            $fee = (float) $item->get_total();

            if ($fee > 0) {
                $total += $fee;
            }
        }

        return $total;
    }
}
