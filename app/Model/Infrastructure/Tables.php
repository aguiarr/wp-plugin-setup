<?php

namespace WPPluginSetup\Model\Infrastructure;

/**
 * Name: Tables
 * @package Model
 * Type: Infrastrucure
 * @since 0.0.3
 */

class Tables
{
    private $model;

    public function __construct()
    {
        global $wpdb;
        $this->model = $wpdb;

        $option = WP_PLUGIN_PREFIX . '_tables'
        ;
        $has_tables = get_option( $option );

        if( $has_tables === false || $has_tables === 0 ) {
            $this->create_table();
            update_option( $option , true);
        }

    }

    private function create_table()
    {
        $_query = "
        
        ";

        if( ! function_exists('dbDelta') ) {
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        }

        dbDelta($_query);

    }

}
