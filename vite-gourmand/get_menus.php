<?php
require_once 'includes/db.php';

$theme = isset($_GET['theme']) ? $_GET['theme'] : '';
$prix_max = isset($_GET['prix_max']) && $_GET['prix_max'] !== '' ? $_GET['prix_max'] : 999;

// On utilise 'prix_par_personne' car c'est le nom dans ta base
$sql = "SELECT * FROM menu WHERE prix_par_personne <= :prix_max";
$params = [':prix_max' => $prix_max];

if ($theme !== '') {
    $sql .= " AND theme = :theme";
    $params[':theme'] = $theme;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$menus = $stmt->fetchAll();

if (count($menus) > 0) {
    foreach ($menus as $menu) {
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                <img src="assets/img/<?php echo htmlspecialchars($menu['image_url']); ?>" 
                     class="card-img-top" 
                     style="height: 200px; object-fit: cover;">
                
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title fw-bold" style="color: var(--vert-pro);"><?php echo htmlspecialchars($menu['titre']); ?></h5>
                    <p class="card-text text-muted flex-grow-1 small"><?php echo htmlspecialchars($menu['description']); ?></p>
                    
                    <div class="mt-3">
                        <p class="fw-bold mb-1" style="color: var(--rouge-bordeaux); font-size: 1.2rem;">
                            <?php echo number_format($menu['prix_par_personne'], 2); ?> € / pers
                        </p>
                        <p class="text-secondary small">Min. personnes : <?php echo $menu['min_personnes']; ?></p>
                    </div>
                    
                    <a href="detail_menu.php?id=<?php echo $menu['id']; ?>" 
                       class="btn btn-outline-success w-100 mt-2" 
                       style="border-radius: 10px; font-weight: 600;">
                        Voir détails
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="col-12 text-center py-5"><p class="text-muted">Aucun menu trouvé.</p></div>';
}
?>