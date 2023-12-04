<!-- Burger button outside the nav container -->
<div class="navigation-right">
    <a href="#" id="openBtn">
        <span class="burger-icon">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </span>
    </a>
</div>
<!-- Content of the burger menu -->
<div id="mySidenav" class="sidenav">
    <?php
    // Displays the menu managed from WordPress in the burger menu
    wp_nav_menu(array('theme_location' => 'menu-principal', 'menu_id' => 'main-menu'));
    ?>
</div>