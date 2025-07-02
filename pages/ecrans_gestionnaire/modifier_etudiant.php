<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config/db.php';
session_start();

$numEtu = $_GET['id'] ?? null;
if (!$numEtu || !is_numeric($numEtu)) {
    if (isset($_GET['json'])) {
        http_response_code(400);
        echo json_encode(["error" => "ID invalide"]);
        exit;
    } else {
        $_SESSION['error'] = "Étudiant introuvable.";
        header("Location: etudiants.php");
        exit;
    }
}

// Récupérer les infos actuelles de l'étudiant
$stmt = $pdo->prepare("
    SELECT e.*, u.mdp_util, i.id_niv_etu
    FROM etudiant e
    JOIN utilisateur u ON e.login_etu = u.login_util
    LEFT JOIN inscrire i ON i.num_etu = e.num_etu
    WHERE e.num_etu = ?
    ORDER BY i.dte_insc DESC
    LIMIT 1
");

$stmt->execute([$numEtu]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

// ➤ Si l'appel vient d'une requête AJAX pour chargement dans le formulaire
if (isset($_GET['json']) && $etudiant) {
    header('Content-Type: application/json');
    echo json_encode($etudiant);
    exit;
}

// Traitement de la modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['studentLastName'] ?? '';
    $nom = $_POST['studentFirstName'] ?? '';
    $login = $_POST['studentLogin'] ?? '';
    $mdp = $_POST['studentPassword'] ?? '';
    $dateNais = $_POST['studentBirthDate'] ?? '';
    $idNiveau = $_POST['studentLevel'] ?? '';

    try {
        $pdo->prepare("UPDATE etudiant SET nom_etu = ?, prenom_etu = ?, login_etu = ?, dte_nais_etu = ?, id_niv_etu = ? WHERE num_etu = ?")
            ->execute([$nom, $prenom, $login, $dateNais, $idNiveau, $numEtu]);

        $pdo->prepare("UPDATE utilisateur SET login_util = ?, mdp_util = ? WHERE login_util = ?")
            ->execute([$login, $mdp, $etudiant['login_etu']]);

        $_SESSION['success'] = "Étudiant modifié avec succès.";
        header("Location: etudiants.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
    }
}else{

}
?>
