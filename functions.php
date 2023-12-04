<?php include_once(get_template_directory() . '/theme_setting/theme_functions.php'); ?>

<?php
function enqueue_theme_script() {
    // Enqueue your main script with the handle 'script'
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);    

    // Pass Ajax URL to script using the correct handle 'script'
    wp_localize_script('script', 'ajax_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));

    // Enqueue Swiper.js from CDN
    wp_enqueue_script('swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '6.10.2', true);
    wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '6.10.2', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_script');

function enqueue_lightbox_scripts() {
    // Enqueue script JavaScript for lightbox
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_scripts');

function enqueue_theme_style() {
    wp_enqueue_style('style', get_template_directory_uri() . '/sass/styles.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_style');

// Add a new image size
add_image_size('custom-thumbnail', 81, 81, false);

/*****************************************************************************************/
/***************                       MODAL                         *********************/
/*****************************************************************************************/
function ajouter_classe_contact_menu($atts, $item, $args) {
    // Check if the menu location is 'menu-principal' and the menu item is 'CONTACT'
    if ($args->theme_location == 'menu-principal' && $item->title == 'CONTACT' && empty($atts['class'])) {
        $atts['class'] = 'contact-link'; // Add the 'contact-link' class
    }
    return $atts;
}
// Add filter to modify the attributes of the menu link
add_filter('nav_menu_link_attributes', 'ajouter_classe_contact_menu', 10, 3);

/*****************************************************************************************/
/***************         AJAX AVEC JQUERY LOAD MORE (ACCEUIL)        *********************/
/*****************************************************************************************/
function load_more_photos() {
    // Get the page and filter parameters from the AJAX request
    $page = $_POST['page'];
    $category = sanitize_text_field($_POST['category']);
    $format = sanitize_text_field($_POST['format']);
    $year = sanitize_text_field($_POST['year']);
    $order_by = $_POST['order_by'];

    // Set up WP_Query arguments for fetching photos
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'orderby' => $order_by,
        'order' => 'ASC',
        'paged' => $page,
    );

    // Add taxonomy filters to the WP_Query
    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'id',
            'terms'    => $category,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'id',
            'terms'    => $format,
        );
    }

    if ($year) {
        $args['tax_query'][] = array(
            'taxonomy' => 'annee',
            'field'    => 'id',
            'terms'    => $year,
        );
    }

    // Execute the WP_Query
    $loop = new WP_Query($args);
    $total_pages = $loop->max_num_pages;

    $response = array();

    if ($loop->have_posts()) {
        ob_start();

        // Output the photo cards using the template part
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('/templates/templates-parts/card');
        }

        $response['html'] = ob_get_clean();
    }

    wp_reset_postdata();

    $response['total_pages'] = $total_pages;
    // Send the JSON response back to the AJAX request
    echo json_encode($response);
    die();
}
// Hook the load_more_photos function to handle AJAX requests
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

/*****************************************************************************************/
/***************        AJAX AVEC JQUERY FILTERS (ACCEUIL)           *********************/
/*****************************************************************************************/
// Function to filter and sort photos based on category, format, year, and order
function filter_and_sort_photos(){
    // Get filter parameters from the AJAX request
    $category = sanitize_text_field($_POST['category']);
    $format = sanitize_text_field($_POST['format']);
    $year = sanitize_text_field($_POST['year']);
    $order_by = $_POST['order_by'];

    // Set up WP_Query arguments
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'orderby' => $order_by,
        'order' => 'ASC',
        'paged' => isset($_POST['page']) ? absint($_POST['page']) : 1,
    );

    // Add taxonomy filters to the WP_Query
    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'id',
            'terms'    => $category,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'id',
            'terms'    => $format,
        );
    }

    if ($year) {
        $args['tax_query'][] = array(
            'taxonomy' => 'annee',
            'field'    => 'id',
            'terms'    => $year,
        );
    }

    // Execute the WP_Query and output photo cards
    $loop = new WP_Query($args);

    if ($loop->have_posts()):
        while ($loop->have_posts()):
            $loop->the_post();
            get_template_part('/templates/templates-parts/card');
        endwhile;
    endif;

    wp_reset_postdata();
    die();
}
// Hook the filter_and_sort_photos function to handle AJAX requests
add_action('wp_ajax_filter_and_sort_photos', 'filter_and_sort_photos');
add_action('wp_ajax_nopriv_filter_and_sort_photos', 'filter_and_sort_photos');

// Function to populate the category filter dropdown
function populate_category_filter(){
    $terms = get_terms('categorie');
    foreach ($terms as $term){
        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
    }
}

// Function to populate the format filter dropdown
function populate_format_filter(){
    $terms = get_terms('format');
    foreach ($terms as $term){
        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
    }
}

// Function to populate the year filter dropdown
function populate_year_filter(){
    $terms = get_terms('annee');
    foreach ($terms as $term){
        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
    }
}

/*****************************************************************************************/
/***************         AJAX AVEC JQUERY LOAD MORE (SINGLE)        *********************/
/*****************************************************************************************/
function get_related_photos() {
    // Get the category ID from the GET request
    $catID = $_GET['cat_id'];

    // Set up WP_Query to fetch related photos based on the category
    $query = new WP_Query(
        array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'terms'    => $catID,
                ),
            ),
        )
    );

    ob_start();
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="relatedPhoto-container">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>">
                <?php include locate_template('/templates/templates-parts/photo-overlay.php'); ?>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    $output = ob_get_clean();

    // Output the related photos HTML and terminate the script
    echo $output;
    wp_die();
}
// Hook the get_related_photos function to handle AJAX requests
add_action('wp_ajax_get_related_photos', 'get_related_photos');
add_action('wp_ajax_nopriv_get_related_photos', 'get_related_photos');
?>