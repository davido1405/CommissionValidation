<?php
session_start();
require_once (__DIR__ . '/../../config/db.php');

if (!isset($_SESSION['id_util'])) {
    header("Location: etudiants.php?erreur=session");
    exit;
}

// Données du formulaire
$mode = $_POST['mode_formulaire'] ?? 'ajout';
$num_etu = $_POST['num_etu'] ?? null;

$prenom = trim($_POST['prenom_etu'] ?? '');
$nom = trim($_POST['nom_etu'] ?? '');
$login = trim($_POST['login_etu'] ?? '');
$mdp = $_POST['mdp_etu'] ?? '';
$naissance = $_POST['dte_nais_etu'] ?? '';
$id_niv_etu = (int) ($_POST['id_niv_etu'] ?? 0);
$id_ac = (int) ($_POST['id_ac'] ?? 0);
$statut = $_POST['statut_etu'] ?? 'Actif';
$montant_insc = (float) ($_POST['montant_insc'] ?? 0);

try {
    if ($mode === 'modification' && $num_etu) {
        // Vérifier unicité du login en excluant l'étudiant courant
        $check = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE login_etu = ? AND num_etu != ?");
        $check->execute([$login, $num_etu]);
        if ($check->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => '❌ Ce login est déjà utilisé par un autre étudiant.']);
            exit;
        }

        // Récupérer ancien login (important pour mettre à jour la table utilisateur)
        $ancien_login = $_POST['ancien_login'] ?? null;
        if (!$ancien_login) {
            echo json_encode(['status' => 'error', 'message' => '❌ Ancien login manquant pour la mise à jour.']);
            exit;
        }

        if (!empty($mdp)) {
            // Hasher le mot de passe et mettre à jour mdp
            $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("UPDATE etudiant SET nom_etu=?, prenom_etu=?, login_etu=?, mdp_etu=?, dte_nais_etu=?, statut_etu=? WHERE num_etu=?");
            $stmt->execute([$nom, $prenom, $login, $mdp_hash, $naissance, $statut, $num_etu]);

            $stmt = $pdo->prepare("UPDATE utilisateur SET login_util=?, mdp_util=? WHERE login_util=?");
            $stmt->execute([$login, $mdp_hash, $ancien_login]);
        } else {
            // Ne pas modifier le mot de passe
            $stmt = $pdo->prepare("UPDATE etudiant SET nom_etu=?, prenom_etu=?, login_etu=?, dte_nais_etu=?, statut_etu=? WHERE num_etu=?");
            $stmt->execute([$nom, $prenom, $login, $naissance, $statut, $num_etu]);

            $stmt = $pdo->prepare("UPDATE utilisateur SET login_util=? WHERE login_util=?");
            $stmt->execute([$login, $ancien_login]);
        }

        if ($montant_insc > 0) {
            $stmt = $pdo->prepare("INSERT INTO inscrire (num_etu, id_ac, id_niv_etu, dte_insc, montant_insc) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$num_etu, $id_ac, $id_niv_etu, date('Y-m-d'), $montant_insc]);
        }

        echo json_encode(['status' => 'success', 'message' => '✅ Étudiant modifié avec succès.']);
        exit;

    } else {
        // Mode ajout
        $check = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE login_etu = ?");
        $check->execute([$login]);
        if ($check->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => '❌ Ce login est déjà utilisé.']);
            exit;
        }

        if (empty($mdp)) {
            echo json_encode(['status' => 'error', 'message' => '❌ Le mot de passe est obligatoire.']);
            exit;
        }

        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO etudiant (nom_etu, prenom_etu, login_etu, mdp_etu, dte_nais_etu, statut_etu) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $login, $mdp_hash, $naissance, $statut]);

        $num_etu = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO utilisateur (login_util, mdp_util) VALUES (?, ?)");
        $stmt->execute([$login, $mdp_hash]);

        if ($montant_insc > 0) {
            $stmt = $pdo->prepare("INSERT INTO inscrire (num_etu, id_ac, id_niv_etu, dte_insc, montant_insc) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$num_etu, $id_ac, $id_niv_etu, date('Y-m-d'), $montant_insc]);
        }

        echo json_encode(['status' => 'success', 'message' => '✅ Étudiant ajouté avec succès.']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => '❌ Une erreur SQL est survenue : ' . $e->getMessage()]);
}
