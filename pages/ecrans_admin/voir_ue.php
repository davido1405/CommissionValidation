<?php
require_once(__DIR__ . '/../../config/db.php');

// ID obligatoire
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    if (isset($_GET['json'])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'ID UE invalide']);
    } else {
        echo "<div class='text-danger'>ID UE invalide</div>";
    }
    exit;
}

$id_ue = (int) $_GET['id'];

// Récupération des infos UE
$stmt = $pdo->prepare("
    SELECT ue.*, 
           e.id_ens AS id_responsable,
           CONCAT(e.prenoms_ens, ' ', e.nom_ens) AS responsable,
           n.lib_niv_etu
    FROM ue
    LEFT JOIN enseignant e ON ue.id_ens = e.id_ens
    LEFT JOIN niveau_etude n ON ue.id_niv_etu = n.id_niv_etu
    WHERE ue.id_ue = ?
");


$stmt->execute([$id_ue]);
$ue = $stmt->fetch(PDO::FETCH_ASSOC);
$ue['id_ens'] = $ue['id_responsable']; // pour compatibilité JS


if (!$ue) {
    if (isset($_GET['json'])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'UE non trouvée']);
    } else {
        echo "<div class='text-danger'>UE non trouvée</div>";
    }
    exit;
}

if (isset($_GET['json'])) {
    //$ue['id_ens'] = $ue['id_responsable'];
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'ue' => $ue]);
    exit;
}
?>

<!-- Affichage HTML pour le modal -->
<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item"><strong>Code UE :</strong> <?= htmlspecialchars($ue['code_ue']) ?></li>
            <li class="list-group-item"><strong>Libellé :</strong> <?= htmlspecialchars($ue['lib_ue']) ?></li>
            <li class="list-group-item"><strong>Crédits :</strong> <?= (int)($ue['credit_ue'] ?? 0) ?> crédits</li>
            <li class="list-group-item"><strong>Semestre :</strong> <?= htmlspecialchars($ue['semestre'] ?? 'N/A') ?></li>
            <li class="list-group-item"><strong>Niveau :</strong> <?= htmlspecialchars($ue['lib_niv_etu'] ?? 'Non défini') ?></li>
            <li class="list-group-item"><strong>Responsable :</strong> <?= htmlspecialchars($ue['responsable'] ?? 'Non assigné') ?></li>
        </ul>
    </div>
</div>
