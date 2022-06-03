<?php 

namespace WPT\Controllers;

use WPT\Helpers\Config;
use WPT\Helpers\Utils;

/**
 * Name: Menus
 * Handle creating submenus
 * @package Controller
 * @since 1.0.0
 */
class Menus {
    
    public function __construct()
    {
        $this->initialize_menus();
    }

    /**
     * Set visible menus
     * @since 1.0.0
     * @param array
     */
    private function menus() {
        return [
            ['About', 'About me'],
        ];
    }

    /**
     * Get the menu controllers
     * @since 1.0.0
     * @return array
     */
    private function initialize_menus() 
    {

        $controllers = $this->menus();
        $menus = [];

        foreach ( $controllers as $key => $controller ) {
            $slug = Utils::parse_view( $controller[0] );
            $function = WPT_PLUGIN_NAMESPACE . "\\Controllers\\Menus\\$controller[0]";
            $menu = [
                'title'    => $controller[1],
                'slug'     => $slug,
                'function' => [new $function, 'request'] ,
                'position' => $key
            ];

            array_push( $menus, $menu );
        }
        return $this->create_menus( $menus );
    }

    /**
     * Create the submenus
     * @param array $menus
     * @param void
     */
    private function create_menus( $menus ) {

        foreach ( $menus as $menu ) {
            add_submenu_page(WPT_PLUGIN_SLUG ,$menu['title'],$menu['title'],'manage_options',$menu['slug'],$menu['function'],$menu['position']);
        }

        remove_submenu_page(WPT_PLUGIN_SLUG ,WPT_PLUGIN_SLUG);
    }
}