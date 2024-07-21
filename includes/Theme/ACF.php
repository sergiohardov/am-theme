<?php

namespace AMTheme\Theme;

use AMTheme\API\Unsplash;

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
        /* Slider Unsplash */
        acf_register_block_type([
            'name'              => 'slider-unsplash',
            'title'             => __('Slider Unsplash', AMTHEME_TEXTDOMAIN),
            'description'       => __('Custom Slider Unsplash Block.', AMTHEME_TEXTDOMAIN),
            'category'          => $this::BLOCKS_CATEGORY,
            'align'             => 'full',
            'supports'          => [
                'anchor'    => true,
                'align'     => ['full'],
                'mode'      => false,
            ],
            'enqueue_assets'    => function () {
                wp_enqueue_style('block-slider-unsplash', AMTHEME_URI . '/assets/css/components/blocks/slider-unsplash.min.css', ['swiper']);
                wp_enqueue_script('block-slider-unsplash', AMTHEME_URI . '/assets/js/components/blocks/slider-unsplash.min.js', ['swiper'], false, true);
            },
            'render_callback'   => function ($block) {
                $fields = [
                    'title' => get_field('title'),
                    'description' => get_field('description'),
                    'search' => get_field('search'),
                    'count' => get_field('count') ?: 5,
                    'orientation' => get_field('orientation') ?: 'landscape',
                ];

                $unsplash = new Unsplash();
                $slides = $unsplash->search_photos($fields['search'], 1, $fields['count'], $fields['orientation']);

                get_template_part('/components/blocks/slider-unsplash', null, [
                    'anchor'    => amtheme_acf_block_anchor($block),
                    'class'     => amtheme_acf_block_class('slider-unsplash', $block),
                    'fields'    => $fields,
                    'slides'    => $slides
                ]);
            },
        ]);
    }
}
