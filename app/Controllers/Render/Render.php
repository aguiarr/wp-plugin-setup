<?php


namespace WPT\Controllers\Render;

use WPT\Helpers\Config;

/**
 * Name: Render HTML
 * Create the method that renders views
 * @package Controller/Render
 * @since 1.0.0
 */
abstract class Render implements InterfaceRender
{

    /**
     * 
     */
    protected function enqueue_scripts( $scripts )
    {
        foreach( $scripts as $script ) {
            $link = isset( $script['external'] ) ? $script['external'] : Config::__dist( $script['file'] );
            wp_enqueue_script( $script['name'], $link );
        }
    }

    /**
     * 
     */
    protected function enqueue_styles( $styles )
    {
        foreach( $styles as $style ) {
            $link = isset( $style['external'] ) ? $style['external'] : Config::__dist( $style['file'] );
            wp_enqueue_style( $style['name'], $link );
        }
    }

    /**
     * 
     */
    private function enqueue_default()
    {
        $scripts = [
            [ 
                'name' => 'global',
                'file' => 'global.js'
            ]
        ];

        $styles = [
            [ 
                'name' => 'fontawesome', 
                'external' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css' 
            ]
        ];

        $this->enqueue_styles( $styles );
        $this->enqueue_scripts( $scripts );
    }


    /**
     * Render HTML files
     * @param string $file
     * @param array $dados
     * @return string
     */
    public function render( $file, $dados )
    {
        extract($dados);
        ob_start();
        
        require __DIR__ . '/../../Views/' . $file;
        $html = ob_get_clean();

        echo $html;


        $this->enqueue_default();
    }
}