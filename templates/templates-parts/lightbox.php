<?php
while (have_posts()):
    the_post();
?>
<div class="lightbox">
    <button class="lightbox_close">Fermer</button>
        <div class="lightbox_container">
            <button class="lightbox_prev">
                <?php previous_post_link('%link', '<img class="arrow" src="' . get_template_directory_uri() . '/assets/images/navArrowL.png" alt="">'); ?>
            </button>
            <div class="img-container">
                <img class="lightbox_img js-img-lightbox" src="<?php echo esc_url(the_post_thumbnail_url()); ?>" alt="">
                <div class="lightbox_info">
                    <div class="lightbox_ref"><?php echo esc_html(get_field('reference')); ?></div>
                    <div class="lightbox_cat">
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'categorie');
                        if ($terms && !is_wp_error($terms)) {
                            $term_names = array();
                            foreach ($terms as $term) {
                                $term_names[] = $term->name;
                            }
                            echo esc_html(implode(', ', $term_names));
                        }
                        ?>
                    </div>
                </div>
            </div>
            <button class="lightbox_next">
                <?php next_post_link('%link', '<img class="arrow" src="' . get_template_directory_uri() . '/assets/images/navArrowR.png" alt="">'); ?>
            </button>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>
<?php endwhile; ?>