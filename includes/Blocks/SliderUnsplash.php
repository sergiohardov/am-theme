<?php

namespace AMTheme\Blocks;

use AMTheme\API\Unsplash;
use AMTheme\Classes\ACFBlock;

class SliderUnsplash extends ACFBlock
{
    function __construct(array $block, string $class, array $fields)
    {
        parent::__construct($block, $class, $fields);

        $this->render('/components/blocks/slider-unsplash', [
            'anchor' => $this->get_anchor(),
            'class' => $this->get_class(),
            'fields' => $this->get_fields(),
            'slides' => $this->get_slides()
        ]);
    }

    private function get_slides(): array
    {
        $fields = $this->get_fields();

        $unsplash = new Unsplash();
        $slides = $unsplash->search_photos($fields['search'], 1, $fields['count'], $fields['orientation']);

        return $slides;
    }
}
