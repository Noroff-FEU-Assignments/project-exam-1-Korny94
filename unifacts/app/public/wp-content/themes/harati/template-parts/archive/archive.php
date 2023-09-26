<?php
/**
 * Show the excerpt.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Harati
 * @since Harati 1.0.0
 */
if ( absint(harati_get_option( 'excerpt_length' )) != '0'){
    the_excerpt();
}