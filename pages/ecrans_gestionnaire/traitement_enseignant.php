<?php
require_once(__DIR__ . '/../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
    exit;
}

$mode = $_POST['mode_formulaire'] ?? 'ajout';
$id_ens = $_POST['id_ens'] ?? null;

$nom = $_POST['nom_ens'] ?? '';
$prenom = $_POST['prenom_ens'] ?? '';
$login = $_POST['login_ens'] ?? '';
$mdp = $_POST['mdp_ens'] ?? '';
$statut = $_POST['statut_ens'] ?? 'Actif';

$id_grade = !empty($_POST['id_grade']) ? (int)$_POST['id_grade'] : null;
$id_fonct = !empty($_POST['id_fonct']) ? (int)$_POST['id_fonct'] : null;
$specialite_libelle = trim($_POST['spe_ens'] ?? '');

// Nettoyage simple
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
$login = htmlspecialchars($login);
$mdp = htmlspecialchars($mdp);

try {
    $pdo->beginTransaction();

    if ($mode === 'ajout') {
        // 1. Ajouter l'enseignant
        $stmt = $pdo->prepare("INSERT INTO enseignant (nom_ens, prenoms_ens, login_ens, mdp_ens, statut_ens) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $login, $mdp, $statut]);
        $id_ens = $pdo->lastInsertId();

        // 2. Créer l’utilisateur
        $stmt = $pdo->prepare("INSERT INTO utilisateur (login_util, mdp_util) VALUES (?, ?)");
        $stmt->execute([$login, $mdp]);
    } else {
        // Modification
        $stmt = $pdo->prepare("UPDATE enseignant SET nom_ens = ?, prenoms_ens = ?, login_ens = ?, mdp_ens = ?, statut_ens = ? WHERE id_ens = ?");
        $stmt->execute([$nom, $prenom, $login, $mdp, $statut, $id_ens]);

        $stmt = $pdo->prepare("UPDATE utilisateur SET login_util = ?, mdp_util = ? WHERE login_util = ?");
        $stmt->execute([$login, $mdp, $login]);

        // Supprimer anciennes associations
        $pdo->prepare("DELETE FROM avoir WHERE id_ens = ?")->execute([$id_ens]);
        $pdo->prepare("DELETE FROM occuper WHERE id_ens = ?")->execute([$id_ens]);
        $pdo->prepare("DELETE FROM enseigner WHERE id_ens = ?")->execute([$id_ens]);
    }

    // 3. Gérer la spécialité (insère si inexistante)
    if ($specialite_libelle !== '') {
        $stmt = $pdo->prepare("SELECT id_spe FROM specialite WHERE lib_spe = ?");
        $stmt->execute([$specialite_libelle]);
        $id_spe = $stmt->fetchColumn();

        if (!$id_spe) {
            $stmt = $pdo->prepare("INSERT INTO specialite (lib_spe) VALUES (?)");
            $stmt->execute([$specialite_libelle]);
            $id_spe = $pdo->lastInsertId();
        }

        // Lier la spécialité à l'enseignant
        $stmt = $pdo->prepare("INSERT INTO enseigner (id_ens, id_spe) VALUES (?, ?)");
        $stmt->execute([$id_ens, $id_spe]);
    }

    // 4. Grade
    if ($id_grade) {
        $stmt = $pdo->prepare("INSERT INTO avoir (id_ens, id_grade, dte_grd) VALUES (?, ?, NOW())");
        $stmt->execute([$id_ens, $id_grade]);
    }

    // 5. Fonction
    if ($id_fonct) {
        $stmt = $pdo->prepare("INSERT INTO occuper (id_ens, id_fonct, dte_occup) VALUES (?, ?, NOW())");
        $stmt->execute([$id_ens, $id_fonct]);
    }

    $pdo->commit();

    echo json_encode([
        'status' => 'success',
        'message' => $mode === 'ajout' ? 'Enseignant ajouté avec succès' : 'Enseignant modifié avec succès'
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur lors du traitement : ' . $e->getMessage()
    ]);
}
?>
