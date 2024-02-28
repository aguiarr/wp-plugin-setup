<?php

namespace WPlugin\Core;

final class Utils
{
    public function render(string $file, array $data): string
    {
        extract($data);
        ob_start();

        $template = get_template_directory() . "/". wptConfig()->baseFolder() ."/$file";

        if (!file_exists($template)) {
            $template = wptConfig()->viewsDir($file);
        }

        if (file_exists($template)) {
            require_once $template;
        }

        return ob_get_clean();
    }
}
