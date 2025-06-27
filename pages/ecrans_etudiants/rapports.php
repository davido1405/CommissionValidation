<?php
require_once '../config/db.php';
require_once '../pages/notifications.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['id_util'])) {
    header('Location: ../login.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lien = filter_var($_POST['lien_rapport'], FILTER_VALIDATE_URL);
    $num_etu = intval($_POST['num_etu']);

    if ($lien && $num_etu) {
        $stmt = $pdo->prepare("INSERT INTO rapport_etudiant (nom_rapport, dte_rapport, lien_rapport, etat_validation, num_etu)
            VALUES ('Rapport soumis', NOW(), ?, 'déposé', ?)");
        $stmt->execute([$lien, $num_etu]);
        envoyerMessage($pdo, $idUtil, "Votre rapport a été bien déposé.", 'succès');

        // Redirection après insertion
        header('Location: ' . $_SERVER['PHP_SELF']); // ou vers ta page tableau de bord
        exit;
    }

    $error = "Lien invalide.";
}
?>





<div class="dashboard-card">
    <h5 class="mb-4"><i class="fas fa-cloud-upload-alt me-2"></i>Soumettre un lien de rapport</h5>

    <!-- Formulaire pour ajouter un lien -->
    <form method="post" action="traitement_ajout_lien.php" class="mb-4">
        <div class="input-group">
            <input type="url" name="lien_rapport" class="form-control" placeholder="Collez ici le lien de votre rapport (Google Drive, OneDrive...)" required>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-1"></i> Soumettre
            </button>
        </div>
        <input type="hidden" name="num_etu" value="<?= $etudiant['num_etu'] ?>">
    </form>

    <!-- Liste des rapports envoyés -->
    <div class="mt-4">
        <h6>Rapports envoyés :</h6>
        <?php if (!empty($rapports)): ?>
            <ul class="list-group">
                <?php foreach ($rapports as $rapport): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="<?= htmlspecialchars($rapport['lien_rapport']) ?>" target="_blank" class="text-decoration-none fw-medium">
                                <?= htmlspecialchars($rapport['nom_rapport']) ?>
                            </a>
                            <br>
                            <small class="text-muted">Soumis le <?= date('d/m/Y', strtotime($rapport['dte_rapport'])) ?></small>
                        </div>
                        <span class="status-badge 
                            <?php
                                switch ($rapport['etat_validation']) {
                                    case 'validé': echo 'status-approved'; break;
                                    case 'rejeté': echo 'status-rejected'; break;
                                    case 'soutenance programmée': echo 'status-final'; break;
                                    default: echo 'status-pending';
                                }
                            ?>">
                            <?= ucfirst($rapport['etat_validation']) ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="text-muted small">Aucun rapport soumis pour l'instant.</div>
        <?php endif; ?>
    </div>
</div>
