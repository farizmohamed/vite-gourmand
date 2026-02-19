<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

// On récupère l'ID du menu depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM menu WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$menu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$menu) {
    echo "<div class='alert alert-danger'>Menu introuvable.</div>";
} else {
?>
    <div class="row">
        <div class="col-md-6">
            <?php 
// 1. On définit l'image par défaut
$imageAffichage = 'default.jpg'; 

// 2. On vérifie si une image existe dans la BDD pour ce menu précis
if (!empty($menu['image_url'])) {
    $imageAffichage = $menu['image_url'];
}
?>

<img src="assets/img/<?php echo $imageAffichage; ?>" 
     class="img-fluid rounded shadow" 
     alt="Photo de <?php echo htmlspecialchars($menu['titre']); ?>"
     style="max-height: 400px; width: 100%; object-fit: cover;">
        </div>
        <div class="col-md-6">
            <h1 class="display-4"><?php echo htmlspecialchars($menu['titre']); ?></h1>
            <p class="lead text-muted"><?php echo htmlspecialchars($menu['description']); ?></p>
            
            <div class="bg-light p-4 rounded mb-4">
                <ul class="list-unstyled">
                    <li><strong>Thème :</strong> <?php echo htmlspecialchars($menu['theme']); ?></li>
                    <li><strong>Régime :</strong> <?php echo htmlspecialchars($menu['regime']); ?></li>
                    <li><strong>Prix :</strong> <?php echo $menu['prix_par_personne']; ?> € / personne</li>
                    <li><strong>Minimum :</strong> <?php echo $menu['min_personnes']; ?> personnes</li>
                </ul>
            </div>

            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="commander.php?id=<?php echo $menu['id']; ?>" class="btn btn-primary btn-lg w-100">Commander ce menu</a>
            <?php else: ?>
                <div class="alert alert-info">
                    Veuillez vous <a href="login.php">connecter</a> ou vous <a href="inscription.php">inscrire</a> pour commander.
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
}
require_once 'includes/footer.php';
?>