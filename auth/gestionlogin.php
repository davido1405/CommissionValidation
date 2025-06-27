<?php
// 1. Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Connexion à la base de données
require_once '../config/db.php';

// 3. Récupération des champs du formulaire
$login = trim($_POST['login'] ?? '');
$mdp = trim($_POST['password'] ?? '');

// 4. Vérification des champs
if (empty($login) || empty($mdp)) {
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header("Location: ../pages/login.php");
    exit;
}

try {
    // 5. Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login_util = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 6. Vérification du mot de passe
    if ($user && $user['mdp_util'] === $mdp) { // Remplace par password_verify() si tu hashes plus tard
        $_SESSION['id_util'] = $user['id_util'];
        $_SESSION['login'] = $user['login_util'];

        // 7. Récupérer le rôle de l'utilisateur (groupe utilisateur)
        $stmtGroupe = $pdo->prepare("
            SELECT gu.lib_gu 
            FROM posseder p
            INNER JOIN groupe_utilisateur gu ON gu.id_gu = p.id_gu
            WHERE p.id_util = ?
        ");
        $stmtGroupe->execute([$user['id_util']]);
        $groupe = $stmtGroupe->fetchColumn();

        if (!$groupe) {
            $_SESSION['error'] = "Aucun groupe associé à ce compte.";
            header("Location: ../pages/login.php");
            exit;
        }

        $_SESSION['role'] = (int)$groupe;

        // 8. Redirection selon le rôle
        switch ($_SESSION['role']) {
            case 1:
                header("Location: ../pages/admin.php");
                break;
            case 2:
                header("Location: ../pages/enseignant.php");
                break;
            case 3:
                header("Location: ../pages/etudiant.php");
                break;
            default:
                $_SESSION['error'] = "Rôle non reconnu.";
                header("Location: ../pages/login.php");
                break;
        }
        exit;
    } else {
        $_SESSION['error'] = "Identifiants invalides.";
        header("Location: ../pages/login.php");
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Erreur de connexion à la base de données.";
    header("Location: ../pages/login.php");
    exit;
}
