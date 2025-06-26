<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$conn = new mysqli("localhost", "root", "", "gestion_stages");

$prenom = $_POST['first_name'];
$nom = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['date_of_birth'];
$filiere = $_POST['department'];
$universite = $_POST['university'];
$annee = $_POST['year'];
$type = $_POST['user_type'];
$lettre = $_POST['cover_letter'];
$cv = $_FILES['resume']['name'];

// Déplacer le CV
move_uploaded_file($_FILES['resume']['tmp_name'], "uploads/" . $cv);

// Token de vérification
$token = bin2hex(random_bytes(32));

$stmt = $conn->prepare("INSERT INTO utilisateurs (prenom, nom, email, telephone, date_naissance, filiere, universite, annee, type_utilisateur, lettre, cv, verif_token) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $prenom, $nom, $email, $phone, $dob, $filiere, $universite, $annee, $type, $lettre, $cv, $token);
$stmt->execute();

$link = "http://localhost/gestion_stages/confirm_email.php?token=$token";

// Envoi de l’email
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tonemail@gmail.com';
$mail->Password = 'mot_de_passe_app';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('tonemail@gmail.com', 'Gestion des Stages');
$mail->addAddress($email);
$mail->Subject = 'Confirmez votre inscription';
$mail->Body = "Bonjour $prenom,\n\nVeuillez cliquer sur ce lien pour confirmer votre inscription : $link";
$mail->send();

echo "Inscription enregistrée. Veuillez vérifier votre email pour confirmer.";
?>
