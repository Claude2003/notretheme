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
