<?php

namespace WPS\Helpers;

/**
 * Name: Utils
 * Has the statics methods
 * @package Helper
 * @since 1.0.0
 */
class Utils {

    /**
     * Parse constroller file name to view
     * @param string $controller
     * @return string
     */
    public static function parse_view( $controller ) 
    {

        $split = str_split( $controller );
        $view = '';
        $count = 0;

        foreach ( $split as $letter ) {
            if ( ctype_upper($letter) ) {
                if ( $count == 0 ) {
                    $view .= strtolower($letter);

                } else {
                    $view .= "_" . strtolower($letter);
                }

            } else {
                $view .= $letter;
            }
            $count++;
        }
        return $view;
    }

    /**
     * Parse view file name to constroller
     * @param string $controller
     * @param string $namespace
     * @return string
     */
    public static function parse_controller( $vew, $namespace = "Actions" ) 
    {

        $split = str_split( $vew );
        $namespace = WP_PLUGIN_NAMESPACE . "\\Controllers\\$namespace\\";
        $class_name = '';
        $count = 0;

        $next_upper = false;

        foreach ( $split as $letter ) {

            if ( $count === 0 ) {
                $class_name .= strtoupper( $letter );
            }else {

                if ( $letter === '_' ) {
                    $next_upper = true;
    
                } else {
                    if ( $next_upper ) {
                        $class_name .= strtoupper( $letter );
    
                    } else {
                        $class_name .= $letter;
                    }
    
                    $next_upper = false;
                }
            }

            $count++;
        }

        $controller = $namespace .= $class_name;

        return $controller;
    }

    /**
     * Redirect to menu page
     * @param string $to_page
     * @return void
     */
    public static function redirect_to_menu_page( $to_page )
    {
        header( "Location: /wp-admin/admin.php?page=$to_page", false, 302 );
    }
}