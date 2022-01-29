<?php 

namespace WPS\Controllers;

use WPS\Helpers\Config;
use WPS\Helpers\Utils;

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
     * Get the menu controllers
     * @return array
     */
    private function initialize_menus() 
    {

        $controllers = Config::controllers();
        $menus = [];

        foreach ( $controllers as $key => $controller ) {
            $slug = Utils::parse_view( $controller[0] );
            $function = "WPS\\Controllers\\Menus\\$controller[0]";
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
            add_submenu_page(WP_PLUGIN_SLUG ,$menu['title'],$menu['title'],'manage_options',$menu['slug'],$menu['function'],$menu['position']);
        }

        remove_submenu_page(WP_PLUGIN_SLUG ,WP_PLUGIN_SLUG);
    }
}