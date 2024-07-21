<?php

namespace AMTheme\Classes;

class ACFBlock
{
    private $anchor;
    private $class;
    private $fields;
    private $block;

    function __construct(array $block, string $class, array $fields)
    {
        $this->set_anchor($block);
        $this->set_class($block, $class);
        $this->fields = $fields;
        $this->block = $block;
    }

    /**
     * Set html attribute "id" if block acnhor not empty
     *
     * @param  array $block
     */
    private function set_anchor(array $block): void
    {
        $result = '';

        if (!empty(isset($block['anchor']))) {
            $result = 'id="' . $block['anchor'] . '"';
        }

        $this->anchor = $result;
    }

    /**
     * Set as a string the combined classes specified from the block and specified during development
     *
     * @param  string $class
     * @param  array $block
     */
    private function set_class(array $block, string $class): void
    {
        $result = $class;

        if (!empty(isset($block['className']))) {
            $result .= ' ' . $block['className'];
        }

        $this->class = $result;
    }

    public function get_anchor(): string
    {
        return $this->anchor;
    }

    public function get_class(): string
    {
        return $this->class;
    }

    public function get_fields(): array
    {
        return $this->fields;
    }

    public function get_block(): array
    {
        return $this->block;
    }

    public function render($path, $data): void
    {
        get_template_part($path, null, $data);
    }
}
