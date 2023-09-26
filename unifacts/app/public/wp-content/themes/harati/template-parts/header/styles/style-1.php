<?php

$is_sticky = harati_get_option('enable_sticky_menu');

$enable_dark_mode          = harati_get_option( 'enable_dark_mode' );
$enable_dark_mode_switcher = harati_get_option( 'enable_dark_mode_switcher' );

$enable_search = harati_get_option( 'enable_search_on_header' );

?>
<div class="site-branding-center">
    <div class="wrapper">
        <?php get_template_part('template-parts/header/site-branding'); ?>
    </div>
</div>

<div class="masthead-main-navigation <?php echo ($is_sticky) ? 'has-sticky-header' : ''; ?>">
    <div class="wrapper">
        <div class="site-header-wrapper">

            <?php if (is_active_sidebar('harati-offcanvas-widget')): ?>
                <div class="site-header-left">
                    <button id="theme-offcanvas-widget-button" class="theme-button theme-button-transparent theme-button-offcanvas">
                        <span class="screen-reader-text"><?php _e('Offcanvas Widget', 'harati'); ?></span>
                        <span class="toggle-icon"><?php harati_theme_svg('menu-alt'); ?></span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="site-header-center">
                <div id="site-navigation" class="main-navigation theme-primary-menu">
                    <?php
                    if (has_nav_menu('primary-menu')) {
                        ?>
                        <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Primary', 'menu', 'harati'); ?>">
                            <ul class="primary-menu reset-list-style">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'primary-menu'
                                    )
                                );
                                ?>
                            </ul>
                        </nav><!-- .primary-menu-wrapper -->
                        <?php
                    } else { ?>
                        <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Primary', 'menu', 'harati'); ?>">
                            <ul class="primary-menu reset-list-style">
                                <?php
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                    )
                                );

                                ?>
                            </ul>
                        </nav><!-- .primary-menu-wrapper -->

                    <?php } ?>
                </div><!-- .main-navigation -->
            </div>
            <div class="site-header-right">
                <?php
                $enable_random_post = harati_get_option('enable_random_post');
                if ($enable_random_post) {
                    $random_post_category = harati_get_option('random_post_category');
                    $rand_posts_arg = array(
                        'posts_per_page' => 1,
                        'orderby'        => 'rand'
                    );
                    if($random_post_category){
                        $rand_posts_arg['cat'] = absint($random_post_category);
                    }
                    $rand_posts = get_posts( $rand_posts_arg );

                    if($rand_posts){
                        ?>
                        <a href="<?php echo esc_url( get_permalink($rand_posts[0]->ID) );?>" class="theme-button theme-button-transparent theme-button-shuffle">
                            <span class="screen-reader-text"><?php _e('Shuffle', 'harati'); ?></span>
                            <?php harati_theme_svg('shuffle'); ?>
                        </a>
                        <?php
                    }
                }
                ?>

                <button id="theme-toggle-offcanvas-button" class="theme-button theme-button-transparent theme-button-offcanvas" aria-expanded="false" aria-controls="theme-offcanvas-navigation">
                    <span class="screen-reader-text"><?php _e('Menu', 'harati'); ?></span>
                    <span class="toggle-icon"><?php harati_theme_svg('menu'); ?></span>
                </button>

                <?php if ( $enable_dark_mode && $enable_dark_mode_switcher ) : ?>
                    <button id="theme-toggle-mode-button" class="theme-button theme-button-transparent theme-button-colormode" title="<?php _e( 'Toggle light/dark mode', 'harati' ); ?>" aria-label="auto" aria-live="polite">
                        <span class="screen-reader-text"><?php _e('Switch color mode', 'harati'); ?></span>
                        <svg class="svg-icon svg-icon-colormode" aria-hidden="true" width="24" height="24" viewBox="0 0 24 24">
                            <mask class="moon" id="moon-mask">
                                <rect x="0" y="0" width="100%" height="100%" fill="white" />
                                <circle cx="24" cy="10" r="6" fill="black" />
                            </mask>
                            <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon-mask)" fill="currentColor" />
                            <g class="sun-beams" stroke="currentColor">
                                <line x1="12" y1="1" x2="12" y2="3" />
                                <line x1="12" y1="21" x2="12" y2="23" />
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                                <line x1="1" y1="12" x2="3" y2="12" />
                                <line x1="21" y1="12" x2="23" y2="12" />
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                            </g>
                        </svg>
                    </button>
                <?php endif; ?>

                <button id="theme-toggle-search-button" class="theme-button theme-button-transparent theme-button-search" aria-expanded="false" aria-controls="theme-header-search">
                    <span class="screen-reader-text"><?php _e('Search', 'harati'); ?></span>
                    <?php harati_theme_svg('search'); ?>
                </button>
            </div>
        </div>
    </div>
</div>