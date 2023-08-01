<?php

namespace WPlugin\Core;

add_action('init', [
    Functions::class,
    'initialize'
]);

add_action('admin_init', [
    Functions::class,
    'desactivationFunction'
]);

add_action('activated_plugin', [
    Functions::class,
    'activationFunction'
]);

add_action('admin_init', [
    Functions::class,
    'checkMissingDependencies'
]);

add_action('admin_menu', [
    Functions::class,
    'createAdminMenu'
]);

add_action('woocommerce_init', [
    Functions::class,
    'woocommerce'
]);

add_filter('plugin_action_links', [
    Functions::class,
    'setSettingsLink'
], 10, 2);
