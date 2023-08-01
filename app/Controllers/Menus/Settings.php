<?php

namespace WPlugin\Controllers\Menus;

use WPlugin\Controllers\Render\AbstractRender;

class Settings extends AbstractRender
{
    private array $fields;

    public function enqueue(): void
    {
        $this->enqueueScripts(['name' => 'settings', 'file' => 'scripts/admin/pages/settings/index.js']);
        $this->enqueueStyles(['name' => 'settings', 'file' => 'styles/admin/pages/settings/index.css']);
    }

    public function request(): void
    {
        $this->enqueue();
        
        $this->fields = [];
        echo $this->render('Admin/settings/index.php', $this->fields);
    }
}
