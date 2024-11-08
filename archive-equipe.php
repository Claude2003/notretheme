<?php get_header(); ?>

<div class="hero-section2">
<img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero3.svg" alt="League of Legends" class="hero-image">
    <div class="hero-overlay2"></div>
    <div class="hero-content2">
        <h2>équipe</h2>
        <p>Plongez dans l’arène de l’e-sport, là où les légendes se forment et l’intensité du jeu atteint son apogée !</p>
    </div>
</div>

<div class="equipes-archive">
    
    <p> Ici, nous vous offrons un accès direct aux matchs les plus attendus, aux équipes de haut niveau et aux compétitions palpitantes de league of legends. Rejoignez une communauté de passionnés qui vivent chaque moment intensément. Suivez les équipes en temps réel et ne manquez jamais une occasion d’encourager vos favoris.</p>

    <?php if (have_posts()) : ?>
        <div class="equipe-list">
            <?php while (have_posts()) : the_post(); ?>
                <article class="equipe-item">
                    <div class="equipe-card">
                        
                        <!-- Titre de l'équipe -->
                        <h2 class="equipe-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <!-- Affichage des joueurs -->
                        <div class="joueurs">
                            <h3>Joueurs :</h3>
                            <ul>
                            
        <?php
        // Récupération des joueurs via ACF (modifié selon votre configuration)
        for ($i = 1; $i <= 4; $i++) {
            $joueur = get_field('joueur' . $i); // Récupérer l'ID du joueur
            if ($joueur) {
                $user_info = get_userdata($joueur); // Obtenir les infos utilisateur pour ce joueur
                if ($user_info) {
                    // Affichage de la photo et du nom du joueur
                    $photo = get_avatar_url($joueur);
                    echo '<li class="joueur-item">';
                    echo '<div class="joueur-photo-container">';
                    echo '<img src="' . esc_url($photo) . '" alt="' . esc_attr($user_info->display_name) . '" class="joueur-photo">';
                    echo '</div>';
                    echo '<p class="joueur-name">' . esc_html($user_info->display_name) . '</p>';
                    echo '</li>';
                }
            }
        }
        ?>
    </ul>
</div>


                        <!-- Affichage des matchs associés à l'équipe -->
                        <div class="matchs">
                            <h3>Matchs associés :</h3>
                            <?php
                            // Récupération des matchs via ACF (champ de relation avec les matchs)
                            $matchs = get_field('match'); // Récupérer les matchs associés
                            
                            if ($matchs) {
                                // Si plusieurs matchs
                                echo '<ul>';
                                foreach ($matchs as $match) {
                                    // Utiliser get_post() pour obtenir les détails du match
                                    $match_post = get_post($match);
                                    if ($match_post) {
                                        echo '<li><a href="' . esc_url(get_permalink($match_post->ID)) . '">' . esc_html($match_post->post_title) . '</a></li>';
                                    }
                                }
                                echo '</ul>';
                            } else {
                                echo '<p>Aucun match associé.</p>';
                            }
                            ?>
                        </div>

                        <!-- Lien vers la page de l'équipe -->
                        <div class="equipe-link">
                            <a href="<?php the_permalink(); ?>" class="btn">Voir l'équipe</a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>

    <?php else : ?>
        <p>Aucune équipe trouvée.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
