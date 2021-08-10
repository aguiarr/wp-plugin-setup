<?php

namespace WPPluginSetup\Helpers;

/**
 * Name: Utils
 * Package: Helper
 * Description: Has the statics methods
 * Version: 1.0.0
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
}