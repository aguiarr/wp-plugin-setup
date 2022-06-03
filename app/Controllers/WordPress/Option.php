<?php

namespace WPT\Controllers\WordPress;

/**
 * Name: Option
 * @package Controllers/WordPress
 * @since 1.0.0
 */
class Option
{
    private $prefix;

    public function __construct()
    {
        $this->prefix = WPT_PLUGIN_SLUG;
    }

    /**
     * Update option
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
     * Get option
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
     * Create option
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