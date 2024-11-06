<?php
// Afficher le titre de l'équipe
the_title();

// Afficher le champ personnalisé "Logo de l'équipe"
$logo = get_field('logo_de_lequipe'); // Remplacez 'logo_de_lequipe' par le nom réel du champ
if ($logo) {
    echo '<img src="' . esc_url($logo) . '" alt="' . get_the_title() . '">';
}

// Afficher la description de l'équipe
$description = get_field('description_de_lequipe');
if ($description) {
    echo '<p>' . esc_html($description) . '</p>';
}
?>
