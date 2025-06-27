<div class="dashboard-card">
    <h5>Comptes rendus</h5>

    <?php if (empty($comptesRendus)): ?>
        <p class="text-muted">Aucun compte rendu disponible.</p>
    <?php else: ?>
        <ul class="list-group mb-4">
            <?php foreach ($comptesRendus as $cr): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($cr['nom_rapport']) ?> – <?= htmlspecialchars($cr['prenom_etu'] . ' ' . $cr['nom_etu']) ?></strong><br>
                    <small class="text-muted">Date : <?= date('d/m/Y', strtotime($cr['date_rendre'])) ?></small><br>
                    <span class="text-muted"><?= nl2br(htmlspecialchars($cr['contenu'])) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- ✅ Formulaire pour ajouter un nouveau compte rendu -->
    <form action="ajouter_compte_rendu.php" method="POST" class="mt-3">
        <div class="mb-2">
            <label for="id_rapport" class="form-label">Rapport concerné</label>
            <select name="id_rapport" class="form-select" required>
                <option value="">-- Sélectionnez un rapport --</option>
                <?php foreach ($rapportsAVerifier as $r): ?>
                    <option value="<?= $r['id_rapport'] ?>">
                        <?= htmlspecialchars($r['theme_mem']) ?> – <?= htmlspecialchars($r['prenom_etu'] . ' ' . $r['nom_etu']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label for="contenu" class="form-label">Contenu du compte rendu</label>
            <textarea class="form-control" name="contenu" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
    </form>
</div>
