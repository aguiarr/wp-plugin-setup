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
        }
    }

    public function render(string $file, array $data): string
    {
        $this->enqueueDefault();

        extract($data);
        ob_start();

        $template = get_template_directory() . "/wc-plugin-template/$file";

        if (!file_exists($template)) {
            $template = config()->viewsDir($file);
        }

        if (file_exists($template)) {
            require_once $template;
        }

        return ob_get_clean();
    }
}
