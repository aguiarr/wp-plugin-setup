<?php

namespace WPS\Controllers\Menus;

use WPS\Controllers\InterfaceController;
use WPS\Controllers\RenderHtml;

/**
 * Name: About
 * @package Menu Controller
 * @since 1.0.0
 */
class About extends RenderHtml implements InterfaceController
{
    /**
     * Call the view render
     * @return void
     */
    public function request()
    {
        echo $this->render( 'Admin/about.php',[] );
    }
}