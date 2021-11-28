<?php

namespace WPPluginSetup\Helpers;

/**
 * Name: Utils
 * @package Helper
 * Description: Has the statics methods
 * @since 0.0.1
 */
class Utils {

    public static function parse_view( string $controller ) {

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
}