<?php
session_start();
require_once '../../config/db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['id_util'])) {
    echo json_encode(['error' => 'Session expirée.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $numEtu = intval($_POST['id']);

    try {
        $stmt = $pdo->prepare("SELECT login_etu FROM etudiant WHERE num_etu = ?");
        $stmt->execute([$numEtu]);
        $login = $stmt->fetchColumn();

        if ($login) {
            $pdo->prepare("DELETE FROM inscrire WHERE num_etu = ?")->execute([$numEtu]);
            $pdo->prepare("DELETE FROM utilisateur WHERE login_util = ?")->execute([$login]);
            $pdo->prepare("DELETE FROM etudiant WHERE num_etu = ?")->execute([$numEtu]);

            echo json_encode(['success' => '🗑️ Étudiant supprimé avec succès.']);
            exit;
        } else {
            echo json_encode(['error' => 'Étudiant introuvable.']);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur : ' . $e->getMessage()]);
        exit;
    }
}

echo json_encode(['error' => 'Requête invalide.']);
