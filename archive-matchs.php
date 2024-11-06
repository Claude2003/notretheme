<?php get_header(); ?>

<div class="hero-section2">
<img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero3.svg" alt="League of Legends" class="hero-image">
    <div class="hero-overlay2"></div>
    <div class="hero-content2">
        <h2>MATCHS</h2>
        <p>Plongez dans l’arène de l’e-sport, là où les légendes se forment et l’intensité du jeu atteint son apogée !</p>
    </div>
</div>

<div class="matchs-archive">
    
<div class="intro-text">
        
        <p>Explorez ici tous les matchs à venir. Retrouvez les informations importantes, comme la date, l'heure et le lieu de chaque match. Restez à jour et ne manquez aucune rencontre !</p>
    </div>
<!-- Formulaire de filtre pour les taxonomies -->
<!-- Formulaire de filtre pour les taxonomies -->

    <!-- Formulaire de filtre pour les taxonomies -->
    <div class="filters">
        <form action="" method="get">
            <select name="date" id="date">
                <option value="">Sélectionner une date</option>
                <?php
                // Récupérer toutes les dates disponibles pour les matchs
                $dates = get_terms(array('taxonomy' => 'date', 'orderby' => 'name', 'order' => 'ASC'));
                foreach ($dates as $date) {
                    $selected = (isset($_GET['date']) && $_GET['date'] == $date->term_id) ? 'selected' : '';
                    echo '<option value="' . esc_attr($date->term_id) . '" ' . $selected . '>' . esc_html($date->name) . '</option>';
                }
                ?>
            </select>

            <select name="lieu" id="lieu">
                <option value="">Sélectionner un lieu</option>
                <?php
                $lieux = get_terms(array('taxonomy' => 'lieu', 'orderby' => 'name', 'order' => 'ASC'));
                foreach ($lieux as $lieu) {
                    $selected = (isset($_GET['lieu']) && $_GET['lieu'] == $lieu->term_id) ? 'selected' : '';
                    echo '<option value="' . esc_attr($lieu->term_id) . '" ' . $selected . '>' . esc_html($lieu->name) . '</option>';
                }
                ?>
            </select>

            <select name="heure" id="heure">
                <option value="">Sélectionner une heure</option>
                <?php
                $heures = get_terms(array('taxonomy' => 'heure', 'orderby' => 'name', 'order' => 'ASC'));
                foreach ($heures as $heure) {
                    $selected = (isset($_GET['heure']) && $_GET['heure'] == $heure->term_id) ? 'selected' : '';
                    echo '<option value="' . esc_attr($heure->term_id) . '" ' . $selected . '>' . esc_html($heure->name) . '</option>';
                }
                ?>
            </select>

            <button type="submit">Filtrer</button>
        </form>
    </div>

    <!-- Affichage des matchs -->
    <?php if (have_posts()) : ?>
        <div class="match-list">
            <?php while (have_posts()) : the_post(); ?>
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
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php 
            // S'assurer que 'paged' est bien pris en compte
            echo paginate_links(array(
                'total' => $query->max_num_pages, // Nombre total de pages
                'current' => max(1, get_query_var('paged')), // Page courante
            ));
            ?>
        </div>
        
    <?php else : ?>
        <p>Aucun match trouvé.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>


