<?php
require_once '../notifications.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}
require_once '../../config/db.php';

$idRapport = $_GET['id'] ?? null;
$idEns = $_SESSION['id_ens'] ?? null;

if ($idRapport && $idEns) {
    try {
        // 1. Enregistrer la validation
        $stmt = $pdo->prepare("INSERT INTO valider (id_rapport, id_ens, etat_valide) VALUES (?, ?, 'validé')");
        $stmt->execute([$idRapport, $idEns]);

        // 2. Récupérer l'étudiant concerné
        $stmt = $pdo->prepare("SELECT num_etu FROM rapport_etudiant WHERE id_rapport = ?");
        $stmt->execute([$idRapport]);
        $numEtu = $stmt->fetchColumn();

        // 3. Trouver son id_utilisateur
        $stmt = $pdo->prepare("SELECT id_util FROM utilisateur WHERE login_util = (SELECT login_etu FROM etudiant WHERE num_etu = ?)");
        $stmt->execute([$numEtu]);
        $idUtilEtu = $stmt->fetchColumn();

        // 4. Envoyer la notification
        $pdo->prepare("
            INSERT INTO message (contenu_msg, type_msg, date_msg, statut, id_util, id_expediteur)
            VALUES (?, ?, NOW(), 'non lue', ?, ?)
        ")->execute([
            'Votre rapport a été validé par un enseignant.',
            'succès',
            $idUtilEtu,     // Étudiant destinataire
            $idEns          // Enseignant expéditeur (depuis session)
        ]);

       
       envoyerMessage($pdo, $idUtilEtu, "Votre rapport a été validé par un enseignant.", 'succès');


    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Paramètres manquants.";
}

header("Location: ../enseignant.php");
exit;
