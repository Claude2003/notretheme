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
    <a href="#" class="logo">
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
            <img src="<?php echo esc_url(get_template_directory_uri() . '/path/to/profile-picture.jpg'); ?>" alt="Profile Picture">
            <p>Arthur Lacroix</p>
            <button class="edit-profile">Modifier le profil</button>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li><a href="<?php echo esc_url(get_post_type_archive_link('equipe')); ?>"> Equipe</a></li>
        <li><a href="<?php echo esc_url(get_post_type_archive_link('matchs')); ?>">Matchs</a></li>
        

    <hr>
        <li><a href="#">À propos</a></li>
        <li><a href="#">Créer une équipe</a></li>
        <li><a href="#">Contact</a></li>
  

        <?php if (is_user_logged_in()) : ?>
    <a class="auth-button" href="<?php echo wp_logout_url(home_url()); ?>">← Se déconnecter</a>
<?php else : ?>
    <a class="auth-button" href="<?php echo esc_url(home_url('/connexion')); ?>">Connexion</a>
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

