<?php

namespace WPlugin\Services\WooCommerce\Logs;

use WC_Logger;

final class Logger
{
    private WC_Logger $wc;
    private string $prefix;
    private bool $enabled;

    public function __construct()
    {
        $this->wc      = new WC_Logger();
        $this->enabled = get_option('wp-plugin-template-logs') === 'yes';
        $this->prefix  = wptConfig()->pluginSlug();
    }

    public function add($var, string $type = 'request'): void
    {
        switch ($type) {
            case 'error':
                $log   = "{$this->prefix}-error";
                $title = '--- ERROR LOG ---';
                break;

            case 'success':
                $log   = "{$this->prefix}-success";
                $title = '--- SUCCESS LOG ---';
                break;

            case 'notification':
                $log   = "{$this->prefix}-notification";
                $title = '--- NOTIFICATION LOG ---';
                break;

            case 'installments':
                $log   = "{$this->prefix}-installments";
                $title = '--- INSTALLMENTS LOG ---';
                break;

            case 'database':
                $log   = "{$this->prefix}-database";
                $title = '--- DATABASE LOG ---';
                break;

            default:
                $log   = "{$this->prefix}-request";
                $title = '--- REQUEST/RESPONSE LOG ---';
                break;
        }

        if ($this->enabled) {
            $this->wc->add($log, "\n{$title} : \n" . print_r($var, true) . "\n");
        }
    }
}
