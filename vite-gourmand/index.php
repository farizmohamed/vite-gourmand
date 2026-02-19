<?php
// Fichier: index.php
require_once 'includes/db.php'; // On se connecte à la base
require_once 'includes/header.php'; // On affiche le menu

// REQUÊTE SQL : On récupère les 3 derniers menus pour les afficher
$sql = "SELECT * FROM menu ORDER BY id DESC LIMIT 3";
$stmt = $pdo->query($sql);
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-5 mb-4 bg-light rounded-3 text-center hero">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Bienvenue chez Vite & Gourmand</h1>
      <p class="col-md-8 fs-4 mx-auto">Découvrez nos menus traiteurs pour tous vos événements. Cuisinés avec passion par nos chefs.</p>
      <a class="btn btn-primary btn-lg" href="menus.php" role="button">Voir tous les menus</a>
    </div>
</div>

<h2 class="mb-4 text-center">Nos Menus du moment</h2>
<div class="row">
    <?php foreach($menus as $menu): ?>
        <div class="col-md-4">
            <div class="card card-menu h-100">
                <?php 
// On définit l'image par défaut au cas où
$imageAffichage = 'default.jpg'; 

// On vérifie si image_url n'est pas vide dans la BDD
if (!empty($menu['image_url'])) {
    $imageAffichage = $menu['image_url'];
}
?>
<img src="assets/img/<?php echo $imageAffichage; ?>" loading="lazy" class="card-img-top" alt="Photo de <?php echo htmlspecialchars($menu['titre']); ?>" style="height: 200px; object-fit: cover;">
                
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($menu['titre']); ?></h5>
                    <p class="card-text text-muted"><?php echo htmlspecialchars($menu['description']); ?></p>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">Prix : <strong><?php echo $menu['prix_par_personne']; ?> €</strong> / pers</li>
                        <li class="list-group-item">Min. personnes : <?php echo $menu['min_personnes']; ?></li>
                    </ul>
                    <a href="detail_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-outline-primary w-100">Voir détails</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<section id="temoignages" class="container my-5">
    <h2 class="text-center mb-5" style="color: var(--vert-pro); font-weight: 700;">Ce que nos clients disent</h2>
    
    <div class="row g-4"> <div class="col-md-4">
            <div class="testimonial-card">
                <p class="fst-italic">"Un repas de Noël inoubliable, merci à l'équipe !"</p>
                <p class="fw-bold text-end mt-3">— Sophie D.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="testimonial-card">
                <p class="fst-italic">"Livraison rapide et plats encore bien chauds. Parfait pour nos réunions."</p>
                <p class="fw-bold text-end mt-3">— Marc L.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="testimonial-card">
                <p class="fst-italic">"Le buffet de printemps était d'une fraîcheur exceptionnelle. Tous nos invités ont adoré !"</p>
                <p class="fw-bold text-end mt-3">— Julie R.</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>