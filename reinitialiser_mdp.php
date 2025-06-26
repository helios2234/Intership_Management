<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestion_stages");

// Vérifie que la connexion à la base est OK
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Vérifie que le token est bien fourni dans l'URL
if (!isset($_GET['token'])) {
    echo "<h3>Lien invalide.</h3>";
    exit;
}

$token = $_GET['token'];

// Vérifie si le token est valide et non expiré
$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE reset_token = ? AND token_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$res = $stmt->get_result();

// Si le token est valide, affiche le formulaire
if ($res->num_rows === 1) {
    // Protection contre les failles XSS
    $token = htmlspecialchars($token);
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Réinitialisation du mot de passe</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 40px;
                padding: 20px;
                background-color: #f9f9f9;
            }
            form {
                max-width: 400px;
                margin: auto;
                padding: 20px;
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            input, label, button {
                display: block;
                width: 100%;
                margin-bottom: 15px;
            }
            input {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            button {
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>

    <h2>Réinitialiser votre mot de passe</h2>
    <form method="POST" action="mettre_a_jour_mdp.php">
        <input type="hidden" name="token" value="<?= $token ?>">
        
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm">Confirmer le mot de passe :</label>
        <input type="password" name="confirm" id="confirm" required>

        <button type="submit">Réinitialiser</button>
    </form>

    </body>
    </html>
    <?php
} else {
    echo "<h3>❌ Lien expiré ou invalide.</h3>";
}
?>
