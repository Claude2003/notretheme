<?php
/* Template Name: Inscription */
get_header();

echo '<div class="inscription-form-container">';
echo '<h1>Inscription</h1>';
echo '<p>Bienvenue ! Remplissez le formulaire ci-dessous pour créer un nouveau compte.</p>';

// Vérifie si l'utilisateur est déjà connecté
if (is_user_logged_in()) {
    echo '<p>Vous êtes déjà connecté.</p>';
} else {
    // Si le formulaire d'inscription est soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = sanitize_text_field($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $pseudonyme = sanitize_text_field($_POST['pseudonyme']);
        $avatar = $_FILES['avatar'];

        $errors = array();

        // Validation des champs
        if (empty($username) || empty($email) || empty($password) || empty($pseudonyme)) {
            $errors[] = 'Tous les champs sont obligatoires.';
        }

        if (email_exists($email)) {
            $errors[] = 'Cet email est déjà utilisé.';
        }

        if (username_exists($username)) {
            $errors[] = 'Ce nom d’utilisateur est déjà pris.';
        }

        // Traitement de l'avatar (si uploadé)
        if (!empty($avatar['name'])) {
            // Vérifier que le fichier est bien une image
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($avatar['type'], $allowed_types)) {
                $errors[] = 'Seules les images (JPEG, PNG, GIF) sont autorisées pour l\'avatar.';
            }
        }

        // Si aucune erreur, créer le compte utilisateur
        if (empty($errors)) {
            $user_id = wp_create_user($username, $password, $email);
            if (is_wp_error($user_id)) {
                echo '<p>Une erreur s\'est produite lors de la création du compte. Veuillez réessayer.</p>';
            } else {
                // Ajouter le pseudonyme à l'utilisateur
                update_user_meta($user_id, 'pseudonyme', $pseudonyme);

                // Traitement de l'avatar
                if (!empty($avatar['name'])) {
                    $upload_dir = wp_upload_dir();
                    $upload_file = $upload_dir['path'] . '/' . basename($avatar['name']);
                    move_uploaded_file($avatar['tmp_name'], $upload_file);

                    // Ajouter l'avatar à l'utilisateur
                    update_user_meta($user_id, 'avatar', $upload_file);
                }
                
          
                
                // Rediriger vers la page d'accueil
                wp_redirect(home_url());
                exit; // Terminer le script après la redirection
            }
        } else {
            // Afficher les erreurs
            foreach ($errors as $error) {
                echo '<p>' . esc_html($error) . '</p>';
            }
        }
    }

    // Afficher le formulaire d'inscription
    ?>
    <form method="post" action="" enctype="multipart/form-data">
        <p>
            <label for="username">Nom d’utilisateur</label>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </p>
        <p>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <label for="pseudonyme">Pseudonyme</label>
            <input type="text" name="pseudonyme" id="pseudonyme" required>
        </p>
        <p>
            <label for="avatar">Photo de profil (Avatar)</label>
            <input type="file" name="avatar" id="avatar" accept="image/jpeg, image/png, image/gif">
        </p>
        <p>
            <input type="submit" value="Créer mon compte">
        </p>
    </form>
    <?php
}

get_footer();
?>
