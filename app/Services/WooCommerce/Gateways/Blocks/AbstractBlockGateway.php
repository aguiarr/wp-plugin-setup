<?php

namespace WPlugin\Services\WooCommerce\Gateways\Blocks;

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
use WPlugin\Services\WooCommerce\Gateways\AbstractGateway;

abstract class AbstractBlockGateway extends AbstractPaymentMethodType
{
    protected $name;
    protected AbstractGateway $gateway;

    public function initialize(): void
    {
        $this->settings = get_option("woocommerce_{$this->name}_settings", []);

        $gateways = WC()->payment_gateways->payment_gateways();
        $this->gateway = isset($gateways[$this->name]) ? $gateways[$this->name] : null;
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function is_active(): bool
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        return is_null($this->gateway) ? false : $this->gateway->is_available();
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function get_payment_method_script_handles(): array
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        $folder = str_replace('wp-plugin-template-', '', $this->name);
        $scriptAssetPath = wptConfig()->distUrl("blocks/$folder/index.assets.php");
        $scriptAsset = file_exists($scriptAssetPath)
            ? require_once $scriptAssetPath
            : array(
                'dependencies' => array(),
                'version' => wptConfig()->pluginVersion()
            );

        wp_register_script(
            $this->name,
            wptConfig()->distUrl("blocks/$folder/index.js"),
            $scriptAsset['dependencies'],
            $scriptAsset['version'],
            true
        );

        return [$this->name];
    }

    protected function getIcon(): string
    {
        return $this->gateway->icon ?? '';
    }

    /**
     * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
     * @override
     */
    public function get_payment_method_data(): array
    {
        //phpcs:enable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
        $fields = array_merge([
            'title' => $this->get_setting('title'),
            'description' => $this->get_setting('description'),
            'icon' => $this->getIcon(),
            'gateway' => $this->gateway->id,
        ], $this->getGatewayCustomFields());

        return apply_filters('wp-plugin-template_block_checkout_fields', $fields);
    }

    abstract protected function getGatewayCustomFields(): array;
}
