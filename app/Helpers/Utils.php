<?php

namespace WPT\Helpers;

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
     * Redirect to menu page
     * @param string $to_page
     * @return void
     */
    public static function redirect_to_menu_page( $to_page )
    {
        header( "Location: /wp-admin/admin.php?page=$to_page", false, 302 );
    }
}