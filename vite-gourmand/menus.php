<?php
require_once 'includes/db.php';
require_once 'includes/header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4" style="color: var(--vert-pro); font-weight: 700; border-left: 5px solid var(--rouge-bordeaux); padding-left: 15px;">
        Tous nos menus traiteurs
    </h2>

    <div class="card mb-5 p-4 shadow-sm" style="border-top: 5px solid var(--vert-pro); border-radius: 15px; background-color: #ffffff;">
        <form id="filterForm" class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-bold" style="color: var(--vert-pro);">Thème Gastronomique</label>
                <select name="theme" id="theme" class="form-select border-success">
                    <option value="">Tous les thèmes</option>
                    <option value="Noel">🎄 Noël</option>
                    <option value="Printemps">🌸 Printemps</option>
                    <option value="Classique">🍽️ Classique</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold" style="color: var(--vert-pro);">Budget Max (€)</label>
                <input type="number" name="prix_max" id="prix_max" class="form-control border-success" placeholder="Ex: 25">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="button" onclick="loadMenus()" class="btn w-100 fw-bold text-white shadow-sm" style="background: linear-gradient(135deg, var(--rouge-bordeaux) 0%, #a4161a 100%); border: none; border-radius: 10px; padding: 10px;">
                    Actualiser la carte
                </button>
            </div>
        </form>
    </div>

    <div id="menuContainer" class="row g-4">
        <div class="text-center py-5">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="mt-2 text-muted">Chargement de nos délices...</p>
        </div>
    </div>
</div>

<script>
// Fonction pour charger les menus sans recharger la page
function loadMenus() {
    const theme = document.getElementById('theme').value;
    const prix = document.getElementById('prix_max').value;
    
    // On appelle get_menus.php qui renvoie le HTML des cartes
    fetch(`get_menus.php?theme=${theme}&prix_max=${prix}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('menuContainer').innerHTML = data;
        })
        .catch(error => {
            console.error('Erreur:', error);
            document.getElementById('menuContainer').innerHTML = '<p class="text-center text-danger">Une erreur est survenue lors du chargement.</p>';
        });
}

// Charger les menus automatiquement au démarrage
document.addEventListener("DOMContentLoaded", loadMenus);
</script>

<?php require_once 'includes/footer.php'; ?>