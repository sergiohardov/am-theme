<?php

if (!class_exists('AMTheme')) {
    final class AMTheme
    {
        function __construct()
        {
            $this->libs();
            $this->defines();
        }

        private function libs()
        {
            $libs = [
                'Autoloader' => get_template_directory() . '/vendor/autoload.php',
                'TGM Plugin Activation' => get_template_directory() . '/vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php'
            ];

            foreach ($libs as $name => $path) {
                if (file_exists($path)) {
                    require_once $path;
                } else {
                    wp_die('Composer: ' . $name . ' not found.');
                }
            }
        }

        private function defines()
        {
            define('AMTHEME_URI', get_template_directory_uri());
            define('AMTHEME_PATH', get_template_directory());
            define('AMTHEME_TEXTDOMAIN', 'am-theme');
        }
    }
    new AMTheme();
}

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
