<?php
$categorie = array_map(function ($term) {
    return $term->term_id;
}, get_the_terms(get_post(), 'categorie'));

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
    )
);
?>

<section class="alsolike-section">
    <h3 class="like-title">Vous aimerez aussi</h3>
    <div class="related-photo">
        <?php while ($query->have_posts()): $query->the_post(); ?>        
            <div class="relatedPhoto-container">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>">
                <?php include locate_template('/templates/templates-parts/photo-overlay.php'); ?>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
    
    <div>
        <button class="loadmore">Toutes les photos</button>
    </div>
</section>