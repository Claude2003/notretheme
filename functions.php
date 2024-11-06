<?php

function register_my_menu(){
    register_nav_menus( array(
        'header-menu' => __( 'Menu De Tete'),
        
    ) );
}
add_action( 'init', 'register_my_menu', 0 );

function get_hero() {
    get_template_part('hero'); // Charge le fichier hero.php
}

function register_custom_post_types() {
    register_post_type('equipe', [
        'label' => 'Équipes',
        'public' => true,
        'has_archive' => true,
        // Autres arguments ici
    ]);

    register_post_type('matchs', [
        'label' => 'Matchs',
        'public' => true,
        'has_archive' => true,
        // Autres arguments ici
    ]);
}
add_action('init', 'register_custom_post_types');


function ajouter_styles_connexion() {
    if (is_page_template('page-connexion.php')) { // Assurez-vous que votre page utilise ce modèle
        wp_enqueue_style('style-connexion', get_template_directory_uri() . '/style-connexion.css');
    }
}
add_action('wp_enqueue_scripts', 'ajouter_styles_connexion');

function add_custom_stylesheet() {
    if (is_page_template('page-inscription.php')) {
        wp_enqueue_style('style-inscription', get_template_directory_uri() . '/style-inscription.css');
    }
}
add_action('wp_enqueue_scripts', 'add_custom_stylesheet');

function filter_match_query($query) {
    // Vérifier si nous sommes sur le front-end et pas dans l'admin
    if (!is_admin() && $query->is_main_query()) {

        // Initialiser une variable pour stocker la tax_query
        $tax_query = array();

        // Filtrer par date (si sélectionnée)
        if (isset($_GET['date']) && !empty($_GET['date'])) {
            $tax_query[] = array(
                'taxonomy' => 'date',
                'field'    => 'id',
                'terms'    => $_GET['date'],
                'operator' => 'IN',
            );
        }

        // Filtrer par lieu (si sélectionné)
        if (isset($_GET['lieu']) && !empty($_GET['lieu'])) {
            $tax_query[] = array(
                'taxonomy' => 'lieu',
                'field'    => 'id',
                'terms'    => $_GET['lieu'],
                'operator' => 'IN',
            );
        }

        // Filtrer par heure (si sélectionnée)
        if (isset($_GET['heure']) && !empty($_GET['heure'])) {
            $tax_query[] = array(
                'taxonomy' => 'heure',
                'field'    => 'id',
                'terms'    => $_GET['heure'],
                'operator' => 'IN',
            );
        }

        // Si des filtres sont sélectionnés, les ajouter à la requête
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }

        // Ajouter la pagination (si nécessaire)
        if (isset($_GET['paged'])) {
            $query->set('paged', $_GET['paged']);
        } else {
            $query->set('paged', 1); // Par défaut, la première page
        }
    }
}
add_action('pre_get_posts', 'filter_match_query');


// Enregistrer une activité utilisateur
function save_user_activity($user_id, $activity_type, $details) {
    global $wpdb;

    // Nom de la table pour stocker les activités
    $table_name = $wpdb->prefix . 'user_activities';

    // Enregistrer l'activité dans la base de données
    $wpdb->insert(
        $table_name,
        array(
            'user_id' => $user_id,
            'activity_type' => $activity_type,
            'details' => $details,
            'date' => current_time('mysql')
        )
    );
}

// Exemple d'enregistrement d'une activité lorsque l'utilisateur crée une équipe
function on_team_creation($team_name) {
    $user_id = get_current_user_id();
    $activity_type = 'Création d\'équipe';
    $details = 'L\'utilisateur a créé l\'équipe : ' . $team_name;
    save_user_activity($user_id, $activity_type, $details);
}
add_action('team_creation', 'on_team_creation');

// Exemple d'enregistrement d'une activité lorsqu'un utilisateur rejoint un match
function on_match_join($match_name) {
    $user_id = get_current_user_id();
    $activity_type = 'Participation à un match';
    $details = 'L\'utilisateur a rejoint le match : ' . $match_name;
    save_user_activity($user_id, $activity_type, $details);
}
add_action('match_join', 'on_match_join');

function create_user_activities_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'user_activities';

    $charset_collate = $wpdb->get_charset_collate();

    // SQL pour créer la table
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        activity_type varchar(255) NOT NULL,
        details text NOT NULL,
        date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id),
        KEY user_id (user_id)
    ) $charset_collate;";

    // Vérifier si la table existe déjà
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Créer la table à l'activation du plugin ou du thème
register_activation_hook(__FILE__, 'create_user_activities_table');
// Récupérer et afficher les activités récentes de l'utilisateur
function display_user_activities($user_id) {
    global $wpdb;

    // Récupérer les 5 dernières activités de l'utilisateur
    $table_name = $wpdb->prefix . 'user_activities';
    $activities = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE user_id = %d ORDER BY date DESC LIMIT 5", 
            $user_id
        )
    );

    if ($activities) {
        echo '<div class="recent-activities">';
        echo '<h2>Activités récentes</h2>';
        foreach ($activities as $activity) {
            echo '<div class="activity-card">';
            echo '<h3>' . esc_html($activity->activity_type) . '</h3>';
            echo '<p>' . esc_html($activity->details) . '</p>';
            echo '<p><strong>Date :</strong> ' . esc_html($activity->date) . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Aucune activité récente.</p>';
    }
}
// Exemple pour appeler l'action lors de la création d'une équipe
function team_creation_form_submit() {
    // Code pour la création de l'équipe
    $team_name = $_POST['team_name']; // Exemple de récupération du nom de l'équipe

    // Déclenchement de l'action de création d'équipe
    do_action('team_creation', $team_name);
}

// Exemple pour appeler l'action lors de la participation à un match
function join_match($match_name) {
    // Code pour lier l'utilisateur au match
    do_action('match_join', $match_name);
}
