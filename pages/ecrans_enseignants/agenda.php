<div class="dashboard-card">
    <h5><i class="fas fa-calendar-alt me-2"></i>Agenda</h5>

    <?php if (empty($agenda)): ?>
        <p class="text-muted">Aucun événement à venir.</p>
    <?php else: ?>
        <?php foreach ($agenda as $event): ?>
            <div class="calendar-event">
                <h6><?= htmlspecialchars($event['titre_event']) ?></h6>
                <p>
                    <i class="fas fa-calendar-day me-2"></i>
                    <?= ucfirst(strftime('%A %d %B', strtotime($event['date_event']))) ?>
                    - <?= date('H\hi', strtotime($event['heure_event'])) ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
