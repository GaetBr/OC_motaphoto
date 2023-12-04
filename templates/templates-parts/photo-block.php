<?php
// Get the category terms for the current post
$categorie = array_map(function ($term) {
    return $term->term_id;
}, get_the_terms(get_post(), 'categorie'));

// Exclude the current post ID from the query
$exclude_image_id = get_the_ID();

// Query for related photos
$query = new WP_Query(
    array(
        'post_not_in'    => [get_the_ID()],
        'post_type'      => 'photo',
        'posts_per_page' => 2,
        'orderby'        => 'rand',
        'tax_query'      => [
            [
                'taxonomy' => 'categorie',
                'terms'    => $categorie,
            ],
        ],
        'post__not_in'   => array($exclude_image_id),
    )
);
?>

<h2 class="like-title">Vous aimerez aussi</h2>
    <div class="related-photo" id="initial-photos">
        <?php while ($query->have_posts()): $query->the_post(); ?>        
            <div class="relatedPhoto-container">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>">
                <?php include locate_template('/templates/templates-parts/photo-overlay.php'); ?>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
    <div class="cta-AllPhotos">
        <button class="cta" id="ajax-AllPhotos" data-catid="<?php echo esc_attr($categorie[0]); ?>">Toutes les photos</button>
    </div>

