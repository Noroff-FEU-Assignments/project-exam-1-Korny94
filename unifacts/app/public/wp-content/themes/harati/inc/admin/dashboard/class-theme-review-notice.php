<?php
/**
 * Harati Theme Review Notice Class.
 *
 * @package Harati
 * @since   1.1.9
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class to display the theme review notice after certain period.
 *
 * Class Harati_Theme_Review_Notice
 */
class Harati_Theme_Review_Notice
{

    /**
     * Constructor function to include the required functionality for the class.
     *
     * Harati_Theme_Review_Notice constructor.
     */
    public function __construct()
    {
        add_action('admin_notices', array($this, 'review_notice_markup'), 0);
        add_action('admin_init', array($this, 'ignore_theme_review_notice'), 0);
        add_action('admin_init', array($this, 'ignore_theme_review_notice_partially'), 0);
        add_action('switch_theme', array($this, 'review_notice_data_remove'));

        $this->review_notice();
    }

    /**
     * Set the required option value as needed for theme review notice.
     */
    public function review_notice()
    {
        // Set the installed time in `harati_theme_installed_time` option table.
        if (!get_option('harati_theme_installed_time')) {
            update_option('harati_theme_installed_time', time());
        }
    }

    /**
     * Show HTML markup if conditions meet.
     */
    public function review_notice_markup()
    {
        $user_id = get_current_user_id();
        $ignored_notice = get_user_meta($user_id, 'harati_ignore_theme_review_notice', true);
        $ignored_notice_partially = get_user_meta($user_id, 'nag_harati_ignore_theme_review_notice_partially', true);
        $dismiss_url = wp_nonce_url(
            add_query_arg('nag_harati_ignore_theme_review_notice', 0),
            'nag_harati_ignore_theme_review_notice_nonce',
            '_harati_ignore_theme_review_notice_nonce'
        );
        $temporary_dismiss_url = wp_nonce_url(
            add_query_arg('nag_harati_ignore_theme_review_notice_partially', 0),
            'nag_harati_ignore_theme_review_notice_partially_nonce',
            '_harati_ignore_theme_review_notice_nonce'
        );

        if (!current_user_can('edit_posts')) {
            return;
        }

        /**
         * Return from notice display if:
         *
         * 1. The theme installed is less than 14 days ago.
         * 2. If the user has ignored the message partially for 14 days.
         * 3. Dismiss always if clicked on 'I Already Did' button.
         */
        if ((get_option('harati_theme_installed_time') > strtotime('-14 day')) || ($ignored_notice_partially > strtotime('-14 day')) || ($ignored_notice)) {
            return;
        }
        ?>
        <div class="notice notice-success harati-notice theme-review-notice" style="position:relative;">

            <div class="harati-notice-message">
                <h3><?php echo esc_html('Enjoying Harati Theme? Share your thoughts and help others discover its benefits.'); ?></h3>

                <p>
                    <?php
                    printf(
                    /* translators: %1$s: Opening of strong tag, %2$s: Theme's Name, %3$s: Closing of strong tag  */
                        esc_html__('Thank you for choosing the %1$s %2$s %3$s WordPress theme! We hope you\'re having a great experience with it so far.', 'harati'),
                        '<strong>',
                        esc_html(wp_get_theme(get_template())),
                        '</strong>'
                    );
                    ?>
                </p>
                <p>
                    <?php esc_html_e('If you have a moment, we\'d be incredibly grateful if you could leave us a review.', 'harati'); ?>
                </p>
                <p><strong><?php esc_html_e('What are the benefits of leaving a review?', 'harati'); ?></strong></p>

                <p>
                    <?php
                    printf(
                    /* translators: %s: Smiley icon */
                        esc_html__('By sharing your thoughts, you\'re helping other WordPress users discover the benefits of the Harati theme. Your review also helps us release regular updates and new features, and fix any issues that might arise. Plus, we\'ll continue to provide free support for all our users.  %s', 'harati'),
                        '<span class="dashicons dashicons-smiley smile-icon"></span>'
                    );
                    ?>
                </p>

                <div class="theme-admin-button-wrap theme-admin-button-group">
                    <a href="https://wordpress.org/support/theme/harati/reviews/?filter=5#new-post" class="button theme-admin-button admin-button-primary" target="_blank">
                        <span class="dashicons dashicons-external"></span>
                        <span><?php esc_html_e('Sure, I\'d love to!', 'harati'); ?></span>
                    </a>

                    <a href="<?php echo esc_url($dismiss_url); ?>" class="button theme-admin-button admin-button-secondary">
                        <span class="dashicons dashicons-smiley"></span>
                        <span><?php esc_html_e('I already did!', 'harati'); ?></span>
                    </a>

                    <a href="<?php echo esc_url($temporary_dismiss_url); ?>" class="button theme-admin-button admin-button-secondary">
                        <span class="dashicons dashicons-calendar"></span>
                        <span><?php esc_html_e('Maybe later', 'harati'); ?></span>
                    </a>

                    <a href="<?php echo esc_url('https://wordpress.org/support/theme/harati/'); ?>" class="button theme-admin-button admin-button-secondary" target="_blank">
                        <span class="dashicons dashicons-testimonial"></span>
                        <span><?php esc_html_e('I have a query', 'harati'); ?></span>
                    </a>
                </div> <!-- /.theme-admin-button-group -->

            </div> <!-- /.harati-notice-message -->

            <a class="notice-dismiss" href="<?php echo esc_url($dismiss_url); ?>"></a>

        </div> <!-- /.theme-review-notice -->
        <?php
    }

    /**
     * `I already did` button or `dismiss` button: remove the review notice permanently.
     */
    public function ignore_theme_review_notice()
    {

        // If user clicks to ignore the notice, add that to their user meta.
        if (isset($_GET['nag_harati_ignore_theme_review_notice']) && isset($_GET['_harati_ignore_theme_review_notice_nonce'])) {

            if (!wp_verify_nonce(wp_unslash($_GET['_harati_ignore_theme_review_notice_nonce']), 'nag_harati_ignore_theme_review_notice_nonce')) {
                wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'harati'));
            }

            if ('0' === $_GET['nag_harati_ignore_theme_review_notice']) {
                add_user_meta(get_current_user_id(), 'harati_ignore_theme_review_notice', 'true', true);
            }
        }
    }

    /**
     * `Maybe later` button: remove the review notice partially.
     */
    public function ignore_theme_review_notice_partially()
    {

        // If user clicks to ignore the notice, add that to their user meta.
        if (isset($_GET['nag_harati_ignore_theme_review_notice_partially']) && isset($_GET['_harati_ignore_theme_review_notice_nonce'])) {

            if (!wp_verify_nonce(wp_unslash($_GET['_harati_ignore_theme_review_notice_nonce']), 'nag_harati_ignore_theme_review_notice_partially_nonce')) {
                wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'harati'));
            }

            if ('0' === $_GET['nag_harati_ignore_theme_review_notice_partially']) {
                update_user_meta(get_current_user_id(), 'nag_harati_ignore_theme_review_notice_partially', time());
            }
        }
    }

    /**
     * Remove the data set after the theme has been switched to other theme.
     */
    public function review_notice_data_remove()
    {
        $get_all_users = get_users();
        $theme_installed_time = get_option('harati_theme_installed_time');

        // Delete options data.
        if ($theme_installed_time) {
            delete_option('harati_theme_installed_time');
        }

        // Delete user meta data for theme review notice.
        foreach ($get_all_users as $user) {
            $ignored_notice = get_user_meta($user->ID, 'harati_ignore_theme_review_notice', true);
            $ignored_notice_partially = get_user_meta($user->ID, 'nag_harati_ignore_theme_review_notice_partially', true);

            // Delete permanent notice remove data.
            if ($ignored_notice) {
                delete_user_meta($user->ID, 'harati_ignore_theme_review_notice');
            }

            // Delete partial notice remove data.
            if ($ignored_notice_partially) {
                delete_user_meta($user->ID, 'nag_harati_ignore_theme_review_notice_partially');
            }
        }
    }
}

new Harati_Theme_Review_Notice();
