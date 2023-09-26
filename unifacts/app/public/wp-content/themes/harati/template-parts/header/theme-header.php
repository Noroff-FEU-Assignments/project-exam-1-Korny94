<?php
/**
 * Displays the site header.
 *
 * @package Harati
 */

$wrapper_classes  = 'site-header theme-site-header';

$header_style = harati_get_option('header_style');
$enable_header_bg_overlay = harati_get_option('enable_header_bg_overlay');
$header_image_size = harati_get_option('header_image_size');
$enable_top_bar = harati_get_option('enable_top_bar');
$header_template = str_replace('header_', '', $header_style);
$header_template = str_replace('_', '-', $header_template);
?>

<?php
if ($enable_top_bar) {
    get_template_part('template-parts/header/theme-topbar');
}
if ($enable_header_bg_overlay) {
    $wrapper_classes .= ' header-has-overlay';
}
$wrapper_classes .= ' header-has-height-'. $header_image_size;
if (!empty(get_header_image())) {
    $wrapper_classes .= ' data-bg';
}
?>
<header id="masthead" class="<?php echo esc_attr($wrapper_classes); ?> " <?php if (!empty(get_header_image())) { ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?> role="banner">
    <?php
    get_template_part('template-parts/header/styles/' . $header_template);
    ?>
</header><!-- #masthead -->

<?php get_template_part('template-parts/header/components/header-offcanvas-widget'); ?>
<?php get_template_part('template-parts/header/components/header-offcanvas'); ?>
<?php get_template_part('template-parts/header/components/header-search'); ?>