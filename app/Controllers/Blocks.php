<?php

namespace WPlugin\Controllers;

final class Blocks implements InterfaceController
{
    public function initialize(): void
	{
		$this->registerComponentBlocks();
	}

	public function registerComponentBlocks(): void
	{
		$blocks = [];

		foreach ($blocks as $block) {
			register_block_type_from_metadata(trConfig()->distDir("blocks/$block"));

			wp_enqueue_script(
				"tainacan-reports-blocks-script-$block",
				wptConfig()->distUrl("blocks/{$block}/index.js"),
				array('wp-blocks', 'wp-element', 'wp-editor')
			);
		}
	}
}
