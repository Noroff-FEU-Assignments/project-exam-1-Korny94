<?php
/**
 * Displays Banner Section
 *
 * @package Harati
 */
$is_banner_section = harati_get_option('enable_banner_section');
$banner_section_cat = harati_get_option( 'banner_section_cat' );
$banner_section_slider_layout = harati_get_option( 'banner_section_slider_layout' );
$number_of_slider_post = harati_get_option( 'number_of_slider_post' );
$enable_banner_cat_meta = harati_get_option( 'enable_banner_cat_meta' );
$enable_banner_authro_meta = harati_get_option( 'enable_banner_authro_meta' );
$enable_banner_date_meta = harati_get_option( 'enable_banner_date_meta' );
$enable_banner_post_description = harati_get_option( 'enable_banner_post_description' );
$slider_post_content_alignment = harati_get_option( 'slider_post_content_alignment' );
$featured_image = "";
if ($banner_section_slider_layout == 'site-banner-layout-1') {
    $banner_alignment_class = 'align-self-center';
}else {
    $banner_alignment_class = 'align-self-bottom';

}
?>

<section class="site-section site-banner <?php echo esc_attr($banner_section_slider_layout); ?>">
    <div class="theme-banner-slider swiper-container">
        <div class="swiper-wrapper">
        <?php $banner_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_slider_post), 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($banner_section_cat)));
            if( $banner_post_query->have_posts() ):
                while ($banner_post_query->have_posts()): $banner_post_query->the_post(); 
                    if (has_post_thumbnail()) {
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; 
                    }
                    ?>
                    <div class="swiper-slide data-bg data-bg-large data-bg-overlay" data-background="<?php echo esc_url($featured_image); ?>">
                        <div class="wrapper h-100">
                            <div class="column-row h-100">
                                <div class="column column-12 justify-content-center <?php echo $banner_alignment_class;?> <?php echo $slider_post_content_alignment; ?>">
                                    <div class="slider-content">
                                        <?php if ($enable_banner_cat_meta) { ?>
                                            <div class="animate__animated animate__fadeInUp animate__delay-1s">
                                                <?php  harati_post_category(); ?>
                                            </div>
                                        <?php } ?>

                                        <?php the_title( '<h2 class="entry-title entry-title-large animate__animated animate__fadeInUp animate__delay-2s"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                                        <?php if ($enable_banner_post_description) { ?>
                                            <div class="animate__animated animate__fadeInUp animate__delay-3s">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="animate__animated animate__fadeInUp mt-4 animate__delay-4s">
                                            <?php if ($enable_banner_date_meta) { harati_posted_on(); } ?>
                                            <?php if ($enable_banner_authro_meta) {  harati_posted_by();} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                endwhile; 
            wp_reset_postdata();
            endif; ?>
        </div>

        <!-- Control -->

        <div class="theme-swiper-control swiper-control">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination theme-swiper-pagination"></div>
        </div>

    </div>
</section>