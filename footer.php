<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Empêche l'accès direct au fichier
}
?>

<footer class="site-footer">
    <div class="footer-content">
        
        <!-- Logo -->
        <div class="footer-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Logo.svg" alt="Logo Board">
        </div>

        <!-- Navigation principale -->
        <div class="footer-section">
            <h3>Navigation</h3>
            <ul class="footer-menu">
                <li><a href="<?php echo esc_url(get_post_type_archive_link('equipe')); ?>">Equipes</a></li>
                <li><a href="<?php echo home_url('/'); ?>">Accueil</a></li>
                <li><a href="<?php echo esc_url(get_post_type_archive_link('matchs')); ?>">Matchs</a></li>
                <li><a href="<?php echo esc_url(home_url('/ajouter-equipe')); ?>">Créer une équipe</a></li>
            </ul>
        </div>

        <!-- Informations légales -->
        <div class="footer-section">
            <h3>Informations légales</h3>
            <ul class="footer-legal">
                <li><a href="<?php echo home_url('/politique-de-confidentialite'); ?>">Politique de confidentialité</a></li>
                <li><a href="<?php echo home_url('/politique-de-cookies'); ?>">Politique de cookies</a></li>
                <li><a href="<?php echo home_url('/conditions-generales'); ?>">Conditions d’utilisations</a></li>
            </ul>
        </div>

        <!-- Réseaux sociaux -->
        <div class="footer-section footer-social">
            <h3>Suivez-nous</h3>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
        </div>

    </div>
    
    <?php wp_footer(); ?>
</footer>
