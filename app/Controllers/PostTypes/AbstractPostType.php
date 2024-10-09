<?php

namespace WPlugin\Controllers\PostTypes;

abstract class AbstractPostType
{
	private array $labels;

    protected function registerLabels(
		string $name,
		string $singular,
		string $plural,
		string $gender
	): void {
        $this->labels = [
            'add_new'            => 'Adicionar nov' . $gender . ' ' . $singular,
            'add_new_item'       => 'Adicionar nov' . $gender . ' ' . $singular,
            'all_items'          => 'Tod' . $gender . 's ' . $plural,
            'edit_item'          => 'Editar ' . $singular,
            'name'               => $name,
            'new_item'           => 'Nov' . $gender . ' ' . $singular,
            'not_found'          => $singular . ' nao encontrado',
            'not_found_in_trash' => $singular . ' nao encontrad' . $gender . ' na lixeira',
            'search_items'       => 'Buscar ' . $singular,
            'singular_name'      => $singular,
            'view_item'          => 'Ver ' . $singular,
            'view_items'         => 'Ver ' . $singular,
		];
    }

	protected function getPostTypeArgs(array $args = []): array
	{
		return array_merge([
			'exclude_from_search' => true,
			'labels'              => $this->labels,
			'menu_icon'           => 'dashicons-screenoptions',
			'public'              => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'supports'            => [
				'editor',
				'title',
				'thumbnail'
			],
		], $args);
	}

	protected function registerPostType(string $postType, array $labels = [], array $args = []): void
	{
		if ($labels) {
			$this->registerLabels(...$labels);
		}

		register_post_type(
			$postType,
			$this->getPostTypeArgs($args)
		);
	}
}
