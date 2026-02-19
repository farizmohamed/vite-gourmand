<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

// Sécurité : Seul un utilisateur connecté peut accéder à cette page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$menu_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->execute([$menu_id]);
$menu = $stmt->fetch();

if (!$menu) {
    die("Menu introuvable.");
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Finaliser votre commande : <?php echo htmlspecialchars($menu['titre']); ?></h4>
            </div>
            <div class="card-body">
                <form action="confirmation.php" method="POST" id="orderForm">
                    <input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Nombre de personnes (Min: <?php echo $menu['min_personnes']; ?>)</label>
                            <input type="number" name="nb_personnes" id="nb_personnes" 
                                   class="form-control" min="<?php echo $menu['min_personnes']; ?>" 
                                   value="<?php echo $menu['min_personnes']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label>Ville de livraison</label>
                            <select name="ville" id="ville" class="form-select">
                                <option value="Bordeaux">Bordeaux (Frais: 0€)</option>
                                <option value="Hors-Bordeaux">Hors Bordeaux (+5€ + km)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Adresse complète</label>
                        <input type="text" name="adresse" class="form-control" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Date de livraison</label>
                            <input type="date" name="date_livraison" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Heure souhaitée</label>
                            <input type="time" name="heure_livraison" class="form-control" required>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Récapitulatif du prix :</strong>
                        <div id="detailPrix">Calcul en cours...</div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100">Confirmer la commande</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Petit script JS pour calculer le prix en temps réel comme demandé
function calculerPrix() {
    const prixUnitaire = <?php echo $menu['prix_par_personne']; ?>;
    const minPers = <?php echo $menu['min_personnes']; ?>;
    const nbPers = parseInt(document.getElementById('nb_personnes').value);
    const ville = document.getElementById('ville').value;

    let totalMenu = nbPers * prixUnitaire;
    let fraisLivraison = (ville === "Bordeaux") ? 0 : 5; // On simplifie pour l'exemple

    // Règle de réduction : -10% si nbPers >= minPers + 5
    if (nbPers >= minPers + 5) {
        totalMenu = totalMenu * 0.9;
        document.getElementById('detailPrix').innerHTML = `Prix réduit (-10%) : ${totalMenu.toFixed(2)}€ + Livraison : ${fraisLivraison}€ = <strong>${(totalMenu + fraisLivraison).toFixed(2)}€</strong>`;
    } else {
        document.getElementById('detailPrix').innerHTML = `Prix : ${totalMenu.toFixed(2)}€ + Livraison : ${fraisLivraison}€ = <strong>${(totalMenu + fraisLivraison).toFixed(2)}€</strong>`;
    }
}

document.getElementById('nb_personnes').addEventListener('input', calculerPrix);
document.getElementById('ville').addEventListener('change', calculerPrix);
calculerPrix();
</script>

<?php require_once 'includes/footer.php'; ?>