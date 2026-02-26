<?php
// 1. LOGIQUE (PHP)
require_once 'includes/db.php';
require_once 'includes/header.php'; 

$sql = "SELECT * FROM menu ORDER BY id DESC LIMIT 3";
$stmt = $pdo->query($sql);
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container mt-4">
    <div class="p-5 mb-4 rounded-3 text-center hero">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenue chez Vite & Gourmand</h1>
            <p class="col-md-8 fs-4 mx-auto">Découvrez nos menus traiteurs. Cuisinés avec passion.</p>
            <a class="btn btn-primary btn-lg" href="menus.php">Voir tous les menus</a>
        </div>
    </div>

    <h2 class="mb-4 text-center">Nos Menus du moment</h2>
    <div class="row">
        <?php foreach($menus as $menu): ?>
            <div class="col-md-4 mb-4">
                <div class="card card-menu h-100">
                    <?php $img = !empty($menu['image_url']) ? htmlspecialchars($menu['image_url']) : 'default.jpg'; ?>
                    <img src="assets/img/<?php echo $img; ?>" class="card-img-top" alt="Menu">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($menu['titre']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($menu['description']); ?></p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">Prix : <strong><?php echo number_format($menu['prix_par_personne'], 2); ?> €</strong></li>
                        </ul>
                        <a href="detail_menu.php?id=<?php echo (int)$menu['id']; ?>" class="btn btn-outline-primary w-100">Détails</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <section id="temoignages" class="container my-5">
        <h2 class="text-center mb-5" style="color: var(--vert-pro); font-weight: 700;">Ce que nos clients disent</h2>
        <div class="row g-4">
            <div class="col-md-4">
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
</main>

<?php require_once 'includes/footer.php'; ?>

