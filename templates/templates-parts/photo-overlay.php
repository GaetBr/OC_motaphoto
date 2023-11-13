<div class="photo-overlay">
    <div class="fullscreen-icon">
        <img class="fullscreen-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="">
    </div>
    <a class="eye-a" href="<?php the_permalink(); ?>">
        <img class="eye-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Icon_eye.png" alt="">
    </a>
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