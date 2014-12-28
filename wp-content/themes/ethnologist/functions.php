<?php

add_action( 'wp_enqueue_scripts', 'ethnologist_enqueue_styles' );
function ethnologist_enqueue_styles() {
	wp_enqueue_style( 'ethnologist-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ethnologist-child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}