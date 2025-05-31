<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'etudiant') {
    header("Location: page_connexion.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tableau de Bord Étudiant</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e8f0fe;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    header {
      background-color: #1a73e8;
      color: white;
      padding: 20px 0;
    }

    main {
      margin-top: 50px;
    }

    .dashboard {
      background-color: white;
      display: inline-block;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .logout-btn {
      display: inline-block;
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #d93025;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .logout-btn:hover {
      background-color: #b71c1c;
    }
  </style>
</head>
<body>

<header>
  <h1>Bienvenue, Étudiant</h1>
</header>

<main>
  <div class="dashboard">
    <h2>Votre tableau de bord</h2>
    <p>Vous êtes connecté en tant qu'étudiant.</p>

    <a href="deconnexion.php" class="logout-btn">Se déconnecter</a>
  </div>
</main>

</body>
</html>
