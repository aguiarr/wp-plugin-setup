<?php

namespace WPT\Controllers\Menus;

use WPT\Controllers\Render\Render;

/**
 * Name: About
 * @package Controller/Menu 
 * @since 1.0.0
 */
class About extends Render
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