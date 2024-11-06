<?php
// Affiche une carte d'équipe avec des informations dynamiques
$equipe_name = get_the_title();
$equipe_description = get_the_excerpt();
$equipe_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
$membres = get_field('membres'); // ACF champs pour les membres

?>

<div class="card-equipe">
    <img src="<?php echo esc_url($equipe_image); ?>" alt="<?php echo esc_attr($equipe_name); ?>" class="card-image">
    <h3 class="card-title"><?php echo esc_html($equipe_name); ?></h3>
    <p class="card-description"><?php echo esc_html($equipe_description); ?></p>
    <div class="card-membres">
        <?php foreach ($membres as $membre): ?>
            <img src="<?php echo esc_url($membre['image']); ?>" alt="<?php echo esc_attr($membre['nom']); ?>" class="membre-icon">
            <span><?php echo esc_html($membre['nom']); ?></span>
        <?php endforeach; ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="card-button">→</a>
</div>
