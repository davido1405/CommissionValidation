
        <div class="header">
            <div class="d-flex align-items-center">
                <h2 class="page-title">
                    <i class="fas fa-tasks me-2"></i>
                    Validation des Rapports
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
                                    <div class="bg-warning text-white rounded-circle p-2">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-0 fw-bold">Délai de validation dépassé</p>
                                    <small class="text-muted">3 rapports en retard</small>
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
            <!-- Priority Alerts -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="alert alert-warning border-0 shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                            <div class="flex-grow-1">
                                <h5 class="alert-heading mb-1">Rapports en attente urgente</h5>
                                <p class="mb-0">3 rapports dépassent le délai de validation standard (7 jours). Action requise immédiatement.</p>
                            </div>
                            <button class="btn btn-warning" onclick="showUrgentReports()">
                                <i class="fas fa-eye me-1"></i>Voir
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Validation Statistics -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stats-title">En attente</div>
                            <div class="stats-number">12</div>
                            <div class="stats-trend">
                                <i class="fas fa-exclamation-triangle text-danger"></i> 3 urgents
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-info">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="stats-title">En cours d'examen</div>
                            <div class="stats-number">8</div>
                            <div class="stats-trend">
                                <i class="fas fa-user-check"></i> Assignés
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stats-title">Validés aujourd'hui</div>
                            <div class="stats-number">5</div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> +2 par rapport à hier
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-danger">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stats-title">Nécessitent révision</div>
                            <div class="stats-number">3</div>
                            <div class="stats-trend">
                                <i class="fas fa-redo"></i> À revoir
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Validation Workflow -->
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-route me-2"></i>Processus de Validation</h5>
                        
                        <div class="workflow-container">
                            <div class="workflow-step completed">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h6>Soumission</h6>
                                    <p class="small text-muted">Dépôt par l'étudiant</p>
                                </div>
                            </div>
                            <div class="workflow-step active">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h6>Examen initial</h6>
                                    <p class="small text-muted">Vérification des critères</p>
                                </div>
                            </div>
                            <div class="workflow-step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h6>Évaluation</h6>
                                    <p class="small text-muted">Évaluation par l'encadrant</p>
                                </div>
                            </div>
                            <div class="workflow-step">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h6>Approbation</h6>
                                    <p class="small text-muted">Validation finale</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="row text-center">
                                <div class="col-3">
                                    <h4 class="text-primary">124</h4>
                                    <small>Soumis</small>
                                </div>
                                <div class="col-3">
                                    <h4 class="text-warning">20</h4>
                                    <small>En examen</small>
                                </div>
                                <div class="col-3">
                                    <h4 class="text-info">15</h4>
                                    <small>En évaluation</small>
                                </div>
                                <div class="col-3">
                                    <h4 class="text-success">89</h4>
                                    <small>Approuvés</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card h-100">
                        <h6 class="mb-3"><i class="fas fa-user-tie me-2"></i>Mes Affectations</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <div class="fw-bold">Rapports à évaluer</div>
                                    <small class="text-muted">Assignés à moi</small>
                                </div>
                                <span class="badge bg-warning rounded-pill">4</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <div class="fw-bold">En attente de ma révision</div>
                                    <small class="text-muted">Corrections demandées</small>
                                </div>
                                <span class="badge bg-info rounded-pill">2</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <div class="fw-bold">Validés par moi</div>
                                    <small class="text-muted">Cette semaine</small>
                                </div>
                                <span class="badge bg-success rounded-pill">7</span>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-primary btn-sm" onclick="showMyAssignments()">
                                <i class="fas fa-list me-1"></i>Voir tous mes rapports
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Validation Queue -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-clipboard-check me-2"></i>File de Validation</h5>
                        <p class="text-muted mb-0">Rapports en attente de traitement</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="showValidationStats()">
                            <i class="fas fa-chart-line me-2"></i>Statistiques
                        </button>
                        <button class="btn btn-success" onclick="bulkValidation()">
                            <i class="fas fa-check-double me-2"></i>Validation en lot
                        </button>
                        <button class="btn btn-primary" onclick="autoAssign()">
                            <i class="fas fa-magic me-2"></i>Attribution automatique
                        </button>
                    </div>
                </div>

                <!-- Quick Filters -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <div class="search-box">
                            <i class="fas fa-search text-muted"></i>
                            <input type="text" id="searchValidation" placeholder="Rechercher un rapport..." onkeyup="filterValidations()">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-2">
                            <div class="col-md-2">
                                <select class="custom-select" id="filterPriority" onchange="filterValidations()">
                                    <option value="">Toutes priorités</option>
                                    <option value="Urgent">Urgent</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Faible">Faible</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="custom-select" id="filterStatus" onchange="filterValidations()">
                                    <option value="">Tous statuts</option>
                                    <option value="En attente">En attente</option>
                                    <option value="En cours">En cours</option>
                                    <option value="En révision">En révision</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="custom-select" id="filterType" onchange="filterValidations()">
                                    <option value="">Tous types</option>
                                    <option value="Mémoire">Mémoire</option>
                                    <option value="Stage">Stage</option>
                                    <option value="Projet">Projet</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="custom-select" id="filterAssignee" onchange="filterValidations()">
                                    <option value="">Tous évaluateurs</option>
                                    <option value="Non assigné">Non assigné</option>
                                    <option value="Moi">Assigné à moi</option>
                                    <option value="Autres">Assigné à d'autres</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="custom-select" id="filterDelay" onchange="filterValidations()">
                                    <option value="">Tous délais</option>
                                    <option value="En retard">En retard</option>
                                    <option value="Dans les temps">Dans les temps</option>
                                    <option value="Nouveau">Nouveau (24h)</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-secondary w-100" onclick="resetValidationFilters()">
                                    <i class="fas fa-undo me-1"></i>Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="validationTable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAllValidations" onchange="toggleSelectAllValidations()">
                                </th>
                                <th>Priorité</th>
                                <th>Étudiant</th>
                                <th>Titre du rapport</th>
                                <th>Type</th>
                                <th>Soumis le</th>
                                <th>Délai</th>
                                <th>Assigné à</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="validationTableBody">
                            <tr class="table-warning">
                                <td>
                                    <input type="checkbox" class="form-check-input validation-checkbox" value="1">
                                </td>
                                <td>
                                    <span class="badge bg-danger">Urgent</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2 bg-primary text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Koné Mamadou</div>
                                            <small class="text-muted">Master 2</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Application mobile de gestion de stocks</div>
                                        <small class="text-muted">Développement Android avec Firebase</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">Mémoire</span></td>
                                <td>18/05/2025</td>
                                <td>
                                    <span class="badge bg-danger">
                                        <i class="fas fa-clock me-1"></i>8 jours
                                    </span>
                                </td>
                                <td>
                                    <span class="text-danger">Non assigné</span>
                                </td>
                                <td><span class="badge bg-warning">En attente</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Examiner" onclick="examineReport(1)">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Assigner" onclick="assignReport(1)">
                                            <i class="fas fa-user-tag"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Commentaire" onclick="addValidationComment(1)">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-info dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="validateQuick(1)">
                                                    <i class="fas fa-check text-success me-2"></i>Validation rapide
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="requestRevision(1)">
                                                    <i class="fas fa-edit text-warning me-2"></i>Demander révision
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="rejectReport(1)">
                                                    <i class="fas fa-times text-danger me-2"></i>Rejeter
                                                </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input validation-checkbox" value="2">
                                </td>
                                <td>
                                    <span class="badge bg-warning">Normal</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2 bg-success text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Yao Marie Ange</div>
                                            <small class="text-muted">Master 1</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Système de gestion de bibliothèque</div>
                                        <small class="text-muted">Conception UML et implémentation</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning text-dark">Stage</span></td>
                                <td>23/05/2025</td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="fas fa-clock me-1"></i>3 jours
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/24" class="rounded-circle me-1" alt="Avatar">
                                        <small>Dr. Diabaté</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">En cours</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Examiner" onclick="examineReport(2)">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Commentaire" onclick="addValidationComment(2)">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Historique" onclick="viewValidationHistory(2)">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input validation-checkbox" value="3">
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Normal</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2 bg-warning text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Bamba Issouf</div>
                                            <small class="text-muted">Licence 3</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Algorithmes de tri et optimisation</div>
                                        <small class="text-muted">Étude comparative des performances</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Projet</span></td>
                                <td>25/05/2025</td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="fas fa-clock me-1"></i>1 jour
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">Non assigné</span>
                                </td>
                                <td><span class="badge bg-warning">En attente</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Examiner" onclick="examineReport(3)">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Assigner" onclick="assignReport(3)">
                                            <i class="fas fa-user-tag"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Commentaire" onclick="addValidationComment(3)">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Navigation des validations">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav>

                <!-- Bulk Actions Panel -->
                <div class="row mt-3" id="bulkValidationPanel" style="display: none;">
                    <div class="col-12">
                        <div class="alert alert-primary d-flex justify-content-between align-items-center">
                            <span id="selectedValidationCount">0 rapport(s) sélectionné(s)</span>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary" onclick="bulkAssignValidator()">
                                    <i class="fas fa-user-tag me-1"></i>Assigner en lot
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="bulkApprove()">
                                    <i class="fas fa-check me-1"></i>Approuver
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="bulkRequestRevision()">
                                    <i class="fas fa-edit me-1"></i>Demander révision
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="bulkReject()">
                                    <i class="fas fa-times me-1"></i>Rejeter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Examine Report Modal -->
    <div class="modal fade" id="examineReportModal" tabindex="-1" aria-labelledby="examineReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examineReportModalLabel">
                        <i class="fas fa-search me-2"></i>Examen du rapport
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="examineReportContent">
                                <!-- Report content will be loaded here -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6><i class="fas fa-clipboard-check me-2"></i>Grille d'évaluation</h6>
                                </div>
                                <div class="card-body">
                                    <form id="evaluationForm">
                                        <div class="mb-3">
                                            <label class="form-label">Conformité du format</label>
                                            <select class="form-select form-select-sm" name="format_score">
                                                <option value="">Évaluer...</option>
                                                <option value="4">Excellent (4/4)</option>
                                                <option value="3">Bien (3/4)</option>
                                                <option value="2">Satisfaisant (2/4)</option>
                                                <option value="1">Insuffisant (1/4)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Qualité du contenu</label>
                                            <select class="form-select form-select-sm" name="content_score">
                                                <option value="">Évaluer...</option>
                                                <option value="6">Excellent (6/6)</option>
                                                <option value="5">Très bien (5/6)</option>
                                                <option value="4">Bien (4/6)</option>
                                                <option value="3">Satisfaisant (3/6)</option>
                                                <option value="2">Insuffisant (2/6)</option>
                                                <option value="1">Très insuffisant (1/6)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Innovation/Originalité</label>
                                            <select class="form-select form-select-sm" name="innovation_score">
                                                <option value="">Évaluer...</option>
                                                <option value="4">Excellent (4/4)</option>
                                                <option value="3">Bien (3/4)</option>
                                                <option value="2">Satisfaisant (2/4)</option>
                                                <option value="1">Insuffisant (1/4)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Présentation/Rédaction</label>
                                            <select class="form-select form-select-sm" name="presentation_score">
                                                <option value="">Évaluer...</option>
                                                <option value="3">Excellent (3/3)</option>
                                                <option value="2">Bien (2/3)</option>
                                                <option value="1">Satisfaisant (1/3)</option>
                                                <option value="0">Insuffisant (0/3)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Méthodologie</label>
                                            <select class="form-select form-select-sm" name="methodology_score">
                                                <option value="">Évaluer...</option>
                                                <option value="3">Excellent (3/3)</option>
                                                <option value="2">Bien (2/3)</option>
                                                <option value="1">Satisfaisant (1/3)</option>
                                                <option value="0">Insuffisant (0/3)</option>
                                            </select>
                                        </div>
                                        
                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label">Note finale</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="finalGrade" name="final_grade" min="0" max="20" step="0.5" readonly>
                                                <span class="input-group-text">/20</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Commentaires</label>
                                            <textarea class="form-control" name="comments" rows="4" placeholder="Commentaires détaillés..."></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Décision</label>
                                            <select class="form-select" name="decision" required>
                                                <option value="">Choisir...</option>
                                                <option value="approve">Valider</option>
                                                <option value="revision">Demander révision</option>
                                                <option value="reject">Rejeter</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-warning" onclick="saveAsDraft()">
                        <i class="fas fa-save me-2"></i>Sauvegarder brouillon
                    </button>
                    <button type="button" class="btn btn-primary" onclick="submitEvaluation()">
                        <i class="fas fa-check me-2"></i>Finaliser l'évaluation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Report Modal -->
    <div class="modal fade" id="assignReportModal" tabindex="-1" aria-labelledby="assignReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignReportModalLabel">
                        <i class="fas fa-user-tag me-2"></i>Assigner le rapport
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="assignReportForm">
                        <div class="mb-3">
                            <label for="assignEvaluator" class="form-label">Évaluateur <span class="text-danger">*</span></label>
                            <select class="form-select" id="assignEvaluator" name="evaluator" required>
                                <option value="">Choisir un évaluateur...</option>
                                <option value="1">Dr. Diabaté Sekou - Informatique</option>
                                <option value="2">Prof. Kouamé Akissi - Mathématiques</option>
                                <option value="3">Dr. Traoré Fatou - Physique</option>
                                <option value="4">Dr. Bamba Issouf - Informatique</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assignPriority" class="form-label">Priorité</label>
                            <select class="form-select" id="assignPriority" name="priority">
                                <option value="Normal">Normal</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Faible">Faible</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assignDeadline" class="form-label">Date limite d'évaluation</label>
                            <input type="date" class="form-control" id="assignDeadline" name="deadline">
                        </div>
                        <div class="mb-3">
                            <label for="assignInstructions" class="form-label">Instructions spéciales</label>
                            <textarea class="form-control" id="assignInstructions" name="instructions" rows="3" placeholder="Instructions ou remarques pour l'évaluateur..."></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notifyEvaluator" name="notify" checked>
                            <label class="form-check-label" for="notifyEvaluator">
                                Notifier l'évaluateur par email
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="confirmAssignment()">
                        <i class="fas fa-paper-plane me-2"></i>Assigner
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-calculate final grade
        function calculateFinalGrade() {
            const form = document.getElementById('evaluationForm');
            const scores = ['format_score', 'content_score', 'innovation_score', 'presentation_score', 'methodology_score'];
            let total = 0;
            let hasAllScores = true;
            
            scores.forEach(scoreField => {
                const value = parseFloat(form[scoreField].value);
                if (!isNaN(value)) {
                    total += value;
                } else {
                    hasAllScores = false;
                }
            });
            
            if (hasAllScores) {
                document.getElementById('finalGrade').value = total.toFixed(1);
            } else {
                document.getElementById('finalGrade').value = '';
            }
        }

        // Filter functions
        function filterValidations() {
            const searchTerm = document.getElementById('searchValidation').value.toLowerCase();
            const priorityFilter = document.getElementById('filterPriority').value;
            const statusFilter = document.getElementById('filterStatus').value;
            const typeFilter = document.getElementById('filterType').value;
            const assigneeFilter = document.getElementById('filterAssignee').value;
            const delayFilter = document.getElementById('filterDelay').value;
            
            const rows = document.querySelectorAll('#validationTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesPriority = !priorityFilter || text.includes(priorityFilter.toLowerCase());
                const matchesStatus = !statusFilter || text.includes(statusFilter.toLowerCase());
                const matchesType = !typeFilter || text.includes(typeFilter.toLowerCase());
                const matchesAssignee = !assigneeFilter || checkAssigneeFilter(row, assigneeFilter);
                const matchesDelay = !delayFilter || checkDelayFilter(row, delayFilter);
                
                row.style.display = (matchesSearch && matchesPriority && matchesStatus && matchesType && matchesAssignee && matchesDelay) ? '' : 'none';
            });
        }

        function checkAssigneeFilter(row, filter) {
            const assigneeText = row.cells[7].textContent;
            switch(filter) {
                case 'Non assigné': return assigneeText.includes('Non assigné');
                case 'Moi': return assigneeText.includes('Thomas'); // Replace with actual user
                case 'Autres': return !assigneeText.includes('Non assigné') && !assigneeText.includes('Thomas');
                default: return true;
            }
        }

        function checkDelayFilter(row, filter) {
            const delayBadge = row.querySelector('.badge');
            const delayText = delayBadge ? delayBadge.textContent : '';
            
            switch(filter) {
                case 'En retard': return delayBadge && delayBadge.classList.contains('bg-danger');
                case 'Dans les temps': return delayBadge && delayBadge.classList.contains('bg-success');
                case 'Nouveau': return delayText.includes('1 jour');
                default: return true;
            }
        }

        function resetValidationFilters() {
            document.getElementById('searchValidation').value = '';
            document.getElementById('filterPriority').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterType').value = '';
            document.getElementById('filterAssignee').value = '';
            document.getElementById('filterDelay').value = '';
            filterValidations();
        }

        // Validation functions
        function examineReport(id) {
            console.log('Examining report:', id);
            
            const reportData = {
                1: {
                    title: 'Application mobile de gestion de stocks',
                    student: 'Koné Mamadou',
                    content: 'Développement d\'une application Android utilisant Firebase...'
                }
            };
            
            const report = reportData[id] || reportData[1];
            
            document.getElementById('examineReportContent').innerHTML = `
                <h6>${report.title}</h6>
                <p><strong>Étudiant:</strong> ${report.student}</p>
                <hr>
                <div class="mb-3">
                    <embed src="#" type="application/pdf" width="100%" height="400px">
                    <p class="text-center mt-2"><small>Prévisualisation du rapport PDF</small></p>
                </div>
            `;
            
            new bootstrap.Modal(document.getElementById('examineReportModal')).show();
        }

        function assignReport(id) {
            console.log('Assigning report:', id);
            
            // Set default deadline to 7 days from now
            const deadline = new Date();
            deadline.setDate(deadline.getDate() + 7);
            document.getElementById('assignDeadline').value = deadline.toISOString().split('T')[0];
            
            new bootstrap.Modal(document.getElementById('assignReportModal')).show();
            
            // Store report ID for assignment
            document.getElementById('assignReportModal').setAttribute('data-report-id', id);
        }

        function confirmAssignment() {
            const form = document.getElementById('assignReportForm');
            if (form.checkValidity()) {
                const reportId = document.getElementById('assignReportModal').getAttribute('data-report-id');
                const evaluator = form.evaluator.value;
                
                console.log('Assigning report', reportId, 'to evaluator', evaluator);
                
                bootstrap.Modal.getInstance(document.getElementById('assignReportModal')).hide();
                showNotification('Rapport assigné avec succès!', 'success');
                
                // Update table row
                // Implementation here
            } else {
                form.reportValidity();
            }
        }

        function addValidationComment(id) {
            const comment = prompt('Ajouter un commentaire:');
            if (comment) {
                console.log('Adding comment to validation:', id, comment);
                showNotification('Commentaire ajouté!', 'info');
            }
        }

        function validateQuick(id) {
            if (confirm('Validation rapide sans évaluation détaillée ?')) {
                console.log('Quick validating report:', id);
                showNotification('Rapport validé rapidement!', 'success');
            }
        }

        function requestRevision(id) {
            const reason = prompt('Motif de la demande de révision:');
            if (reason) {
                console.log('Requesting revision for report:', id, reason);
                showNotification('Demande de révision envoyée!', 'warning');
            }
        }

        function rejectReport(id) {
            const reason = prompt('Motif du rejet:');
            if (reason && confirm('Confirmer le rejet du rapport ?')) {
                console.log('Rejecting report:', id, reason);
                showNotification('Rapport rejeté!', 'danger');
            }
        }

        function submitEvaluation() {
            const form = document.getElementById('evaluationForm');
            if (form.checkValidity()) {
                console.log('Submitting evaluation...');
                bootstrap.Modal.getInstance(document.getElementById('examineReportModal')).hide();
                showNotification('Évaluation soumise avec succès!', 'success');
            } else {
                alert('Veuillez compléter tous les champs requis.');
            }
        }

        function saveAsDraft() {
            console.log('Saving evaluation as draft...');
            showNotification('Brouillon sauvegardé!', 'info');
        }

        // Bulk operations
        function toggleSelectAllValidations() {
            const selectAll = document.getElementById('selectAllValidations');
            const checkboxes = document.querySelectorAll('.validation-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            
            updateBulkValidationPanel();
        }

        function updateBulkValidationPanel() {
            const checkedBoxes = document.querySelectorAll('.validation-checkbox:checked');
            const panel = document.getElementById('bulkValidationPanel');
            const countElement = document.getElementById('selectedValidationCount');
            
            if (checkedBoxes.length > 0) {
                panel.style.display = 'block';
                countElement.textContent = `${checkedBoxes.length} rapport(s) sélectionné(s)`;
            } else {
                panel.style.display = 'none';
            }
        }

        function bulkAssignValidator() {
            const checkedBoxes = document.querySelectorAll('.validation-checkbox:checked');
            if (checkedBoxes.length === 0) {
                alert('Veuillez sélectionner au moins un rapport.');
                return;
            }
            
            const evaluator = prompt('Assigner à quel évaluateur ?');
            if (evaluator) {
                console.log('Bulk assigning to evaluator:', evaluator);
                showNotification(`${checkedBoxes.length} rapport(s) assigné(s)!`, 'success');
            }
        }

        function bulkApprove() {
            const checkedBoxes = document.querySelectorAll('.validation-checkbox:checked');
            if (checkedBoxes.length === 0) {
                alert('Veuillez sélectionner au moins un rapport.');
                return;
            }
            
            if (confirm(`Approuver ${checkedBoxes.length} rapport(s) ?`)) {
                console.log('Bulk approving reports');
                showNotification(`${checkedBoxes.length} rapport(s) approuvé(s)!`, 'success');
            }
        }

        function autoAssign() {
            if (confirm('Attribution automatique basée sur la spécialisation et la charge de travail ?')) {
                console.log('Auto-assigning reports...');
                showNotification('Attribution automatique en cours...', 'info');
            }
        }

        function showUrgentReports() {
            // Filter to show only urgent reports
            document.getElementById('filterPriority').value = 'Urgent';
            filterValidations();
        }

        function showMyAssignments() {
            // Filter to show only reports assigned to current user
            document.getElementById('filterAssignee').value = 'Moi';
            filterValidations();
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
            // Add event listeners to evaluation form
            const evalForm = document.getElementById('evaluationForm');
            if (evalForm) {
                evalForm.addEventListener('change', calculateFinalGrade);
            }
            
            // Add event listeners to checkboxes
            document.querySelectorAll('.validation-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkValidationPanel);
            });
            
            // Add workflow step styles
            const style = document.createElement('style');
            style.textContent = `
                .workflow-container {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin: 2rem 0;
                }
                .workflow-step {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    flex: 1;
                    position: relative;
                }
                .workflow-step:not(:last-child)::after {
                    content: '';
                    position: absolute;
                    top: 25px;
                    right: -50%;
                    width: 100%;
                    height: 2px;
                    background-color: #dee2e6;
                    z-index: -1;
                }
                .workflow-step.completed::after {
                    background-color: #28a745;
                }
                .step-number {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-color: #dee2e6;
                    color: #6c757d;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    margin-bottom: 10px;
                }
                .workflow-step.completed .step-number {
                    background-color: #28a745;
                    color: white;
                }
                .workflow-step.active .step-number {
                    background-color: #007bff;
                    color: white;
                }
                .step-content {
                    text-align: center;
                }
            `;
            document.head.appendChild(style);
            
            console.log('Validation page loaded');
        });
    </script>