<?php
require_once 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Sécurité : on crypte le mot de passe

    try {
        // On insère l'utilisateur (par défaut en rôle 'client')
       // On insère l'utilisateur dans la table 'utilisateur' (sans le s)
        // On utilise ?, ?, ? car tu envoies 3 variables dans l'execute plus bas
        $sql = "INSERT INTO utilisateur (nom, email, mot_de_passe) VALUES (?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        
        // Ici on envoie bien les 3 données : nom, email et mot de passe crypté
        $stmt->execute([$nom, $email, $password]);

        // On redirige vers la connexion avec un message de succès
        header('Location: login.php?success=Compte créé avec succès !');
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
}