<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

// Sécurité : Vérifier si l'utilisateur est un employé ou admin
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'employe' && $_SESSION['role'] !== 'admin')) {
    echo "<div class='alert alert-danger'>Accès réservé au personnel.</div>";
    require_once 'includes/footer.php';
    exit();
}

// Logique de mise à jour du statut
if (isset($_POST['update_status'])) {
    $commande_id = $_POST['commande_id'];
    $nouveau_statut = $_POST['statut'];
    
    $update = $pdo->prepare("UPDATE commande SET statut = ? WHERE id = ?");
    $update->execute([$nouveau_statut, $commande_id]);
    echo "<div class='alert alert-success'>Statut mis à jour avec succès !</div>";
}

// Récupération de toutes les commandes avec les infos clients
$sql = "SELECT c.*, u.nom, u.prenom, m.titre 
        FROM commande c 
        JOIN utilisateur u ON c.utilisateur_id = u.id 
        JOIN menu m ON c.menu_id = m.id 
        ORDER BY c.date_commande DESC";
$stmt = $pdo->query($sql);
$all_orders = $stmt->fetchAll();
?>

<h2>Gestion des Commandes (Espace Personnel)</h2>

<table class="table table-hover mt-4">
    <thead class="table-dark">
        <tr>
            <th>Client</th>
            <th>Menu</th>
            <th>Total</th>
            <th>Statut Actuel</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_orders as $order): ?>
        <tr>
            <td><?php echo htmlspecialchars($order['nom'] . " " . $order['prenom']); ?></td>
            <td><?php echo htmlspecialchars($order['titre']); ?></td>
            <td><?php echo $order['prix_total']; ?> €</td>
            <td>
                <span class="badge bg-primary"><?php echo $order['statut']; ?></span>
            </td>
            <td>
                <form method="POST" class="d-flex gap-2">
                    <input type="hidden" name="commande_id" value="<?php echo $order['id']; ?>">
                    <select name="statut" class="form-select form-select-sm">
                        <option value="accepté" <?php if($order['statut'] == 'accepté') echo 'selected'; ?>>Accepter</option>
                        <option value="en préparation" <?php if($order['statut'] == 'en préparation') echo 'selected'; ?>>Préparation</option>
                        <option value="en cours de livraison" <?php if($order['statut'] == 'en cours de livraison') echo 'selected'; ?>>Livraison</option>
                        <option value="livré" <?php if($order['statut'] == 'livré') echo 'selected'; ?>>Livré</option>
                        <option value="terminée" <?php if($order['statut'] == 'terminée') echo 'selected'; ?>>Terminer</option>
                    </select>
                    <button type="submit" name="update_status" class="btn btn-sm btn-warning">OK</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'includes/footer.php'; ?>