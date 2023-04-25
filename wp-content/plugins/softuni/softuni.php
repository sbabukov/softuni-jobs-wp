<?php

/**
 * Plugin Name: SoftUni traning
 * Description: This our test plugin
 * Version: 0.0.1
 */

//  if ( is_admin() ) {
//      var_dump( 'test' );
//  } else {
//     var_dump( 'in else' );
//  }

// change title of page
function change_title_text($title)
{
    
    return $title . ' 1st function. ';
}

// use filter; 'the title' - filter name, 'change_title_text' - the argument is our function
// add_filter( 'the_title', 'change_title_text', 8 );

function change_title_again($title)
{
    var_dump( $title );
    return $title . ' 2nd function.';
}

// add_filter( 'the_title', 'change_title_again', 7);

function change_title_for_the_third_time($title)
{
    
    return $title . ' 3rd function.';
}

add_filter('the_title', 'change_title_for_the_third_time', 6);

// the page content manipulating
function change_my_content($content)
{
    
    $post_title = get_the_title(get_the_ID());
    $tweeter = '<a class="twitter-share-button" href="https://twitter.com/intent/tweet"> '.$post_title.'</a>';

    $content .= '<div>' . $tweeter . '</div>';
    return $content;
}

add_filter('the_content', 'change_my_content');

function add_body_class( $classes) {
    $classes [] = 'my-custome-body-class';
    // var_dump( $classes); die();
    return $classes;
}

add_filter( 'body_class', 'add_body_class' );

// page-template-default page page-id-5 logged-in admin-bar no-customize-support wp-embed-responsive
// page-template-default page page-id-5 logged-in admin-bar no-customize-support wp-embed-responsive my-custome-body-class

function detect_word( $content) {
    // var_dump( $content); die();

    $my_word = 'Stefan Babukov';

    if ( str_contains( $content, $my_word ) ) {
        $content .= '<p>"This returned true!"</p>';
        // $my_word = str_replace( $content, $my_word, 'Petya Babukova');
        // $content .= $my_word;
        // $content = str_replace( $content, $my_word);
    } else {
        $content .= '<p>"This returned false!"</p>';
    }

    return $content;
    }


add_filter( 'the_content', 'detect_word');

