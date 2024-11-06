<?php
// Afficher le titre du match
the_title();

// Afficher la date du match
$date_match = get_field('date_du_match'); // Remplacez 'date_du_match' par le nom réel du champ
if ($date_match) {
    echo '<p>Date du match : ' . esc_html($date_match) . '</p>';
}

// Afficher les équipes du match
$equipes = get_field('equipes_participantes'); // Remplacez 'equipes_participantes' par le nom réel du champ
if ($equipes) {
    echo '<p>Équipes : ' . implode(' vs ', $equipes) . '</p>';
}

// Afficher les résultats si le match est joué
$resultats = get_field('resultats_du_match');
if ($resultats) {
    echo '<p>Résultats : ' . esc_html($resultats) . '</p>';
}
?>
