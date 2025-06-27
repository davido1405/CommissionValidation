<?php
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$idUtil = $_SESSION['id_util'] ?? null;
if (!$idUtil) {
    header("Location: ../login.php");
    exit;
}

// Récupérer les infos de l'étudiant connecté
$stmt = $pdo->prepare("
    SELECT u.login_util AS email, e.nom_etu, e.prenom_etu
    FROM utilisateur u
    JOIN etudiant e ON u.login_util = e.login_etu
    WHERE u.id_util = ?
");
$stmt->execute([$idUtil]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newNom = trim($_POST['nom']);
    $newPrenom = trim($_POST['prenom']);
    $newEmail = trim($_POST['email']);
    $newPass = trim($_POST['password']);

    // Mettre à jour le login (email)
    $stmt = $pdo->prepare("UPDATE utilisateur SET login_util = ? WHERE id_util = ?");
    $stmt->execute([$newEmail, $idUtil]);

    // Mettre à jour les infos dans etudiant
    $stmt = $pdo->prepare("UPDATE etudiant SET nom_etu = ?, prenom_etu = ?, login_etu = ? WHERE login_etu = ?");
    $stmt->execute([$newNom, $newPrenom, $newEmail, $user['email']]);

    // Mettre à jour le mot de passe si fourni
    if (!empty($newPass)) {
        $stmt = $pdo->prepare("UPDATE utilisateur SET mdp_util = ? WHERE id_util = ?");
        $stmt->execute([$newPass, $idUtil]);
    }

    // Rafraîchir les données
    header("Location: ?page=parametre&success=1");
    exit;
}
?>


<div class="dashboard-card">
    <h5>Paramètres</h5>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Modifications enregistrées avec succès.</div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="prenom" class="form-control mb-2" placeholder="Prénom" value="<?= htmlspecialchars($user['prenom_etu']) ?>">
            <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?= htmlspecialchars($user['nom_etu']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Mettre à jour
        </button>
    </form>
</div>

