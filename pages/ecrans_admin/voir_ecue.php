<?php
// voir_ecue.php
require_once(__DIR__ . '/../../config/db.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$isJson = isset($_GET['json']) && $_GET['json'] == '1';

if (!$id) {
    if ($isJson) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'ID ECUE manquant']);
    } else {
        echo "<div class='text-danger'>ID ECUE manquant</div>";
    }
    exit;
}

$stmt = $pdo->prepare("SELECT ec.*, ue.lib_ue, ue.code_ue, CONCAT(e.prenoms_ens, ' ', e.nom_ens) AS enseignant FROM ecue ec LEFT JOIN ue ON ec.id_ue = ue.id_ue LEFT JOIN enseigner_ecue ee ON ec.id_ecue = ee.id_ecue LEFT JOIN enseignant e ON ee.id_ens = e.id_ens WHERE ec.id_ecue = ? ORDER BY ee.date_affectation DESC LIMIT 1");
$stmt->execute([$id]);
$ecue = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ecue) {
    if ($isJson) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => "ECUE introuvable"]);
    } else {
        echo "<div class='text-danger'>ECUE introuvable</div>";
    }
    exit;
}

if ($isJson) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'ecue' => $ecue]);
    exit;
}
?>

<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item"><strong>Code ECUE :</strong> <?= htmlspecialchars($ecue['code_ecue']) ?></li>
            <li class="list-group-item"><strong>Libellé :</strong> <?= htmlspecialchars($ecue['lib_ecue']) ?></li>
            <li class="list-group-item"><strong>UE associée :</strong> <?= htmlspecialchars($ecue['lib_ue'] . " ({$ecue['code_ue']})") ?></li>
            <li class="list-group-item"><strong>Semestre :</strong> <?= htmlspecialchars($ecue['semestre'] ?? 'N/A') ?></li>
            <li class="list-group-item"><strong>Année Académique :</strong> <?= htmlspecialchars($ecue['id_ac'] ?? 'N/A') ?></li>
            <li class="list-group-item"><strong>Enseignant :</strong> <?= htmlspecialchars($ecue['enseignant'] ?? 'Non assigné') ?></li>
        </ul>
    </div>
</div>
