<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // WordPress loop to display page content
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', 'page');

            // Uncomment the next line if you want to display comments
            // comments_template();

        endwhile;
        ?>

    </main>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>