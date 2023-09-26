<?php
/**
 * Displays progressbar
 *
 * @package Harati
 */

$show_progressbar = harati_get_option( 'show_progressbar' );

if ( $show_progressbar ) :
	$progressbar_position = harati_get_option( 'progressbar_position' );
	echo '<div id="harati-progress-bar" class="theme-progress-bar ' . esc_attr( $progressbar_position ) . '"></div>';
endif;
