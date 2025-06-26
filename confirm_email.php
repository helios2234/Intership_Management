<?php
$conn = new mysqli("localhost", "root", "", "gestion_stages");
$token = $_GET['token'];

$stmt = $conn->prepare("UPDATE utilisateurs SET is_verified = 1, verif_token = NULL WHERE verif_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Votre email a été confirmé avec succès.";
} else {
    echo "Lien invalide ou expiré.";
}
?>
