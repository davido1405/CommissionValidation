<?php
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}

// Ici, on récupère l'id_util de la session (OK)
$idUtil = $_SESSION['id_util'];

// Récupérer les infos du personnel administratif via id_util (et non id_pers)
$stmt = $pdo->prepare("SELECT * FROM personnel_admin WHERE id_util = ?");
$stmt->execute([$idUtil]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    die("Personnel administratif non trouvé pour cet utilisateur.");
}

// Exemple d'accès sécurisé au nom

// Récupérer le nombre de notifications non lues pour cet utilisateur
$stmtNotif = $pdo->prepare("SELECT COUNT(*) FROM notification WHERE id_util = ? AND statut = 'non_lue'");
$stmtNotif->execute([$idUtil]);
$nbNotifications = $stmtNotif->fetchColumn();

// Récupérer les détails des dernières notifications non lues
$stmtDetails = $pdo->prepare("
    SELECT titre, contenu, type_notif, date_notif 
    FROM notification 
    WHERE id_util = ? AND statut = 'non_lue' 
    ORDER BY date_notif DESC 
    LIMIT 5
");
$stmtDetails->execute([$idUtil]);
$notifications = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);


$role = $_SESSION['role'] ?? 0; // Rôle utilisateur
$page = $_GET['page'] ?? 'default';


// Étudiants total (distinct num_etu dans inscrire)
$query = "SELECT COUNT(DISTINCT num_etu) AS total_etudiants FROM inscrire";
$etudiants = $pdo->query($query)->fetch(PDO::FETCH_ASSOC)['total_etudiants'] ?? 0;

// Étudiants inscrits ces 6 derniers mois
$query = "SELECT COUNT(DISTINCT num_etu) AS recent_etudiants FROM inscrire WHERE dte_insc >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
$etudiants_recent = $pdo->query($query)->fetch(PDO::FETCH_ASSOC)['recent_etudiants'] ?? 0;

// Enseignants total
$query = "SELECT COUNT(*) AS total_enseignants FROM enseignant";
$enseignants = $pdo->query($query)->fetch(PDO::FETCH_ASSOC)['total_enseignants'] ?? 0;

// Rapports actifs
$query = "SELECT COUNT(*) AS rapports_actifs FROM rapport_etudiant WHERE etat_validation = 'actif'";
$rapports = $pdo->query($query)->fetch(PDO::FETCH_ASSOC)['rapports_actifs'] ?? 0;


?>

        
        
<div class="header">
    <div class="d-flex align-items-center">
        <h2 class="page-title">
            <i class="fas fa-tachometer-alt me-2"></i>
            Espace Administrateur
        </h2>
        <div class="ms-4 d-none d-md-block">
            <span class="badge bg-success p-2">Année académique: 2024-2025</span>
        </div>
    </div>

    <div class="d-flex align-items-center gap-4">
        <div class="d-none d-md-flex align-items-center">
            <span class="text-dark me-3">
                Bienvenue, <strong><?= htmlspecialchars($admin['prenoms_pers'] . ' ' .$admin['nom_pers']) ?></strong>
            </span>
        </div>

        <div class="dropdown me-3">
            <a class="btn btn-light position-relative rounded-circle p-2" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <?php if ($nbNotifications > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= intval($nbNotifications) ?>
                        <span class="visually-hidden">nouvelles notifications</span>
                    </span>
                <?php endif; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="min-width: 320px;">
                <li><h6 class="dropdown-header bg-light py-3">Notifications</h6></li>

                <?php if (empty($notifications)): ?>
                    <li class="px-3 py-2 text-muted small">Aucune notification récente.</li>
                <?php else: ?>
                    <?php foreach ($notifications as $notif): ?>
                        <li>
                            <a class="dropdown-item py-3 border-bottom" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-<?= 
                                            $notif['type_notif'] === 'alerte' ? 'danger' : 
                                            ($notif['type_notif'] === 'succès' ? 'success' : 'primary') 
                                        ?> text-white rounded-circle p-2">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 fw-bold"><?= htmlspecialchars($notif['titre']) ?></p>
                                        <small class="text-muted"><?= date('d/m/Y H:i', strtotime($notif['date_notif'])) ?></small>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center py-2" href="#">Voir toutes les notifications</a></li>
            </ul>
        </div>


        <div class="dropdown">
            <a class="btn btn-outline-dark d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar me-2 bg-white">
                    <i class="fas fa-user"></i>
                </div>
                <span class="d-none d-md-inline">Mon compte</span>
                <i class="fas fa-chevron-down ms-2 d-none d-md-inline"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <li><div class="dropdown-header bg-light py-3"><?= htmlspecialchars($admin['prenoms_pers'] . ' ' . $admin['nom_pers']) ?></div></li>
                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user-circle me-2"></i>Mon profil</a></li>
                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-question-circle me-2"></i>Aide</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger py-2" href="../auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
            </ul>
        </div>
    </div>
</div>


        <div class="content-area">
            <!-- Statistics Cards Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="stats-title">Étudiants</div>
                            <div class="stats-number"><?= $etudiants ?></div>
                            <div class="stats-trend">
                                <i class="fas <?= ($evo_etudiants >= 0) ? 'fa-arrow-up text-success' : 'fa-arrow-down text-danger' ?>"></i>
                                <?= abs($evo_etudiants) ?>% ce semestre
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stats-title">Enseignants</div>
                            <div class="stats-number"><?= $enseignants ?></div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up text-success"></i> <?= $nouveaux_enseignants ?> nouveaux ce trimestre
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (in_array($role, [2])): // Gestionnaire rapports ?>
                    <div class="col-md-3">
                        <div class="stats-card h-100">
                            <div class="stats-card-content">
                                <div class="stats-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="stats-title">Rapports actifs</div>
                                <div class="stats-number"><?= $rapports_actifs ?></div>
                                <div class="stats-trend">
                                    <i class="fas fa-circle text-warning"></i> <?= $rapports_attente ?> en attente
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card h-100">
                            <div class="stats-card-content">
                                <div class="stats-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="stats-title">Jurys formés</div>
                                <div class="stats-number"><?= $jurys ?></div>
                                <div class="stats-trend">
                                    <i class="fas fa-circle text-success"></i> <?= $soutenances ?> soutenances planifiées
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            
            <!-- Quick Actions Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Actions rapides</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Voir toutes les actions</a></li>
                                    <li><a class="dropdown-item" href="#">Personnaliser</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-primary-subtle text-primary">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                    </div>
                                    <h6>Ajouter un étudiant</h6>
                                    <p class="text-muted small mb-3">Créer un nouveau compte étudiant</p>
                                    <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                        Commencer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-success-subtle text-success">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <h6>Valider des rapports</h6>
                                    <p class="text-muted small mb-3">12 rapports en attente de validation</p>
                                    <button class="btn btn-sm btn-outline-success w-100">
                                        Traiter <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-warning-subtle text-warning">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                    </div>
                                    <h6>Constituer un jury</h6>
                                    <p class="text-muted small mb-3">Affecter des enseignants aux soutenances</p>
                                    <button class="btn btn-sm btn-outline-warning w-100">
                                        Composer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-calendar me-2"></i>Événements à venir</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                                <div>
                                    <div class="fw-bold">Soutenance M2 - Groupe A</div>
                                    <div class="small text-muted">Salle A104 · 09:00 - 12:00</div>
                                </div>
                                <span class="badge bg-info rounded-pill">Demain</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                                <div>
                                    <div class="fw-bold">Date limite - Dépôt mémoires</div>
                                    <div class="small text-muted">Pour les M1 Informatique</div>
                                </div>
                                <span class="badge bg-warning rounded-pill">3 jours</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                <div>
                                    <div class="fw-bold">Réunion jury de délibération</div>
                                    <div class="small text-muted">Salle de conférence · 14:00</div>
                                </div>
                                <span class="badge bg-secondary rounded-pill">10 mai</span>
                            </li>
                        </ul>
                        <div class="text-center mt-3">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-calendar-plus me-1"></i> Planifier un nouvel événement
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Data Management Tabs -->
            <div class="dashboard-card mb-4">
                <ul class="nav nav-tabs" id="dataManagementTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="students-tab" data-bs-toggle="tab" data-bs-target="#students-tab-pane" type="button" role="tab" aria-controls="students-tab-pane" aria-selected="true">
                            <i class="fas fa-user-graduate me-2"></i>Étudiants
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="teachers-tab" data-bs-toggle="tab" data-bs-target="#teachers-tab-pane" type="button" role="tab" aria-controls="teachers-tab-pane" aria-selected="false">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Enseignants
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports-tab-pane" type="button" role="tab" aria-controls="reports-tab-pane" aria-selected="false">
                            <i class="fas fa-file-alt me-2"></i>Rapports
                        </button>
                    </li>
                </ul>
                <div class="tab-content p-3" id="dataManagementTabsContent">
                    <!-- Students Tab -->
                    <div class="tab-pane fade show active" id="students-tab-pane" role="tabpanel" aria-labelledby="students-tab" tabindex="0">
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-4">
                                <div class="search-box">
                                    <i class="fas fa-search text-muted"></i>
                                    <input type="text" placeholder="Rechercher un étudiant...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="custom-select">
                                            <option selected>Niveau d'étude</option>
                                            <option>Licence 1</option>
                                            <option>Licence 2</option>
                                            <option>Licence 3</option>
                                            <option>Master 1</option>
                                            <option>Master 2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select">
                                            <option selected>Année académique</option>
                                            <option>2024-2025</option>
                                            <option>2023-2024</option>
                                            <option>
                                        </select>
                                    </div>
                                </div>
                            </div>
</div>
</div>
</div>                            
</div>
</div>