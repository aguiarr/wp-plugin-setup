<?php

namespace WPlugin\Services\WooCommerce\Settings;

class Template
{
    public function __construct()
    {
        add_filter('woocommerce_settings_tabs_array', [$this, 'addSettingsTab'], 50);
        add_action('woocommerce_settings_tabs_wp-plugin-template', [$this, 'renderTabFields']);
        add_action('woocommerce_update_options_wp-plugin-template', [$this, 'updateTabFields']);
    }

    public function addSettingsTab(array $tabs): array
    {
        $tabs['wp-plugin-template'] = __('Template', 'wp-plugin-template');
        return $tabs;
    }

    public function renderTabFields(): void
    {
        woocommerce_admin_fields($this->getTabFields());
    }

    public function getTabFields(): array
    {
        $fields = [
            'section_title' => [
                'name' => __('Template - Settings', 'wp-plugin-template'),
                'type' => 'title',
                'id' => 'wp-plugin-template-settings'
            ],
            'order_prefix' => [
                'title' => __('Order Prefix', 'wp-plugin-template'),
                'type' => 'text',
                'desc' => __('Order prefix sent to the payment API..', 'wp-plugin-template'),
                'id' => 'wp-plugin-template-order_prefix',
                'default' => '',
            ],
            'environment' => [
                'title' => __('Enviroment type', 'wp-plugin-template'),
                'type' => 'select',
                'desc' => __(
                    'Select the type of environment in which the plugin transactions will be conducted.',
                    'wp-plugin-template'
                ),
                'id' => 'wp-plugin-template-environment',
                'options' => [
                    'production' => 'Production',
                    'sandbox' => 'Sandbox'
                ],
                'default' => 'sandbox',
            ],
            'success_status' => [
                'title' => __('Success Status', 'wp-plugin-template'),
                'type' => 'select',
                'desc' => 'Select the order status that the plugin should set in the event of a successful payment.',
                'id' => 'wp-plugin-template-success_status',
                'options' => wc_get_order_statuses(),
                'default' => 'wc-processing'
            ],
            'show_icons' => [
                'title' => __('Show checkout Icons', 'wp-plugin-template'),
                'type' => 'checkbox',
                'desc' => __('Show gateway icons at checkout.', 'wp-plugin-template'),
                'id' => 'wp-plugin-template-show_icons',
                'default' => 'no',
            ],
            'logs' => [
                'title' => __('Active logs', 'wp-plugin-template'),
                'type' => 'checkbox',
                'desc' => __('Check this option to enable WooCommerce logs.', 'wp-plugin-template'),
                'id' => 'wp-plugin-template-logs',
                'default' => 'yes',
            ],
            'section_end' => [
                'type' => 'sectionend',
            ]
        ];

        return apply_filters('wp-plugin-template_settings_fields', $fields);
    }

    public function updateTabFields(): void
    {
        woocommerce_update_options($this->getTabFields());
    }
}
