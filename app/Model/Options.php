<?php

namespace AfiliaPlugin\Model;

/**
 * Name: Options
 * @package Model
 * @since 1.0.0
 */
class Options
{
    private $prefix;

    public function __construct()
    {
        $this->prefix = WP_PLUGIN_SLUG;
    }

    /**
     * Update options
     * @param String $opt
     * @param Mixed $value
     * @return Mixed
     */
    public function update( $opt, $value )
    {
        $option = $this->prefix . $opt;

        $result = update_option( $option, $value );
        return $result;
    }

    /**
     * Get options
     * @param String $opt
     * @return Mixed
     */
    public function get( $opt )
    {
        $option = $this->prefix . $opt;
        $result = get_option( $option );
        
        return $result;
    }

    /**
     * Create options
     * @param String $opt
     * @param Mixed $value
     * @return Mixed
     */
    public function create( $opt, $value )
    {
        $option = $this->prefix . $opt;

        $result = add_option( $option, $value );
        return $result;
    }
}