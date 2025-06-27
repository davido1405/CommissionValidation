    <?php
require_once '../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}

$idUtil = $_SESSION['id_util'];

// Récupération de l'étudiant connecté
$stmt = $pdo->prepare("SELECT * FROM etudiant WHERE login_etu = (SELECT login_util FROM utilisateur WHERE id_util = ?)");
$stmt->execute([$idUtil]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupération de l'inscription + niveau + année
$stmt = $pdo->prepare("SELECT i.*, n.lib_niv_etu, a.dte_deb, a.dte_fin 
    FROM inscrire i
    JOIN niveau_etude n ON i.id_niv_etu = n.id_niv_etu
    JOIN annee_academique a ON a.id_ac = i.id_ac
    WHERE i.num_etu = ?
    ORDER BY i.dte_insc DESC
    LIMIT 1");
$stmt->execute([$etudiant['num_etu']]);
$inscription = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupération des rapports, encadrants et statuts
$stmt = $pdo->prepare("SELECT r.nom_rapport, d.dte_dep, r.etat_validation
FROM rapport_etudiant r
JOIN deposer d ON r.id_rapport = d.id_rapport
WHERE d.num_etu = ?
ORDER BY d.dte_dep DESC
");
$stmt->execute([$etudiant['num_etu']]);
$rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Données formatées
$nomComplet = htmlspecialchars($etudiant['prenom_etu'] . ' ' . $etudiant['nom_etu']);
$niveau = htmlspecialchars($inscription['lib_niv_etu'] ?? '---');
$annee = $inscription ? date('Y', strtotime($inscription['dte_deb'])) . '-' . date('Y', strtotime($inscription['dte_fin'])) : '---';
$dateInsc = $inscription ? date('d/m/Y', strtotime($inscription['dte_insc'])) : '---';
$email = htmlspecialchars($etudiant['login_etu']);
$numEtudiant=htmlspecialchars($etudiant['num_etu']);

$stmt = $pdo->prepare("SELECT * FROM message WHERE id_util = ? ORDER BY date_msg DESC");
$stmt->execute([$idUtil]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


//Notifications d'utilisateur
$idUtil = $_SESSION['id_util'];
$stmt = $pdo->prepare("SELECT * FROM notification WHERE id_util = ? ORDER BY date_notif DESC LIMIT 5");
$stmt->execute([$idUtil]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

//compter les notifications non lue
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM notification WHERE id_util = ? AND statut = 'non_lue'");
$stmtCount->execute([$idUtil]);
$notifCount = $stmtCount->fetchColumn();

//Gérer statut du rapport

// Récupération des rapports de l'étudiant (dernier d'abord)
$stmt = $pdo->prepare("
    SELECT r.nom_rapport, r.dte_rapport, r.lien_rapport, r.etat_validation, r.id_jury,
           e.nom_ens, e.prenoms_ens
    FROM rapport_etudiant r
    LEFT JOIN valider v ON r.id_rapport = v.id_rapport
    LEFT JOIN enseignant e ON v.id_ens = e.id_ens
    WHERE r.num_etu = ?
    ORDER BY r.dte_rapport DESC
");
$stmt->execute([$etudiant['num_etu']]);
$rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialisation de l'état
$etape = 0;
$statutText = "Aucun rapport";
$dateMaj = null;

// On prend le plus récent
$dernier = $rapports[0] ?? null;

if ($dernier) {
    $etape = 1;
    $statutText = "Rapport déposé";
    $dateMaj = $dernier['dte_rapport'];

    if ($dernier['etat_validation'] === 'validé') {
        $etape = 2;
        $statutText = "Rapport validé";
    }

    if (!empty($dernier['id_jury'])) {
        $etape = 3;
        $statutText = "Jury affecté";
    }

    if ($dernier['etat_validation'] === 'soutenance programmée') {
        $etape = 4;
        $statutText = "Soutenance programmée";
    }
}

$pourcentage = $etape * 25;


// Récupération du dernier rapport de l'étudiant
$stmt = $pdo->prepare("
    SELECT r.nom_rapport, r.dte_rapport, r.etat_validation, r.id_jury,
           e.nom_ens, e.prenoms_ens
    FROM rapport_etudiant r
    LEFT JOIN valider v ON v.id_rapport = r.id_rapport
    LEFT JOIN enseignant e ON v.id_ens = e.id_ens
    WHERE r.num_etu = ?
    ORDER BY r.dte_rapport DESC
    LIMIT 1
");
$stmt->execute([$etudiant['num_etu']]);
$dernierRapport = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialisation
$etat = $dernierRapport['etat_validation'] ?? null;
$juryAffecte = !empty($dernierRapport['id_jury']);
$dateDepot = $dernierRapport['dte_rapport'] ?? null;
$titre = $dernierRapport['nom_rapport'] ?? '';
$encadreur = (!empty($dernierRapport['nom_ens']))
    ? "Prof. {$dernierRapport['prenoms_ens']} {$dernierRapport['nom_ens']}"
    : "Non attribué";


// Récupération des rapports déposés par l'étudiant connecté
$stmt = $pdo->prepare("
    SELECT r.nom_rapport, r.etat_validation, d.dte_dep,
           e.nom_ens, e.prenoms_ens
    FROM rapport_etudiant r
    JOIN deposer d ON d.id_rapport = r.id_rapport
    LEFT JOIN valider v ON v.id_rapport = r.id_rapport
    LEFT JOIN enseignant e ON e.id_ens = v.id_ens
    WHERE r.num_etu = ?
    ORDER BY d.dte_dep DESC
");
$stmt->execute([$etudiant['num_etu']]);
$rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
    <div class="header">
            <div class="d-flex align-items-center">
                <h2 class="page-title">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Espace Étudiant
                </h2>
                <div class="ms-4 d-none d-md-block">
                    <span class="badge bg-success p-2">Année académique: <?= $annee ?></span>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-4">
    <div class="d-none d-md-flex align-items-center">
        <span class="text-dark me-3">Bienvenue, <strong><?= htmlspecialchars($etudiant['prenom_etu'] . ' ' . $etudiant['nom_etu']) ?></strong></span>
    </div>
    <div class="dropdown me-3">
        <a class="btn btn-light position-relative rounded-circle p-2" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i>
            <?php if ($notifCount > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $notifCount ?>
                <span class="visually-hidden">nouvelles notifications</span>
            </span>
            <?php endif; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="min-width: 320px;">
            <li><h6 class="dropdown-header bg-light py-3">Notifications</h6></li>

            <?php if (count($notifications) > 0): ?>
                <?php foreach ($notifications as $notif): ?>
                    <li><a class="dropdown-item py-3 border-bottom" href="#">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-<?= 
                                    $notif['type_notif'] === 'succès' ? 'success' :
                                    ($notif['type_notif'] === 'alerte' ? 'danger' : 'primary')
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
            <?php else: ?>
                <li class="dropdown-item text-muted text-center">Aucune notification</li>
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
            <li><div class="dropdown-header bg-light py-3"><?= $nomComplet ?></div></li>
            <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user-circle me-2"></i>Mon profil</a></li>
            <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
            <li><a class="dropdown-item py-2" href="#"><i class="fas fa-question-circle me-2"></i>Aide</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger py-2" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
        </ul>
    </div>
</div>
</div>
    
    
    
    <div class="row g-4">
                <!-- Informations étudiant -->
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-user-graduate me-2"></i>Informations personnelles</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Numéro étudiant</label>
                                <div class="fw-medium"><?=$numEtudiant?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Nom complet</label>
                                <div class="fw-medium"><?= $nomComplet ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Niveau d'étude</label>
                                <div class="fw-medium"><?= $niveau ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Année académique</label>
                                <div class="fw-medium"><?= $annee ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Login</label>
                                <div class="fw-medium"><?= $email ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Date d'inscription</label>
                                <div class="fw-medium"><?= $dateInsc ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statut rapport -->
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-chart-pie me-2"></i>État de la soutenance</h5>
                        <div class="d-flex flex-column align-items-center justify-content-center py-3">
                            <div class="progress w-100 mb-3" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $pourcentage ?>%;" aria-valuenow="<?= $pourcentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between w-100 px-2">
                                <span class="small text-muted">Dépôt</span>
                                <span class="small text-muted">Validation</span>
                                <span class="small text-muted">Jury</span>
                                <span class="small text-muted">Soutenance</span>
                            </div>
                            <div class="mt-4 text-center">
                                <span class="status-badge <?= $etape === 4 ? 'status-approved' : 'status-pending' ?>">
                                    <?= $statutText ?>
                                </span>
                                <?php if ($dateMaj): ?>
                                    <p class="mt-3 mb-0 text-muted small">Dernière mise à jour: <?= date('d/m/Y', strtotime($dateMaj)) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Timeline suivi -->
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-history me-2"></i>Suivi de votre rapport</h5>
                        
                        <div class="timeline">

                        <!-- Étape 1 : Dépôt -->
                        <div class="timeline-item">
                            <div class="timeline-marker active"><i class="fas fa-check"></i></div>
                            <h6 class="m-0">Dépôt du rapport</h6>
                            <p class="text-muted small">
                                <?= $dateDepot ? "Rapport déposé le " . date('d/m/Y', strtotime($dateDepot)) : "Aucune date disponible" ?>
                            </p>
                            <p class="small">Votre rapport "<?= htmlspecialchars($titre) ?>" a été soumis avec succès.</p>
                        </div>

                        <!-- Étape 2 : Validation par l'encadreur -->
                        <div class="timeline-item">
                            <div class="timeline-marker <?= $etat === 'validé' || $juryAffecte || $etat === 'soutenance programmée' ? 'active' : 'pending' ?>">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h6 class="m-0">Validation par l'encadreur</h6>
                            <p class="text-muted small">
                                <?= $etat === 'validé' || $juryAffecte || $etat === 'soutenance programmée'
                                    ? "Validé par $encadreur"
                                    : "En attente - $encadreur" ?>
                            </p>
                            <p class="small">
                                <?= $etat === 'validé' || $juryAffecte || $etat === 'soutenance programmée'
                                    ? "Votre rapport a été validé."
                                    : "Votre encadreur est en train d'examiner votre rapport." ?>
                            </p>
                        </div>

                        <!-- Étape 3 : Validation par la commission -->
                        <div class="timeline-item">
                            <div class="timeline-marker <?= $juryAffecte || $etat === 'soutenance programmée' ? 'active' : 'future' ?>">
                                <i class="fas fa-hourglass"></i>
                            </div>
                            <h6 class="m-0">Validation par la commission</h6>
                            <p class="text-muted small">
                                <?= $juryAffecte || $etat === 'soutenance programmée'
                                    ? "Validé"
                                    : "Étape à venir" ?>
                            </p>
                        </div>

                        <!-- Étape 4 : Affectation du jury -->
                        <div class="timeline-item">
                            <div class="timeline-marker <?= $juryAffecte ? 'active' : 'future' ?>">
                                <i class="fas fa-users"></i>
                            </div>
                            <h6 class="m-0">Affectation du jury</h6>
                            <p class="text-muted small"><?= $juryAffecte ? "Jury affecté" : "Étape à venir" ?></p>
                        </div>

                        <!-- Étape 5 : Planification de la soutenance -->
                        <div class="timeline-item">
                            <div class="timeline-marker <?= $etat === 'soutenance programmée' ? 'active' : 'future' ?>">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h6 class="m-0">Planification de la soutenance</h6>
                            <p class="text-muted small">
                                <?= $etat === 'soutenance programmée' ? "Date planifiée" : "Étape à venir" ?>
                            </p>
                        </div>

                    </div>

                </div>
                </div>

                <!-- Upload rapport -->
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <form action="traitement_lien.php" method="POST">
                            <div class="form-group">
                                <label for="lien_rapport">Lien de votre rapport (Google Drive, OneDrive...)</label>
                                <input type="url" class="form-control" name="lien_rapport" id="lien_rapport" placeholder="https://drive.google.com/..." required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">
                                <i class="fas fa-paper-plane me-2"></i>Soumettre
                            </button>
                        </form>

                    </div>
                </div>
                
                <!-- Mes rapports récents -->
                <div class="col-12">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-file-alt me-2"></i>Mes rapports déposés</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Titre du rapport</th>
                                        <th>Date de dépôt</th>
                                        <th>Encadreur</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rapports as $r): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($r['nom_rapport']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($r['dte_rapport'])) ?></td>
                                            <td><?= $r['nom_ens'] ? 'Prof. ' . htmlspecialchars($r['prenoms_ens'] . ' ' . $r['nom_ens']) : 'Non défini' ?></td>
                                            <td>
                                                <span class="status-badge 
                                                    <?php
                                                        if ($r['etat_validation'] === 'validé') echo 'status-approved';
                                                        elseif ($r['etat_validation'] === 'soutenance programmée') echo 'status-final';
                                                        elseif ($r['etat_validation'] === 'rejeté') echo 'status-rejected';
                                                        else echo 'status-pending';
                                                    ?>">
                                                    <?= ucfirst($r['etat_validation']) ?: 'En attente' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if (!empty($r['lien_rapport'])): ?>
                                                    <a class="btn btn-sm btn-outline-primary" href="<?= htmlspecialchars($r['lien_rapport']) ?>" target="_blank" title="Voir le rapport">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline-secondary disabled" title="Aucun lien disponible">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button class="btn btn-sm btn-outline-secondary" title="Historique">
                                                    <i class="fas fa-history"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>