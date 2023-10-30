<?php include_once(get_template_directory() . '/theme_setting/theme_functions.php'); ?>
<?php

function enqueue_theme_script() {
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_theme_script');

function enqueue_theme_style() {
    wp_enqueue_style('style', get_template_directory_uri() . '/sass/styles.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_style');

/*****************************************************************************************/
/***************                       MODAL                         *********************/
/*****************************************************************************************/

// Ajouter une classe au lien "CONTACT" dans le menu
function ajouter_classe_contact_menu($atts, $item, $args) {
    // Vérifier si l'élément de menu est le lien "CONTACT" et si la classe n'est pas déjà définie
    if ($args->theme_location == 'menu-principal' && $item->title == 'CONTACT' && empty($atts['class'])) {
        $atts['class'] = 'contact-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ajouter_classe_contact_menu', 10, 3);
?>