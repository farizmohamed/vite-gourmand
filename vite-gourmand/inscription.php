<?php require_once 'includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0 mt-5">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4>Créer un compte client</h4>
            </div>
            <div class="card-body p-4">
                <form action="traitement_inscription.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="nom" class="form-control" placeholder="Ex: Jean Dupont" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Adresse Email</label>
                        <input type="email" name="email" class="form-control" placeholder="exemple@mail.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">S'inscrire</button>
                </form>
                <div class="text-center mt-3">
                    <p>Déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>