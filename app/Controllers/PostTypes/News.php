<?php

namespace Parresia\News\Controllers\PostTypes;

use WPlugin\Controllers\PostTypes\AbstractPostType;

final class News extends AbstractPostType
{
    public const POST_TYPE = 'wpt-post-type';

	public function register()
	{
		$this->registerPostType(
			postType: self::POST_TYPE,
			labels: [
				'Template',
				'Post',
				'Posts',
				'o'
			]
		);
	}
}
