<?php


namespace WPlugin\Controllers\Render;

abstract class AbstractRender implements InterfaceRender
{
    protected bool $hasEnqueue = true;

    protected function enqueueScripts(array $script): void
    {
        $link = isset($script['external']) ? $script['external'] : config()->distUrl($script['file']);
        wp_enqueue_script($script['name'], $link);
    }

    protected function enqueueStyles(array $style): void
    {
        $link = isset($style['external']) ? $style['external'] : config()->distUrl($style['file']);
        wp_enqueue_style($style['name'], $link);
    }

    private function enqueueDefault(): void
    {
        if ($this->hasEnqueue) {
            $this->enqueueStyles(
                [
                    'name' => 'fontawesome',
                    'external' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'
                ]
            );

            $this->enqueueStyles(['name' => 'global', 'file' => 'styles/global/index.css']);
            $this->enqueueStyles(['name' => 'tailwind', 'file' => 'app.css']);
        }
    }

    public function render(string $file, array $data): string
    {
        $this->enqueueDefault();
        return utils()->render($file, $data);
    }
}
