<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Harati
 */

get_header();
// Add a main container in case if sidebar is present
$class = '';
$page_layout = harati_get_page_layout();
?>
<?php
global $post;
$harati_post_layout = esc_html( get_post_meta( $post->ID, 'harati_post_layout', true ) ); 
$featured_image = "";
if (has_post_thumbnail($post->ID)) {
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; 
} 
if ($harati_post_layout == "layout-2") { ?>
    <div class="single-featured-banner">
        <div class="featured-banner-media">
            <div class="data-bg data-bg-large data-bg-fixed" data-background="<?php echo esc_url($featured_image); ?>"></div>
        </div>
        <div class="featured-banner-content">
            <div class="wrapper">
                <?php $display_read_time_in = harati_get_option('display_read_time_in');
                if (in_array('single-page', $display_read_time_in)) {
                    harati_read_time();
                } ?>

                <header class="entry-header">
                    <?php
                    if ( is_singular() ) :
                        the_title( '<h1 class="entry-title entry-title-large">', '</h1>' );
                    else :
                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif;

                    if ( 'post' === get_post_type() ) :
                        ?>
                        <div class="harati-entry-meta">
                            <?php
                            harati_posted_on();
                            $byline = sprintf(
                            /* translators: %s: post author. */
                                esc_html_x('by %s', 'post author', 'harati'),
                                '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url( $post->post_author )) . '">' . esc_html(get_the_author_meta( 'nicename', $post->post_author )) . '</a></span>'
                            );

                            echo '<span class="byline"> ' . $byline . '</span>';
                            ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </header><!-- .entry-header -->
            </div>
        </div>
    </div>
<?php } ?>

    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">

                <?php
                while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content', get_post_type());

                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'harati') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'harati') . '</span> <span class="nav-title">%title</span>',
                        )
                    );

                    if ('post' === get_post_type()) :

                        // Get Author Info & related/Author posts
                        $show_author_info = harati_get_option('show_author_info');
                        $show_related_posts = harati_get_option('show_related_posts');
                        $show_author_posts = harati_get_option('show_author_posts');

                        if ($show_author_info):
                            get_template_part('template-parts/single/author-info');
                        endif;

                        if ($show_related_posts):
                            get_template_part('template-parts/single/related-posts');
                        endif;

                        if ($show_author_posts):
                            get_template_part('template-parts/single/author-posts');
                        endif;

                    endif;

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </div><!-- #primary -->
            <?php
            if ('no-sidebar' != $page_layout) {
                get_sidebar();
            }
            ?>
        </div>
    </main>
<?php
get_footer();
