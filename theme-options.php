<?php
function theme_custom_options_page() {
    add_theme_page('Options de thème personnalisé', 'Options de thème personnalisé', 'manage_options', 'theme-custom-options', 'theme_custom_options_callback');
}

function theme_custom_options_callback() {
    if (!current_user_can('manage_options')) {
        return;
    }

    echo '<div class="wrap">';
    // Title
    echo '<h2 style="margin-bottom: 30px;">Ajouter des boutons personnalisés</h2>';
    
    // Start Form
    echo '<form method="post" action="admin-post.php">';

    // Utilisez un conteneur flex pour aligner verticalement
    echo '<div style="display: flex; flex-direction: column; max-width: 600px;">'; 

    // Style pour les labels (gras et couleur marron)
    $label_style = 'style="font-weight: bold; color: brown;  margin-bottom: 10px;"';
    // Text for  new button
    echo '<label ' . $label_style . ' for="button_page">Texte :</label>';
    echo '<input type="text" name="button_text" placeholder="Texte du bouton" style= "margin-bottom: 10px; max-width: 250px;"/>';
    // List of Pages for new button
    echo '<label ' . $label_style . ' for="button_page">Page cible :</label>';
    $pages = get_pages();
    echo '<select id="button_page" name="button_page" style="margin-bottom: 10px; max-width: 250px;">';
    foreach ($pages as $page) {
        echo '<option value="' . $page->ID . '">' . $page->post_title . '</option>';
    }
    echo '</select>';
    // Button "Ajouter"
    echo '<input type="hidden" name="action" value="add_custom_buttons" />';
    echo '<input type="submit" value="Ajouter" style="max-width: 100px; margin-top: 10px; margin-bottom: 50px;" />';
    
    // Fermez le conteneur flex
    echo '</div>'; 
    // End Form
    echo '</form>';

    // Title of existing buttons
    echo '<label ' . $label_style . ' for="button_page">Liste des boutons existants :</label><br/>';
    
    // Get texts of existing buttons as an array 'custom_buttons'
    $custom_buttons = get_option('custom_buttons', array());
    // $custom_pages = get_option('custom_pages', array());
    // $custom_pages=[];
    // update_option('custom_pages', $custom_pages);
    $custom_pages = get_option('custom_pages', array());
    $pages = get_pages();
    
    var_dump($custom_buttons);
    var_dump($custom_pages);
    foreach ($custom_buttons as $index => $button_text) {
        echo '<form method="post" action="admin-post.php">';
        //echo '<div>';
        // Utilisez un conteneur flex pour aligner verticalement
        echo '<div style="display: flex; flex-direction: column; max-width: 250px;">'; 
        echo '<label style="margin-top: 20px;" for="button_text_' . $index . '">Texte du bouton :</label>';
        echo '<input type="text" id="button_text_' . $index . '" name="updated_button_text" value="' . esc_html($button_text) . '" />';
        
        echo '<label ' . $label_style . ' for="button_page">Page cible :</label>';
        $pages = get_pages();
        echo '<select id="button_page" name="updated_button_page" style="margin-bottom: 10px; max-width: 250px;">';
        foreach ($pages as $page) {
            $selected = ($page->ID == $custom_pages[$index]) ? 'selected' : ''; 
            echo '<option value="' . $page->ID . '"'  . $selected .  '>' . $page->post_title . '</option>';
        }
        echo '</select>';
        //echo '<input type="text" id="button_text_' . $index . '" name="updated_button_text" value="' . esc_html($button_page) . '" />';
        
        echo '<input type="hidden" name="button_index" value="' . $index . '" />';
        echo '<input type="hidden" name="action" value="update_custom_button" />';
        echo '<input type="submit" value="Modifier" style="max-width: 100px; margin-top: 10px;"/>';
       // echo '</div>';
        
        // Fermez le conteneur flex
        echo '</div>'; 
        echo '</form>';

        echo '<form method="post" action="admin-post.php">';
        echo '<div>';
        echo '<input type="hidden" name="button_index" value="' . $index . '" />';
        echo '<input type="hidden" name="action" value="delete_custom_button" />';
        echo '<input type="submit" value="Supprimer" style="width: 100px; margin-top: 10px; />';
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

    if(isset($_POST['button_page'])){
        $button_page = $_POST['button_page'];
        $custom_pages = get_option('custom_pages', array());
        $custom_pages[] = $button_page;
        update_option('custom_pages', $custom_pages);
    }

    wp_redirect(admin_url('themes.php?page=theme-custom-options'));
    exit;
}

function update_custom_button() {
    ob_start();
    var_dump($_POST);
    $output = ob_get_clean();
    $theme_path = get_template_directory();
    $log_file_path = $theme_path . '/log.html';
    error_log($output, 3, $log_file_path);

    if (isset($_POST['button_index']) && isset($_POST['updated_button_text'])  && isset($_POST['updated_button_page'])) {
        
        $button_index = $_POST['button_index'];
        $updated_button_text = sanitize_text_field($_POST['updated_button_text']);
        $updated_button_page = $_POST['updated_button_page'];

        $custom_buttons = get_option('custom_buttons', array());
        $custom_buttons[$button_index] = $updated_button_text;
        update_option('custom_buttons', $custom_buttons);
        
        $custom_pages = get_option('custom_pages', array());
        $custom_pages[$button_index] = $updated_button_page;
        update_option('custom_pages', $custom_pages);

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
    // }  
   
    // if (isset($_POST['button_index'])) {
        $button_index = $_POST['button_index'];
        $custom_pages = get_option('custom_pages', array());
        unset($custom_pages[$button_index]);

        update_option('custom_pages', $custom_pages);
    }  

    // Rediriger vers la même page pour afficher les boutons mis à jour
    wp_redirect(admin_url('themes.php?page=theme-custom-options'));
    exit;
}

add_action('admin_menu', 'theme_custom_options_page');
add_action('admin_post_add_custom_buttons', 'add_custom_buttons');
add_action('admin_post_update_custom_button', 'update_custom_button');
add_action('admin_post_delete_custom_button', 'delete_custom_button');