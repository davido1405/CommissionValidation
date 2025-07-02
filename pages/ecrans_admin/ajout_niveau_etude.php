<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../../config/db.php';
session_start();

header('Content-Type: application/json');

// Vérifier session utilisateur etc...

$code = $_POST['code'] ?? null;
$lib_niv_etu = $_POST['lib_niv_etu'] ?? null;
$cycle = $_POST['cycle'] ?? null;
$duree = $_POST['duree'] ?? null;
$credits = $_POST['credits'] ?? null;
$ordre = $_POST['ordre'] ?? null;
$actif = isset($_POST['actif']) && $_POST['actif'] == 1 ? 1 : 0;

// Validation simple côté serveur
if (!$code || !$lib_niv_etu || !$cycle || !$duree || !$credits) {
    echo json_encode(['success' => false, 'message' => 'Champs obligatoires manquants']);
    exit;
}

try {
    $sql = "INSERT INTO niveau_etude (code, lib_niv_etu, cycle, duree, credits, actif) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$code, $lib_niv_etu, $cycle, $duree, $credits, $actif]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur base de données']);
}
?>