<?php
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$idUtil = $_SESSION['id_util'] ?? null;
if (!$idUtil) {
    header("Location: ../login.php");
    exit;
}

// Récupérer les messages non lus avec expéditeur
$stmt = $pdo->prepare("
    SELECT m.id_msg, m.contenu_msg, m.date_msg, m.type_msg, m.statut, u.login_util AS expediteur
    FROM message m
    LEFT JOIN utilisateur u ON m.id_expediteur = u.id_util
    WHERE m.id_util = ? AND m.statut = ?
    ORDER BY m.date_msg DESC
");
$stmt->execute([$idUtil, "non_lue"]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Nombre de messages non lus
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM message WHERE id_util = ? AND statut = ?");
$stmtCount->execute([$idUtil, "non_lue"]);
$nbMessagesNonLus = $stmtCount->fetchColumn();
?>

<div class="dashboard-card">
    <h5>Mes messages (<?= $nbMessagesNonLus ?> non lus)</h5>

    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="comment-item bg-light">
                <div class="comment-header d-flex justify-content-between">
                    <div>
                        <strong><?= ucfirst(htmlspecialchars($msg['type_msg'] ?? 'Info')) ?></strong>
                        <?php if (!empty($msg['expediteur'])): ?>
                            <span class="text-muted small ms-2">de <?= htmlspecialchars($msg['expediteur']) ?></span>
                        <?php endif; ?>
                    </div>
                    <span class="text-muted small"><?= date('d/m/Y à H:i', strtotime($msg['date_msg'])) ?></span>
                </div>
                <div class="comment-body mt-2"><?= nl2br(htmlspecialchars($msg['contenu_msg'])) ?></div>

                <form method="POST" action="../pages/marquer_comme_lue.php" class="mt-2">
                    <input type="hidden" name="id_msg" value="<?= (int)$msg['id_msg'] ?>">
                    <button class="btn btn-sm btn-outline-secondary">Marquer comme lue</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-muted">Aucun message non lu pour le moment.</div>
    <?php endif; ?>
</div>
