<?php
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Vérifier la connexion
if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}

$idAdmin = $_SESSION['id_util']; // ou $_SESSION['id_pers'] si tu as un identifiant propre

// Récupérer les infos de l'administrateur
$stmt = $pdo->prepare("SELECT * FROM personnel_admin WHERE id_pers = ?");
$stmt->execute([$idAdmin]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les notifications non lues
$stmtNotif = $pdo->prepare("SELECT COUNT(*) FROM notification WHERE id_util = ? AND statut = 'non_lue'");
$stmtNotif->execute([$idAdmin]);
$nbNotifications = $stmtNotif->fetchColumn();

// Détails des dernières notifications
$stmtDetails = $pdo->prepare("
    SELECT titre, contenu, type_notif, date_notif 
    FROM notification 
    WHERE id_util = ? AND statut = 'non_lue' 
    ORDER BY date_notif DESC 
    LIMIT 5
");
$stmtDetails->execute([$idAdmin]);
$notifications = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);
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
                Bienvenue, <strong><?= $admin['prenoms_pers'] . ' ' . $admin['nom_pers'] ?></strong>
            </span>
        </div>

        <div class="dropdown me-3">
            <a class="btn btn-light position-relative rounded-circle p-2" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $nbNotifications ?>
                    <span class="visually-hidden">nouvelles notifications</span>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="min-width: 320px;">
                <li><h6 class="dropdown-header bg-light py-3">Notifications</h6></li>

                <?php if (empty($notifications)): ?>
                    <li class="px-3 py-2 text-muted small">Aucune notification récente.</li>
                <?php else: ?>
                    <?php foreach ($notifications as $notif): ?>
                        <li><a class="dropdown-item py-3 border-bottom" href="#">
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
                        </a></li>
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
                <li><div class="dropdown-header bg-light py-3"><?= htmlspecialchars($admin['prenoms_admin'] . ' ' . $admin['nom_admin']) ?></div></li>
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
                            <div class="stats-number">482</div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> +8% ce semestre
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
                            <div class="stats-number">56</div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> +3 nouveaux
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stats-title">Rapports actifs</div>
                            <div class="stats-number">124</div>
                            <div class="stats-trend">
                                <i class="fas fa-circle text-warning"></i> 12 en attente
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
                            <div class="stats-number">24</div>
                            <div class="stats-trend">
                                <i class="fas fa-circle text-success"></i> 8 soutenances planifiées
                            </div>
                        </div>
                    </div>
                </div>
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