<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
    <style>
        /* Ajoutez des styles personnalisés si nécessaire */
        .navbar-nav {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .navbar-nav .nav-item {
            flex: 1;
            text-align: left;
        }

        .navbar-nav li:hover > ul.sub-menu {
            display: block;
        }

        .navbar-nav ul.sub-menu {
            display: none;
        }


        /* Styles CSS pour l'alignement */
        .top-header-conteneur {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-right-header-conteneur {
            display: flex;
            justify-content: space-between;
            align-items: right;
        }

        .bouton-ovale {
            background-color: rgb(210, 180, 140); /* Couleur marron */
            border: 2px solid rgb(210, 180, 140);
            color: #fff; /* Couleur du texte */
            border-radius: 50px; /* Pour rendre le bouton ovale */
            padding: 10px 20px; /* Ajustez le rembourrage selon vos besoins */
            margin-right: 10px;
            text-align: center; /* Centre le texte à l'intérieur du bouton */
            display: inline-block; /* Permet au bouton de s'ajuster automatiquement à son contenu */
            text-decoration: none; /* Supprime le soulignement par défaut des liens */
        }
        .fixtab {
            z-index: 999999;
            position: fixed;
            top: 40%;
            right: 0;
            width: 170px;
            /* background: white; */
            background: rgba(255,255,255,.7);
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px 0px 0px 10px;
        }

        /*fixed navigation*/
        .submenu-fixer {
            height: 20px;
        }

        html body .container-fluid.submenu-wrapper.fixed {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

        }

        html body .fixed-branding {
            background: #135184;
            height: 60px;
            margin: 0 -50px;
        }

        .fixed-logo-a img {
            width: 350px;
            margin-top: 9px;
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .bg-gray {
            background-color: rgba(128, 128, 128, 0.1); /* ou la valeur de gris de votre choix */
        }
        .all-wrapper {
            width: 1650px;
            height: auto;
            margin: 0px auto;
            position: relative;
            box-shadow: 0px 0px 100px rgba(0,0,0,0.2);
            background-color: #fff;
        }

    </style>
    
</head>

<body>

    <div class="all-wrapper">

	    <!-- <div class="container" > -->

            <div class="top-header-conteneur">
                <!-- Les boutons à gauche-->
                <div style="flex: 30%; text-align: center;">
                    <?php
                        $largeur_entete = get_theme_mod('entete_largeur', 100); // 1200 est la valeur par défaut
                        $hauteur_entete = get_theme_mod('entete_hauteur', 300); // 400 est la valeur par défaut
                        
                        // Utilisez ces valeurs pour afficher l'image d'en-tête
                        
                            // Affiche l'image d'en-tête personnalisée avec la taille redimensionnée
                        //the_custom_header_markup();
                        $entete_image = get_header_image(); // Récupère l'URL de l'image d'en-tête

                        if ($entete_image) {
                            echo '<div id="entete">';
                            echo '<img src="' . esc_url($entete_image) . '" alt="Image d\'en-tête" width="' . esc_attr($largeur_entete) . '" height="' . esc_attr($hauteur_entete) . '">';
                            echo '</div>';
                        }
                    ?>
                </div>
                <!-- Les boutons à droite-->
                <div style="flex: 70%; text-align: right;">
                <?php $custom_buttons = get_option('custom_buttons', array());
                foreach ($custom_buttons as $button_text) {
                    echo '<button class="bouton-ovale" style="padding: bottom 7px;"><a style="color: #fff;" href="#">' . esc_html($button_text) . '</a></buton>';
                } ?>
                </div>

            </div>

        <!-- </div> -->

        <div>
            <nav class="navbar  navbar-expand-md navbar-light bg-gray" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                        <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'header',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse container-fluid',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => 'nav navbar-nav mx-auto',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ) );
                        ?>
                </div>
            </nav>
        </div>
    