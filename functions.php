<?php include_once(get_template_directory() . '/theme_setting/theme_functions.php'); ?>
<?php

// Enqueue des scripts et styles uniquement sur les pages nécessaires
function theme_enqueue_scripts() {
    if (is_home() || is_front_page()) {
        // Charger les scripts et styles nécessaires pour la page d'accueil
        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
        wp_enqueue_style('style', get_template_directory_uri() . '/sass/styles.css', array(), '1.0', 'all');
       
    }   
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

?>