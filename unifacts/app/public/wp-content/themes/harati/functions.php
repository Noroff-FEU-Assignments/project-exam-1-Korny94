<?php
/**
 * Harati functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Harati
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function harati_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Harati, use a find and replace
        * to change 'harati' to the name of your theme in all the template files.
        */
    load_theme_textdomain('harati', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'top-menu' => esc_html__('Top Menu', 'harati'),
            'primary-menu' => esc_html__('Primary Menu', 'harati'),
            'social-menu' => esc_html__('Social Menu', 'harati'),
            'footer-menu' => esc_html__('Footer Menu', 'harati'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'harati_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add post-formats support.
    add_theme_support(
        'post-formats',
        array(
            'link',
            'aside',
            'gallery',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );

    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
}

add_action('after_setup_theme', 'harati_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function harati_content_width()
{
    $GLOBALS['content_width'] = apply_filters('harati_content_width', 640);
}

add_action('after_setup_theme', 'harati_content_width', 0);

/**
 *  Minor header styles/scripts that needs to run before other styles/scripts
 */
function harati_head_scripts()
{
    ?>
    <script type="text/javascript">
        let storageKey = 'theme-preference';

        let getColorPreference = function () {
            if (localStorage.getItem(storageKey))
                return localStorage.getItem(storageKey)
            else
                return window.matchMedia('(prefers-color-scheme: dark)').matches
                    ? 'dark'
                    : 'light'
        }

        let theme = {
            value: getColorPreference()
        };

        let setPreference = function () {
            localStorage.setItem(storageKey, theme.value);
            reflectPreference();
        }

        let reflectPreference = function () {
            document.firstElementChild.setAttribute("data-theme", theme.value);
            document.querySelector("#theme-toggle-mode-button")?.setAttribute("aria-label", theme.value);
        }

        // set early so no page flashes / CSS is made aware
        reflectPreference();

        window.addEventListener('load', function () {
            reflectPreference();
            let toggleBtn = document.querySelector("#theme-toggle-mode-button");
            if (toggleBtn) {
                toggleBtn.addEventListener("click", function () {
                    theme.value = theme.value === 'light' ? 'dark' : 'light';
                    setPreference();
                });
            }
        });

        // sync with system changes
        window
            .matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', ({matches: isDark}) => {
                theme.value = isDark ? 'dark' : 'light';
                setPreference();
            });
    </script>
    <?php
}

add_action('wp_head', 'harati_head_scripts');

/**
 * Enqueue scripts and styles.
 */
function harati_scripts()
{

    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

    $fonts_url = harati_fonts_url();
    if ($fonts_url) {

        require_once get_theme_file_path('inc/webfont/class-theme-webfont-loader.php');
        wp_enqueue_style(
            'harati-google-fonts',
            wptt_get_webfont_url($fonts_url),
            array(),
            _S_VERSION
        );
    }

    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate' . $min . '.css', array(), _S_VERSION);

    if (harati_get_option('show_lightbox_image')) {
        wp_enqueue_style('glightbox', get_template_directory_uri() . '/assets/css/glightbox' . $min . '.css', array(), _S_VERSION);
        wp_enqueue_script('glightbox-script', get_template_directory_uri() . '/assets/js/glightbox' . $min . '.js', array(), _S_VERSION, true);
    }
    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper-bundle' . $min . '.css', array(), _S_VERSION);
    wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/js/swiper-bundle' . $min . '.js', array(), _S_VERSION, true);

    wp_enqueue_style('harati-style', get_stylesheet_uri(), array(), _S_VERSION);

    wp_style_add_data('harati-style', 'rtl', 'replace');

    wp_add_inline_style('harati-style', harati_get_inline_css());


    if (harati_get_option('enable_dark_mode')) {
        wp_enqueue_style('harati-night-style', get_template_directory_uri() . '/assets/css/dark-mode.css', array(), _S_VERSION);
        wp_add_inline_style('harati-night-style', harati_get_dark_mode_inline_css());
    }

    wp_enqueue_script('harati-script', get_template_directory_uri() . '/assets/js/script.js', array(), _S_VERSION, true);


    // Ajax Load Posts Scripts
    $pagination_type = harati_get_option('pagination_type');
    if ('ajax_load_on_click' == $pagination_type || 'ajax_load_on_scroll' == $pagination_type):
        wp_enqueue_script('harati-load-posts', get_template_directory_uri() . '/assets/js/pagination.js', array(), _S_VERSION, true);
        // Localized variables
        global $wp_query;
        wp_localize_script('harati-load-posts', 'HaratiVars', array(
            'nonce' => wp_create_nonce('harati-load-posts-nonce'),
            'ajaxurl' => admin_url('admin-ajax.php'),
            'query_vars' => json_encode($wp_query->query_vars)
        ));
    endif;


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'harati_scripts');



/**
 * Admin enqueue script
 */
function harati_admin_scripts($hook)
{
    $current_screen = get_current_screen();
    if ($current_screen->id === "post" || $current_screen->id === "page") {
        wp_enqueue_style('harati-metabox', get_template_directory_uri() . '/inc/meta/css/metabox.css');
        wp_style_add_data('harati-metabox', 'rtl', 'replace');
        wp_enqueue_script('harati-metabox-js', get_template_directory_uri() . '/inc/meta/js/metabox.js', array('jquery'), '', 1);

    }
}

add_action('admin_enqueue_scripts', 'harati_admin_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions for this theme.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Custom Widgets and sidebars for this theme.
 */
require get_template_directory() . '/inc/widgets/init.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}
/**
 */
require get_template_directory() . '/classes/body-class.php';

/**
 * Load SVG Icons
 */
require get_template_directory() . '/classes/class-svg-icons.php';

/**
 * Admin
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Load dynamic styles
 */

include(get_template_directory() . '/inc/dynamic-styles.php');


include(get_template_directory() . '/inc/pagination.php');
include(get_template_directory() . '/inc/meta/post-meta.php');

add_filter('themeinwp_enable_demo_import_compatiblity','harati_demo_import_filter_apply');

if( !function_exists('harati_demo_import_filter_apply') ):

    function harati_demo_import_filter_apply(){

        return true;

    }

endif;