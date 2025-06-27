<?php
$stmt = $pdo->prepare("
    SELECT r.id_rapport, r.nom_rapport, r.dte_rapport, r.theme_mem, r.etat_validation,
           e.nom_etu, e.prenom_etu, ne.lib_niv_etu
    FROM rapport_etudiant r
    JOIN etudiant e ON e.num_etu = r.num_etu
    JOIN inscrire i ON i.num_etu = e.num_etu
    JOIN niveau_etude ne ON ne.id_niv_etu = i.id_niv_etu
    WHERE NOT EXISTS (
        SELECT 1 FROM valider v WHERE v.id_rapport = r.id_rapport AND v.id_ens = ?
    )
    ORDER BY r.dte_rapport DESC
");
$stmt->execute([$enseignant['id_ens']]);
$rapportsAVerifier = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="dashboard-card">
    <h5><i class="fas fa-file-signature me-2"></i>Rapports à évaluer</h5>

    <?php if (empty($rapportsAVerifier)): ?>
        <p class="text-muted">Aucun rapport en attente d’évaluation.</p>
    <?php else: ?>
        <?php foreach ($rapportsAVerifier as $rapport): ?>
            <div class="report-card mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>Rapport de <?= htmlspecialchars($rapport['prenom_etu'] . ' ' . $rapport['nom_etu']) ?></strong><br>
                        <small class="text-muted"><?= htmlspecialchars($rapport['lib_niv_etu']) ?> - <?= htmlspecialchars($rapport['theme_mem']) ?></small>
                    </div>
                    <div class="status-badge status-pending">En attente</div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
