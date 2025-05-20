<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=gestion_stages', 'root', '');

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Données du formulaire
    $prenom     = $_POST['first_name'];
    $nom        = $_POST['last_name'];
    $email      = $_POST['email'];
    $telephone  = $_POST['phone'];
    $naissance  = $_POST['date_of_birth'];
    $filiere    = $_POST['department'];
    $universite = $_POST['university'];
    $annee      = $_POST['year'];
    $type       = $_POST['user_type'];
    $lettre     = $_POST['cover_letter'] ?? '';
    $identifiant = uniqid('ID_', true);
    $token = bin2hex(random_bytes(16)); // token de validation

    // Upload du CV
    $cv_path = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $cv_dir = 'uploads/';
        $cv_path = $cv_dir . basename($_FILES['resume']['name']);
        move_uploaded_file($_FILES['resume']['tmp_name'], $cv_path);
    }

    // Insertion dans la BDD
    $stmt = $pdo->prepare("INSERT INTO utilisateurs 
        (identifiant, prenom, nom, email, telephone, date_naissance, filiere, universite, annee_etude, type_utilisateur, lettre_motivation, cv_path, token_validation) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $identifiant, $prenom, $nom, $email, $telephone, $naissance, $filiere, $universite, $annee, $type, $lettre, $cv_path, $token
    ]);

    // Envoi de l'email de confirmation
    $subject = "Confirmation de votre inscription";
    $message = "Bonjour $prenom $nom,\n\nMerci de vous être inscrit. Voici votre identifiant : $identifiant\n\nVeuillez confirmer votre email en cliquant ici :\nhttp://votre-site.com/valider.php?token=$token\n\nL'équipe Gestion de Stages";
    $headers = "From: no-reply@gestiondestages.com";

    if (mail($email, $subject, $message, $headers)) {
        echo "Un email de confirmation vous a été envoyé.";
    } else {
        echo "Erreur lors de l'envoi du mail.";
    }
}
?>
