<?php
session_start();
require_once '../config/db.php';

// Si l'étudiant n’est pas connecté, on redirige
if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}

// Récupérer l'étudiant via l'utilisateur connecté
$idUtil = $_SESSION['id_util'];

// Associer l'utilisateur à l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiant WHERE login_etu = (SELECT login_util FROM utilisateur WHERE id_util = ?)");
$stmt->execute([$idUtil]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    echo "<p class='alert alert-danger'>Impossible de charger les informations de l'étudiant.</p>";
    exit;
}

// Requêtes complémentaires
// Inscription
$stmt = $pdo->prepare("SELECT i.*, a.dte_deb, a.dte_fin, n.lib_niv_etu
    FROM inscrire i
    JOIN annee_academique a ON i.id_ac = a.id_ac
    JOIN niveau_etude n ON i.id_niv_etu = n.id_niv_etu
    WHERE i.num_etu = ?
    ORDER BY dte_insc DESC LIMIT 1");
$stmt->execute([$etudiant['num_etu']]);
$inscription = $stmt->fetch(PDO::FETCH_ASSOC);

// Rapports
$stmt = $pdo->prepare("SELECT r.*, d.dte_dep
    FROM rapport_etudiant r
    JOIN deposer d ON d.id_rapport = r.id_rapport
    WHERE d.num_etu = ?
    ORDER BY d.dte_dep DESC");
$stmt->execute([$etudiant['num_etu']]);
$rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);


//badge message
$id_util = $_SESSION['id_util'] ?? null;
$nbMessages = 0;

if ($id_util) {
    $stmt = $pdo->prepare("SELECT count(*) FROM message WHERE id_util = ? and statut=?");
    $stmt->execute([$id_util,"non_lue"]);
    $nbMessages = $stmt->fetchColumn();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDCOV - Espace Étudiant</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo-container">
            <h5 class="text-white m-0">VOTRE LOGO </h5>
        </div>
        <div class="mt-4">
            <a href="?page=default" class="nav-link active">
                <i class="fas fa-home"></i> Tableau de bord
            </a>
            <a href="?page=rapports" class="nav-link">
                <i class="fas fa-file-alt"></i> Mes rapports
            </a>
            <a href="?page=message" class="nav-link d-flex justify-content-between">
                <div>
                    <i class="fas fa-envelope"></i> Messages
                </div>
                <?php if ($nbMessages > 0): ?>
                    <span class="badge bg-danger rounded-pill"><?= $nbMessages?></span>
                <?php endif; ?>
            </a>

            <a href="?page=plane" class="nav-link">
                <i class="fas fa-calendar-alt"></i> Planification
            </a>
            <a href="?page=monjury" class="nav-link">
                <i class="fas fa-users"></i> Mon jury
            </a>
            <a href="?page=parametre" class="nav-link">
                <i class="fas fa-cog"></i> Paramètres
            </a>
            <a href="?page=aide" class="nav-link">
                <i class="fas fa-question-circle"></i> Aide
            </a>
            <a href="../auth/logout.php" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="content-area">
            <?php
                $page=$_GET['page'] ?? 'default';
                switch($page){
                    case 'message':
                        include('ecrans_etudiants/message.php');
                        break;
                    case 'rapports':
                        include('ecrans_etudiants/rapports.php');
                        break;
                    case 'plane':
                        include('ecrans_etudiants/planif.php');
                        break;
                    case 'monjury':
                        include('ecrans_etudiants/monjury.php');
                        break;
                    case 'parametre':
                        include('ecrans_etudiants/parametre.php');
                        break;
                    case 'aide':
                        include('ecrans_etudiants/aide.php');
                        break;
                    case 'default':
                        include('ecrans_etudiants/default.php');
                        break;
                }
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer tous les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
</body>
</html>