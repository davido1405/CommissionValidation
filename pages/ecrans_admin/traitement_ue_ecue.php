<?php
require_once(__DIR__ . '/../../config/db.php');
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['id_util'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expirée.']);
    exit;
}

$mode = $_POST['mode_formulaire'] ?? '';
$date_now = date('Y-m-d');

try {
    if ($mode === 'ajout_ue') {
        // Données UE
        $code = $_POST['code_ue'] ?? '';
        $libelle = $_POST['lib_ue'] ?? '';
        $credit = (int) ($_POST['credit_ue'] ?? 0);
        $id_niv = (int) ($_POST['id_niv_etu'] ?? 0);
        $id_ens = (int) ($_POST['id_ens_responsable'] ?? 0);
        $semestre = $_POST['semestre'] ?? '';
        $id_ac = (int) ($_POST['id_ac'] ?? 1); // Par défaut 1 ou récupérer dynamiquement

        // Vérifier doublon code_ue
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM ue WHERE code_ue = ?");
        $stmt->execute([$code]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => '❌ Ce code UE est déjà utilisé.']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO ue (code_ue, lib_ue, credit_ue, id_niv_etu, semestre, id_ens, id_ac)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$code, $libelle, $credit, $id_niv, $semestre, $id_ens, $id_ac]);

        echo json_encode(['status' => 'success', 'message' => '✅ UE ajoutée avec succès.']);
        exit;

    } elseif ($mode === 'ajout_ecue') {
        // Données ECUE
        $code_ecue = $_POST['code_ecue'] ?? '';
        $lib_ecue = $_POST['lib_ecue'] ?? '';
        $credit = (int) ($_POST['credit_ecue'] ?? 0);
        $id_ue = (int) ($_POST['id_ue'] ?? 0);
        $semestre = $_POST['semestre'] ?? '';
        $id_ac = (int) ($_POST['id_ac'] ?? 1);
        $specialite = $_POST['spe_ens'] ?? '';
        $enseignants = $_POST['id_ens'] ?? []; // tableau

        // Vérifier doublon
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM ecue WHERE code_ecue = ?");
        $stmt->execute([$code_ecue]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => '❌ Ce code ECUE est déjà utilisé.']);
            exit;
        }

        // Insertion dans ECUE
        $stmt = $pdo->prepare("INSERT INTO ecue (code_ecue, lib_ecue, id_ue, semestre, id_ac)
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$code_ecue, $lib_ecue, $id_ue, $semestre, $id_ac]);
        $id_ecue = $pdo->lastInsertId();

        // Affecter enseignants à ECUE
        if (!empty($enseignants)) {
            $stmtInsertEns = $pdo->prepare("INSERT INTO enseigner_ecue (id_ens, id_ecue, date_affectation) VALUES (?, ?, ?)");
            foreach ((array)$enseignants as $id_ens) {
                $stmtInsertEns->execute([$id_ens, $id_ecue, $date_now]);
            }
        }

        // Associer une spécialité si besoin
        if (!empty($specialite)) {
            $stmtSpe = $pdo->prepare("INSERT INTO ecue_specialite (id_ecue, id_spe) VALUES (?, ?)");
            $stmtSpe->execute([$id_ecue, $specialite]);
        }

        echo json_encode(['status' => 'success', 'message' => '✅ ECUE ajoutée avec succès.']);
        exit;
    }

    echo json_encode(['status' => 'error', 'message' => '❌ Action non reconnue.']);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => '❌ Erreur SQL : ' . $e->getMessage()]);
    exit;
}
