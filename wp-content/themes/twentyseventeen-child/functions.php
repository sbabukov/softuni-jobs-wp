<?php

// functions for load css parent theme
function twentyseventeen_parent_style() {
	$parenthandle = 'twentyseventeen'; 
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/style.css',
		array(), 
		$theme->parent()->get( 'Version' )
	);
	
}

add_action( 'wp_enqueue_scripts', 'twentyseventeen_parent_style' );