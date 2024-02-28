<?php

namespace WPlugin\Services\WooCommerce\Logs;

use WC_Logger;

final class Logger
{
  private WC_Logger $wc;
  private string $prefix;
  private bool $enabled;

  public function __construct(bool $enabled = true)
  {
    $this->wc      = new WC_Logger();
    $this->enabled = $enabled;
    $this->prefix  = wplConfig()->pluginSlug();
  }

  public function add($var, string $type = 'database'): void
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

      default:
        $log   = "{$this->prefix}-database";
        $title = '--- REQUEST LOG ---';
        break;
    }

    if ($this->enabled) {
      $this->wc->add($log, "\n{$title} : \n" . print_r($var, true) . "\n");
    }
  }
}
