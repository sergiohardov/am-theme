<?php

/**
 * Returns html attribute "id" if block acnhor not empty
 *
 * @param  array $block
 * @return string
 */
function amtheme_acf_block_anchor($block)
{
    $result = '';

    if (!empty(isset($block['anchor']))) {
        $result = 'id="' . $block['anchor'] . '"';
    }

    return $result;
}

/**
 * Returns as a string the combined classes specified from the block and specified during development
 *
 * @param  string $class
 * @param  array $block
 * @return string
 */
function amtheme_acf_block_class($class, $block)
{
    $result = $class;

    if (!empty(isset($block['className']))) {
        $result .= ' ' . $block['className'];
    }

    return $result;
}
