<?php
require_once(__DIR__ . '/../../config/db.php');
header('Content-Type: application/json');

// Vérifie si l'ID est présent et valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID ECUE invalide.']);
    exit;
}

$id_ecue = (int) $_GET['id'];

try {
    // Commence une transaction
    $pdo->beginTransaction();

    // Supprimer d'abord les dépendances (ex. : enseigner_ecue, ecue_specialite)
    $pdo->prepare("DELETE FROM enseigner_ecue WHERE id_ecue = ?")->execute([$id_ecue]);
    $pdo->prepare("DELETE FROM ecue_specialite WHERE id_ecue = ?")->execute([$id_ecue]);

    // Puis supprimer l’ECUE
    $stmt = $pdo->prepare("DELETE FROM ecue WHERE id_ecue = ?");
    $stmt->execute([$id_ecue]);

    // Valider la transaction
    $pdo->commit();

    echo json_encode(['status' => 'success', 'message' => 'ECUE supprimée avec succès.']);
} catch (Exception $e) {
    // En cas d’erreur, annuler la transaction
    $pdo->rollBack();
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la suppression : ' . $e->getMessage()]);
}
?>