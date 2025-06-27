<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestion_stages");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des champs
    $prenom = htmlspecialchars($_POST['first_name']);
    $nom = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ✅ crypté
    $telephone = htmlspecialchars($_POST['phone']);
    $date_naissance = $_POST['date_of_birth'];
    $type_utilisateur = $_POST['user_type'];
    $annee_etude = $_POST['year'];
    $universite = htmlspecialchars($_POST['university']);
    $filiere = $_POST['department'];
    $lettre_motivation = htmlspecialchars($_POST['cover_letter']);

    // Upload du fichier PDF (CV)
    $cv_nom = $_FILES['resume']['name'];
    $cv_temp = $_FILES['resume']['tmp_name'];
    $cv_destination = "uploads/" . basename($cv_nom);

    // Créer le dossier s'il n'existe pas
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (move_uploaded_file($cv_temp, $cv_destination)) {
        // Requête SQL d'insertion
        $sql = "INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, telephone, date_naissance, type_utilisateur, universite, filiere, annee_etude, lettre_motivation, cv)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssisss", $prenom, $nom, $email, $password, $telephone, $date_naissance, $type_utilisateur, $universite, $filiere, $annee_etude, $lettre_motivation, $cv_nom);

        if ($stmt->execute()) {
            // ✅ Redirection vers la page de connexion
            header("Location: page_connexion.html");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur lors du téléchargement du fichier CV.";
    }

    $conn->close();
}
?>
