<?php
/* Template Name: Connexion */
get_header(); ?>
<div class="hero-section2">
<img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero3.svg" alt="League of Legends" class="hero-image">
    <div class="hero-overlay2"></div>
    <div class="hero-content2">
        <h2>Se connecter</h2>
        <p>Plongez dans l’arène de l’e-sport, là où les légendes se forment et l’intensité du jeu atteint son apogée !</p>
    </div>
</div>

<div class="connexion-form-container">
    
    <?php
    // Vérifier si l'utilisateur est connecté
    if (is_user_logged_in()) {
        echo '<p>Vous êtes déjà connecté.</p>';
    } else {
        // Si l'utilisateur n'est pas connecté, afficher le formulaire de connexion
        $args = array(
            'redirect' => home_url(), // Redirection après connexion
            'form_id' => 'loginform',
            'label_username' => __('Nom d’utilisateur'),
            'label_password' => __('Mot de passe'),
            'label_remember' => __('Se souvenir de moi'),
            'label_log_in' => __('Connexion'),
            'remember' => true
        );
        wp_login_form($args);

        // Lien pour la création de compte
        echo '<p>Pas encore de compte ? <a href="' . esc_url(home_url('/inscription')) . '">Créer un compte</a></p>';

        // Affichage des boutons de connexion via Google et GitHub (ajouté par Nextend)
        if (function_exists('nextend_social_login_get_provider_html')) {
            echo '<p><strong>Ou connectez-vous avec :</strong></p>';
            echo nextend_social_login_get_provider_html('google');
            echo nextend_social_login_get_provider_html('github');
        }
    }
    ?>

</div>

<?php get_footer(); ?>
