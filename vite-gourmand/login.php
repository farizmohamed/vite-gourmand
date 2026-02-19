<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

$error = "";

// On vérifie si le formulaire a été envoyé
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // On cherche l'utilisateur dans la table par son email
    $sql = "SELECT * FROM utilisateur WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérification : utilisateur trouvé ET mot de passe hashé correct
    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // On enregistre les infos en session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom'] = $user['nom'];
        
        // Redirection vers l'accueil
        header('Location: index.php');
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-header bg-success text-white text-center py-3">
                <h4>Connexion</h4>
            </div>
            <div class="card-body p-4">
                <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success">Compte créé avec succès !</div>
                <?php endif; ?>

                <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 btn-lg">Se connecter</button>
                </form>
                <div class="text-center mt-3">
                    <p>Pas encore de compte ? <a href="inscription.php">S'inscrire ici</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>