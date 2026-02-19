<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }

$user_id = $_SESSION['user_id'];

// Récupérer les commandes de l'utilisateur avec le titre du menu
$stmt = $pdo->prepare("
    SELECT c.*, m.titre 
    FROM commande c 
    JOIN menu m ON c.menu_id = m.id 
    WHERE c.utilisateur_id = ? 
    ORDER BY c.date_commande DESC
");
$stmt->execute([$user_id]);
$commandes = $stmt->fetchAll();
?>

<div class="container mt-5">
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_GET['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h3 class="mb-4" style="color: var(--vert-pro); font-weight: 700;">Mon Espace Personnel</h3>

    <div class="card mb-4 shadow-sm border-0" style="border-radius: 15px; border-left: 5px solid var(--vert-pro);">
        <div class="card-body d-flex align-items-center">
            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 65px; height: 65px; font-size: 28px; font-weight: bold;">
                <?php echo strtoupper(substr($_SESSION['user_nom'] ?? 'F', 0, 1)); ?>
            </div>
            <div class="ms-4">
                <h4 class="mb-0" style="color: var(--vert-pro);">Bonjour, <?php echo htmlspecialchars($_SESSION['user_nom'] ?? 'Fariz Mohamed'); ?> !</h4>
                <p class="text-muted mb-0">Ravi de vous revoir chez Vite & Gourmand</p>
            </div>
        </div>
    </div>

    <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header bg-white py-3 border-0">
            <h4 class="card-title mb-0" style="color: var(--rouge-bordeaux); font-weight: 600;">📦 Historique de mes commandes</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr style="color: var(--vert-pro);">
                            <th class="ps-4">Date Livraison</th>
                            <th>Menu</th>
                            <th class="text-center">Convives</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Statut</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commandes as $cmd): 
                            $badgeClass = 'bg-info text-dark';
                            if ($cmd['statut'] == 'en_attente') $badgeClass = 'bg-warning text-dark';
                            if ($cmd['statut'] == 'confirme') $badgeClass = 'bg-success text-white';
                            
                            $statutTexte = str_replace('_', ' ', $cmd['statut']);
                        ?>
                        <tr>
                            <td class="ps-4"><?php echo date('d/m/Y', strtotime($cmd['date_livraison'])); ?></td>
                            <td class="fw-bold"><?php echo htmlspecialchars($cmd['titre']); ?></td>
                            <td class="text-center"><?php echo $cmd['nb_personnes']; ?></td>
                            <td class="text-center fw-bold" style="color: var(--rouge-bordeaux);">
                                <?php echo number_format($cmd['prix_total'], 2); ?> €
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill <?php echo $badgeClass; ?> px-3 py-2 text-capitalize">
                                    <?php echo htmlspecialchars($statutTexte); ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="menus.php" class="btn btn-sm btn-outline-success rounded-pill d-block mb-1">Commander à nouveau</a>
                                
                                <?php if ($cmd['statut'] == 'en_attente'): ?>
                                    <a href="annuler_commande.php?id=<?php echo $cmd['id']; ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill d-block"
                                       onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
                                       Annuler
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if (empty($commandes)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <p class="mb-2">Vous n'avez pas encore passé de commande.</p>
                                    <a href="menus.php" class="btn btn-primary">Découvrir nos menus</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.table thead th {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-bottom: 2px solid #f8f9fa;
}
.table-hover tbody tr:hover {
    background-color: rgba(26, 71, 42, 0.02);
}
</style>

<?php require_once 'includes/footer.php'; ?>