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
     * Enqueue page/menu scripts
     * @param array $scripts
     * @return void
     */
    protected function enqueue_scripts( $scripts )
    {
        foreach( $scripts as $script ) {
            $link = isset( $script['external'] ) ? $script['external'] : Config::__dist( $script['file'] );
            wp_enqueue_script( $script['name'], $link );
        }
    }

    /**
     * Enqueue page/menu styles
     * @param array $styles
     * @return void
     */
    protected function enqueue_styles( $styles )
    {
        foreach( $styles as $style ) {
            $link = isset( $style['external'] ) ? $style['external'] : Config::__dist( $style['file'] );
            wp_enqueue_style( $style['name'], $link );
        }
    }

    /**
     * Call enqueue default
     * @return void
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

        $template = get_template_directory() . "/wpt-templates/$file";
        
        if ( ! file_exists( $template ) ) {
            $template = Config::__views( $file );
        }
        
        require $template;
        $html = ob_get_clean();

        echo $html;


        $this->enqueue_default();
    }
}