<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="profile" href="//gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    
    <!-- долното вече го ползваме в function.php -->
    <!-- <link rel="stylesheet" href="wp-content\themes\softuni-jobs\css\master.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <title><?php wp_title(); ?></title>
    
    <?php wp_head(); ?>
</head>

<body>
    <div class="site-wrapper">
        <header class="site-header">
           <!-- правим проверка дали има постове -->
            <?php if( is_single() ): ?>
                <p class="site-title"><a href="<?php echo home_url() ?>">Job Offers</a></p>
            <?php else: ?>
                <h1 class="site-title"><a href="<?php echo home_url() ?>">Job Offers</a></h1>
            <?php endif; ?>
        </header>

        <!-- Викане на меню -->
        <div class="header-nav-menu">
            <?php
            // тази проверка е ако съществува това меню, тогава го викаме 
            if ( has_nav_menu( 'primary_menu' ) ){
                
                // в аргументите може да задаве клас и други неща
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary_menu',
                    )
                ); 
            }
            ?>
        </div>