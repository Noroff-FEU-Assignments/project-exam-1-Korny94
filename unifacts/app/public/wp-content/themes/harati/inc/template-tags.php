<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Harati
 */

if (!function_exists('harati_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function harati_posted_on()
    {   global $post;
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'harati'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists('harati_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function harati_posted_by()
    {
        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'harati'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists('harati_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function harati_entry_footer($enabled_post_meta = array())
    {
        if (in_array('tags', $enabled_post_meta)) {
            // Hide category and tag text for pages.
            if ('post' === get_post_type()) {

                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'harati'));
                if ($tags_list) {
                    /* translators: 1: list of tags. */
                    printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'harati') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
            }        
            if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
                echo '<span class="comments-link">';
                comments_popup_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: post title */
                            __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'harati'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post(get_the_title())
                    )
                );
                echo '</span>';
            }
        }

        edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'harati'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif; 

if (!function_exists('harati_entry_footer_all')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function harati_entry_footer_all()
    {
            // Hide category and tag text for pages.
            if ('post' === get_post_type()) {

                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'harati'));
                if ($tags_list) {
                    /* translators: 1: list of tags. */
                    printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'harati') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
            }        
            if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
                echo '<span class="comments-link">';
                comments_popup_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: post title */
                            __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'harati'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post(get_the_title())
                    )
                );
                echo '</span>';
            }

        edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'harati'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif; 
if (!function_exists('harati_post_category')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function harati_post_category()
    {
        if( 'post' === get_post_type() ){

        /* translators: used between list items, there is a space after the comma */
        $categories = get_the_category();
        echo '<div class="entry-meta-item entry-meta-categories">';
            echo '<div class="entry-meta-wrapper">';
                echo '<span class="cat-links">';
                    foreach( $categories as $category ){

                        $cat_name = $category->name;
                        $cat_slug = $category->slug;
                        $cat_url = get_category_link( $category->term_id ); ?>
                        <a href="<?php echo esc_url( $cat_url ); ?>" rel="category tag"><?php echo esc_html( $cat_name ); ?></a>

                    <?php }
                echo '</span>';
            echo '</div>';
        echo '</div>';
        }
    }
endif; 

if (!function_exists('harati_read_time')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function harati_read_time()
    { 
    $enable_read_time_option = harati_get_option('enable_read_time_option');
        if (!$enable_read_time_option) {
            return;
        }
        ?>

        <div class="harati-meta post-read-time">
            <span class="meta-icon">
                <span class="screen-reader-text"><?php _e( 'Estimated read time', 'harati' ); ?></span>
                <?php harati_theme_svg('hourglass'); ?>
            </span>
            <span class="meta-text">
                <?php
                $read_time = harati_estimated_read_time(get_the_content());
                echo sprintf(__("%s min read", 'harati'), number_format_i18n($read_time));
                ?>
            </span>
        </div>
<?php }
endif; 
/**
 * Adds a Sub Nav Toggle to Menu
 *
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param WP_Post $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @return stdClass An object of wp_nav_menu() arguments.
 * @since Harati 1.0
 *
 */
function harati_add_sub_toggles_to_main_menu($args, $item, $depth)
{


    if ('primary-menu' === $args->theme_location && (isset($args->show_toggles) && $args->show_toggles)) {

        // Wrap the menu item link contents in a div, used for positioning.
        $args->before = '<div class="ancestor-wrapper">';
        $args->after = '';

        // Add a toggle to items with children.
        if (in_array('menu-item-has-children', $item->classes, true)) {

            $toggle_target_string = '.theme-offcanvas-menu .menu-item-' . $item->ID . ' > .sub-menu';

            // Add the sub menu toggle.
            $args->after .= '<button class="theme-button sub-menu-toggle theme-button-transparent" data-toggle-target="' . $toggle_target_string . '" data-toggle-duration="250" aria-expanded="false"><span class="screen-reader-text">' . __('Show sub menu', 'harati') . '</span>' . harati_get_theme_svg('chevron-down') . '</button>';

        }

        // Close the wrapper.
        $args->after .= '</div><!-- .ancestor-wrapper -->';

        // Add sub menu icons to the primary menu without toggles.
    } elseif ('primary-menu' === $args->theme_location) {
        if (in_array('menu-item-has-children', $item->classes, true)) {
            $args->link_after = '<span class="icon">' . harati_get_theme_svg('chevron-down') . '</span>';
        } else {
            $args->link_after = '';
        }
    }

    return $args;

}

add_filter('nav_menu_item_args', 'harati_add_sub_toggles_to_main_menu', 10, 3);


if (!function_exists('harati_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function harati_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="entry-image">
                <figure class="featured-media">
                    <?php the_post_thumbnail(); ?>
                </figure>
                <?php $display_read_time_in = harati_get_option('display_read_time_in');
                if (in_array('single-page', $display_read_time_in)) {
                    harati_read_time();
                } ?>
            </div><!-- .entry-image -->

        <?php else : ?>
            <div class="entry-image">
                <figure class="featured-media">
                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                        the_post_thumbnail(
                            'post-thumbnail',
                            array(
                                'alt' => the_title_attribute(
                                    array(
                                        'echo' => false,
                                    )
                                ),
                            )
                        );
                        ?>
                    </a>
                </figure>
            </div>

        <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
endif;


if (!function_exists('harati_comments')) {
    /*
     * COMMENT LAYOUT
     */
    function harati_comments($comment, $args, $depth)
    {
        static $comment_number;

        if (!isset($comment_number))
            $comment_number = $args['per_page'] * ($args['page'] - 1) + 1; else {
            $comment_number++;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?>>
        <article id="comment-<?php echo $comment->comment_ID; ?>" class="comment-article  media">

            <span class="comment-number"><?php echo $comment_number ?></span>

            <?php if (get_comment_type($comment->comment_ID) == 'comment'): ?>
                <aside class="comment__avatar  media__img">
                    <!-- custom gravatar call -->
                    <?php $bgauthemail = get_comment_author_email(); ?>
                    <img src="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=60" class="comment__avatar-image" height="60" width="60" />
                </aside>
            <?php endif; ?>
            <div class="media__body">
                <header class="comment__meta comment-author">
                    <?php printf('<span class="comment__author-name">%s</span>', get_comment_author_link()) ?>
                    <time class="comment__time" datetime="<?php comment_time('c'); ?>">
                        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"
                           class="comment__timestamp"><?php printf(__('on %s at %s', 'harati'), get_comment_date(), get_comment_time()); ?> </a>
                    </time>
                    <div class="comment__links">
                        <?php
                        edit_comment_link(__('Edit', 'harati'), '  ', '');
                        comment_reply_link(array_merge($args, array('depth' => $depth,
                            'max_depth' => $args['max_depth']
                        )));
                        ?>
                    </div>
                </header>
                <!-- .comment-meta -->
                <?php if ($comment->comment_approved == '0') : ?>
                    <div class="alert info">
                        <p><?php _e('Your comment is awaiting moderation.', 'harati') ?></p>
                    </div>
                <?php endif; ?>
                <section class="comment__content comment">
                    <?php comment_text() ?>
                </section>
            </div>
        </article>
        <!-- </li> is added by WordPress automatically -->
        <?php
    } // don't remove this bracket!
}

if (!function_exists('harati_post_meta_info')) :
    /**
     * Display post meta info.
     *
     * @param boolean $author Show author
     * @param boolean $comment Show read time
     * @param boolean $date Show date
     *
     * @since 1.0.0
     */
    function harati_post_meta_info($enabled_post_meta = array())
    {
        ?>
        <ul class="harati-entry-meta reset-list-style">
            <?php
            // Author
            if (in_array('author', $enabled_post_meta)) {
                ?>
                <li class="harati-meta post-author">
					<span class="meta-icon">
						<span class="screen-reader-text"><?php _e('Post Author', 'harati'); ?></span>
						<?php harati_theme_svg('user'); ?>
					</span>
                    <span class="meta-text">
						<?php
                        printf(
                        /* translators: %s: Author name. */
                            __('By %s', 'harati'),
                            '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a>'
                        );
                        ?>
					</span>
                </li>
                <?php
            }

            // Date
            if (in_array('date', $enabled_post_meta)) {
                ?>
                <li class="harati-meta post-date">
                    <span class="meta-icon">
						<span class="screen-reader-text"><?php _e('Post Date', 'harati'); ?></span>
                        <?php harati_theme_svg('calendar'); ?>
                    </span>
                    <span class="meta-text">
                        <?php echo esc_html(get_the_date()); ?>
                    </span>
                </li>
                <?php
            }

            // Comment
            if (in_array('comment', $enabled_post_meta)) {
                if (!post_password_required() && (comments_open() || get_comments_number())) {
                    ?>
                    <li class="harati-meta post-comment">
                        <?php
                        $number = get_comments_number(get_the_ID());
                        if (0 == $number) {
                            $respond_link = get_permalink() . '#respond';
                            $comment_link = apply_filters('respond_link', $respond_link, get_the_ID());
                        } else {
                            $comment_link = get_comments_link();
                        }
                        ?>
                        <span class="meta-icon">
							<span class="screen-reader-text"><?php _e('Post Comment', 'harati'); ?></span>
							<?php harati_theme_svg('comment'); ?>
						</span>
                        <span class="meta-text">
							<a href="<?php echo esc_url($comment_link) ?>">
								<?php
                                if ('1' === $number) {
                                    esc_html_e('1 comment', 'harati');
                                } else {
                                    printf(
                                    /* translators: %s: Comment count number. */
                                        esc_html(_nx('%s comment', '%s comments', $number, 'Comments title', 'harati')),
                                        esc_html(number_format_i18n($number))
                                    );
                                }
                                ?>
							</a>
						</span>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
        <?php
    }
endif;

