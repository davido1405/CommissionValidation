
        <div class="header">
            <div class="d-flex align-items-center">
                <h2 class="page-title">
                    <i class="fas fa-users me-2"></i>
                    Gestion des Jurys
                </h2>
                <div class="ms-4 d-none d-md-block">
                    <span class="badge bg-success p-2">Année académique: 2024-2025</span>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-flex align-items-center">
                    <span class="text-dark me-3">Bienvenue, <strong>Thomas Bernard</strong></span>
                </div>
                <div class="dropdown me-3">
                    <a class="btn btn-light position-relative rounded-circle p-2" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            4
                            <span class="visually-hidden">nouvelles notifications</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="min-width: 320px;">
                        <li><h6 class="dropdown-header bg-light py-3">Notifications</h6></li>
                        <li><a class="dropdown-item py-3 border-bottom" href="#">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info text-white rounded-circle p-2">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-0 fw-bold">Soutenance programmée</p>
                                    <small class="text-muted">Demain à 09:00 - Salle A104</small>
                                </div>
                            </div>
                        </a></li>
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
                        <li><div class="dropdown-header bg-light py-3">Thomas Bernard</div></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user-circle me-2"></i>Mon profil</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-question-circle me-2"></i>Aide</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger py-2" href="#"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
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
                            <div class="stats-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stats-title">Jurys Constitués</div>
                            <div class="stats-number">24</div>
                            <div class="stats-trend">
                                <i class="fas fa-plus"></i> +3 cette semaine
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-warning">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stats-title">Soutenances Planifiées</div>
                            <div class="stats-number">8</div>
                            <div class="stats-trend">
                                <i class="fas fa-calendar"></i> Cette semaine
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-success">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stats-title">Soutenances Réalisées</div>
                            <div class="stats-number">156</div>
                            <div class="stats-trend">
                                <i class="fas fa-check"></i> Cette année
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-info">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stats-title">En attente de jury</div>
                            <div class="stats-number">12</div>
                            <div class="stats-trend">
                                <i class="fas fa-exclamation-triangle"></i> À traiter
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Calendar -->
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Actions Rapides</h5>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-primary-subtle text-primary">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                    </div>
                                    <h6>Constituer un jury</h6>
                                    <p class="text-muted small mb-3">Affecter des enseignants</p>
                                    <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#createJuryModal">
                                        Créer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-success-subtle text-success">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                    </div>
                                    <h6>Planifier soutenance</h6>
                                    <p class="text-muted small mb-3">Programmer une session</p>
                                    <button class="btn btn-sm btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#scheduleDefenseModal">
                                        Planifier <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-warning-subtle text-warning">
                                            <i class="fas fa-magic"></i>
                                        </div>
                                    </div>
                                    <h6>Attribution automatique</h6>
                                    <p class="text-muted small mb-3">Basée sur la disponibilité</p>
                                    <button class="btn btn-sm btn-outline-warning w-100" onclick="autoAssignJuries()">
                                        Assigner <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card h-100">
                        <h6 class="mb-3"><i class="fas fa-calendar-week me-2"></i>Prochaines Soutenances</h6>
                        <div class="upcoming-defenses">
                            <div class="defense-item mb-3 p-2 border-start border-4 border-primary">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Koné Mamadou</h6>
                                        <small class="text-muted">Application mobile</small>
                                    </div>
                                    <span class="badge bg-primary">Demain</span>
                                </div>
                                <div class="mt-2">
                                    <small><i class="fas fa-clock me-1"></i>09:00 - 11:00</small><br>
                                    <small><i class="fas fa-map-marker-alt me-1"></i>Salle A104</small>
                                </div>
                            </div>
                            <div class="defense-item mb-3 p-2 border-start border-4 border-success">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Yao Marie</h6>
                                        <small class="text-muted">Système de bibliothèque</small>
                                    </div>
                                    <span class="badge bg-success">Jeudi</span>
                                </div>
                                <div class="mt-2">
                                    <small><i class="fas fa-clock me-1"></i>14:00 - 16:00</small><br>
                                    <small><i class="fas fa-map-marker-alt me-1"></i>Salle B205</small>
                                </div>
                            </div>
                            <div class="defense-item mb-3 p-2 border-start border-4 border-warning">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Bamba Issouf</h6>
                                        <small class="text-muted">Algorithmes de tri</small>
                                    </div>
                                    <span class="badge bg-warning text-dark">Vendredi</span>
                                </div>
                                <div class="mt-2">
                                    <small><i class="fas fa-clock me-1"></i>10:00 - 12:00</small><br>
                                    <small><i class="fas fa-map-marker-alt me-1"></i>Salle C301</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-outline-primary btn-sm" onclick="showFullCalendar()">
                                <i class="fas fa-calendar me-1"></i>Voir calendrier complet
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jury Management Tabs -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-clipboard-list me-2"></i>Gestion des Jurys de Soutenance</h5>
                        <p class="text-muted mb-0">Constituer et gérer les jurys pour les soutenances</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="exportJuryReport()">
                            <i class="fas fa-file-pdf me-2"></i>Rapport PDF
                        </button>
                        <button class="btn btn-success" onclick="generateJurySheets()">
                            <i class="fas fa-file-excel me-2"></i>Fiches d'évaluation
                        </button>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="juryTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="active-juries-tab" data-bs-toggle="tab" data-bs-target="#active-juries" type="button" role="tab">
                            <i class="fas fa-users me-2"></i>Jurys Actifs
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pending-reports-tab" data-bs-toggle="tab" data-bs-target="#pending-reports" type="button" role="tab">
                            <i class="fas fa-hourglass-half me-2"></i>En attente de jury
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-defenses-tab" data-bs-toggle="tab" data-bs-target="#completed-defenses" type="button" role="tab">
                            <i class="fas fa-check-circle me-2"></i>Soutenances terminées
                        </button>
                    </li>
                </ul>

                <div class="tab-content p-3" id="juryTabsContent">
                    <!-- Active Juries Tab -->
                    <div class="tab-pane fade show active" id="active-juries" role="tabpanel">
                        <!-- Filters for Active Juries -->
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-4">
                                <div class="search-box">
                                    <i class="fas fa-search text-muted"></i>
                                    <input type="text" id="searchActiveJury" placeholder="Rechercher un jury..." onkeyup="filterActiveJuries()">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <select class="custom-select" id="filterJuryStatus" onchange="filterActiveJuries()">
                                            <option value="">Tous les statuts</option>
                                            <option value="Constitué">Constitué</option>
                                            <option value="Planifié">Planifié</option>
                                            <option value="En cours">En cours</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="custom-select" id="filterJuryType" onchange="filterActiveJuries()">
                                            <option value="">Tous les types</option>
                                            <option value="Mémoire">Mémoire</option>
                                            <option value="Stage">Stage</option>
                                            <option value="Projet">Projet</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="custom-select" id="filterJuryLevel" onchange="filterActiveJuries()">
                                            <option value="">Tous les niveaux</option>
                                            <option value="Licence 3">Licence 3</option>
                                            <option value="Master 1">Master 1</option>
                                            <option value="Master 2">Master 2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-outline-secondary w-100" onclick="resetJuryFilters()">
                                            <i class="fas fa-undo me-1"></i>Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Juries Table -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="activeJuriesTable">
                                <thead>
                                    <tr>
                                        <th>ID Jury</th>
                                        <th>Étudiant</th>
                                        <th>Titre du rapport</th>
                                        <th>Membres du jury</th>
                                        <th>Date/Heure</th>
                                        <th>Salle</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">#JUR001</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2 bg-primary text-white">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">Koné Mamadou</div>
                                                    <small class="text-muted">Master 2 - Informatique</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Application mobile de gestion</div>
                                                <small class="text-muted">Développement Android</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="jury-members">
                                                <div><strong>Président:</strong> Dr. Diabaté Sekou</div>
                                                <div><strong>Rapporteur:</strong> Prof. Kouamé Akissi</div>
                                                <div><strong>Examinateur:</strong> Dr. Bamba Issouf</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">27/05/2025</div>
                                            <small class="text-muted">09:00 - 11:00</small>
                                        </td>
                                        <td><span class="badge bg-info">A104</span></td>
                                        <td><span class="badge bg-warning">Planifié</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Détails" onclick="viewJuryDetails(1)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editJury(1)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="PV" onclick="generatePV(1)">
                                                    <i class="fas fa-file-alt"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Notifier" onclick="notifyJury(1)">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">#JUR002</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2 bg-success text-white">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">Yao Marie Ange</div>
                                                    <small class="text-muted">Master 1 - Informatique</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Système de bibliothèque</div>
                                                <small class="text-muted">Conception et développement</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="jury-members">
                                                <div><strong>Président:</strong> Prof. Kouamé Akissi</div>
                                                <div><strong>Rapporteur:</strong> Dr. Traoré Fatou</div>
                                                <div><strong>Examinateur:</strong> Dr. Ouattara Jean</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">28/05/2025</div>
                                            <small class="text-muted">14:00 - 16:00</small>
                                        </td>
                                        <td><span class="badge bg-success">B205</span></td>
                                        <td><span class="badge bg-warning">Planifié</span></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Détails" onclick="viewJuryDetails(2)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editJury(2)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="PV" onclick="generatePV(2)">
                                                    <i class="fas fa-file-alt"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Notifier" onclick="notifyJury(2)">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pending Reports Tab -->
                    <div class="tab-pane fade" id="pending-reports" role="tabpanel">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>12 rapports</strong> sont en attente d'affectation à un jury.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" class="form-check-input" id="selectAllPending" onchange="toggleSelectAllPending()">
                                        </th>
                                        <th>Étudiant</th>
                                        <th>Titre du rapport</th>
                                        <th>Type</th>
                                        <th>Date validation</th>
                                        <th>Priorité</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input pending-checkbox" value="1">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2 bg-warning text-white">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">Touré Ahmed</div>
                                                    <small class="text-muted">Master 2</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Système de recommandation IA</td>
                                        <td><span class="badge bg-primary">Mémoire</span></td>
                                        <td>20/05/2025</td>
                                        <td><span class="badge bg-danger">Urgent</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="assignJuryQuick(1)">
                                                <i class="fas fa-users"></i> Assigner jury
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input pending-checkbox" value="2">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2 bg-info text-white">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold">Diabaté Aminata</div>
                                                    <small class="text-muted">Master 1</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>E-commerce mobile avec React Native</td>
                                        <td><span class="badge bg-warning text-dark">Stage</span></td>
                                        <td>22/05/2025</td>
                                        <td><span class="badge bg-warning">Normal</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="assignJuryQuick(2)">
                                                <i class="fas fa-users"></i> Assigner jury
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3" id="bulkAssignPanel" style="display: none;">
                            <div class="col-12">
                                <div class="alert alert-primary d-flex justify-content-between align-items-center">
                                    <span id="selectedPendingCount">0 rapport(s) sélectionné(s)</span>
                                    <button class="btn btn-sm btn-primary" onclick="bulkAssignJuries()">
                                        <i class="fas fa-users me-1"></i>Assigner jurys en lot
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Defenses Tab -->
                    <div class="tab-pane fade" id="completed-defenses" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6>Soutenances réalisées</h6>
                                <small class="text-muted">156 soutenances cette année académique</small>
                            </div>
                            <button class="btn btn-outline-primary btn-sm" onclick="generateAnnualReport()">
                                <i class="fas fa-chart-line me-1"></i>Rapport annuel
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Étudiant</th>
                                        <th>Titre</th>
                                        <th>Date soutenance</th>
                                        <th>Note finale</th>
                                        <th>Mention</th>
                                        <th>PV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Koffi Jean-Marie</td>
                                        <td>Intelligence artificielle en santé</td>
                                        <td>15/05/2025</td>
                                        <td><span class="badge bg-success">17/20</span></td>
                                        <td><span class="badge bg-warning text-dark">Très Bien</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-success" onclick="downloadPV(1)">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ouattara Fatoumata</td>
                                        <td>Blockchain et sécurité</td>
                                        <td>12/05/2025</td>
                                        <td><span class="badge bg-success">15/20</span></td>
                                        <td><span class="badge bg-info">Bien</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-success" onclick="downloadPV(2)">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Jury Modal -->
    <div class="modal fade" id="createJuryModal" tabindex="-1" aria-labelledby="createJuryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJuryModalLabel">
                        <i class="fas fa-users-cog me-2"></i>Constituer un nouveau jury
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createJuryForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="juryStudent" class="form-label">Étudiant <span class="text-danger">*</span></label>
                                <select class="form-select" id="juryStudent" name="num_etu" required>
                                    <option value="">Choisir un étudiant...</option>
                                    <option value="1">Koné Mamadou - Master 2</option>
                                    <option value="2">Yao Marie Ange - Master 1</option>
                                    <option value="3">Bamba Issouf - Licence 3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="juryReport" class="form-label">Rapport <span class="text-danger">*</span></label>
                                <select class="form-select" id="juryReport" name="id_rapport" required>
                                    <option value="">Choisir un rapport...</option>
                                    <option value="1">Application mobile de gestion</option>
                                    <option value="2">Système de bibliothèque</option>
                                    <option value="3">Algorithmes de tri</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="juryPresident" class="form-label">Président du jury <span class="text-danger">*</span></label>
                                <select class="form-select" id="juryPresident" name="president" required>
                                    <option value="">Choisir...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="juryReporter" class="form-label">Rapporteur <span class="text-danger">*</span></label>
                                <select class="form-select" id="juryReporter" name="rapporteur" required>
                                    <option value="">Choisir...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="juryExaminer" class="form-label">Examinateur <span class="text-danger">*</span></label>
                                <select class="form-select" id="juryExaminer" name="examinateur" required>
                                    <option value="">Choisir...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="juryAdditional" class="form-label">Membre supplémentaire</label>
                                <select class="form-select" id="juryAdditional" name="membre_supp">
                                    <option value="">Optionnel...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="juryNotes" class="form-label">Notes/Instructions</label>
                                <textarea class="form-control" id="juryNotes" name="notes" rows="3" placeholder="Instructions spéciales pour le jury..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="createJury()">
                        <i class="fas fa-save me-2"></i>Constituer le jury
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Defense Modal -->
    <div class="modal fade" id="scheduleDefenseModal" tabindex="-1" aria-labelledby="scheduleDefenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleDefenseModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Planifier une soutenance
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="scheduleDefenseForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="defenseJury" class="form-label">Jury <span class="text-danger">*</span></label>
                                <select class="form-select" id="defenseJury" name="id_jury" required>
                                    <option value="">Choisir un jury...</option>
                                    <option value="1">#JUR001 - Koné Mamadou</option>
                                    <option value="2">#JUR002 - Yao Marie Ange</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="defenseDate" class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="defenseDate" name="date_soutenance" required>
                            </div>
                            <div class="col-md-6">
                                <label for="defenseStartTime" class="form-label">Heure de début <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="defenseStartTime" name="heure_debut" required>
                            </div>
                            <div class="col-md-6">
                                <label for="defenseEndTime" class="form-label">Heure de fin <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="defenseEndTime" name="heure_fin" required>
                            </div>
                            <div class="col-md-6">
                                <label for="defenseRoom" class="form-label">Salle <span class="text-danger">*</span></label>
                                <select class="form-select" id="defenseRoom" name="salle" required>
                                    <option value="">Choisir une salle...</option>
                                    <option value="A104">Salle A104</option>
                                    <option value="B205">Salle B205</option>
                                    <option value="C301">Salle C301</option>
                                    <option value="Amphi 1">Amphithéâtre 1</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="defenseType" class="form-label">Type de soutenance</label>
                                <select class="form-select" id="defenseType" name="type_soutenance">
                                    <option value="Publique">Publique</option>
                                    <option value="Privée">Privée</option>
                                    <option value="Mixte">Mixte</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="notifyParticipants" name="notify" checked>
                                    <label class="form-check-label" for="notifyParticipants">
                                        Notifier tous les participants par email
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="defenseInstructions" class="form-label">Instructions particulières</label>
                                <textarea class="form-control" id="defenseInstructions" name="instructions" rows="3" placeholder="Instructions spéciales pour la soutenance..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="scheduleDefense()">
                        <i class="fas fa-calendar-check me-2"></i>Planifier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Jury Details Modal -->
    <div class="modal fade" id="viewJuryModal" tabindex="-1" aria-labelledby="viewJuryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewJuryModalLabel">
                        <i class="fas fa-users me-2"></i>Détails du jury
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="juryDetailsContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="editJuryFromModal()">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functions
        function filterActiveJuries() {
            const searchTerm = document.getElementById('searchActiveJury').value.toLowerCase();
            const statusFilter = document.getElementById('filterJuryStatus').value;
            const typeFilter = document.getElementById('filterJuryType').value;
            const levelFilter = document.getElementById('filterJuryLevel').value;
            
            const rows = document.querySelectorAll('#activeJuriesTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesStatus = !statusFilter || text.includes(statusFilter.toLowerCase());
                const matchesType = !typeFilter || text.includes(typeFilter.toLowerCase());
                const matchesLevel = !levelFilter || text.includes(levelFilter.toLowerCase());
                
                row.style.display = (matchesSearch && matchesStatus && matchesType && matchesLevel) ? '' : 'none';
            });
        }

        function resetJuryFilters() {
            document.getElementById('searchActiveJury').value = '';
            document.getElementById('filterJuryStatus').value = '';
            document.getElementById('filterJuryType').value = '';
            document.getElementById('filterJuryLevel').value = '';
            filterActiveJuries();
        }

        // Jury management functions
        function createJury() {
            const form = document.getElementById('createJuryForm');
            if (form.checkValidity()) {
                const formData = new FormData(form);
                
                // Validate that president, reporter, and examiner are different
                const president = formData.get('president');
                const reporter = formData.get('rapporteur');
                const examiner = formData.get('examinateur');
                
                if (president === reporter || president === examiner || reporter === examiner) {
                    alert('Le président, le rapporteur et l\'examinateur doivent être différents.');
                    return;
                }
                
                console.log('Creating jury...');
                bootstrap.Modal.getInstance(document.getElementById('createJuryModal')).hide();
                showNotification('Jury constitué avec succès!', 'success');
            } else {
                form.reportValidity();
            }
        }

        function scheduleDefense() {
            const form = document.getElementById('scheduleDefenseForm');
            if (form.checkValidity()) {
                const formData = new FormData(form);
                
                // Validate time range
                const startTime = formData.get('heure_debut');
                const endTime = formData.get('heure_fin');
                
                if (startTime >= endTime) {
                    alert('L\'heure de fin doit être postérieure à l\'heure de début.');
                    return;
                }
                
                console.log('Scheduling defense...');
                bootstrap.Modal.getInstance(document.getElementById('scheduleDefenseModal')).hide();
                showNotification('Soutenance planifiée avec succès!', 'success');
            } else {
                form.reportValidity();
            }
        }

        function viewJuryDetails(id) {
            console.log('Viewing jury details:', id);
            
            const juryData = {
                1: {
                    id: '#JUR001',
                    student: 'Koné Mamadou',
                    title: 'Application mobile de gestion de stocks',
                    president: 'Dr. Diabaté Sekou',
                    reporter: 'Prof. Kouamé Akissi',
                    examiner: 'Dr. Bamba Issouf',
                    date: '27/05/2025',
                    time: '09:00 - 11:00',
                    room: 'A104',
                    status: 'Planifié'
                }
            };
            
            const jury = juryData[id] || juryData[1];
            
            const detailsContent = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informations générales</h6>
                        <p><strong>ID Jury:</strong> ${jury.id}</p>
                        <p><strong>Étudiant:</strong> ${jury.student}</p>
                        <p><strong>Titre:</strong> ${jury.title}</p>
                        <p><strong>Date:</strong> ${jury.date}</p>
                        <p><strong>Heure:</strong> ${jury.time}</p>
                        <p><strong>Salle:</strong> ${jury.room}</p>
                        <p><strong>Statut:</strong> <span class="badge bg-warning">${jury.status}</span></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Composition du jury</h6>
                        <div class="jury-composition">
                            <div class="jury-member mb-2 p-2 border-start border-4 border-primary">
                                <strong>Président</strong><br>
                                ${jury.president}<br>
                                <small class="text-muted">Préside la soutenance</small>
                            </div>
                            <div class="jury-member mb-2 p-2 border-start border-4 border-success">
                                <strong>Rapporteur</strong><br>
                                ${jury.reporter}<br>
                                <small class="text-muted">Évalue le rapport</small>
                            </div>
                            <div class="jury-member mb-2 p-2 border-start border-4 border-info">
                                <strong>Examinateur</strong><br>
                                ${jury.examiner}<br>
                                <small class="text-muted">Pose les questions</small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Documents</h6>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-pdf text-danger me-2"></i>Rapport de l'étudiant
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-file-alt text-primary me-2"></i>Fiche d'évaluation
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-envelope text-info me-2"></i>Convocation jury
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Actions disponibles</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="generatePV(${id})">
                                <i class="fas fa-file-alt me-2"></i>Générer PV
                            </button>
                            <button class="btn btn-outline-success" onclick="notifyJury(${id})">
                                <i class="fas fa-envelope me-2"></i>Notifier les membres
                            </button>
                            <button class="btn btn-outline-warning" onclick="editJury(${id})">
                                <i class="fas fa-edit me-2"></i>Modifier le jury
                            </button>
                            <button class="btn btn-outline-info" onclick="rescheduleDefense(${id})">
                                <i class="fas fa-calendar-alt me-2"></i>Reprogrammer
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('juryDetailsContent').innerHTML = detailsContent;
            new bootstrap.Modal(document.getElementById('viewJuryModal')).show();
        }

        function editJury(id) {
            console.log('Editing jury:', id);
            // Open edit modal with pre-filled data
        }

        function generatePV(id) {
            console.log('Generating PV for jury:', id);
            showNotification('Génération du procès-verbal en cours...', 'info');
        }

        function notifyJury(id) {
            if (confirm('Envoyer les notifications à tous les membres du jury ?')) {
                console.log('Notifying jury members:', id);
                showNotification('Notifications envoyées!', 'success');
            }
        }

        function assignJuryQuick(id) {
            console.log('Quick assigning jury for report:', id);
            // Open create jury modal with pre-filled report
        }

        function autoAssignJuries() {
            if (confirm('Effectuer l\'attribution automatique des jurys basée sur les spécialisations et disponibilités ?')) {
                console.log('Auto-assigning juries...');
                showNotification('Attribution automatique en cours...', 'info');
            }
        }

        // Bulk operations for pending reports
        function toggleSelectAllPending() {
            const selectAll = document.getElementById('selectAllPending');
            const checkboxes = document.querySelectorAll('.pending-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            
            updateBulkAssignPanel();
        }

        function updateBulkAssignPanel() {
            const checkedBoxes = document.querySelectorAll('.pending-checkbox:checked');
            const panel = document.getElementById('bulkAssignPanel');
            const countElement = document.getElementById('selectedPendingCount');
            
            if (checkedBoxes.length > 0) {
                panel.style.display = 'block';
                countElement.textContent = `${checkedBoxes.length} rapport(s) sélectionné(s)`;
            } else {
                panel.style.display = 'none';
            }
        }

        function bulkAssignJuries() {
            const checkedBoxes = document.querySelectorAll('.pending-checkbox:checked');
            if (checkedBoxes.length === 0) {
                alert('Veuillez sélectionner au moins un rapport.');
                return;
            }
            
            if (confirm(`Constituer des jurys pour ${checkedBoxes.length} rapport(s) automatiquement ?`)) {
                console.log('Bulk assigning juries...');
                showNotification(`${checkedBoxes.length} jury(s) constitué(s)!`, 'success');
            }
        }

        // Utility functions
        function showFullCalendar() {
            console.log('Showing full calendar...');
            // Navigate to calendar view or open calendar modal
        }

        function exportJuryReport() {
            console.log('Exporting jury report...');
            showNotification('Génération du rapport PDF en cours...', 'info');
        }

        function generateJurySheets() {
            console.log('Generating jury evaluation sheets...');
            showNotification('Génération des fiches d\'évaluation...', 'info');
        }

        function generateAnnualReport() {
            console.log('Generating annual report...');
            showNotification('Génération du rapport annuel...', 'info');
        }

        function downloadPV(id) {
            console.log('Downloading PV:', id);
            showNotification('Téléchargement du procès-verbal...', 'info');
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 5000);
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to pending checkboxes
            document.querySelectorAll('.pending-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkAssignPanel);
            });
            
            // Set default defense date to tomorrow
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('defenseDate').value = tomorrow.toISOString().split('T')[0];
            
            // Set default times
            document.getElementById('defenseStartTime').value = '09:00';
            document.getElementById('defenseEndTime').value = '11:00';
            
            console.log('Jury management page loaded');
        });

        // Auto-update end time when start time changes
        document.getElementById('defenseStartTime').addEventListener('change', function() {
            const startTime = this.value;
            if (startTime) {
                const [hours, minutes] = startTime.split(':');
                const endHours = parseInt(hours) + 2; // Default 2-hour duration
                const endTime = `${endHours.toString().padStart(2, '0')}:${minutes}`;
                document.getElementById('defenseEndTime').value = endTime;
            }
        });
    </script>