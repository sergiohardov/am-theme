<?php

namespace AMTheme\Theme;

class ACF
{
    const JSON_PATH = AMTHEME_PATH . '/data/acf-json';
    const BLOCKS_CATEGORY = 'am-theme';

    function __construct()
    {
        add_filter('acf/settings/save_json', [$this, 'local_save_json']);
        add_filter('acf/settings/load_json', [$this, 'local_load_json']);
        add_filter('block_categories_all', [$this, 'add_category_top'], 10, 2);
        add_action('acf/init', [$this, 'register_blocks']);
    }

    public function local_save_json($path)
    {
        return $this::JSON_PATH;
    }

    public function local_load_json($paths)
    {
        unset($paths[0]);
        $paths[] = $this::JSON_PATH;

        return $paths;
    }

    public function add_category_top($categories, $post)
    {
        $category = [
            'slug'  => $this::BLOCKS_CATEGORY,
            'title' => 'AMTheme'
        ];

        array_unshift($categories, $category);

        return $categories;
    }

    public function register_blocks()
    {
    }
}
