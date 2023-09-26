<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */
/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if (!function_exists('harati_hex2rgb')) {
    function harati_hex2rgb($hex, $array = false)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        if (!$array) {
            $rgb = implode(",", $rgb);
        }
        return $rgb;
    }
}
if (!function_exists('harati_get_inline_css')) :
    /**
     * Outputs theme custom CSS.
     *
     * @since 1.0.0
     */
    function harati_get_inline_css()
    {
        $defaults = harati_get_default_customizer_values();
        $site_title_text_size = harati_get_option('site_title_text_size');
        $site_tagline_text_size = harati_get_option('site_tagline_text_size');

        $top_bar_bg_color = harati_get_option('top_bar_bg_color');
        $top_bar_text_color = harati_get_option('top_bar_text_color');

        $header_bg_color = harati_get_option('header_bg_color');
        $progressbar_color = harati_get_option('progressbar_color');

        $footer_bg_color = harati_get_option('footer_bg_color');

        ob_start();
        ?>
        <?php if ($site_title_text_size != $defaults['site_title_text_size']) : ?>
        @media (min-width: 1000px){
        .site-title {
        font-size: <?php echo esc_attr($site_title_text_size) . 'px'; ?>;
        }
        }
    <?php endif; ?>
        <?php if ($site_tagline_text_size != $defaults['site_tagline_text_size']) : ?>
        @media (min-width: 1000px){
        .site-description {
        font-size: <?php echo esc_attr($site_tagline_text_size) . 'px'; ?>;
        }
        }
    <?php endif; ?>
        <?php if ($top_bar_bg_color != $defaults['top_bar_bg_color']) : ?>
        #theme-topbar{
        background-color: <?php echo esc_attr($top_bar_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($top_bar_text_color != $defaults['top_bar_text_color']) : ?>
        #theme-topbar,
        #theme-topbar a:not(:hover):not(:focus){
        color: <?php echo esc_attr($top_bar_text_color); ?>;
        }
    <?php endif; ?>
        <?php if ($header_bg_color != $defaults['header_bg_color']) : ?>
        .site-header{
        background-color: <?php echo esc_attr($header_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($progressbar_color != $defaults['progressbar_color']) : ?>
        #harati-progress-bar{
        background-color: <?php echo esc_attr($progressbar_color); ?>;
        }
    <?php endif; ?>

        <?php if ($footer_bg_color != $defaults['footer_bg_color']) : ?>
        .site-footer {
        background-color:  <?php echo esc_attr($footer_bg_color); ?>;
        }
    <?php endif; ?>

        <?php
        return ob_get_clean();
    }
endif;
if (!function_exists('harati_get_dark_mode_inline_css')) :
    /**
     * Outputs theme dark mode custom CSS.
     *
     * @since 1.0.0
     */
    function harati_get_dark_mode_inline_css()
    {
        $defaults = harati_get_default_customizer_values();
        $dark_mode_accent_color = harati_get_option('dark_mode_accent_color');
        $dark_mode_bg_color = harati_get_option('dark_mode_bg_color');
        $dark_mode_text_color = harati_get_option('dark_mode_text_color');
        ob_start();
        ?>
        <?php if ($dark_mode_bg_color !== $defaults['dark_mode_bg_color']) : ?>
        :root {
        --theme-darkmode-bg-color: <?php echo esc_attr($dark_mode_bg_color); ?>
        }
    <?php endif; ?>
        <?php if ($dark_mode_text_color !== $defaults['dark_mode_text_color']) : ?>
        :root {
        --theme-darkmode-text-color: <?php echo esc_attr($dark_mode_text_color); ?>
        --theme-darkmode-accent-hover-color: <?php echo esc_attr($dark_mode_text_color); ?>
        }

        [data-theme="dark"] .site-topbar,
        [data-theme="dark"] .site-footer {
        background-color: <?php echo esc_attr(harati_hex2rgb($dark_mode_accent_color, 0.03)); ?>;
        }

    <?php endif; ?>
        <?php if ($dark_mode_accent_color !== $defaults['dark_mode_accent_color']) : ?>
        :root {
        --theme-darkmode-accent-color: <?php echo esc_attr($dark_mode_accent_color); ?>;
        }
    <?php endif; ?>
        <?php
        $css = ob_get_clean();
        return $css;
    }
endif;
