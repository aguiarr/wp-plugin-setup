<?php

namespace WPS\Controllers\Menus;

use WPS\Controllers\InterfaceController;
use WPS\Controllers\RenderHtml;

/**
 * Name: About
 * @package Controller
 * Type: Menu Controller
 * View path: about.php
 * @since 0.0.1
 */
class About extends RenderHtml implements InterfaceController{

    public function request(): void
    {
        echo $this->render( 'Admin/about.php',[] );
    }
}