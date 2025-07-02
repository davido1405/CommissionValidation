<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); // Ne pas afficher les erreurs dans la réponse
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug_suspension.log');


require_once (__DIR__ . '/../../config/db.php');
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id_util'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Non autorisé']);
    exit;
}

$id_ens = isset($_POST['id_ens']) ? (int)$_POST['id_ens'] : null;
$action = $_POST['action'] ?? null;
$raison = $_POST['raison'] ?? null;

if (!$id_ens || !in_array($action, ['suspendre', 'reactiver'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Paramètres invalides']);
    exit;
}

file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " Début action: id_ens=$id_ens, action=$action, raison=" . ($raison ?? 'null') . "\n", FILE_APPEND);

try {
    if ($action === 'suspendre') {
        if (empty(trim($raison))) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'La raison de suspension est obligatoire']);
            exit;
        }

        // Mise à jour statut enseignant (valeurs correctes : Actif, Inactif, Suspendu)
        $stmt = $pdo->prepare("UPDATE enseignant SET statut_ens = 'Suspendu' WHERE id_ens = ?");
        $stmt->execute([$id_ens]);
        file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " statut enseignant suspendu OK\n", FILE_APPEND);

        // Insertion suspension
        $stmt = $pdo->prepare("INSERT INTO suspension_enseignant (id_ens, date_debut, raison, statut) VALUES (?, NOW(), ?, 'suspendu')");
        $stmt->execute([$id_ens, $raison]);
        file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " insertion suspension OK\n", FILE_APPEND);

        echo json_encode(['status' => 'success', 'message' => 'Enseignant suspendu avec succès.']);
        exit;

    } elseif ($action === 'reactiver') {
        // Mise à jour statut enseignant
        $stmt = $pdo->prepare("UPDATE enseignant SET statut_ens = 'Actif' WHERE id_ens = ?");
        $stmt->execute([$id_ens]);
        file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " statut enseignant réactivé OK\n", FILE_APPEND);

        // Recherche suspension en cours (statut suspendu)
        $stmt = $pdo->prepare("SELECT id_suspension FROM suspension_enseignant WHERE id_ens = ? AND statut = 'suspendu' ORDER BY date_debut DESC LIMIT 1");
        $stmt->execute([$id_ens]);
        $id_suspension = $stmt->fetchColumn();

        if ($id_suspension) {
            $stmt = $pdo->prepare("UPDATE suspension_enseignant SET date_fin = NOW(), statut = 'active' WHERE id_suspension = ?");
            $stmt->execute([$id_suspension]);
            file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " suspension clôturée OK\n", FILE_APPEND);
        } else {
            file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " aucune suspension en cours trouvée\n", FILE_APPEND);
        }

        echo json_encode(['status' => 'success', 'message' => 'Enseignant réactivé avec succès.']);
        exit;
    }
} catch (PDOException $e) {
    file_put_contents(__DIR__ . '/debug_suspension.log', date('Y-m-d H:i:s') . " Erreur serveur : " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erreur serveur : ' . $e->getMessage()]);
    exit;
}
?>