<?php get_header(); ?>

<div class="equipes-archive">
    <h1>Liste des Équipes</h1>
    <p>Ici, vous pouvez explorer les équipes composées de joueurs passionnés. Chaque équipe participe à divers matchs. Découvrez les joueurs de chaque équipe, ainsi que les matchs qu'ils ont joués.</p>

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
                                            echo '<li>';
                                            echo '<img src="' . esc_url($photo) . '" alt="' . esc_attr($user_info->display_name) . '" class="joueur-photo">';
                                            echo esc_html($user_info->display_name);
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
                            $matchs = get_field('matchs'); // Récupérer les matchs associés
                            
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
