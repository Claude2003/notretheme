<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Empêche l'accès direct au fichier
}
?>

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-logo">
            <!-- Logo du site (remplace le chemin si nécessaire) -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Logo.svg" alt="Logo Board">
        </div>

        <nav class="footer-menu">
            <ul>
                <li><a href="<?php echo home_url('/equipes'); ?>">Equipes</a></li>
                <li><a href="<?php echo home_url('/accueil'); ?>">Accueil</a></li>
                <li><a href="<?php echo home_url('/matchs'); ?>">Matchs</a></li>
                <li><a href="<?php echo home_url('/a-propos'); ?>">À Propos</a></li>
                <li><a href="<?php echo home_url('/creer-une-equipe'); ?>">Créer Une Équipe</a></li>
                <li><a href="<?php echo home_url('/contact'); ?>">Nous Contacter</a></li>
            </ul>
        </nav>

        <div class="footer-legal">
            <ul>
                <li><a href="<?php echo home_url('/politique-de-confidentialite'); ?>">Politique De Confidentialité</a></li>
                <li><a href="<?php echo home_url('/mentions-legales'); ?>">Mentions Légales</a></li>
                <li><a href="<?php echo home_url('/conditions-generales'); ?>">Conditions Générales D’utilisations</a></li>
            </ul>
        </div>

        <div class="footer-social">
    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
    <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
</div>
    
</footer>

<?php wp_footer(); ?>
</body>
</html>

