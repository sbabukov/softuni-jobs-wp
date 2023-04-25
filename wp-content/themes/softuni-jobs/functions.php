<?php
// support for pictures thumbnails
add_theme_support( 'post-thumbnails');

// add custom image size
add_image_size( 'job-thumbnail',  105, 120 );

// function of get css path (enqueue style)
function softuni_assets(){
    wp_enqueue_style( 
        'sofuni-jobs', 
        get_template_directory_uri() . '/css/master.css', array(), 
        filemtime( get_template_directory_uri(). '/css/master.css' ));
}
add_action( 'wp_enqueue_scripts', 'softuni_assets' );

/**
 * Taking care our custom menu
 *
 * @return void
 */
function softuni_register_nav_menu(){
    register_nav_menus( array(
        'primary_menu' => __( 'Primary Menu', 'softuni' ),
        'footer_menu'  => __( 'Footer Menu', 'softuni' ),
    ) );
}
add_action( 'after_setup_theme', 'softuni_register_nav_menu', 0 );




