<?php
/* Template Name: Ajouter Équipe */
?>

<?php get_header(); ?>

<div class="hero-section2">
<img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero3.svg" alt="League of Legends" class="hero-image">
    <div class="hero-overlay2"></div>
    <div class="hero-content2">
        <h2>
CREER UNE EQUIPE
</h2>
        <p>Plongez dans l’arène de l’e-sport, là où les légendes se forment et l’intensité du jeu atteint son apogée !</p>
    </div>
</div>

<div class="page-header">
    <p>Bienvenue sur la page d'ajout d'équipe ! Ici, vous pouvez créer et enregistrer une nouvelle équipe en quelques étapes simples. 
       Remplissez les informations nécessaires telles que le nom de l'équipe, sa description, ainsi que les joueurs et leurs pseudonymes.
    </p>
</div>

<div class="ajouter-equipe">
    <?php
    // Vérifier si l'utilisateur est connecté
    if (is_user_logged_in()) :

        // Si le formulaire est soumis, traiter la soumission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter_equipe_nonce']) && wp_verify_nonce($_POST['ajouter_equipe_nonce'], 'ajouter_equipe_action')) {

            // Vérifier les champs obligatoires
            if (!empty($_POST['equipe_nom']) && !empty($_POST['equipe_description']) && !empty($_POST['joueur_1']) && !empty($_POST['joueur_2']) && !empty($_POST['joueur_3']) && !empty($_POST['joueur_4']) && !empty($_POST['joueur_5'])) {

                // Créer un nouveau post de type 'équipe'
                $nouvelle_equipe = array(
                    'post_title'    => sanitize_text_field($_POST['equipe_nom']),
                    'post_content'  => sanitize_textarea_field($_POST['equipe_description']),
                    'post_type'     => 'equipe',
                    'post_status'   => 'publish',
                    'post_author'   => get_current_user_id(), // Lier à l'utilisateur connecté
                );

                // Insérer le post et obtenir son ID
                $equipe_id = wp_insert_post($nouvelle_equipe);

                // Ajouter les joueurs et leurs pseudonymes
                for ($i = 1; $i <= 5; $i++) {
                    if (!empty($_POST["joueur_$i"]) && !empty($_POST["pseudonyme_$i"])) {
                        update_post_meta($equipe_id, "joueur_$i", sanitize_text_field($_POST["joueur_$i"]));
                        update_post_meta($equipe_id, "pseudonyme_$i", sanitize_text_field($_POST["pseudonyme_$i"]));
                    }
                }

                // Message de confirmation
                echo '<p class="success">L\'équipe a été créée avec succès.</p>';
            } else {
                echo '<p class="error">Veuillez remplir tous les champs obligatoires et sélectionner au moins 5 joueurs avec leurs pseudonymes.</p>';
            }
        }

        // Récupérer les utilisateurs enregistrés (joueurs)
        $args = array(
            'orderby' => 'display_name',
            'order' => 'ASC',
        );
        $joueurs = get_users($args);
    ?>

    <form method="POST">
        <label for="equipe_nom">Nom de l'équipe :</label>
        <input type="text" id="equipe_nom" name="equipe_nom" required>

        <label for="equipe_description">Description de l'équipe :</label>
        <textarea id="equipe_description" name="equipe_description" required></textarea>

        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <div class="joueur-section">
                <label for="joueur_<?php echo $i; ?>">Joueur <?php echo $i; ?> :</label>
                <select id="joueur_<?php echo $i; ?>" name="joueur_<?php echo $i; ?>" onchange="updateJoueurOptions()" required>
                    <option value="">Sélectionner un joueur</option>
                    <?php foreach ($joueurs as $joueur) : ?>
                        <option value="<?php echo esc_attr($joueur->ID); ?>">
                            <?php echo esc_html($joueur->display_name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="pseudonyme_<?php echo $i; ?>">Pseudonyme du Joueur <?php echo $i; ?> :</label>
                <input type="text" id="pseudonyme_<?php echo $i; ?>" name="pseudonyme_<?php echo $i; ?>" required>
            </div>
        <?php endfor; ?>

        <!-- Ajouter le nonce pour la sécurité -->
        <?php wp_nonce_field('ajouter_equipe_action', 'ajouter_equipe_nonce'); ?>

        <input type="submit" value="Ajouter l'équipe">
    </form>

    <script>
        function updateJoueurOptions() {
            // Récupérer toutes les sélections de joueurs
            const selections = [
                document.getElementById('joueur_1'),
                document.getElementById('joueur_2'),
                document.getElementById('joueur_3'),
                document.getElementById('joueur_4'),
                document.getElementById('joueur_5')
            ];

            // Récupérer les IDs des joueurs sélectionnés
            const selectedIds = selections.map(select => select.value).filter(id => id !== "");

            // Désactiver les options déjà sélectionnées dans les autres sélections
            selections.forEach(select => {
                const options = select.querySelectorAll('option');
                options.forEach(option => {
                    if (selectedIds.includes(option.value) && option.value !== select.value) {
                        option.disabled = true; // Désactiver si déjà sélectionné ailleurs
                    } else {
                        option.disabled = false; // Activer si pas sélectionné
                    }
                });
            });
        }

        // Initialiser la fonction au chargement de la page
        document.addEventListener('DOMContentLoaded', updateJoueurOptions);
    </script>

    <?php else : ?>
        <p>Vous devez être connecté pour créer une équipe. <a href="<?php echo wp_login_url(get_permalink()); ?>">Se connecter</a></p>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
s