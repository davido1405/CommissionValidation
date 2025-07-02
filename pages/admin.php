<?php
// session_start avant tout contenu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion base de données
require_once '../config/db.php';

$role = $_SESSION['role'] ?? 0; // Rôle utilisateur
$page = $_GET['page'] ?? 'default';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDCOV - Espace Administrateur</title>
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
            <a href="?page=default" class="nav-link <?= ($page === 'default') ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>

            <div class="nav-category">Gestion Académique</div>

            <?php if (in_array($role, [1, 2])): // Gestionnaire administratif ou Admin ?>
                <a href="?page=etudiants" class="nav-link <?= ($page === 'etudiants') ? 'active' : '' ?>">
                    <i class="fas fa-user-graduate"></i> Étudiants
                </a>
                <a href="?page=enseignants" class="nav-link <?= ($page === 'enseignants') ? 'active' : '' ?>">
                    <i class="fas fa-chalkboard-teacher"></i> Enseignants
                </a>
                <a href="?page=ue" class="nav-link <?= ($page === 'ue') ? 'active' : '' ?>">
                    <i class="fas fa-book"></i> UE / ECUE
                </a>
                <a href="?page=anneeaca" class="nav-link <?= ($page === 'anneeaca') ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt"></i> Année académique
                </a>
                <a href="?page=niveauetude" class="nav-link <?= ($page === 'niveauetude') ? 'active' : '' ?>">
                    <i class="fas fa-layer-group"></i> Niveaux d'étude
                </a>
            <?php endif; ?>

            <?php if (in_array($role, [2])): // Gestionnaire rapports ou Admin ?>
                <div class="nav-category">Gestion des Mémoires</div>
                <a href="?page=rapports" class="nav-link <?= ($page === 'rapports') ? 'active' : '' ?>">
                    <i class="fas fa-file-alt"></i> Rapports
                </a>
                <a href="?page=validation" class="nav-link d-flex justify-content-between <?= ($page === 'validation') ? 'active' : '' ?>">
                    <div>
                        <i class="fas fa-tasks"></i> Validations
                    </div>
                    <span class="badge bg-danger rounded-pill">12</span>
                </a>
                <a href="?page=jury" class="nav-link <?= ($page === 'jury') ? 'active' : '' ?>">
                    <i class="fas fa-users"></i> Jurys
                </a>
                <a href="?page=entreprise" class="nav-link <?= ($page === 'entreprise') ? 'active' : '' ?>">
                    <i class="fas fa-building"></i> Entreprises
                </a>
            <?php endif; ?>

            <div class="nav-category">Administration</div>

            <?php if (in_array($role, [2])): // Tous les gestionnaires ou admin ?>
                <a href="?page=utilisateurs" class="nav-link <?= ($page === 'utilisateurs') ? 'active' : '' ?>">
                    <i class="fas fa-user-shield"></i> Utilisateurs
                </a>
                <a href="?page=statistiques" class="nav-link <?= ($page === 'statistiques') ? 'active' : '' ?>">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </a>
                <a href="?page=journalaudi" class="nav-link <?= ($page === 'journalaudi') ? 'active' : '' ?>">
                    <i class="fas fa-history"></i> Journal d'Audit
                </a>
                <a href="?page=parametre" class="nav-link <?= ($page === 'parametre') ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
            <?php endif; ?>

            <a href="../auth/logout.php" class="nav-link text-danger mt-4">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>


    <!-- Main Content Area -->
    <div class="main-content">
        <?php
            $page=$_GET['page'] ?? 'default';
            switch($page){
                case 'etudiants':
                    include('ecrans_gestionnaire/etudiants.php');
                    break;
                case 'enseignants':
                    include('ecrans_gestionnaire/enseignants.php');
                    break;
                case 'ue':
                    include('ecrans_gestionnaire/ue.php');
                    break;
                case 'anneeaca':
                    include('ecrans_gestionnaire/anneaca.php');
                    break;
                case 'niveauetude':
                    include('ecrans_gestionnaire/niveauetude.php');
                    break;
                case 'rapports':
                    include('ecrans_gestionnaire/rapport.php');
                    break;
                case 'validation':
                    include('ecrans_gestionnaire/validation.php');
                    break;
                case 'jury':
                    include('ecrans_gestionnaire/jury.php');
                    break;
                case 'entreprise':
                    include('ecrans_gestionnaire/entreprise.php');
                    break;
                case 'utilisateurs':
                    include('ecrans_gestionnaire/utilisateur.php');
                    break;
                case 'statistiques':
                    include('ecrans_gestionnaire/statistique.php');
                    break;
                case 'journalaudi':
                    include('ecrans_gestionnaire/Paudite.php');
                    break;
                case 'parametre':
                    include('ecrans_gestionnaire/parametre.php');
                    break;
                case 'default':
                    include('ecrans_gestionnaire/default.php');
                    break;
            }
        ?>
    </div>

</body>