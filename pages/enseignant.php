<?php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['id_util'])) {
    header('Location: ../pages/login.php');
    exit;
}

// Récupération du login
$idUtil = $_SESSION['id_util'];
$stmt = $pdo->prepare("SELECT login_util FROM utilisateur WHERE id_util = ?");
$stmt->execute([$idUtil]);
$login = $stmt->fetchColumn();

// Trouver l’enseignant correspondant à ce login
$stmt = $pdo->prepare("SELECT * FROM enseignant WHERE login_ens = ?");
$stmt->execute([$login]);
$enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$enseignant) {
    die("Erreur : enseignant introuvable dans la base de données.");
}

// Enregistrer l'id_ens dans la session si besoin
$_SESSION['id_ens'] = $enseignant['id_ens'];
$idEns = $enseignant['id_ens'];


// 2. Nombre de rapports à valider
$stmt = $pdo->prepare("
    SELECT COUNT(*) FROM rapport_etudiant r
    WHERE NOT EXISTS ( SELECT 1 FROM valider v WHERE v.id_rapport = r.id_rapport AND v.id_ens = ?)");
$stmt->execute([$idEns]);
$nbRapportsAVerifier = $stmt->fetchColumn();

// 3. Nombre de jurys à venir (où l'enseignant est membre)
$stmt = $pdo->prepare("
    SELECT COUNT(*) FROM jury_etudiant
    WHERE id_ens = ? AND statut IN ('Validé', 'En attente', 'Confirmé')
");
$stmt->execute([$idEns]);
$nbJurys = $stmt->fetchColumn();

// 4. Nombre d’étudiants encadrés
$stmt = $pdo->prepare("
    SELECT COUNT(DISTINCT r.num_etu)
    FROM rapport_etudiant r
    JOIN valider v ON v.id_rapport = r.id_rapport
    WHERE v.id_ens = ?
");
$stmt->execute([$idEns]);
$nbEtudiants = $stmt->fetchColumn();

// 5. Nombre de comptes rendus rendus
$stmt = $pdo->prepare("SELECT COUNT(*) FROM rendre WHERE id_ens = ?");
$stmt->execute([$idEns]);
$nbComptesRendus = $stmt->fetchColumn();

// 6. Notifications (si utilisées)
$stmt = $pdo->prepare("SELECT * FROM notification WHERE id_util = (SELECT id_util FROM utilisateur WHERE login_util = ?) ORDER BY date_notif DESC LIMIT 4");
$stmt->execute([$enseignant['login_ens']]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);


//badge message
$idUtil = $_SESSION['id_util'] ?? null;
$nbMessages = 0;

if ($idUtil) {
    $stmt = $pdo->prepare("SELECT * FROM message WHERE id_util = ? AND statut = 'non lue'");
    $stmt->execute([$idUtil]);
    $nbMessages = $stmt->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDCOV - Espace Enseignant</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">

    
    
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo-container">
            <h5 class="text-white m-0">VOTRE LOGO</h5>
        </div>
        <div class="mt-4">
            <a href="?page=default" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
            <a href="?page=rapports" class="nav-link">
                <i class="fas fa-file-alt"></i> Rapports à évaluer
            </a>
            <a href="?page=message" class="nav-link d-flex justify-content-between">
                <div>
                    <i class="fas fa-envelope"></i> Messages
                </div>
                <?php if ($nbMessages > 0): ?>
                    <span class="badge bg-danger"><?= count($nbMessages)?></span>

                <?php endif; ?>
            </a>
            <a href="?page=monjury" class="nav-link">
                <i class="fas fa-users"></i> Mes jurys
            </a>
            <a href="?page=agenda" class="nav-link">
                <i class="fas fa-calendar-alt"></i> Agenda
            </a>
            <a href="?page=validationrapport" class="nav-link">
                <i class="fas fa-check-square"></i> Validation de rapports
            </a>
            <a href="?page=compterendu" class="nav-link">
                <i class="fas fa-clipboard-list"></i> Comptes rendus
            </a>
            <a href="?page=parametre" class="nav-link">
                <i class="fas fa-cog"></i> Paramètres
            </a>
            <a href="?page=deconnexion" class="nav-link text-danger">
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
                    case 'rapports':
                        include('ecrans_enseignants/rapportaevaluer.php');
                        break;
                    case 'message':
                        include('ecrans_enseignants/messageenseignant.php');
                        break;
                    case 'agenda':
                        include('ecrans_enseignants/agenda.php');
                        break;
                    case 'monjury':
                        include('ecrans_enseignants/monjury.php');
                        break;
                    case 'parametre':
                        include('ecrans_enseignants/parametre.php');
                        break;
                    case 'compterendu':
                        include('ecrans_enseignants/compterendu.php');
                        break;
                    case 'validationrapport':
                        include('ecrans_enseignants/validationrapports.php');
                        break;
                    case 'deconnexion':
                        include('../auth/logout.php');
                        break;
                    case 'default':
                        include('ecrans_enseignants/default.php');
                        break;
                    }
            ?>
        </div>
    </div>

</body>