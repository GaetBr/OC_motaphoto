<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <?php wp_head(); ?>    
</head>
<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="header-container">
            <div class="site-branding">
                <?php
                // Display the logo if defined in Customize > Site Identity
                the_custom_logo();

                // If the site doesn't have a logo, display the site title
                if (!has_custom_logo()) {
                    echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
                    echo '<p class="site-description">' . get_bloginfo('description') . '</p>';
                }
                ?>
            </div><!-- .site-branding -->
            
            <?php get_template_part('/templates/templates-parts/menu-burger'); ?>

            <nav id="site-navigation" class="main-navigation" role="navigation">
                <?php
                // Display the menu managed from WordPress
                wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_id' => 'main-menu'));
                ?>
            </nav><!-- #site-navigation -->
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">