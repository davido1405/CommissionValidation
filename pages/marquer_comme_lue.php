<?php
require_once '../config/db.php'; // ajuste le chemin si nécessaire

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_util'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_msg'])) {
    $idMsg = intval($_POST['id_msg']);
    $idUtil = $_SESSION['id_util'];

    // Vérifie si ce message appartient bien à cet utilisateur (sécurité)
    $stmt = $pdo->prepare("SELECT id_util FROM message WHERE id_msg = ?");
    $stmt->execute([$idMsg]);
    $ownerId = $stmt->fetchColumn();

    if ($ownerId == $idUtil) {
        // Marquer comme lue
        $stmt = $pdo->prepare("UPDATE message SET statut = 'lue' WHERE id_msg = ?");
        $stmt->execute([$idMsg]);
    }
}

header("Location: ".$_SERVER['HTTP_REFERER']); // retour à la page précédente
exit;
