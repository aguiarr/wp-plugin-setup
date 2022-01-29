<?php

namespace WPS\Model;

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
     * @param string $opt
     * @param mixed $value
     * @return mixed
     */
    public function update( $opt, $value )
    {
        $option = $this->prefix . $opt;

        $result = update_option( $option, $value );
        return $result;
    }

    /**
     * Get options
     * @param string $opt
     * @return mixed
     */
    public function get( $opt )
    {
        $option = $this->prefix . $opt;
        $result = get_option( $option );
        
        return $result;
    }

    /**
     * Create options
     * @param string $opt
     * @param mixed $value
     * @return mixed
     */
    public function create( $opt, $value )
    {
        $option = $this->prefix . $opt;

        $result = add_option( $option, $value );
        return $result;
    }
}