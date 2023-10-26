<?php 
// Ajout de la prise en charge du logo personnalisé
function theme_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}

add_action('after_setup_theme', 'theme_setup');

// Enregistrement des menus
function theme_register_menus() {
    register_nav_menus(array(
        'menu-principal' => __('Menu Principal', 'text-domain'),
        'menu-footer' => __('Menu Footer', 'text-domain'),
        'offcanvas-menu' => __('Menu Hors Champ', 'text-domain'),
    ));
}

add_action('after_setup_theme', 'theme_register_menus');

?>
