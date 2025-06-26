<?php
$conn = new mysqli("localhost", "root", "", "gestion_stages");

// Vérifie que tous les champs nécessaires sont fournis
if (!isset($_POST['token'], $_POST['password'], $_POST['confirm'])) {
    echo "Champs manquants.";
    exit;
}

$token = $_POST['token'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Vérifie que les deux mots de passe sont identiques
if ($password !== $confirm) {
    echo "❌ Les mots de passe ne correspondent pas.";
    exit;
}

// Hachage sécurisé du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Met à jour le mot de passe et supprime le token
$stmt = $conn->prepare("UPDATE utilisateurs SET mot_de_passe = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ? AND token_expiry > NOW()");
$stmt->bind_param("ss", $hashedPassword, $token);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "✅ Mot de passe mis à jour avec succès.";
    // 🔁 Redirection possible vers la page de connexion :
    // header("Location: connexion.php?success=1");
} else {
    echo "❌ Lien invalide ou expiré. Veuillez recommencer.";
}
?>
