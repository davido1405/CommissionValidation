<?php
$stmt = $pdo->prepare("
    SELECT 
        j.role_jury,
        j.statut,
        e.nom_etu,
        e.prenom_etu
    FROM jury_etudiant j
    JOIN etudiant e ON j.num_etu = e.num_etu
    WHERE j.id_ens = ?
    ORDER BY j.statut DESC
");
$stmt->execute([$enseignant['id_ens']]);
$jurys = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="dashboard-card">
    <h5><i class="fas fa-users me-2"></i>Mes jurys</h5>

    <?php if (empty($jurys)): ?>
        <p class="text-muted">Aucun jury pour le moment.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($jurys as $jury): ?>
                <?php
                    $statut = strtolower($jury['statut']);
                    $badgeClass = match ($statut) {
                        'prévu' => 'bg-info text-dark',
                        'confirmé' => 'bg-success',
                        'en attente' => 'bg-warning text-dark',
                        'annulé' => 'bg-danger',
                        default => 'bg-secondary'
                    };
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($jury['role_jury']) ?> — <?= htmlspecialchars($jury['nom_etu'] . ' ' . $jury['prenom_etu']) ?>
                    <span class="badge <?= $badgeClass ?>"><?= ucfirst($jury['statut']) ?></span>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
