<?php
get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Boucle WordPress pour afficher le contenu de l'article
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', 'single');

        endwhile; 
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>