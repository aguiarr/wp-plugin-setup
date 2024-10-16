<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Domains\PostTypes;

use WPlugin\WordPress\Domains\PostTypes\Abstractions\AbstractPostType;

final class Example extends AbstractPostType
{
    public const POST_TYPE = 'example';

	public function register()
	{
		$this->registerPostType(
			postType: self::POST_TYPE,
			labels: [
				'CPT Example',
				'Exemplo',
				'Exemplos',
				'o'
			]
		);
	}
}
