</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <nav id="footer-navigation" class="footer-navigation" role="navigation">
        <?php
        // Affiche le menu du footer
        wp_nav_menu(array('theme_location' => 'menu-footer', 'menu_id' => 'footer-menu'));
        ?>
    </nav><!-- #footer-navigation -->
</footer><!-- #colophon -->
<?php get_template_part('templates/templates-parts/modal-contact'); ?>
<?php wp_footer(); ?>
</body>
</html>