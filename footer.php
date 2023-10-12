    </div>
    <footer>
        <style>
            .main-footer.with-social {
                height: 100px;
                display: flex;
                align-items: center;
                padding-left: 0px;
                padding-inline-start: 0px;
                
            }

            .menu_class_perso ul {
                padding-left: 0px !important;
            }
            .menu_class_perso li {
                display: inline;
                margin-right: 40px; 
                margin-left: 0px;
                padding-left: 0px;
                padding-inline-start: 0px; 
            }

        </style>
    <div class="container">
    <!-- <nav class="navbar  navbar-expand-md navbar-light bg-gray" role="navigation"> -->
        <div class="main-footer with-social">
            <?php 
            wp_nav_menu([
                'theme_location'=>'footer',
                'container'=>'div',
                'menu_class'=>'menu_class_perso',
                ]);
                ?>
        </div>

        <div class="footer-copyright" style="font-size: 15px;">
            <p>Copyright © 2023&nbsp;Bali International Arbitration &amp; Mediation Center "BIAMC" all rights reserved</p>
        </div>

    </div>

    </footer>
    <?php wp_footer() ?>
</body>
</html>