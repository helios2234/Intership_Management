<?php
$pdo = new PDO('mysql:host=localhost;dbname=gestion_stages', 'root', '');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE token_validation = ?");
    $stmt->execute([$token]);

    if ($stmt->rowCount() > 0) {
        $pdo->prepare("UPDATE utilisateurs SET email_verifie = 1 WHERE token_validation = ?")
            ->execute([$token]);
        echo "Email confirmé avec succès !";
    } else {
        echo "Lien invalide ou déjà utilisé.";
    }
}
?>
