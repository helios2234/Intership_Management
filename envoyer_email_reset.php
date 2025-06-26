<?php
// Charger PHPMailer et ses classes
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestion_stages");

// Vérifie si le champ email a été envoyé
if (!isset($_POST['email'])) {
    echo "Veuillez fournir une adresse email.";
    exit;
}

$email = $_POST['email'];

// Vérifie si l'e-mail existe dans la base
$result = $conn->prepare("SELECT * FROM utilisateurs WHERE email=?");
$result->bind_param("s", $email);
$result->execute();
$query = $result->get_result();

if ($query->num_rows == 0) {
    echo "Adresse e-mail introuvable.";
    exit;
}

// Génère un token sécurisé et une date d'expiration (1h plus tard)
$token = bin2hex(random_bytes(32));
$expiry = date("Y-m-d H:i:s", time() + 3600); // maintenant + 1 heure

// Mise à jour du token et de son expiration dans la base de données
$stmt = $conn->prepare("UPDATE utilisateurs SET reset_token=?, token_expiry=? WHERE email=?");
$stmt->bind_param("sss", $token, $expiry, $email);
$stmt->execute();

// 🔧 MODIFIE ICI : lien de ton fichier de réinitialisation
$link = "http://localhost/gestion-stages/reinitialiser_mdp.php?token=$token";

// Configuration de l'envoi de mail via PHPMailer
try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';         // 🔧 Serveur SMTP Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'habibtefack@gmail.com'; // 🔧 Ton adresse Gmail
    $mail->Password = 'dtyx nxtn murp biyf';   // 🔧 Ton mot de passe d'application (PAS le vrai mot de passe Gmail)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // 🔧 MODIFIE : adresse de l'expéditeur et nom
    $mail->setFrom('habibtefack@gmail.com', 'Gestion des Stages');
    $mail->addAddress($email); // Destinataire
    $mail->Subject = 'Réinitialisation de mot de passe';

    // 🔧 MODIFIE ce message si tu veux personnaliser
    $mail->Body = "Bonjour,\n\nCliquez sur le lien suivant pour réinitialiser votre mot de passe :\n$link\n\nCe lien expirera dans 1 heure.";

    $mail->send();
    echo "✅ Un lien de réinitialisation vous a été envoyé à l'adresse : $email";
} catch (Exception $e) {
    echo "❌ Erreur lors de l'envoi : {$mail->ErrorInfo}";
}
?>
