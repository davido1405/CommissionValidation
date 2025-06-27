<?php
$jury = [];

if (isset($etudiant['num_etu'])) {
    $stmt = $pdo->prepare("
        SELECT j.role_jury, j.statut, e.nom_ens, e.prenoms_ens
        FROM jury_etudiant j
        JOIN enseignant e ON j.id_ens = e.id_ens
        WHERE j.num_etu = ?
    ");
    $stmt->execute([$etudiant['num_etu']]);
    $jury = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<div class="dashboard-card">
    <h5>Mon jury</h5>
    <ul class="list-group">
        <?php if (!empty($jury)): ?>
            <?php foreach ($jury as $membre): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($membre['role_jury']) ?> : <?= htmlspecialchars($membre['prenoms_ens'] . ' ' . $membre['nom_ens']) ?>
                    <?php
                        $badgeClass = match (strtolower($membre['statut'])) {
                            'validé' => 'bg-success',
                            'confirmé' => 'bg-success',
                            'en attente' => 'bg-warning text-dark',
                            'rejeté' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($membre['statut']) ?></span>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item text-muted">Aucun jury assigné pour le moment.</li>
        <?php endif; ?>
    </ul>
</div>

