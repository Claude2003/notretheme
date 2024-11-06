<?php
// Carrousel pour les matchs
$matchs = new WP_Query(array(
    'post_type' => 'matchs',
    'posts_per_page' => 5
));
?>

<div class="carousel-matchs">
    <?php while ($matchs->have_posts()) : $matchs->the_post(); ?>
        <div class="carousel-item">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" class="carousel-image">
            <div class="carousel-content">
                <h3 class="carousel-title"><?php the_title(); ?></h3>
                <p class="carousel-description"><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="carousel-button">→</a>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>
