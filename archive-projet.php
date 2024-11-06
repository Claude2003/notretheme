<?php get_header(); ?>

<div class="projets-archive">
    <div class="intro-text">
        <h1>Liste des Projets</h1>
        <p>Découvrez ici les projets réalisés par notre équipe. Chaque projet est unique et illustre notre savoir-faire en matière de créativité, de développement et de design. Explorez les différentes réalisations pour voir comment nous mettons en œuvre des idées innovantes et des solutions efficaces pour répondre aux besoins de nos clients et partenaires.</p>
    </d>
    <?php if (have_posts()) : ?>
        <div class="projet-list">
            <?php while (have_posts()) : the_post(); ?>
                <article class="projet-item">
                    <div class="projet-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="projet-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <h2 class="projet-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="projet-excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <div class="projet-link">
                            <a href="<?php the_permalink(); ?>" class="btn">Voir le projet</a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
    <?php else : ?>
        <p>Aucun projet trouvé.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

