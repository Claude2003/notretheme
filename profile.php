<?php
/* Template Name: Profil Utilisateur */
get_header(); ?>

<div class="profile-container">
    
<?php
    // Vérifier si l'utilisateur est connecté
    if (!is_user_logged_in()) {
        echo '<p>Vous devez être connecté pour voir votre profil.</p>';
        echo '<p><a href="' . esc_url(home_url('/connexion')) . '">Se connecter</a></p>';
    } else {
        // Récupérer l'utilisateur actuel
        $current_user = wp_get_current_user();
        ?>

        <div class="profile-info">
            <h2>Informations de profil</h2>
            <p><strong>Nom d’utilisateur :</strong> <?php echo esc_html($current_user->user_login); ?></p>
            <p><strong>Email :</strong> <?php echo esc_html($current_user->user_email); ?></p>

            <?php
            // Afficher l'avatar de l'utilisateur
            echo '<p><strong>Avatar :</strong></p>';
            echo get_avatar($current_user->ID, 100); // Affiche l'avatar avec une taille de 100px
            ?>

            <p><strong>Modifier l'avatar :</strong></p>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="profile_avatar" accept="image/*">
                <input type="submit" value="Changer l'avatar">
            </form>

            <?php
            // Traitement du changement d'avatar
            if (isset($_FILES['profile_avatar']) && !empty($_FILES['profile_avatar']['name'])) {
                $uploaded_file = $_FILES['profile_avatar'];

                if ($uploaded_file['error'] === UPLOAD_ERR_OK) {
                    $file_type = wp_check_filetype($uploaded_file['name']);

                    if (in_array($file_type['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
                        $upload_dir = wp_upload_dir();
                        $uploaded_file_path = $upload_dir['path'] . '/' . basename($uploaded_file['name']);
                        move_uploaded_file($uploaded_file['tmp_name'], $uploaded_file_path);

                        $attachment = array(
                            'post_mime_type' => $file_type['type'],
                            'post_title' => sanitize_file_name($uploaded_file['name']),
                            'post_content' => '',
                            'post_status' => 'inherit',
                            'guid' => $upload_dir['url'] . '/' . basename($uploaded_file['name']),
                        );
                        $attachment_id = wp_insert_attachment($attachment, $uploaded_file_path);

                        update_user_meta($current_user->ID, 'profile_picture', $attachment_id);
                        echo '<p>Avatar mis à jour avec succès !</p>';
                    } else {
                        echo '<p style="color: red;">Seules les images JPEG, PNG et GIF sont autorisées.</p>';
                    }
                } else {
                    echo '<p style="color: red;">Erreur lors de l\'upload de l\'image. Veuillez réessayer.</p>';
                }
            }
            ?>
        </div>

        <!-- Accordéon pour la section de modification de profil -->
        <div class="profile-edit">
            <h2 onclick="toggleAccordion()">Modifier mon profil</h2>
            <div id="accordion-content" style="display: none;">
                <form method="post">
                    <p>
                        <label for="username">Nom d’utilisateur :</label>
                        <input type="text" name="username" id="username" value="<?php echo esc_attr($current_user->user_login); ?>" required>
                    </p>
                    <p>
                        <label for="email">Email :</label>
                        <input type="email" name="email" id="email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                    </p>
                    <p>
                        <label for="current_password">Mot de passe actuel :</label>
                        <input type="password" name="current_password" id="current_password">
                    </p>
                    <p>
                        <label for="new_password">Nouveau mot de passe :</label>
                        <input type="password" name="new_password" id="new_password">
                    </p>
                    <p>
                        <input type="submit" value="Sauvegarder les modifications">
                    </p>
                </form>

                <?php
                // Traitement du formulaire pour modifier les informations de profil
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $new_username = sanitize_text_field($_POST['username']);
                    $new_email = sanitize_email($_POST['email']);
                    $current_password = $_POST['current_password'];
                    $new_password = $_POST['new_password'];

                    $errors = array();

                    if (!empty($current_password) && !wp_check_password($current_password, $current_user->user_pass, $current_user->ID)) {
                        $errors[] = 'Le mot de passe actuel est incorrect.';
                    }

                    if (!empty($new_password)) {
                        wp_set_password($new_password, $current_user->ID);
                    }

                    if (email_exists($new_email) && $new_email != $current_user->user_email) {
                        $errors[] = 'Cet email est déjà utilisé.';
                    }

                    if (username_exists($new_username) && $new_username != $current_user->user_login) {
                        $errors[] = 'Ce nom d’utilisateur est déjà pris.';
                    }

                    if (empty($errors)) {
                        wp_update_user(array(
                            'ID' => $current_user->ID,
                            'user_login' => $new_username,
                            'user_email' => $new_email
                        ));
                        echo '<p>Votre profil a été mis à jour avec succès.</p>';
                    } else {
                        foreach ($errors as $error) {
                            echo '<p style="color: red;">' . esc_html($error) . '</p>';
                        }
                    }
                }
                ?>
            </div>
        </div>


        <p><a href="<?php echo esc_url(home_url()); ?>">Retour à l'accueil</a></p>
    <?php } ?>
</div>

<script>
// Fonction pour afficher/cacher le contenu de l'accordéon
function toggleAccordion() {
    var content = document.getElementById("accordion-content");
    content.style.display = content.style.display === "none" ? "block" : "none";
}
</script>


<?php get_footer(); ?>