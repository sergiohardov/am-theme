<?php

namespace AMTheme\Theme;

class Setup
{
    function __construct()
    {
        add_action('after_setup_theme', [$this, 'textdomain']);
        add_action('tgmpa_register', [$this, 'muplugins']);
    }

    public function textdomain()
    {
        load_theme_textdomain(AMTHEME_TEXTDOMAIN, AMTHEME_PATH . '/languages');
    }

    public function muplugins()
    {
        $plugins = [
            [
                'name'      => 'ACF',
                'slug'      => 'advanced-custom-fields-pro',
                'source'    => get_template_directory() . '/plugins/advanced-custom-fields-pro.zip',
                'required'  => true,
            ]
        ];

        $config = [
            'id'           => 'am-theme',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'parent_slug'  => 'themes.php',
            'capability'   => 'edit_theme_options',
            'has_notices'  => true,
            'dismissable'  => false,
            'dismiss_msg'  => '',
            'is_automatic' => true,
            'message'      => '',
        ];

        tgmpa($plugins, $config);
    }
}
