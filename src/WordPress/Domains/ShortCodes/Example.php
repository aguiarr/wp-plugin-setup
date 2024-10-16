<?php

namespace Espiritualidade\Controllers\Shortcodes;

use WPlugin\WordPress\Domains\Menus\Abstractions\AbstractShortCode;

final class Example extends AbstractShortCode
{
    private array $fields = [];

	public function register(): void
	{
		add_shortcode('wp-plugin-template_example', [$this, 'request']);
	}

	public function request()
	{
        return $this->render('public/shortcodes/example/index.php', $this->fields);
	}
}
