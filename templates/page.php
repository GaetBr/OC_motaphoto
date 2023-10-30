<?php
/**
 * Template Name: Simple page
 *
 * @package WordPress
 * @subpackage OCmotaphoto
 * @since OCmotaphoto 1.0
 */
get_header();
?>

<!-- Contenu de la page -->
<div id="content" class="site-content">
    <?php
    // Le contenu de votre page sera géré par l'interface WordPress ici
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>