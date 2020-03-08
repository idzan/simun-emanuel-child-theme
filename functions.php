<?php

function simun_emanuel_child_enqueue_scripts() {
	wp_enqueue_style(
		'altair-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'altair-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'simun_emanuel_child_enqueue_scripts' );
