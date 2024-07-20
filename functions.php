<?php

use AMTheme\Theme\Setup;
use AMTheme\Theme\Customizer;
use AMTheme\Theme\ACF;

if (!class_exists('AMTheme')) {
    final class AMTheme
    {
        function __construct()
        {
            $this->libs();
            $this->defines();
            $this->init();
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

            // Customizer
            define('AMTHEME_FIELD_FOOTER_COPY', 'am_customizer_setting_footer_copyright');
        }

        private function init()
        {
            new Setup();        // Base setup theme
            new Customizer();   // Theme Customizer
            new ACF();          // ACF Settings

            // Theme functions
            require_once AMTHEME_PATH . '/includes/Theme/Functions.php';
        }
    }

    new AMTheme();
}
