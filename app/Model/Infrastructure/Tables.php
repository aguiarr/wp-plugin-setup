<?php

namespace WPS\Model\Infrastructure;

/**
 * Name: Tables
 * @package Infrastrucure Model
 * @since 1.0.0
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

    /**
     * Create tables
     * @return Void
     */
    private function create_table()
    {
        $_query = "";

        if( ! function_exists('dbDelta') ) {
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        }

        dbDelta($_query);

    }

}
