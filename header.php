<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>    
</head>
<body <?php body_class(); ?>>

    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">
            <?php
             // Affiche le logo si tu l'as défini dans Personnaliser > Identité du site
            the_custom_logo();

            // Si le site n'a pas de logo, affiche le titre du site
            if (!has_custom_logo()) {
                echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
                echo '<p class="site-description">' . get_bloginfo('description') . '</p>';
            }
            ?>
        </div><!-- .site-branding -->

         <!-- Bouton Burger en dehors du conteneur nav -->
         <div class="navigation-right">
            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </span>
            </a>
        </div>

        <!-- Contenu du menu burger -->
        <div id="mySidenav" class="sidenav">
            <?php
            // Affiche le menu géré depuis WordPress dans le menu burger
            wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_id' => 'main-menu'));
            ?>
        </div>
        
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php
            // Affiche le menu géré depuis WordPress
            wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_id' => 'main-menu'));
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">