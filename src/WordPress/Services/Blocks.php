<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Services;

final class Blocks implements InterfaceService
{
    public function initialize(): void
	{
        add_action('admin_enqueue_scripts', [$this, 'registerDomains']);
	}

	public function registerDomains(): void
	{
		$blocks = [];

		foreach ($blocks as $block) {
			register_block_type_from_metadata(wptConfig()->distDir("blocks/$block"));

			wp_enqueue_script(
				"wp-plugin-template-blocks-script-$block",
				wptConfig()->distUrl("blocks/{$block}/index.js"),
				array('wp-blocks', 'wp-element', 'wp-editor')
			);
		}
	}
}
