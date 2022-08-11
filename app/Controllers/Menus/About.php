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
     * Enqueue custom scripts and styles to the page
     * @return void
     */
    private function enqueue()
    {
        $this->enqueue_scripts( [ 'name' => 'wp-admin', 'file' => '/scripts/admin/pages/about/index.js' ] );
        $this->enqueue_styles( [ 'name' => 'wpa-admin', 'file' => '/styles/admin/pages/about/index.css' ] );
    }
    
    /**
     * Call the view render
     * @return void
     */
    public function request()
    {
        $this->render( 'admin/about.php', [] );
        $this->enqueue();
    }
}