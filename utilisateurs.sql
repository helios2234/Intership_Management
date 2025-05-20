CREATE DATABASE IF NOT EXISTS gestion_stages;
USE gestion_stages;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identifiant VARCHAR(50) NOT NULL UNIQUE,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    date_naissance DATE,
    filiere VARCHAR(100),
    universite VARCHAR(150),
    annee_etude INT,
    type_utilisateur ENUM('etudiant', 'encadrant', 'entreprise') NOT NULL,
    lettre_motivation TEXT,
    cv_path VARCHAR(255),
    email_verifie BOOLEAN DEFAULT FALSE,
    token_validation VARCHAR(100),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
