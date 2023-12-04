<div class="photo-overlay">
    <!-- Fullscreen icon with data attributes for image, reference, and category -->
    <div class="fullscreen-icon">
        <img class="fullscreen-img"
             src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Icon_fullscreen.png"
             alt=""
             data-image="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
             data-ref="<?php echo esc_html(get_field('reference')); ?>"
             data-cat="<?php
                $terms = get_the_terms(get_the_ID(), 'categorie');
                if ($terms && !is_wp_error($terms)) {
                    $term_names = array();
                    foreach ($terms as $term) {
                        $term_names[] = esc_html($term->name);
                    }
                    echo implode(', ', $term_names);
                }
             ?>">
    </div>
    <a class="eye-a" href="<?php the_permalink(); ?>">
        <img class="eye-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Icon_eye.png" alt="">
    </a>
    <!-- Hover info with title and category -->
    <div class="hover-info">
        <div class="hover-title">
            <?php echo get_the_title(); ?>
        </div>
        <div class="hover-cat">
            <?php
            $terms = get_the_terms(get_the_ID(), 'categorie');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array();
                foreach ($terms as $term) {
                    $term_names[] = $term->name;
                }
                echo implode(', ', $term_names);
            }
            ?>
        </div>
    </div>
</div>