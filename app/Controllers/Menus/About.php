<?php

namespace WPT\Controllers\Menus;

use WPT\Controllers\Render\InterfaceRender;
use WPT\Controllers\Render\Render;

/**
 * Name: About
 * @package Menu Controller
 * @since 1.0.0
 */
class About extends Render implements InterfaceRender
{
    /**
     * Call the view render
     * @return void
     */
    public function request()
    {
        echo $this->render( 'Admin/about.php', [] );
    }
}