<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}
$id_util = $_SESSION['id_util'] ?? null;
$enseignant = [];
$nbRapportsAVerifier = 0;
$nbJurys = 0;
$nbEtudiants = 0;
$nbComptesRendus = 0;

if ($id_util) {
    // Récupérer l’enseignant via login
    $stmt = $pdo->prepare("SELECT * FROM enseignant WHERE login_ens = (SELECT login_util FROM utilisateur WHERE id_util = ?)");
    $stmt->execute([$id_util]);
    $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($enseignant) {
        $idEns = $enseignant['id_ens'];

        // 1. Nombre de rapports à valider
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM rapport_etudiant r WHERE NOT EXISTS (SELECT 1 FROM valider v WHERE v.id_rapport = r.id_rapport AND v.id_ens = ?)");
        $stmt->execute([$idEns]);
        $nbRapportsAVerifier = $stmt->fetchColumn();

        // 2. Jurys à venir
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM jury_etudiant WHERE id_ens = ? AND statut IN ('Validé', 'En attente', 'Confirmé')");
        $stmt->execute([$idEns]);
        $nbJurys = $stmt->fetchColumn();

        // 3. Étudiants encadrés
        $stmt = $pdo->prepare("SELECT COUNT(DISTINCT r.num_etu) FROM rapport_etudiant r JOIN valider v ON v.id_rapport = r.id_rapport WHERE v.id_ens = ?");
        $stmt->execute([$idEns]);
        $nbEtudiants = $stmt->fetchColumn();

        // 4. Comptes rendus
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM rendre WHERE id_ens = ?");
        $stmt->execute([$idEns]);
        $nbComptesRendus = $stmt->fetchColumn();

        // 🔻 AJOUTE ICI
        $stmt = $pdo->prepare("SELECT * FROM message WHERE id_util = ? ORDER BY date_msg DESC");
        $stmt->execute([$idUtil]);
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //5.Notification
        $nbNotifications = 0; // ← Initialisation sécurisée
        $stmtNotif = $pdo->prepare("SELECT COUNT(*) FROM notification WHERE id_util = ? AND statut = 'non_lue'");
        $stmtNotif->execute([$idEns]);
        $nbNotifications = $stmtNotif->fetchColumn();

        $stmtNotifDetails = $pdo->prepare("SELECT * FROM notification WHERE id_util = ? AND statut = 'non_lue' ORDER BY date_notif DESC LIMIT 4");
        $stmtNotifDetails->execute([$idEns]);
        $notifications = $stmtNotifDetails->fetchAll(PDO::FETCH_ASSOC);


        //6.Profil enseignant
        $stmt = $pdo->prepare("SELECT * FROM enseignant WHERE login_ens = (SELECT login_util FROM utilisateur WHERE id_util = ?)");
        $stmt->execute([$id_util]);
        $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

        //7.Taches de l'enseignant
        $taches = [];
        $stmt = $pdo->prepare("
                SELECT titre_tache, date_limite, statut 
                FROM tache_enseignant 
                WHERE id_ens = ? 
                ORDER BY date_limite ASC
            ");
        $stmt->execute([$enseignant['id_ens']]);
        $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //8.raport à valider
        $rapportsAVerifier = [];
        $stmt = $pdo->prepare("
        SELECT r.id_rapport, r.nom_rapport, r.dte_rapport, r.theme_mem, r.etat_validation,
               e.nom_etu, e.prenom_etu, ne.lib_niv_etu
        FROM rapport_etudiant r
        JOIN etudiant e ON e.num_etu = r.num_etu
        JOIN inscrire i ON i.num_etu = e.num_etu
        JOIN niveau_etude ne ON ne.id_niv_etu = i.id_niv_etu
        WHERE NOT EXISTS (
            SELECT 1 FROM valider v WHERE v.id_rapport = r.id_rapport AND v.id_ens = ?
        )
        ORDER BY r.dte_rapport DESC
        ");
        $stmt->execute([$enseignant['id_ens']]);
        $rapportsAVerifier = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jurys = [];
        $stmt = $pdo->prepare("
            SELECT 
                e.nom_etu,
                e.prenom_etu,
                ne.lib_niv_etu,
                j.role_jury,
                j.statut
            FROM jury_etudiant j
            JOIN etudiant e ON e.num_etu = j.num_etu
            JOIN inscrire i ON i.num_etu = e.num_etu
            JOIN niveau_etude ne ON ne.id_niv_etu = i.id_niv_etu
            WHERE j.id_ens = ?
            ORDER BY e.nom_etu
        ");
        $stmt->execute([$enseignant['id_ens']]);
        $jurys = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $agenda = [];
        $stmt = $pdo->prepare("
                SELECT titre_event, date_event, heure_event
                FROM agenda
                WHERE id_ens = ?
                ORDER BY date_event ASC
                LIMIT 5
            ");
        $stmt->execute([$enseignant['id_ens']]);
        $agenda = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $comptesRendus = [];
        $stmt = $pdo->prepare("
            SELECT r.id_rendre, r.date_rendre, r.contenu, re.nom_rapport, e.nom_etu, e.prenom_etu
            FROM rendre r
            JOIN rapport_etudiant re ON r.id_rapport = re.id_rapport
            JOIN etudiant e ON re.num_etu = e.num_etu
            WHERE r.id_ens = ?
            ORDER BY r.date_rendre DESC
        ");
        $stmt->execute([$enseignant['id_ens']]);
        $comptesRendus = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
?>

<div class="header">
            <div class="d-flex align-items-center">
                <h2 class="page-title">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    Espace Enseignant
                </h2>
                <div class="ms-4 d-none d-md-block">
                    <span class="badge bg-success p-2">Année académique: 2024-2025</span>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-flex align-items-center">
                    <span class="text-dark me-3">
                    Bienvenue, <strong>Prof. <?= htmlspecialchars($enseignant['prenoms_ens'] . ' ' . $enseignant['nom_ens']) ?></strong>
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
                        <?php if (empty($notifications)): ?>
                                <li class="px-3 py-2 text-muted small">Aucune notification récente.</li>
                            <?php else: ?>
                                <?php foreach ($notifications as $notif): ?>
                                    <li><a class="dropdown-item py-3 border-bottom" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-<?= $notif['type_notif'] === 'alerte' ? 'danger' : ($notif['type_notif'] === 'succès' ? 'success' : 'primary') ?> text-white rounded-circle p-2">
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
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="btn btn-outline-dark d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar me-2 bg-white">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <span class="d-none d-md-inline">Mon compte</span>
                        <i class="fas fa-chevron-down ms-2 d-none d-md-inline"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li>
                            <div class="dropdown-header bg-light py-3">
                                Prof. <?= htmlspecialchars($enseignant['prenoms_ens'] . ' ' . $enseignant['nom_ens']) ?>
                            </div>
                        </li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user-circle me-2"></i>Mon profil</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-question-circle me-2"></i>Aide</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger py-2" href="../auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                    </ul>
                </div>

            </div>
        </div>
            
            
            
            <div class="row g-4">
                <!-- Statistiques générales -->
                <div class="col-md-12">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-value"><?= $nbRapportsAVerifier ?></div>
                                <div class="stat-label">Rapports à valider</div>
                                <div class="stat-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-value"><?= $nbJurys ?></div>
                                <div class="stat-label">Jurys à venir</div>
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-value"><?= $nbEtudiants ?></div>
                                <div class="stat-label">Étudiants encadrés</div>
                                <div class="stat-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-value"><?= $nbComptesRendus ?></div>
                                <div class="stat-label">Comptes rendus</div>
                                <div class="stat-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Profil enseignant -->
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-id-badge me-2"></i>Profil enseignant</h5>
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-3 rounded-circle bg-light mb-3">
                                <i class="fas fa-user-tie fa-3x text-secondary"></i>
                            </div>
                            <h4>Prof. <?= htmlspecialchars($enseignant['prenoms_ens'] . ' ' . $enseignant['nom_ens']) ?></h4>
                            <span class="badge bg-primary">Titre à définir</span> <!-- Si tu as un champ pour ça -->
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">ID Enseignant</label>
                                <div class="fw-medium"><?= htmlspecialchars($enseignant['id_ens']) ?></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Login</label>
                                <div class="fw-medium"><?= htmlspecialchars($enseignant['login_ens']) ?></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Spécialité</label>
                                <div class="fw-medium">
                                    <?php
                                    // Si la spécialité est dans une autre table reliée :
                                    // À adapter selon ton MCD
                                    if (isset($enseignant['id_spe'])) {
                                        $stmtSpe = $pdo->prepare("SELECT lib_spe FROM specialite WHERE id_spe = ?");
                                        $stmtSpe->execute([$enseignant['id_spe']]);
                                        $spe = $stmtSpe->fetchColumn();
                                        echo htmlspecialchars($spe);
                                    } else {
                                        echo "Non renseignée";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Grade académique</label>
                                <div class="fw-medium">
                                    <?php
                                    if (isset($enseignant['id_grade'])) {
                                        $stmtGrade = $pdo->prepare("SELECT nom_grade FROM grade WHERE id_grade = ?");
                                        $stmtGrade->execute([$enseignant['id_grade']]);
                                        echo htmlspecialchars($stmtGrade->fetchColumn());
                                    } else {
                                        echo "Non défini";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small text-muted">Fonction</label>
                                <div class="fw-medium">
                                    <?php
                                    if (isset($enseignant['id_fonct'])) {
                                        $stmtFonct = $pdo->prepare("SELECT nom_fonct FROM fonction WHERE id_fonct = ?");
                                        $stmtFonct->execute([$enseignant['id_fonct']]);
                                        echo htmlspecialchars($stmtFonct->fetchColumn());
                                    } else {
                                        echo "Non précisée";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Tâches à faire -->
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-tasks me-2"></i>Tâches à effectuer</h5>

                        <?php if (empty($taches)): ?>
                            <p class="text-muted">Aucune tâche pour le moment.</p>
                        <?php else: ?>
                            <?php foreach ($taches as $tache): ?>
                                <div class="task-item <?= htmlspecialchars($tache['statut']) ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1 <?= $tache['statut'] === 'termine' ? 'text-decoration-line-through' : '' ?>">
                                                <?= htmlspecialchars($tache['titre_tache']) ?>
                                            </h6>
                                            <p class="small mb-0">
                                                <?= $tache['statut'] === 'termine' ? 'Complété le' : 'Date limite' ?> :
                                                <?= date('d/m/Y', strtotime($tache['date_limite'])) ?>
                                            </p>
                                        </div>
                                        <?php
                                            $badgeClass = match ($tache['statut']) {
                                                'urgent' => 'bg-danger',
                                                'important' => 'bg-warning',
                                                'en_cours' => 'bg-info',
                                                'termine' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($tache['statut']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="text-end mt-3">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus me-2"></i>Ajouter une tâche
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Rapports à valider -->
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-file-signature me-2"></i>Rapports à valider</h5>

                        <?php if (empty($rapportsAVerifier)): ?>
                            <p class="text-muted">Aucun rapport à valider pour le moment.</p>
                        <?php else: ?>
                            <?php foreach ($rapportsAVerifier as $rapport): ?>
                                <div class="report-card mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h6><?= htmlspecialchars($rapport['theme_mem']) ?></h6>
                                        <span class="status-badge status-<?= $rapport['etat_validation'] === 'validé' ? 'approved' : 'new' ?>">
                                            <?= ucfirst($rapport['etat_validation']) ?>
                                        </span>
                                    </div>
                                    <div class="small text-muted mb-2">
                                        Soumis par: <?= htmlspecialchars($rapport['prenom_etu'] . ' ' . $rapport['nom_etu']) ?>
                                    </div>
                                    <div class="small text-muted mb-3">Date de soumission: <?= date('d/m/Y', strtotime($rapport['dte_rapport'])) ?></div>
                                    <div class="report-actions">
                                        <a href="voir_rapport.php?id=<?= $rapport['id_rapport'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Voir
                                        </a>
                                        <a href="../pages/ecrans_enseignants/valider_rapport.php?id=<?= $rapport['id_rapport'] ?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-1"></i> Approuver
                                        </a>
                                        <a href="rejeter_rapport.php?id=<?= $rapport['id_rapport'] ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times me-1"></i> Rejeter
                                        </a>
                                        <a href="commenter_rapport.php?id=<?= $rapport['id_rapport'] ?>" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment me-1"></i> Commenter
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="text-center mt-3">
                                <a href="tous_rapports.php" class="btn btn-primary">
                                    <i class="fas fa-list me-2"></i>Voir tous les rapports
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                <!-- Agenda / Calendrier -->
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-calendar-alt me-2"></i>Agenda</h5>
                        <div class="calendar-event">
                            <h6>Réunion du Département</h6>
                            <div class="small"><i class="fas fa-clock me-1"></i> 08/05/2025, 10:00 - 12:00</div>
                            <div class="small"><i class="fas fa-map-marker-alt me-1"></i> Salle de conférence A</div>
                        </div>
                        <div class="calendar-event">
                            <h6>Soutenance - Laura Jane</h6>
                            <div class="small"><i class="fas fa-clock me-1"></i> 12/05/2025, 14:00 - 16:00</div>
                            <div class="small"><i class="fas fa-map-marker-alt me-1"></i> Amphi B</div>
                        </div>
                        <div class="calendar-event">
                            <h6>Commission académique</h6>
                            <div class="small"><i class="fas fa-clock me-1"></i> 15/05/2025, 09:00 - 11:00</div>
                            <div class="small"><i class="fas fa-map-marker-alt me-1"></i> Salle du conseil</div>
                        </div>
                        <div class="calendar-event">
                            <h6>Jury de délibération - Master 2</h6>
                            <div class="small"><i class="fas fa-clock me-1"></i> 20/05/2025, 13:00 - 17:00</div>
                            <div class="small"><i class="fas fa-map-marker-alt me-1"></i> Salle de conférence C</div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus me-2"></i>Ajouter un événement
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Jurys assignés -->
                <div class="col-md-12">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-users me-2"></i>Mes jurys assignés</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>