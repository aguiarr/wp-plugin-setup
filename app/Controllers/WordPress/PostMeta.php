<?php

namespace WPT\Controllers\WordPress;

/**
 * Name: PostMeta
 * @package Controllers\WordPress
 * @since 1.0.0
 */
class PostMeta
{
    private $prefix;

    public function __construct()
    {
        $this->prefix = WPT_PLUGIN_SLUG;
    }

    /**
     * Update option
     * @param int $id
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function update( $id, $key, $value )
    {
        $meta = $this->prefix . $key;

        $result = update_post_meta( $id, $meta, $value );
        return $result;
    }

    /**
     * Get option
     * @param int $id
     * @param string $key
     * @return mixed
     */
    public function get( $id, $key )
    {
        $meta = $this->prefix . $key;
        $result = get_post_meta( $id, $meta );
        
        return $result;
    }

    /**
     * Create option
     * @param int $id
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function insert( $id, $key, $value )
    {
        $meta = $this->prefix . $key;

        $result = add_post_meta( $id, $meta, $value );
        return $result;
    }
}