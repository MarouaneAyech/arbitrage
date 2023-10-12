<?php
function theme_custom_options_page() {
    add_theme_page('Options de thème personnalisé', 'Options de thème personnalisé', 'manage_options', 'theme-custom-options', 'theme_custom_options_callback');
}

function theme_custom_options_callback() {
    if (!current_user_can('manage_options')) {
        return;
    }

    echo '<div class="wrap">';
    echo '<h2>Ajouter des boutons personnalisés</h2>';
    echo '<form method="post" action="admin-post.php">';
    echo '<input type="text" name="button_text" placeholder="Texte du bouton" />';
    echo '<input type="hidden" name="action" value="add_custom_buttons" />';
    echo '<input type="submit" value="Ajouter" />';
    echo '</form>';

    $custom_buttons = get_option('custom_buttons', array());

    foreach ($custom_buttons as $index => $button_text) {
        echo '<form method="post" action="admin-post.php">';
        echo '<div>';
        echo '<label for="button_text_' . $index . '">Texte du bouton :</label>';
        echo '<input type="text" id="button_text_' . $index . '" name="updated_button_text" value="' . esc_html($button_text) . '" />';
        echo '<input type="hidden" name="button_index" value="' . $index . '" />';
        echo '<input type="hidden" name="action" value="update_custom_button" />';
        echo '<input type="submit" value="Modifier" />';
        echo '</div>';
        echo '</form>';

        echo '<form method="post" action="admin-post.php">';
        echo '<div>';
        echo '<input type="hidden" name="button_index" value="' . $index . '" />';
        echo '<input type="hidden" name="action" value="delete_custom_button" />';
        echo '<input type="submit" value="Supprimer" />';
        echo '</div>';
        echo '</form>';
    }

    echo '</div>';
}

function add_custom_buttons() {
    if (isset($_POST['button_text'])) {
        $button_text = sanitize_text_field($_POST['button_text']);
        $custom_buttons = get_option('custom_buttons', array());
        $custom_buttons[] = $button_text;
        update_option('custom_buttons', $custom_buttons);
    }

    wp_redirect(admin_url('themes.php?page=theme-custom-options'));
    exit;
}

function update_custom_button() {
    // ob_start();
    // var_dump($_POST);
    // $output = ob_get_clean();
    // $theme_path = get_template_directory();
    // $log_file_path = $theme_path . '/log.html';
    // error_log($output, 3, $log_file_path);

    if (isset($_POST['button_index']) && isset($_POST['updated_button_text'])) {
        $button_index = $_POST['button_index'];
        $updated_button_text = sanitize_text_field($_POST['updated_button_text']);
        $custom_buttons = get_option('custom_buttons', array());
        $custom_buttons[$button_index] = $updated_button_text;
        
        update_option('custom_buttons', $custom_buttons);
    }  
   
        // Rediriger vers la même page pour afficher les boutons mis à jour
        wp_redirect(admin_url('themes.php?page=theme-custom-options'));
        exit;
}

function delete_custom_button() {
    if (isset($_POST['button_index'])) {
        $button_index = $_POST['button_index'];
        $custom_buttons = get_option('custom_buttons', array());
        unset($custom_buttons[$button_index]);

        update_option('custom_buttons', $custom_buttons);
    }  
   
    // Rediriger vers la même page pour afficher les boutons mis à jour
    wp_redirect(admin_url('themes.php?page=theme-custom-options'));
    exit;
}

add_action('admin_menu', 'theme_custom_options_page');
add_action('admin_post_add_custom_buttons', 'add_custom_buttons');
add_action('admin_post_update_custom_button', 'update_custom_button');
add_action('admin_post_delete_custom_button', 'delete_custom_button');