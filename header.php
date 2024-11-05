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

    <div class="wrap">
        <!-- Menu fixe -->
        <header>
        <div class="header-container">
        <div class="logo">
            <a href="<?php echo esc_url(home_url(path: '/')); ?>">
                
            </a>
        </div>
       
            <nav class="fixed-menu">
                <ul>
                <li><a href="#section1"> Taux Exprimé</a></li>
                    <li><a href="#section2">Taux d'Abstention</a></li>
                    <li><a href="#section3">Taux d'Inscription</a></li>
                    <li><a href="#section4">Votes par Candidat</a></li>
                    <li><a href="#section5">Taux de Votes Blancs</a></li>
                </ul>
            </nav>
            
            </div>


        </header>

