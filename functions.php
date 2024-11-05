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
