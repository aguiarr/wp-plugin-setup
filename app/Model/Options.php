<?php

namespace AfiliaPlugin\Model;

/**
 * Name: Options
 * @package Model
 * @since 0.0.3
 */
class Options
{
    private $prefix;

    public function __construct()
    {
        $this->prefix = WP_PLUGIN_SLUG;
    }

    public function update( $opt, $value )
    {
        $option = $this->prefix . $opt;

        $result = update_option( $option, $value );
        return $result;
    }

    public function get( $opt )
    {
        $option = $this->prefix . $opt;
        $result = get_option( $option );
        
        return [ $result ];
    }

    public function create( $opt, $value )
    {
        $option = $this->prefix . $opt;

        $result = add_option( $option, $value );
        return $result;
    }

    public function check( $opt )
    {
        $option = $this->prefix . $opt;

        if ( ! get_option( $option ) ) {
            return false;
        }

        return true;
    }
}