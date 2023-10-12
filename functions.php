<?php
/********************************
            Les fonctions
********************************/
/*
arbitration_theme_supports() :
-----------------------------------
Cette fonction ajoute différentes fonctionnalités de support à votre thème: 
- Prise en charge des titres ('title-tag')
- Prise en charge des menus ('menus')
- La définition des emplacements des menus ('register_nav_menu') :
   + menu en header
   + menu en footer
- Prise en charge des en-têtes personnalisés ('custom-header').

Elle est attachée à l'action 'after_setup_theme'
Ce qui signifie que cette fonction sera exécutée après que le thème ait été configuré.
*/
function arbitration_theme_supports(){
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menu('header','En tête du menu');
    register_nav_menu('footer','Pied du page');
    add_theme_support('custom-header');
}

/*
arbitration_theme_register_assets() :
--------------------------------------
Cette fonction enregistre et ajoute les styles et scripts nécessaires à votre thème, tels que Bootstrap. 
Elle utilise les fonctions wp_register_style et wp_register_script pour les enregistrer
Puis, elle les enfile avec wp_enqueue_style et wp_enqueue_script.

A noter que Bootsrap dépend de 'popper' et 'jquery'
C'est pour cela il suffit de lui appliquer wp_enqueue_style et wp_enqueue_script pour que les autres seront automatiquement prises en charge.

Elle est également attachée à l'action 'wp_enqueue_scripts'
Ce qui signifie qu'elle sera exécutée lorsque les scripts et styles doivent être chargés sur la page du site.
*/
function arbitration_theme_register_assets(){
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', ['popper','jquery'], false, true);
    wp_register_script('popper','https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery','https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);

    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

/*
arbitration_theme_menu_class($classes) :
---------------------------------------------
Cette fonction ajoute une classe 'nav-item' aux éléments de menu. 
Elle est utilisée pour personnaliser les classes des éléments de menu du thème.
*/
function arbitration_theme_menu_class($classes)
{
    // var_dump(func_get_args());
    // die();
    $classes[] = 'nav-item';
    return $classes;
}

/*
arbitration_theme_menu_link_class($attrs) :
---------------------------------------------
Cette fonction ajoute une classe 'nav-link' aux liens des éléments de menu. 
Elle est utilisée pour personnaliser les classes des liens dans les menus du thème.
*/
function arbitration_theme_menu_link_class($attrs)
{
    // var_dump(func_get_args());
    // die();
    $attrs['class'] = 'nav-link';
    return $attrs;
}

/*
arbitration_theme_register_navwalker() :
--------------------------------------------------
Cette fonction enregistre un "Custom Navigation Walker" personnalisé.
On aura besoin de cette classe personnalisée pour personnaliser le rendu de menu de navigation.
 */
function arbitration_theme_register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

/*
arbitration_theme_customize_register($wp_customize) :
------------------------------------------------------
Cette fonction est utilisée pour personnaliser les options du thème via le Customizer de WordPress. 
Elle crée une section pour les paramètres de l'en-tête
Puis, elle ajoute des contrôles pour la largeur et la hauteur de l'en-tête.
*/
function arbitration_theme_customize_register($wp_customize) {
    // Section pour les paramètres de l'en-tête
    $wp_customize->add_section('entete_section', array(
        'title' => 'Paramètres de l\'en-tête',
        'priority' => 30,
    ));

    // Contrôle pour la largeur de l'en-tête
    $wp_customize->add_setting('entete_largeur', array(
        'default' => 200, // Largeur par défaut
    ));

    $wp_customize->add_control('entete_largeur', array(
        'label' => 'Largeur de l\'en-tête',
        'section' => 'entete_section',
        'type' => 'number',
    ));

    // Contrôle pour la hauteur de l'en-tête
    $wp_customize->add_setting('entete_hauteur', array(
        'default' => 50, // Hauteur par défaut
    ));

    $wp_customize->add_control('entete_hauteur', array(
        'label' => 'Hauteur de l\'en-tête',
        'section' => 'entete_section',
        'type' => 'number',
    ));
}

/*
arbitration_theme_background_image_register($wp_customize):
--------------------------------------------------------------
Cette fonction est utilisée pour personnaliser l'image d'arrière-plan de l'en-tête via le Customizer. 
Elle crée une section pour l'image d'arrière-plan de l'en-tête et un contrôle pour la sélection de cette image.
*/
function arbitration_theme_background_image_register($wp_customize) {
    // Ajouter au customizer une section pour l'image d'arrière-plan
    $wp_customize->add_section('background_image', array(
        'title' => __('Image d\'arrière-plan', 'votre-theme-textdomain'),
        'priority' => 30,
    ));

    // On définit un paramètre dans le Customizer de WordPress
    // Il sera utilisé pour stocker la valeur de l'image d'arrière-plan sélectionnée par l'utilisateur. 
    // Notes: 
    // - 'default' => '' : Cette partie définit la valeur par défaut du paramètre. 
    //    -> Dans ce cas, la valeur par défaut est une chaîne vide
    // - La fonction de rappel ('sanitize_callback') permet de valider et nettoyer les données entrées par l'utilisateur.
    //    -> esc_url_raw est utilisée, ce qui signifie que WordPress s'assurera que l'URL de l'image est une URL valide et sécurisée. 
    $wp_customize->add_setting('background_image_setting', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // Ajouter dans Customizer un contrôle (champ de formulaire) pour sélectionner l'image d'arrière-plan
    // $wp_customize->add_control :  C'est une méthode de l'objet $wp_customize qui permet d'ajouter un contrôle au Customizer.
    // WP_Customize_Image_Control : est une classe de WordPress pour gérer les contrôles d'image dans le Customizer.
    // - label : C'est l'étiquette ou le libellé du contrôle, qui s'affichera dans l'interface d'administration du Customizer. 
    // - section : Cela indique à quelle section du Customizer ce contrôle appartient. 
    //      -> Dans votre exemple, le contrôle d'image est ajouté à la section 'background_image'
    // - settings : Cela spécifie le paramètre (setting) auquel ce contrôle est lié. 
    //      -> Dans votre exemple, il est lié au paramètre 'background_image_setting
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'background_image_control', array(
        'label' => __('Sélectionnez une image d\'arrière-plan', 'votre-theme-textdomain'),
        'section' => 'background_image',
        'settings' => 'background_image_setting',
    )));
} 

/*
arbitration_theme_text_band_register($wp_customize) :
--------------------------------------------------------
Cette fonction est utilisée pour personnaliser le texte personnalisé via le Customizer. 
Elle crée une section pour le texte personnalisé et un contrôle pour définir ce texte.
*/
function arbitration_theme_text_band_register($wp_customize) {
    // Section pour le texte personnalisé
    $wp_customize->add_section('custom_text_section', array(
        'title' => __('Texte personnalisé', 'votre-theme-textdomain'),
        'priority' => 30,
    ));

    // Contrôle pour le texte personnalisé
    $wp_customize->add_setting('custom_text_setting', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('custom_text_control', array(
        'label' => __('Texte personnalisé', 'votre-theme-textdomain'),
        'section' => 'custom_text_section',
        'settings' => 'custom_text_setting',
        'type' => 'text',
    ));
}

/********************************
            Les actions
-------------------------------------
Ces actions déterminent quand ces fonctions seront exécutées dans le cycle de vie de WordPress
Ce qui leur permet d'ajouter des fonctionnalités et de personnaliser votre thème au bon moment.
********************************/
add_action('after_setup_theme', 'arbitration_theme_supports');
add_action('wp_enqueue_scripts','arbitration_theme_register_assets');
add_action( 'after_setup_theme', 'arbitration_theme_register_navwalker' );
add_action('customize_register', 'arbitration_theme_customize_register');
add_action('customize_register', 'arbitration_theme_background_image_register');
add_action('customize_register', 'arbitration_theme_text_band_register');
// add_filter('nav_menu_css_class', 'arbitration_theme_menu_class');
// add_filter('nav_menu_link_attributes', 'arbitration_theme_menu_link_class');
// add_action('after_setup_theme', 'montheme_custom_image_sizes');


//-----------------------------------------------

require_once get_template_directory() . '/theme-options.php';


// require_once get_template_directory() . '/customizer.php';


