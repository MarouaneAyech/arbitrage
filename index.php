<?php get_header() ?>

<style>
    .m-0 {
        text-decoration: none; /* Supprime le soulignement */
        color: black; /* Change la couleur du texte en noir (ou la couleur souhaitée) */
        margin-bottom: 30px;
    }
    .img-bg {
        background-repeat: no-repeat; 
        background-position: center; 
        background-size: cover; 
        min-height: 600px;
    }
    .band-text {
        font-family: 'gabriola', sans-serif !important;
        position: absolute;
        top: 250px;
        left: 0px;
        background: linear-gradient(90deg, rgba(14, 81, 134, 1) 60%, rgba(14, 81, 134, 0));
        color: white;
        z-index: 9;
        text-align: center;
        width: 800px;
        padding: 4px 20px 0px 20px;
        font-size: 46px;
        height: 60px;
    }
</style>

<!-- Définir l'image de background pour le contenu de la page d'index (le div qui est entre header et footer) 
- get_theme_mod(
                    'background_image_setting', 
                    get_template_directory_uri() . '/_DA4.jpg'
                )
  -> cetrte fonction est utilisée pour récupérer la valeur d'un paramètre.
  -> Dans notre cas, il s'agit de 'background_image_setting'
  -> Si aucun réglage n'a été défini par l'utilisateur,une image par défaut est utilisée
  -> Son chemin est get_template_directory_uri() . '/_DA4.jpg'.
  -> La fonction get_template_directory_uri() renvoie l'adresse web complète du dossier de votre thème WordPress.
--> 
<div class="img-bg" style="background-image: url('<?php echo get_theme_mod('background_image_setting', get_template_directory_uri() . '/images/_DA4.jpg'); ?>');">
    
    <!-- <div class='os-container'>  -->
        
        <!-- <div class="container" style="left: 0px;"> -->
            <div class="band-text">
                <?php echo get_theme_mod('custom_text_setting', 'Find Resolution In Paradise'); ?>
            </div>
        <!-- </div> -->

        <div class="fixtab">
            <a href="https://biamcacademy.com/" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo_aima_small.png" width="100%" height="100%">
            <p class="m-0" style="text-align: center; margin-bottom: 30px;">AIMA</p>
            </a>
        </div>

    <!-- </div> -->

</div>

<?php get_footer() ?>

