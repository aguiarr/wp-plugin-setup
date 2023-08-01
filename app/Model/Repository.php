<?php

namespace WPlugin\Model;

abstract class Repository
{
    protected $prefix;
    protected $db;

    public function __construct()
    {
        $this->setDatabase();
    }

    private function setDatabase()
    {
        global $wpdb;

        if ($wpdb) {
            $this->db = $wpdb;
            $this->setPrefix();
        }
    }

    private function setPrefix()
    {
        if ($this->db) {
            $this->prefix = $this->db->prefix;
        }
    }

    protected function query($query)
    {
        if (strpos($query, 'SELECT') === false) {
            return $this->db->query($query);
        }

        return $this->db->get_results($query);
    }
}
