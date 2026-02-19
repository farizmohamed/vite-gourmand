<?php
// Fichier: includes/db.php
$host = 'localhost';
$dbname = 'vite_gourmand';
$username = 'root'; // Par défaut sur XAMPP
$password = '';     // Par défaut vide sur XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // On active les erreurs pour voir les problèmes s'il y en a
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>