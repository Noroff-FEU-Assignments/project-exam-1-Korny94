<?php

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widget-base/widgetbase.php';

require get_template_directory() . '/inc/widgets/recent-widget.php';
require get_template_directory() . '/inc/widgets/social-widget.php';
require get_template_directory() . '/inc/widgets/author-widget.php';
require get_template_directory() . '/inc/widgets/newsletter-widget.php';
require get_template_directory() . '/inc/widgets/tab-widget.php';
require get_template_directory() . '/inc/widgets/cta-widget.php';

/* Register site widgets */
if ( ! function_exists( 'harati_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function harati_widgets() {
        register_widget( 'Harati_Recent_Posts' );
        register_widget( 'Harati_Social_Menu' );
        register_widget( 'Harati_Author_Info' );
        register_widget( 'Harati_Mailchimp_Form' );
        register_widget( 'Harati_Call_To_Action' );
        register_widget( 'Harati_Tab_Posts' );
    }
endif;
add_action( 'widgets_init', 'harati_widgets' );