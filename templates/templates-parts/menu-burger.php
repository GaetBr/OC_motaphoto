<!-- Bouton Burger en dehors du conteneur nav -->
<div class="navigation-right">
    <a href="#" id="openBtn">
        <span class="burger-icon">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </span>
    </a>
</div>
<!-- Contenu du menu burger -->
<div id="mySidenav" class="sidenav">
    <?php
    // Affiche le menu géré depuis WordPress dans le menu burger
    wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_id' => 'main-menu'));
    ?>
</div>