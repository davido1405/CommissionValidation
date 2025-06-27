<?php
$evenements = [];

if (isset($etudiant['num_etu'])) {
    $stmt = $pdo->prepare("SELECT titre_evt, date_evt FROM evenement_etudiant WHERE num_etu = ? ORDER BY date_evt ASC");
    $stmt->execute([$etudiant['num_etu']]);
    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<div class="dashboard-card">
    <h5>Planification</h5>

    <?php if (!empty($evenements)): ?>
        <?php foreach ($evenements as $evt): ?>
            <div class="calendar-event">
                <h6><?= htmlspecialchars($evt['titre_evt']) ?></h6>
                <p><i class="fas fa-calendar-alt me-2"></i>
                    <?= date('l d F Y - H\hi', strtotime($evt['date_evt'])) ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-muted">Aucun événement planifié pour le moment.</div>
    <?php endif; ?>
</div>

