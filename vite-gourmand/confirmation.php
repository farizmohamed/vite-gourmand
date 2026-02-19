<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $menu_id = $_POST['menu_id'];
    $nb_personnes = intval($_POST['nb_personnes']);
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $date_prestation = $_POST['date_livraison'] . ' ' . $_POST['heure_livraison'];

    // 1. Récupérer les infos du menu pour le calcul
    $stmtMenu = $pdo->prepare("SELECT prix_par_personne, min_personnes FROM menu WHERE id = ?");
    $stmtMenu->execute([$menu_id]);
    $menu = $stmtMenu->fetch();

    // 2. Calcul du prix du menu avec remise de 10% (si nb > min + 5) [cite: 120]
    $prix_unitaire = $menu['prix_par_personne'];
    $total_menu = $nb_personnes * $prix_unitaire;
    
    if ($nb_personnes >= ($menu['min_personnes'] + 5)) {
        $total_menu = $total_menu * 0.9; // Remise 10%
    }

    // 3. Calcul des frais de livraison [cite: 115]
    // Base 5€ + 0.59€/km (on simule 20km pour l'exercice si hors Bordeaux)
    $frais_livraison = 0;
    if ($ville !== "Bordeaux") {
        $distance_simulee = 20; 
        $frais_livraison = 5 + ($distance_simulee * 0.59);
    }

    $prix_total = $total_menu + $frais_livraison;

    // 4. Insertion dans la table 'commande' [cite: 111, 113]
    try {
        $sql = "INSERT INTO commande (utilisateur_id, menu_id, date_livraison, lieu_livraison, nb_personnes, prix_total, statut) 
                VALUES (?, ?, ?, ?, ?, ?, 'en_attente')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $menu_id, $date_prestation, $adresse . ' (' . $ville . ')', $nb_personnes, $prix_total]);

        echo "<div class='alert alert-success text-center'>
                <h2>Merci pour votre commande !</h2>
                <p>Le montant total est de <strong>" . number_format($prix_total, 2) . " €</strong>.</p>
                <p>Vous allez recevoir un mail de confirmation sous peu[cite: 122].</p>
                <a href='index.php' class='btn btn-primary'>Retour à l'accueil</a>
              </div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur lors de la commande : " . $e->getMessage() . "</div>";
    }
} else {
    header('Location: index.php');
}

require_once 'includes/footer.php';
?>