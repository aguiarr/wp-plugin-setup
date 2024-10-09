<?php

namespace WPlugin\Controllers\Menus;

use WPlugin\Controllers\Render\AbstractRender;

final class Settings extends AbstractRender
{
    private array $fields;

    public function enqueue(): void
    {
        $this->enqueueScripts(['name' => 'settings', 'file' => 'scripts/admin/menus/settings/index.js']);
        $this->enqueueStyles(['name' => 'settings', 'file' => 'styles/admin/menus/settings/index.css']);
    }

    public function request(): void
    {
        $this->enqueue();

        $this->fields = [
            'teste' => 'Teste Titulo'
        ];
        echo $this->render('Admin/menus/settings/index.php', $this->fields);
    }
}
