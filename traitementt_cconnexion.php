<?php
session_start();
require 'db_config.php'; // Connexion PDO à la base MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $user_type = strtolower(trim($_POST['user_type']));

    // Vérifie que le type d'utilisateur est valide
    $types_valides = ['etudiant', 'entreprise', 'encadreur'];
    if (!in_array($user_type, $types_valides)) {
        header("Location: page_connexion.html?statut=type_invalide");
        exit();
    }

    // Récupère l'utilisateur par email et type
    $sql = "SELECT * FROM utilisateurs WHERE email = :email AND user_type = :user_type";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email, ':user_type' => $user_type]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // Authentification réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirection selon le rôle
        switch ($user['user_type']) {
            case 'etudiant':
                header("Location: page_etudiants.html");
                break;
            case 'entreprise':
                header("Location: page_entreprise.html");
                break;
            case 'encadreur':
                header("Location: page_encadreur.html");
                break;
            default:
                header("Location: page_garde.html");
                break;
        }
        exit();
    } else {
        // Authentification échouée
        header("Location: page_connexion.html?statut=erreur_connexion");
        exit();
    }
}
?>
