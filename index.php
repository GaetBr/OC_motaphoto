<?php get_header(); 
/*
 * Template Name: Home
 */
?>

<section id="hero-header">
    <?php 
    // Query to retrieve a random photo for the hero header
    $query = new WP_Query(
        array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'orderby' => 'rand',
     )
    );

    if ($query->have_posts()):
        $query->the_post();
        if (has_post_thumbnail()):
            // Display the hero container with the title and featured image
            echo '<div class="hero-container">';
            echo '<h1>Photographe Event</h1>';            
                the_post_thumbnail('full', ['class' => 'hero-img']);
            echo '</div>';
        endif;
    endif;

    wp_reset_postdata();
    ?>
</section>
<section id="photo-catalog">
    <?php get_template_part('/templates/templates-parts/filters'); ?>
    <?php
    // Query to retrieve a list of photos for the photo catalog
    $loop = new WP_Query(
        array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'ASC',
            'paged' => $page,
        )
    );
    if ($loop->have_posts()):
        echo '<div class="row">';
        while ($loop->have_posts()):
            $loop->the_post();
            // Include the template part for displaying individual photo cards
            get_template_part('/templates/templates-parts/card');
        endwhile;
        echo '</div>';
    ?>
    <?php endif;
    wp_reset_postdata(); ?>

    <!-- Display a message if no photos are found -->
    <p id="no-photos-message" style="display: none;">Aucune photo trouvée.</p>
    
    <!-- Load more button for fetching additional photos -->
    <div class="cta-loadMore">
        <button class="cta" id="ajax-LoadMore">Charger Plus</button>
    </div>
</section>
<?php get_footer(); ?>