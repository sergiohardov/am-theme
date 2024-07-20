<header class="site-header">
    <div class="am-container">
        <div class="site-header__inner">

            <a class="site-header__logo" href="<?php echo esc_url(home_url()); ?>" rel="home">
                <?php bloginfo('name'); ?>
            </a>

            <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => false,
                'menu_class' => 'site-header__menu'
            ]); ?>
        </div>
    </div>
</header>