<?php
/**
 * Displays the Topbar
 *
 * @package Harati
 */

$hide_topbar_on_mobile = harati_get_option('hide_topbar_on_mobile');

$enable_topbar_date = harati_get_option('enable_topbar_date');
$enable_topbar_time = harati_get_option('enable_topbar_time');

$enable_topbar_nav = harati_get_option('enable_topbar_nav');
$enable_topbar_social_icons = harati_get_option('enable_topbar_social_icons');


?>
<div id="theme-topbar" class="site-topbar theme-site-topbar <?php echo ($hide_topbar_on_mobile) ? 'hide-on-mobile': '';?>">
    <div class="wrapper">
        <div class="site-topbar-wrapper">

            <div class="site-topbar-item site-topbar-left">
                <?php if ( $enable_topbar_date ) :
                    $date_format = harati_get_option( 'todays_date_format', 'l ,  j  F Y' );
                    ?>
                    <div class="site-topbar-component topbar-component-date">
                        <div class="topbar-component-icon">
                            <?php harati_theme_svg('calendar'); ?>
                        </div>
                        <div class="theme-display-date">
                            <?php echo date_i18n($date_format, current_time('timestamp')); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ( $enable_topbar_time ) : ?>
                    <div class="site-topbar-component topbar-component-time">
                        <div class="topbar-component-icon">
                            <?php harati_theme_svg('clock'); ?>
                        </div>
                        <div class="theme-display-clock"></div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="site-topbar-item site-topbar-right">
                <?php
                if ($enable_topbar_social_icons) :
                    wp_nav_menu(
                        array(
                            'theme_location' => 'social-menu',
                            'container_class' => 'site-topbar-component topbar-component-social-navigation',
                            'fallback_cb' => false,
                            'depth' => 1,
                            'menu_class' => 'theme-social-navigation theme-menu theme-topbar-navigation',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                        )
                    );
                endif;
                ?>

                <?php
                if ($enable_topbar_nav) :
                    wp_nav_menu(
                        array(
                            'theme_location' => 'top-menu',
                            'container_class' => 'site-topbar-component topbar-component-top-navigation',
                            'fallback_cb' => false,
                            'depth' => 2,
                            'menu_class' => 'theme-top-navigation theme-menu theme-topbar-navigation',
                        )
                    );
                endif;
                ?>
            </div>

        </div>
    </div>
</div>
