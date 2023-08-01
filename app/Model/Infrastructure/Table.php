<?php

namespace WPlugin\Model\Infrastructure;

abstract class Table
{
    protected string $prefix;
    protected object $db;
    protected string $table;

    private function setDatabase(): void
    {
        global $wpdb;

        if ($wpdb) {
            $this->db = $wpdb;
            $this->setPrefix();
        }
    }


    private function setPrefix(): void
    {
        if ($this->db) {
            $this->prefix = $this->db->prefix;
        }
    }


    protected function setTable($table): void
    {
        $this->setDatabase();
        $this->table = $this->prefix . $table;
    }


    protected function create($fields = []): void
    {
        if (empty($fields)) {
            return;
        }

        $rows = [];

        foreach ($fields as $key => $value) {
            $row = "`$key` " . implode(" ", $value);
            array_push($rows, $row);
        }

        $fields = implode(",", $rows);
        $this->db->query("CREATE TABLE IF NOT EXISTS {$this->table} ( {$fields} );");
    }


    protected function drop(): void
    {
        $this->db->query("DROP TABLE {$this->table};");
    }
}
