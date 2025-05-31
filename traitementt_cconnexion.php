<?php
session_start();
require 'db_config.php'; // fichier où tu configures la connexion PDO à MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $user_type = $_POST['user_type'];

    $sql = "SELECT * FROM utilisateurs WHERE email = :email AND user_type = :user_type";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email, ':user_type' => $user_type]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirection selon le rôle
        if ($user['user_type'] === 'etudiant') {
            header("Location: page_etudiants.html");
        } elseif ($user['user_type'] === 'entreprise') {
            header("Location: page_entreprise.html");
        } elseif ($user['user_type'] === 'encadreur') {
            header("Location: page_encadreur.html");
        } else {
            header("Location: page garde.html"); // Page d’accueil générale
        }
        exit();
    } else {
        // Redirection en cas d'erreur
        header("Location: page_connexion.html?statut=erreur");
        exit();
    }
}
?>
