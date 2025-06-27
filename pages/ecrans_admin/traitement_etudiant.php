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

$prenom = $_POST['prenom_etu'] ?? '';
$nom = $_POST['nom_etu'] ?? '';
$login = $_POST['login_etu'] ?? '';
$mdp = $_POST['mdp_etu'] ?? '';
$naissance = $_POST['dte_nais_etu'] ?? '';
$id_niv_etu = (int) ($_POST['id_niv_etu'] ?? 0);
$id_ac = (int) ($_POST['id_ac'] ?? 0);
$statut = $_POST['statut_etu'] ?? 'Actif';
$montant_insc = (float) ($_POST['montant_insc'] ?? 0);

try {
    if ($mode === 'modification' && $num_etu) {
        // 🔄 Mise à jour des données
        $stmt = $pdo->prepare("UPDATE etudiant SET nom_etu=?, prenom_etu=?, login_etu=?, mdp_etu=?, dte_nais_etu=?, statut_etu=? WHERE num_etu=?");
        $stmt->execute([$nom, $prenom, $login, $mdp, $naissance, $statut, $num_etu]);

        // 🔄 Mise à jour du compte utilisateur
        $stmt = $pdo->prepare("UPDATE utilisateur SET login_util=?, mdp_util=? WHERE login_util=?");
        $stmt->execute([$login, $mdp, $login]); // Ici on écrase l'ancien login

        if($montant_insc > 0){
            // 📌 Nouvelle ligne d’inscription (historique)
            $stmt = $pdo->prepare("INSERT INTO inscrire (num_etu, id_ac, id_niv_etu, dte_insc, montant_insc) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$num_etu, $id_ac, $id_niv_etu, date('Y-m-d'), $montant_insc]);
        }

        // ✅ Redirection avec notification succès modification
        echo json_encode(['status' => 'success', 'message' => '✅ Étudiant modifié avec succès.']);
        exit;
    } else {
        // 🔍 Vérifie l’unicité du login
        $check = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE login_etu = ?");
        $check->execute([$login]);
        if ($check->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => '❌ Ce login est déjà utilisé.']);
        }

        // ➕ Insertion nouvel étudiant
        $stmt = $pdo->prepare("INSERT INTO etudiant (nom_etu, prenom_etu, login_etu, mdp_etu, dte_nais_etu, statut_etu) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $login, $mdp, $naissance, $statut]);

        // ➕ Création du compte utilisateur
        $stmt = $pdo->prepare("INSERT INTO utilisateur (login_util, mdp_util) VALUES (?, ?)");
        $stmt->execute([$login, $mdp]);

        // 🆔 Récupère l'ID de l'étudiant
        $num_etu = $pdo->lastInsertId();

        // ➕ Ajout dans inscrire
        $stmt = $pdo->prepare("INSERT INTO inscrire (num_etu, id_ac, id_niv_etu, dte_insc, montant_insc) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$num_etu, $id_ac, $id_niv_etu, date('Y-m-d'), $montant_insc]);

        // ✅ Redirection avec notification succès ajout
        echo json_encode(['status' => 'success', 'message' => '✅ Étudiant ajouté avec succès.']);
        exit;
    }
} catch (PDOException $e) {
    // En cas d'erreur SQL
    echo json_encode(['status' => 'error', 'message' => '❌ Une erreur sql est survenue.']);

}
