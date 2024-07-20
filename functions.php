<?php

require_once get_template_directory() . '/vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action('tgmpa_register', function () {
    $plugins = array(
        array(
            'name'      => 'ACF',
            'slug'      => 'advanced-custom-fields-pro',
            'source'    => get_template_directory() . '/plugins/advanced-custom-fields-pro.zip',
            'required'  => true,
        ),
    );

    $config = array(
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
    );

    tgmpa($plugins, $config);
});
