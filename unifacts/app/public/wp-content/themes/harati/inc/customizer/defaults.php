<?php
/**
 * Default customizer values.
 *
 * @package Harati
 */
if ( ! function_exists( 'harati_get_default_customizer_values' ) ) :
	/**
	 * Get default customizer values.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default customizer values.
	 */
	function harati_get_default_customizer_values() {

		$defaults = array();
        // header image section
        $defaults['enable_header_bg_overlay'] = false;
        $defaults['header_image_size'] = 'none';

		//Site title options
        $defaults['hide_title'] = false;
		$defaults['hide_tagline'] = false;
		$defaults['site_title_text_size'] = 52;
        $defaults['site_tagline_text_size'] = 18;

        // General options
		$defaults['show_lightbox_image'] = false;
        
        $defaults['show_preloader'] = false;
        $defaults['preloader_style'] = 'theme-preloader-spinner-1';
        $defaults['show_progressbar']           = false;
        $defaults['progressbar_position']       = 'top';
        $defaults['progressbar_color']          = '#e4b33f';
        
        // header full page add
        $defaults['ed_header_ad'] = false;
        $defaults['ed_header_type'] = 'welcome-banner-default';
        $defaults['advertisement_section_title'] = esc_html__('Welcome Advertisement Message', 'harati');

        // Top bar.
        $defaults['enable_top_bar']      = false;
        $defaults['hide_topbar_on_mobile'] = true;

        $defaults['enable_topbar_time'] = false;
        $defaults['enable_topbar_date'] = false;
        $defaults['todays_date_format'] = 'l, F j Y';

        $defaults['enable_topbar_social_icons'] = true;
        $defaults['enable_topbar_nav']        = true;

        $defaults['top_bar_bg_color'] = '#000000';
        $defaults['top_bar_text_color'] = '#fff';

        // Header
        $defaults['header_bg_color'] = '#ffffff';
        $defaults['header_style'] = 'header_style_1';
        $defaults['enable_top_nav'] = true;
        $defaults['enable_header_social_nav'] = true;

        $defaults['enable_random_post'] = true;
        $defaults['random_post_category'] = '';

        $defaults['enable_search_on_header'] = true;
        $defaults['header_search_btn_style'] = 'style_1';
        $defaults['enable_mini_cart_header'] = true;
        $defaults['enable_woo_my_account'] = true;
        $defaults['enable_sticky_menu'] = true;

        // Dark Mode.
        $defaults['enable_dark_mode']          = true;
        $defaults['enable_dark_mode_switcher'] = true;
        $defaults['dark_mode_accent_color']    = '#066ac6';
        $defaults['dark_mode_bg_color']        = '#1e1e1e';
        $defaults['dark_mode_text_color']        = '#ffffff';

        // Front Page
		$defaults['front_page_enable_sidebar'] = false;
		$defaults['hide_front_page_sidebar_mobile'] = false;
		$defaults['front_page_layout'] = 'right-sidebar';

        // front page banner sectiion
        $defaults['enable_banner_section'] = true;
        $defaults['banner_section_slider_layout'] = 'site-banner-layout-1';
        $defaults['number_of_slider_post'] = '4';
        $defaults['slider_post_content_alignment'] = 'text-left';
        $defaults['banner_section_cat'] = '';
        $defaults['enable_banner_cat_meta'] = true;
        $defaults['enable_banner_post_description'] = true;
        $defaults['enable_banner_authro_meta'] = true;
        $defaults['enable_banner_date_meta'] = true;

        // archive options
        $defaults['global_sidebar_layout'] = 'right-sidebar';
        $defaults['hide_global_sidebar_mobile'] = false;
        $defaults['excerpt_length'] = 25;

        // Single options
        $defaults['single_sidebar_layout'] = 'right-sidebar';
        $defaults['hide_single_sidebar_mobile'] = false;
        $defaults['single_post_meta'] = array('author', 'date', 'comment', 'category', 'tags');
        
        $defaults['show_author_info'] = true;

        $defaults['show_related_posts'] = true;
        $defaults['related_posts_text'] = __('You May Also Like', 'harati');
        $defaults['no_of_related_posts'] = 3;
        $defaults['related_posts_orderby'] = 'date';
        $defaults['related_posts_order'] = 'desc';
        $defaults['author_posts_orderby'] = 'date';
        $defaults['author_posts_order'] = 'desc';

        $defaults['show_author_posts'] = true;
        $defaults['author_posts_text'] = __('More From Author', 'harati');
        $defaults['no_of_author_posts'] = 3;

        // Archive
        $defaults['archive_style'] = 'archive_style_1';
        $defaults['archive_post_meta_1'] = array('author', 'date', 'comment', 'category','tags');
        $defaults['archive_post_meta_2'] = array('author', 'date', 'category');
        $defaults['archive_post_meta_3'] = array('author', 'date', 'category');
        $defaults['archive_post_meta_4'] = array('category');

        // pagination
        $defaults['pagination_type'] = 'default';

        // readtime option
        $defaults['enable_read_time_option'] = true;
        $defaults['display_read_time_in'] =array('home-page','single-page','archive-page');
        $defaults['words_per_minute'] = 200;

        // footer related post
        $defaults['enable_footer_recommended_post_section'] = true;
        $defaults['footer_recommended_post_title'] = esc_html__( 'You May Also Like:', 'harati' );
        $defaults['enable_category_meta'] = true;
        $defaults['enable_post_excerpt'] = false;
        $defaults['enable_date_meta'] = true;
        $defaults['enable_author_meta'] = true;
        $defaults['select_cat_for_footer_recommended_post'] = '';

        /*Footer*/
        $defaults['enable_copyright'] = true;
        $defaults['footer_bg_color'] = '#ffffff';
        $defaults['footer_column_layout'] = 'footer_layout_1';
        $defaults['enable_footer_sticky'] = false;
        $defaults['copyright_text'] = esc_html__( 'Copyright &copy;', 'harati' );
        $defaults['copyright_date_format'] = 'Y';
        $defaults['enable_footer_credit'] = true;
        $defaults['enable_footer_nav'] = false;
        $defaults['enable_footer_social_nav'] = false;
        $defaults['enable_scroll_to_top'] = true;


		$defaults = apply_filters( 'harati_default_customizer_values', $defaults );
		return $defaults;
	}
endif;