<?php
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$idUtil = $_SESSION['id_util'] ?? null;
if (!$idUtil) {
    header("Location: ../login.php");
    exit;
}

// Récupérer les messages liés à l'enseignant connecté
$stmt = $pdo->prepare("
    SELECT m.id_msg, m.contenu_msg, m.date_msg, m.type_msg, m.statut, u.login_util
    FROM message m
    JOIN utilisateur u ON m.id_util = u.id_util
    WHERE m.id_util = ? and m.statut=?
    ORDER BY m.date_msg DESC
");

$stmt->execute([$idUtil,"non_lue"]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT COUNT(*) FROM message WHERE id_util = ? AND statut = ?");
$stmt->execute([$idUtil,"non_lue"]);
$nbMessagesNonLus = $stmt->fetchColumn();

?>

<div class="dashboard-card">
    <h5>Mes messages</h5>
    <?php if (count($messages) > 0): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="comment-item <?= ($msg['statut'] ?? '') === 'non_lue' ? 'bg-light' : '' ?>">
                <div class="comment-header">
                    <strong><?= ucfirst($msg['type_msg'] ?? 'info') ?></strong>

                    <span class="text-muted small"><?= date('d/m/Y à H:i', strtotime($msg['date_msg'])) ?></span>
                </div>
                <div class="comment-body"><?= nl2br(htmlspecialchars($msg['contenu_msg'])) ?></div>
                <form method="POST" action="../pages/marquer_comme_lue.php">
                    <input type="hidden" name="id_msg" value="<?= $msg['id_msg'] ?? 0 ?>">
                    <button class="btn btn-sm btn-outline-secondary">Marquer comme lue</button>
                </form>

            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="text-muted">Aucun message pour le moment.</div>
    <?php endif; ?>
</div>
