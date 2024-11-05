<?php
// Variables pour l'image et le texte
$image_path = get_template_directory_uri() . '/assets/img/election.webp'; // Chemin vers l'image dans le répertoire du thème
$overlay_text = 'Dossiers'; // Texte à afficher
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image avec texte superposé</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"> <!-- Lien vers la feuille de style -->
</head>
<body>

<div class="image-container">
    <img src="<?php echo $image_path; ?>" alt="Image principale">
    <div class="overlay-text">
        <h1>DisparitésÉlectorale lors des Élections Présidentielles de 2022 Selon les type de communes</h1>
        
        <h4>Cette étude examine les résultats du premier tour des élections présidentielles de 2022 en France, en se concentrant sur les disparités de participation électorale en fonction des types de communes. À travers une série de graphiques interactifs, nous mettons en lumière le taux d'abstention, le nombre d'inscrits et les suffrages exprimés, tout en distinguant les zones rurales, urbaines et les communes dont le statut est inconnu.</h4>
    </div>
</div>

</body>
</html>

