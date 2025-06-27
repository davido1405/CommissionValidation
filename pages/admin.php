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
            <a href="?page=default" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
            
            <div class="nav-category">Gestion Académique</div>
            <a href="?page=etudiants" class="nav-link">
                <i class="fas fa-user-graduate"></i> Étudiants
            </a>
            <a href="?page=enseignants" class="nav-link">
                <i class="fas fa-chalkboard-teacher"></i> Enseignants
            </a>
            <a href="?page=ue" class="nav-link">
                <i class="fas fa-book"></i> UE / ECUE
            </a>
            <a href="?page=anneeaca" class="nav-link">
                <i class="fas fa-calendar-alt"></i> Année académique
            </a>
            <a href="?page=niveauetude" class="nav-link">
                <i class="fas fa-layer-group"></i> Niveaux d'étude
            </a>
            
            <div class="nav-category">Gestion des Mémoires</div>
            <a href="?page=rapports" class="nav-link">
                <i class="fas fa-file-alt"></i> Rapports
            </a>
            <a href="?page=validation" class="nav-link d-flex justify-content-between">
                <div>
                    <i class="fas fa-tasks"></i> Validations
                </div>
                <span class="badge bg-danger rounded-pill">12</span>
            </a>
            <a href="?page=jury" class="nav-link">
                <i class="fas fa-users"></i> Jurys
            </a>
            <a href="?page=entreprise" class="nav-link">
                <i class="fas fa-building"></i> Entreprises
            </a>
            
            <div class="nav-category">Administration</div>
            <a href="?page=utilisateurs" class="nav-link">
                <i class="fas fa-user-shield"></i> Utilisateurs
            </a>
            <a href="?page=statistiques" class="nav-link">
                <i class="fas fa-chart-bar"></i> Statistiques
            </a>
            <a href="?page=journalaudi" class="nav-link active">
                <i class="fas fa-history"></i> Journal d'Audit
            </a>
            <a href="?page=parametre" class="nav-link">
                <i class="fas fa-cog"></i> Paramètres
            </a>
            <a href="?page=enseignants" class="nav-link text-danger mt-4">
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
                    include('ecrans_admin/etudiants.php');
                    break;
                case 'enseignants':
                    include('ecrans_admin/enseignants.php');
                    break;
                case 'ue':
                    include('ecrans_admin/ue.php');
                    break;
                case 'anneeaca':
                    include('ecrans_admin/anneaca.php');
                    break;
                case 'niveauetude':
                    include('ecrans_admin/niveauetude.php');
                    break;
                case 'rapports':
                    include('ecrans_admin/rapport.php');
                    break;
                case 'validation':
                    include('ecrans_admin/validation.php');
                    break;
                case 'jury':
                    include('ecrans_admin/jury.php');
                    break;
                case 'entreprise':
                    include('ecrans_admin/entreprise.php');
                    break;
                case 'utilisateurs':
                    include('ecrans_admin/utilisateur.php');
                    break;
                case 'statistiques':
                    include('ecrans_admin/statistique.php');
                    break;
                case 'journalaudi':
                    include('ecrans_admin/Paudite.php');
                    break;
                case 'parametre':
                    include('ecrans_admin/parametre.php');
                    break;
                case 'default':
                    include('ecrans_admin/default.php');
                    break;
            }
        ?>
    </div>

</body>