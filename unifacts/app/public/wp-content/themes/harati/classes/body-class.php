<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function harati_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    $header_style = harati_get_option('header_style');
    $classes[] = ' harati-'.$header_style;
    // Get the color mode of the site.
    $enable_dark_mode = harati_get_option( 'enable_dark_mode' );
    if ( $enable_dark_mode ) {
        $classes[] = 'harati-dark-mode';
    } else {
        $classes[] = 'harati-light-mode';
    }

	// Get appropriate class for the sidebar layout to work
	$page_layout = harati_get_page_layout();
    if('no-sidebar' != $page_layout ){
        $classes[] = 'has-sidebar '.esc_attr($page_layout);
    }else{
        $classes[] = esc_attr($page_layout);
    }

	return $classes;
}
add_filter( 'body_class', 'harati_body_classes' );
