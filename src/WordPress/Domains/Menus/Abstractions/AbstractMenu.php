<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\Menus\Abstractions;

abstract class AbstractMenu implements InterfaceMenu
{
    protected bool $hasEnqueue = true;

    protected function enqueueScripts(array $script): void
    {
        $link = isset($script['external']) ? $script['external'] : wptConfig()->distUrl($script['file']);
        $dependencies = isset($script['dependencies']) ? $script['dependencies'] : [];

        wp_enqueue_script($script['name'], $link, $dependencies);
    }

    protected function enqueueStyles(array $style): void
    {
        $link = isset($style['external']) ? $style['external'] : wptConfig()->distUrl($style['file']);
        wp_enqueue_style($style['name'], $link);
    }

    private function enqueueDefault(): void
    {
        if ($this->hasEnqueue) {
            $this->enqueueStyles(['name' => 'tailwind', 'file' => 'app.css']);
        }
    }

    public function render(string $file, array $data): string
    {
        $this->enqueueDefault();
        return wptUtils()->render($file, $data);
    }
}
