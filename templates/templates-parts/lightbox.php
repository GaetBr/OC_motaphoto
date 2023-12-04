<?php
while (have_posts()):
    the_post();
?>
<div class="lightbox">
    <button class="lightbox_close">Fermer</button>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="lightbox_container">
            <button class="lightbox_prev">
                <img class="arrow arrowNavL" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/navArrowL.png" alt="nav arrow left">
                <span>Précédente</span>
            </button>
                <div class="img-container"> 
                    <img class="lightbox_img js-img-lightbox" src="" alt="">
                    <div class="lightbox_info">
                        <p class="lightbox_ref"></p>
                        <p class="lightbox_cat"></p>
                    </div>
                </div>
            <button class="lightbox_next">
                <span>Suivante</span>
                <img class="arrow arrowNavR" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/navArrowR.png" alt="nav arrow right">
            </button>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>
<?php endwhile; ?>
            