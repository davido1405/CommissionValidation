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
    // -------------------------
    // AJOUT OU MODIFICATION UE
    // -------------------------
    if ($mode === 'ajout_ue' || $mode === 'modification_ue') {
        $id_ue     = (int) ($_POST['id_ue'] ?? 0);
        $code      = $_POST['code_ue'] ?? '';
        $libelle   = $_POST['lib_ue'] ?? '';
        $credit    = (int) ($_POST['credit_ue'] ?? 0);
        $id_niv    = (int) ($_POST['id_niv_etu'] ?? 0);
        $id_ens    = (int) ($_POST['id_ens_responsable'] ?? 0);
        $semestre  = $_POST['semestre'] ?? '';
        $id_ac     = (int) ($_POST['id_ac'] ?? 1);

        // Vérifie doublon code_ue si ajout ou si code changé
        if ($mode === 'ajout_ue' || ($mode === 'modification_ue' && $code !== getOldCode($pdo, $id_ue, 'ue'))) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM ue WHERE code_ue = ? AND id_ue != ?");
            $stmt->execute([$code, $id_ue]);
            if ($stmt->fetchColumn() > 0) {
                echo json_encode(['status' => 'error', 'message' => '❌ Ce code UE est déjà utilisé.']);
                exit;
            }
        }

        if ($mode === 'ajout_ue') {
            $stmt = $pdo->prepare("INSERT INTO ue (code_ue, lib_ue, credit_ue, id_niv_etu, semestre, id_ens, id_ac)
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$code, $libelle, $credit, $id_niv, $semestre, $id_ens, $id_ac]);
            echo json_encode(['status' => 'success', 'message' => '✅ UE ajoutée avec succès.']);
        } else {
            $stmt = $pdo->prepare("UPDATE ue SET code_ue = ?, lib_ue = ?, credit_ue = ?, id_niv_etu = ?, semestre = ?, id_ens = ?, id_ac = ? WHERE id_ue = ?");
            $stmt->execute([$code, $libelle, $credit, $id_niv, $semestre, $id_ens, $id_ac, $id_ue]);
            echo json_encode(['status' => 'success', 'message' => '✅ UE modifiée avec succès.']);
        }
        exit;
    }

    // -------------------------
    // AJOUT OU MODIFICATION ECUE
    // -------------------------
    elseif ($mode === 'ajout_ecue' || $mode === 'modification_ecue') {
        $id_ecue   = (int) ($_POST['id_ecue'] ?? 0);
        $code      = $_POST['code_ecue'] ?? '';
        $libelle   = $_POST['lib_ecue'] ?? '';
        $credit    = (int) ($_POST['credit_ecue'] ?? 0);
        $id_ue     = (int) ($_POST['id_ue'] ?? 0);
        $semestre  = $_POST['semestre'] ?? '';
        $id_ac     = (int) ($_POST['id_ac'] ?? 1);
        $specialite = $_POST['spe_ens'] ?? '';
        $enseignants = $_POST['id_ens'] ?? [];

        // Vérifie doublon si ajout ou changement de code
        if ($mode === 'ajout_ecue' || ($mode === 'modification_ecue' && $code !== getOldCode($pdo, $id_ecue, 'ecue'))) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM ecue WHERE code_ecue = ? AND id_ecue != ?");
            $stmt->execute([$code, $id_ecue]);
            if ($stmt->fetchColumn() > 0) {
                echo json_encode(['status' => 'error', 'message' => '❌ Ce code ECUE est déjà utilisé.']);
                exit;
            }
        }

        if ($mode === 'ajout_ecue') {
            $stmt = $pdo->prepare("INSERT INTO ecue (code_ecue, lib_ecue, id_ue, semestre, id_ac)
                                   VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$code, $libelle, $id_ue, $semestre, $id_ac]);
            $id_ecue = $pdo->lastInsertId();
        } else {
            $stmt = $pdo->prepare("UPDATE ecue SET code_ecue = ?, lib_ecue = ?, id_ue = ?, semestre = ?, id_ac = ? WHERE id_ecue = ?");
            $stmt->execute([$code, $libelle, $id_ue, $semestre, $id_ac, $id_ecue]);

            // Supprimer les anciennes liaisons
            $pdo->prepare("DELETE FROM enseigner_ecue WHERE id_ecue = ?")->execute([$id_ecue]);
            $pdo->prepare("DELETE FROM ecue_specialite WHERE id_ecue = ?")->execute([$id_ecue]);
        }

        // Réinsérer les enseignants
        if (!empty($enseignants)) {
            $stmtInsert = $pdo->prepare("INSERT INTO enseigner_ecue (id_ens, id_ecue, date_affectation) VALUES (?, ?, ?)");
            foreach ((array)$enseignants as $id_ens) {
                $stmtInsert->execute([$id_ens, $id_ecue, $date_now]);
            }
        }

        // Réinsérer spécialité
        if (!empty($specialite)) {
            $stmtSpe = $pdo->prepare("INSERT INTO ecue_specialite (id_ecue, id_spe) VALUES (?, ?)");
            $stmtSpe->execute([$id_ecue, $specialite]);
        }

        $message = $mode === 'ajout_ecue' ? '✅ ECUE ajoutée avec succès.' : '✅ ECUE modifiée avec succès.';
        echo json_encode(['status' => 'success', 'message' => $message]);
        exit;
    }

    echo json_encode(['status' => 'error', 'message' => '❌ Action non reconnue.']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => '❌ Erreur SQL : ' . $e->getMessage()]);
    exit;
}

// Fonction utilitaire
function getOldCode($pdo, $id, $table) {
    $col = $table === 'ue' ? 'code_ue' : 'code_ecue';
    $col_id = $table === 'ue' ? 'id_ue' : 'id_ecue';
    $stmt = $pdo->prepare("SELECT $col FROM $table WHERE $col_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
}
