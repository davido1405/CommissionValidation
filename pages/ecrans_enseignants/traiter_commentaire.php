<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}
require_once '../config/db.php';

$idRapport = $_POST['id_rapport'] ?? null;
$commentaire = trim($_POST['commentaire'] ?? '');
$idEns = $_SESSION['id_ens'] ?? null;

if ($idRapport && $idEns && !empty($commentaire)) {
    try {
        $stmt = $pdo->prepare("INSERT INTO valider (id_rapport, id_ens, etat_valide, date_validation) VALUES (?, ?, 'en attente', NOW())");
        $stmt->execute([$idRapport, $idEns]);

        // Ajoute le commentaire comme message ou autre selon la structure
        $stmt = $pdo->prepare("INSERT INTO message (contenu_msg, type_msg, id_util) VALUES (?, 'info', ?)");
        $stmt->execute([$commentaire, $_SESSION['id_util']]);

        $stmt = $pdo->prepare("SELECT num_etu FROM rapport_etudiant WHERE id_rapport = ?");
        $stmt->execute([$idRapport]);
        $numEtu = $stmt->fetchColumn();

        if ($numEtu) {
            $stmt = $pdo->prepare("SELECT id_util FROM utilisateur WHERE login_util = (
                SELECT login_etu FROM etudiant WHERE num_etu = ?)");
            $stmt->execute([$numEtu]);
            $idUtilEtu = $stmt->fetchColumn();

            if ($idUtilEtu) {
                $stmt = $pdo->prepare("INSERT INTO notification (id_util, titre, contenu, type_notif, statut) 
                                    VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $idUtilEtu,
                    "Commentaire sur votre rapport",
                    "Un commentaire a été ajouté à votre rapport : \"$commentaire\"",
                    'info',
                    'non_lue'
                ]);
            }
        }


        $_SESSION['success'] = "Commentaire enregistré.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Veuillez remplir tous les champs.";
}

header("Location: ../pages/enseignant.php");
exit;
