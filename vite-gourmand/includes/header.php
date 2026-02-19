<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// On récupère les infos de session s'ils existent
$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['role'] ?? null;
$user_nom = $_SESSION['nom'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite & Gourmand</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css?v=1.1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">🍽️ Vite & Gourmand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="menus.php">Nos Menus</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="profil.php">👤 <?php echo htmlspecialchars($user_nom); ?></a></li>
            <li class="nav-item"><a class="nav-link btn-logout" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
            <li class="nav-item"><a class="nav-link btn-inscription" href="inscription.php">Inscription</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div id="loader-bar"></div>

<div class="container-fluid px-5 mt-4">