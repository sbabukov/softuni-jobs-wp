
<footer class="site-footer">
        <p>Copyright <?php echo date( 'Y' )?> | Developer links:
            <a href="#">Edits</a>,
            <a href="#">Home</a>,
            <a href="#">Single</a>
        </p>
       
        <!-- Викане на меню -->
        <div class="footer-nav-menu">
            <?php
            // тази проверка е ако съществува това меню, тогава го викаме 
            if ( has_nav_menu( 'footer_menu' ) ){
                
                // в аргументите може да задаве клас и други неща
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer_menu',
                    )
                ); 
            }
            ?>
        </div>
</footer>
    </div>

    
<?php wp_footer(); ?>

</body>
</html>