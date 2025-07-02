<?php
require_once '../../config/db.php';
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID manquant']);
    exit;
}

$id = intval($_GET['id']);

try {
    // Infos principales
    $stmt = $pdo->prepare("SELECT * FROM niveau_etude WHERE id_niv_etu = ?");
    $stmt->execute([$id]);
    $niveau = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$niveau) {
        echo json_encode(['error' => 'Niveau introuvable']);
        exit;
    }

    // Étudiants inscrits
    $stmt = $pdo->prepare("SELECT COUNT(DISTINCT num_etu) FROM inscrire WHERE id_niv_etu = ?");
    $stmt->execute([$id]);
    $niveau['nb_etudiants'] = (int)$stmt->fetchColumn();

    // UE
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM ue WHERE id_niv_etu = ?");
    $stmt->execute([$id]);
    $niveau['nb_ue'] = (int)$stmt->fetchColumn();

    // Taux fictif
    $niveau['success_rate'] = rand(70, 95);

    // Description/prerequis fallback
    $niveau['description'] = $niveau['description'] ?? null;
    $niveau['prerequisites'] = $niveau['prerequisites'] ?? null;
    $niveau['nb_specialites'] = null; // clé définie pour éviter problème JS
    echo json_encode($niveau);



    echo json_encode($niveau);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur serveur : ' . $e->getMessage()]);
}
?>