<?php
// Connexion à la base de données
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $prenom     = $_POST['first_name'];
    $nom        = $_POST['last_name'];
    $email      = $_POST['email'];
    $telephone  = $_POST['phone'];
    $date_naiss = $_POST['date_of_birth'];
    $filiere    = $_POST['department'];
    $universite = $_POST['university'];
    $annee      = $_POST['year'];
    $type_utilisateur = strtolower($_POST['user_type']); // étudiant / entreprise / encadreur
    $lettre_motivation = $_POST['cover_letter'];
    $mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Gestion du fichier CV
    $cv = $_FILES['resume'];
    $cv_path = '';
    if ($cv['error'] === 0) {
        $cv_path = 'uploads/' . basename($cv['name']);
        move_uploaded_file($cv['tmp_name'], $cv_path);
    }

    // Insertion dans la base de données
    $sql = "INSERT INTO utilisateurs 
        (prenom, nom, email, telephone, date_naissance, filiere, universite, annee_etude, user_type, lettre_motivation, cv_path, mot_de_passe) 
        VALUES 
        (:prenom, :nom, :email, :telephone, :date_naissance, :filiere, :universite, :annee_etude, :user_type, :lettre_motivation, :cv_path, :mot_de_passe)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':prenom' => $prenom,
        ':nom' => $nom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':date_naissance' => $date_naiss,
        ':filiere' => $filiere,
        ':universite' => $universite,
        ':annee_etude' => $annee,
        ':user_type' => $type_utilisateur,
        ':lettre_motivation' => $lettre_motivation,
        ':cv_path' => $cv_path,
        ':mot_de_passe' => $mot_de_passe
    ]);

    echo "Inscription réussie. <a href='page_connexion.html'>Se connecter</a>";
} else {
    echo "Méthode non autorisée.";
}
?>
