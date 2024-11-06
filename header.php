<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

<header class="header">
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>" >
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/Logo.svg'); ?>" alt="Logo">
    </a>
    <button class="menu-toggle" id="menuToggle">
        ☰
    </button>
</header>

<!-- Menu de bord -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <button class="close-btn" id="closeBtn">&times;</button>
        <div class="profile">
    <!-- Affichage de l'avatar de l'utilisateur -->
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/avatar.svg'); ?>" alt="Profile Picture">
    
    <!-- Affichage du nom de l'utilisateur connecté -->
    <p><?php 
        // Récupérer l'utilisateur actuel
        $current_user = wp_get_current_user();
        // Afficher son nom complet (ou le pseudonyme, si défini)
        echo esc_html($current_user->display_name); 
    ?></p>
    
    <!-- Lien pour modifier le profil -->
    <a href="<?php echo esc_url(home_url('/profile')); ?>" class="edit-profile1">Modifier le profil</a>
</div>
    </div>
    <ul class="sidebar-menu">
    
    <hr>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('equipe')); ?>"> Equipe</a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('matchs')); ?>">Matchs</a></li>
        

    <hr>
       
        <li><a href="<?php echo esc_url(home_url('/ajouter-equipe ')); ?>"> Créer une équipe</a></li>
        <li><a href="<?php echo esc_url(home_url('/')); ?>"></i>Contact</a></li>
         <li><a href="#">À propos</a></li>



        <?php if (is_user_logged_in()) : ?>
    <a class="auth-button" href="<?php echo wp_logout_url(home_url()); ?>">← Se déconnecter</a>
<?php else : ?>
    <a class="auth-button" href="<?php echo esc_url(home_url('/connexion')); ?>">Connexion</a>
<?php endif; ?>

    </ul>
</nav>

<nav class="desktop-nav">
        <ul>
            <li><a href="<?php echo esc_url(get_post_type_archive_link('equipe')); ?>">Equipe</a></li>
            <li><a href="<?php echo esc_url(get_post_type_archive_link('matchs')); ?>">Matchs</a></li>
            <li><a href="<?php echo esc_url(home_url('/ajouter-equipe')); ?>">Créer une équipe</a></li>
            <li><a href="<?php echo esc_url(home_url('/')); ?>">Contact</a></li>
            <li><a href="#">À propos</a></li>
            <?php if (is_user_logged_in()) : ?>
                <li><a href="<?php echo wp_logout_url(home_url()); ?>">← Se déconnecter</a></li>
            <?php else : ?>
                <li><a href="<?php echo esc_url(home_url('/connexion')); ?>">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>

<script>
    // JavaScript pour ouvrir et fermer le menu
    document.getElementById("menuToggle").addEventListener("click", function() {
        document.getElementById("sidebar").classList.add("active");
    });

    document.getElementById("closeBtn").addEventListener("click", function() {
        document.getElementById("sidebar").classList.remove("active");
    });
</script>

<?php wp_footer(); ?>
</body>
</html>

