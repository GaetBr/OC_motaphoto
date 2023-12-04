<div class="card-img">
    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>">
    <?php include locate_template('/templates/templates-parts/photo-overlay.php'); ?>
</div>