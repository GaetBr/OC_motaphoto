<div class="filters">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="custom-select">
                    <select id="category-filter">
                        <option value="" hidden>CATEGORIES</option>
                        <?php populate_category_filter(); ?>
                    </select>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="custom-select">
                    <select id="format-filter">
                        <option value="" hidden>FORMATS</option>
                        <?php populate_format_filter(); ?>
                    </select>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="custom-select">
                    <select id="year-filter">
                        <option value="" hidden>TRIER PAR</option>
                        <?php populate_year_filter(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- <button id="reset-filters">Réinitialiser les filtres</button> -->
</div>