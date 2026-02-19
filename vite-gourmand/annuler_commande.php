<?php
require_once 'includes/db.php';
session_start();

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $commande_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // On vérifie que la commande appartient bien à l'utilisateur et qu'elle est "en_attente"
    $stmt = $pdo->prepare("DELETE FROM commande WHERE id = ? AND utilisateur_id = ? AND statut = 'en_attente'");
    $stmt->execute([$commande_id, $user_id]);

    header('Location: profil.php?message=Commande annulée avec succès');
    exit();
}

header('Location: profil.php');
exit();