<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Harati
 */

?>

<?php 
$enable_footer_recommended_post_section = harati_get_option('enable_footer_recommended_post_section');
if ($enable_footer_recommended_post_section) {
    get_template_part( 'template-parts/footer/footer-recommended-post' );
}

 ?>
<?php get_template_part( 'template-parts/footer/footer-widgets-full' ); ?>

<?php do_action( 'harati_before_footer' ); ?>

</div>  <!-- site-content-area -->

<?php
$is_sticky_footer = harati_get_option('enable_footer_sticky');
$enable_footer_sticky = harati_get_option('enable_footer_sticky');
if($enable_footer_sticky){
    ?>
    <div class="sticky-footer-spacer"></div>
    <?php
}
?>
<footer id="colophon" class="site-footer" <?php echo ($is_sticky_footer) ? 'data-sticky-footer="true"': '';?>>
    <div class="wrapper">
        <?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>
        <?php get_template_part( 'template-parts/footer/footer-info' ); ?>
    </div>

    <?php
    $enable_scroll_to_top = harati_get_option('enable_scroll_to_top');
    if($enable_scroll_to_top){
        ?>
        <a id="theme-scroll-to-start" href="javascript:void(0)">
            <span class="screen-reader-text"><?php _e('Scroll to top', 'harati'); ?></span>
            <?php harati_theme_svg('arrow-up');?>
        </a>
        <?php
    }
    ?>

    <!-- Custom cursor -->
    <div class="cursor-dot-outline"></div>
    <div class="cursor-dot"></div>
    <!-- .Custom cursor -->

</footer><!-- #colophon -->

<?php do_action( 'harati_after_footer' ); ?>

</div><!-- #page -->

<?php do_action( 'harati_after_site' ); ?>

<?php wp_footer(); ?>

</body>
</html>
