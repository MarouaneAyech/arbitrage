<?php
function customizer_settings($wp_customize) {
    $wp_customize->add_section('custom_buttons_section', array(
        'title' => 'Boutons personnalisés',
        'priority' => 30,
    ));

    $wp_customize->add_setting('custom_buttons_setting', array(
        'default' => '',
        'type' => 'option',
    ));

    $wp_customize->add_control('custom_buttons_control', array(
        'label' => 'Ajouter un bouton personnalisé',
        'section' => 'custom_buttons_section',
        'settings' => 'custom_buttons_setting',
        'type' => 'text',
    ));
}
add_action('customize_register', 'customizer_settings');
