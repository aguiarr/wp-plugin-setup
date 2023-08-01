<?php

namespace WPlugin\Model\Infrastructure\Tables;

use WPlugin\Model\Infrastructure\Table;

class Settings extends Table
{
    public function __construct()
    {
        $this->setTable( "wp_plugin_settings" );
    }

    public function up(): void
    {
        $this->create( [
            'id'         => [ 'INT AUTO_INCREMENT primary key NOT NULL' ],
            'created_at' => [ 'DATETIME DEFAULT CURRENT_TIMESTAMP' ],
            'updated_at' => [ 'DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP' ]
        ] );
    }

    public function down(): void
    {
        $this->drop();
    }
}


