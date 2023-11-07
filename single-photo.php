<?php
/*
 * Template Name: single-photo
 */
$reference = get_post_meta(get_the_ID(), 'reference', true);
get_header(); ?>
<div id="primary" class="content">
    <main class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post-content">
                <div class="post-info">
                    <h1 class="post-title break-line">
                        <?php the_title();?>
                    </h1>
                    <p>RÉFÉRENCE : <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
                    <p>CATÉGORIE : <?php echo the_terms(get_the_ID(), 'categorie', false); ?></p>
                    <p>TYPE : <?php echo get_post_meta(get_the_ID(), 'type', true);?></p>
                    <p>FORMAT : <?php echo the_terms(get_the_ID(), 'format', false); ?></p>
                    <p>ANNÉE : <?php echo the_terms(get_the_ID(), 'annee', false); ?></p>
                </div>
                <div class="post-image">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="post-thumbnail custom-image-size" />
                    <a href="#img1" class="lightbox-trigger">
                        <span class="fullscreen-icon">
                            <img class="fullscreen-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="fullscreen image"/>
                        </span>
                    </a>

                    <a href="#" class="lightbox" id="img1">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>" />
                    </a>
                </div>
            </div>
        </article>
        <section class="interested-section">
            <div class="interested">
                <div class="interested_contact">
                    <p> Cette photo vous intéresse ? </p>
                    <div class="interested-btn">
                        <button data-refphoto="<?php echo get_the_ID(); ?>" id="contactBTN">Contact</button>
                    </div>
                </div>
                <div class="interested-image">
                    <div class="container-thumbnail">
                        <div class="img-container">
                            <div class="img-previous"><?php echo get_the_post_thumbnail(get_previous_post(), 'custom-thumbnail'); ?></div>
                            <div class="img-next"><?php echo get_the_post_thumbnail(get_next_post(), 'custom-thumbnail'); ?></div>            
                        </div>

                    <div class="arrow-container">
                        <div class="previous">
                            <?php previous_post_link('%link', '<img class="arrow" src="' . get_template_directory_uri() . '/assets/images/arrowL.png" alt="">'); ?>
                        </div>

                        <div class="next">
                            <?php next_post_link('%link', '<img class="arrow" src="' . get_template_directory_uri() . '/assets/images/arrowR.png" alt="">'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php get_template_part('/templates/templates-parts/photo_block'); ?>
    </main>
</div>
<script>
  // Récupère la référence de la photo en tant que variable JavaScript
  var refPhoto = <?php echo json_encode($reference, JSON_HEX_TAG); ?>;
</script>
<?php get_footer(); ?>