<?php
require_once(__DIR__ . '/../../config/db.php');
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID UE invalide']);
    exit;
}

$id_ue = (int)$_GET['id'];

try {
    // Supprimer les ECUE liées à l'UE
    $pdo->prepare("DELETE FROM ecue WHERE id_ue = ?")->execute([$id_ue]);

    // Supprimer l'UE
    $stmt = $pdo->prepare("DELETE FROM ue WHERE id_ue = ?");
    $stmt->execute([$id_ue]);

    echo json_encode(['status' => 'success', 'message' => 'UE et ECUEs associées supprimées avec succès.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur serveur : ' . $e->getMessage()]);
}
