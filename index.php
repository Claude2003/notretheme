<?php get_header(); ?>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<?php get_hero(); ?> <!-- Appel de la section Hero -->

<section class="intro-match">
        <h2>Préparez-vous à vibrer avec nous ! Accédez aux informations essentielles pour chaque  <span>match</span> et vivez l'excitation en temps réel</h2>
       
    </section>

    <!-- Détails des matchs -->
    <section class="match-details">
       
        <p>
            Découvrez des rendez-vous à ne pas manquer, avec une liste de duels à venir, les équipes en compétition, et tous les détails de la rencontre.
            Retrouvez ici les dates, heures, et lieux des matchs, accompagnés d'images qui capturent l'intensité de chaque moment.
        </p>
    </section>
    <div class="matchs-archive">

    <!-- Carrousel personnalisé -->
    <div class="custom-carousel">
       
        <div class="carousel-wrapper">
            <?php
            // Créer une nouvelle requête pour le type de contenu 'match'
            $match_query = new WP_Query(array(
                'post_type' => 'matchs', // Remplacez 'match' par le nom exact de votre CPT
                'posts_per_page' => -1 // Tous les matchs
            ));

            // Vérifiez si des posts sont trouvés
            if ($match_query->have_posts()) :
                while ($match_query->have_posts()) : $match_query->the_post();
            ?>
                    <div class="carousel-item">
                        <article class="match-item">
                            <div class="match-card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="match-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <h2 class="match-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="match-meta">
                                    <p><strong>Date:</strong> <?php echo get_the_term_list(get_the_ID(), 'date', '', ', ', ''); ?></p>
                                    <p><strong>Lieu:</strong> <?php echo get_the_term_list(get_the_ID(), 'lieu', '', ', ', ''); ?></p>
                                    <p><strong>Heure:</strong> <?php echo get_the_term_list(get_the_ID(), 'heure', '', ', ', ''); ?></p>
                                </div>

                                <div class="match-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="match-link">
                                    <a href="<?php the_permalink(); ?>" class="btn">Voir le match</a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p>Aucun match trouvé.</p>
            <?php endif; ?>
        </div>
        
    </div>
    
</div>
<div class="button-container">
                <a href="#add-team" class="cta-button">VOIR PLUS DE MATCHS</a> </div>

    <!-- Section des équipes -->
    <section class="team-intro">
        <h2>Entrez dans les coulisses, DÉCOUVREZ chaque  <span>équipe</span>, et soutenez vos favoris vers la victoire.</h2>
        <p>
            Les équipes qui marquent l'histoire de  <span>League of Legends</span> sont toutes ici. Explorez leur parcours, découvrez les visages, et suivez leurs performances.
            En un clic, accédez aux informations détaillées sur chaque équipe : leurs joueurs clés, leur palmarès, leurs statistiques et les moments qui les ont rendus célèbres.
            Que ce soit les champions incontestés ou les outsiders en quête de gloire, chaque équipe possède une histoire unique qui attend d'être découverte.
        </p>
    </section>
    <div class="equipes-archive">
    
    <?php
    // Créer une requête personnalisée pour récupérer 4 équipes
    $args = array(
        'post_type' => 'equipe',  // Remplacez 'equipe' par le nom du type de post de vos équipes
        'posts_per_page' => 4,    // Limite à 4 équipes
    );
    $equipe_query = new WP_Query($args);

    if ($equipe_query->have_posts()) : ?>
        <div class="equipe-list">
            <?php while ($equipe_query->have_posts()) : $equipe_query->the_post(); ?>
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
    
                        <!-- Affichage des champs ACF liés à l'équipe -->
                        <div class="equipe-data">
                            
                            <ul>
                                <?php
                                // Récupération des étudiants via ACF
                                $etudiant_1 = get_field('joueur1'); // ID de l'utilisateur 1
                                $etudiant_2 = get_field('joueur2'); // ID de l'utilisateur 2
                                $etudiant_3 = get_field('joueur3'); // ID de l'utilisateur 2
                                $etudiant_4 = get_field('joueur4'); // ID de l'utilisateur 2

                                // Affichage des noms des étudiants si présents
                                if ($etudiant_1) {
                                    $user_info_1 = get_userdata($etudiant_1); // Obtenir les informations utilisateur pour l'étudiant 1
                                    if ($user_info_1) {
                                        echo '<li>' . esc_html($user_info_1->display_name) . '</li>'; // Affiche le nom affiché de l'utilisateur 1
                                    }
                                }

                                if ($etudiant_2) {
                                    $user_info_2 = get_userdata($etudiant_2); // Obtenir les informations utilisateur pour l'étudiant 2
                                    if ($user_info_2) {
                                        echo '<li>' . esc_html($user_info_2->display_name) . '</li>'; // Affiche le nom affiché de l'utilisateur 2
                                    }
                                }

                                if ($etudiant_3) {
                                    $user_info_3 = get_userdata($etudiant_3); // Obtenir les informations utilisateur pour l'étudiant 2
                                    if ($user_info_3) {
                                        echo '<li>' . esc_html($user_info_3->display_name) . '</li>'; // Affiche le nom affiché de l'utilisateur 2
                                    }
                                }

                                if ($etudiant_4) {
                                    $user_info_4 = get_userdata($etudiant_4); // Obtenir les informations utilisateur pour l'étudiant 2
                                    if ($user_info_4) {
                                        echo '<li>' . esc_html($user_info_4->display_name) . '</li>'; // Affiche le nom affiché de l'utilisateur 2
                                    }
                                }
                                ?>
                            </ul>

                           
    </ul>
</div>


                        <!-- Affichage des matchs associés à l'équipe -->
                        <div class="matchs">
                            <h3>Matchs associés :</h3>
                            <?php
                            $matchs = get_field('match'); // Récupérer les matchs associés
                            
                            if ($matchs) {
                                echo '<ul>';
                                foreach ($matchs as $match) {
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
        <div>
                <a href="#add-team" class="cta-button">VOIR PLUS D’EQUIPE</a> </div>
            <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata(); // Réinitialiser la requête pour ne pas affecter les autres boucles ?>
    <?php else : ?>
        <p>Aucune équipe trouvée.</p>
    <?php endif; ?>
</div>

   
<?php get_footer(); ?>



