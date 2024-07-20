<?php

namespace AMTheme\Theme;

class Customizer
{
    const PANEL_MAIN = 'am_customizer_panel_theme';
    const SECTION_FOOTER = 'am_customizer_section_footer';

    function __construct()
    {
        add_action('customize_register', [$this, 'theme_panel']);
        add_action('customize_register', [$this, 'footer']);
    }

    public function theme_panel($wp_customizer)
    {
        $wp_customizer->add_panel($this::PANEL_MAIN, [
            'priority' => 1,
            'title' => __('Theme Options', AMTHEME_TEXTDOMAIN),
        ]);
    }

    public function footer($wp_customizer)
    {
        $wp_customizer->add_section($this::SECTION_FOOTER, $args = [
            'panel' => $this::PANEL_MAIN,
            'title' => __('Footer', AMTHEME_TEXTDOMAIN),
        ]);

        $wp_customizer->add_setting(AMTHEME_FIELD_FOOTER_COPY, $args = [
            'default' => '',
        ]);

        $wp_customizer->add_control(AMTHEME_FIELD_FOOTER_COPY, $args = [
            'section' => $this::SECTION_FOOTER,
            'label' => __('Copyright', AMTHEME_TEXTDOMAIN),
            'type' => 'text',
            'description' => 'You can use <code>[date]</code> construction for show current date.',
        ]);
    }
}
