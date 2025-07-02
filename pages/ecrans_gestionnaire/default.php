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



//Gérer les évènements à venir
try {
    $stmt = $pdo->prepare("SELECT titre_event, date_event, heure_event FROM agenda WHERE date_event >= CURDATE() ORDER BY date_event ASC, heure_event ASC LIMIT 5");
    $stmt->execute();
    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $evenements = [];
}

function formatBadgeDate($date_event) {
    $today = new DateTime();
    $eventDate = new DateTime($date_event);
    $diff = $today->diff($eventDate)->days;
    $now = $today->format('Y-m-d');
    $target = $eventDate->format('Y-m-d');

    if ($target === $now) {
        return ['Aujourd\'hui', 'primary'];
    } elseif ($diff === 1) {
        return ['Demain', 'info'];
    } elseif ($diff <= 7) {
        return [$diff . ' jours', 'warning'];
    } else {
        return [$eventDate->format('d M'), 'secondary'];
    }
}
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
                            <div class="stats-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="stats-title">Étudiants</div>
                            <div class="stats-number"><?= $etudiants ?></div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> <?= $etudiants_recent ?> étudiants ont fait un versement ces 6 derniers mois
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                            <div class="stats-title">Enseignants</div>
                            <div class="stats-number"><?= $enseignants ?></div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> <?= $enseignants ?> Actuellements sous contrat
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (in_array($role, [2])): // Gestionnaire rapports ?>
                    <div class="col-md-3 <?= ($page==='default')?'active':''?>">
                        <div class="stats-card h-100">
                            <div class="stats-card-content">
                                <div class="stats-icon"><i class="fas fa-file-alt"></i></div>
                                <div class="stats-title">Rapports actifs</div>
                                <div class="stats-number"><?= $rapports ?></div>
                                <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> <?= $rapports ?> Rapports actuellements actifs
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
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i> Actions rapides</h5>
                            <div class="dropdown">
                                
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
                                    <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="location.href='?page=etudiants'">
                                        Commencer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-primary-subtle text-primary">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                    </div>
                                    <h6>Ajouter un enseignant</h6>
                                    <p class="text-muted small mb-3">Créer un nouveau compte enseignant</p>
                                    <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="location.href='?page=enseignants'">
                                        Commencer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-primary-subtle text-primary">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                    <h6>Ajouter une UE/ECUE</h6>
                                    <p class="text-muted small mb-3">Ajouter nouvelles UE/ECUE</p>
                                    <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="location.href='?page=ue'">
                                        Commencer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <?php if (in_array($role, [2])): // Gestionnaire rapports ?>
                                <div class="col-md-4">
                                    <div class="custom-card p-3 text-center h-100">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <div class="card-icon bg-success-subtle text-success">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <h6>Valider des rapports</h6>
                                        <p class="text-muted small mb-3"><?= $rapports ?> rapports en attente de validation</p>
                                        <button type="button" class="btn btn-sm btn-outline-success w-100" onclick="location.href='?page=rapports'">
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
                                        <button type="button" class="btn btn-sm btn-outline-warning w-100" onclick="location.href='?page=jury'">
                                            Affecter <i class="fas fa-arrow-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="custom-card p-3 text-center h-100">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <div class="card-icon bg-warning-subtle text-warning">
                                                <i class="fas fa-building"></i>
                                            </div>
                                        </div>
                                        <h6>Renseigner une entreprise</h6>
                                        <p class="text-muted small mb-3">Ajouter une entreprise partenaire</p>
                                        <button type="button" class="btn btn-sm btn-outline-warning w-100" onclick="location.href='?page=entreprise'">
                                            Renseigner <i class="fas fa-arrow-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="dashboard-card h-100">
                        <h5 class="mb-4"><i class="fas fa-calendar me-2"></i>Événements à venir</h5>
                        <ul class="list-group list-group-flush">
                            <?php if (!empty($evenements)): ?>
                                <?php foreach ($evenements as $event): ?>
                                    <?php 
                                        [$badgeText, $badgeColor] = formatBadgeDate($event['date_event']);
                                        $heure = date('H:i', strtotime($event['heure_event']));
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($event['titre_event']) ?></div>
                                            <div class="small text-muted"><?= date('d/m', strtotime($event['date_event'])) ?> · <?= $heure ?></div>
                                        </div>
                                        <span class="badge bg-<?= $badgeColor ?> rounded-pill"><?= $badgeText ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item px-0 py-3 text-muted text-center">Aucun événement à venir</li>
                            <?php endif; ?>
                        </ul>
                        <?php if (in_array($role, [2])): // Gestionnaire rapports ?>
                            <div class="text-center mt-3">
                                <button class="btn btn-sm btn-outline-primary" onclick="location.href='?page=agenda'">
                                    <i class="fas fa-calendar-plus me-1"></i> Planifier un nouvel événement
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            
</div>
</div>
</div>                            
</div>
</div>