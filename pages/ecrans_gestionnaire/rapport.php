
        <div class="content-area">
            <!-- Statistics Cards Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-primary">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stats-title">Total Rapports</div>
                            <div class="stats-number">124</div>
                            <div class="stats-trend">
                                <i class="fas fa-plus"></i> +15 ce mois
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stats-title">En attente</div>
                            <div class="stats-number">12</div>
                            <div class="stats-trend">
                                <i class="fas fa-exclamation-triangle"></i> À traiter
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
                            <div class="stats-title">Validés</div>
                            <div class="stats-number">89</div>
                            <div class="stats-trend">
                                <i class="fas fa-percentage"></i> 72% du total
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
                            <div class="stats-title">Rejetés</div>
                            <div class="stats-number">23</div>
                            <div class="stats-trend">
                                <i class="fas fa-redo"></i> Nécessitent révision
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Status Overview -->
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
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </div>
                                    <h6>Soumettre un rapport</h6>
                                    <p class="text-muted small mb-3">Déposer un nouveau rapport</p>
                                    <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#submitReportModal">
                                        Déposer <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-warning-subtle text-warning">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                    <h6>Recherche avancée</h6>
                                    <p class="text-muted small mb-3">Filtrer par critères spécifiques</p>
                                    <button class="btn btn-sm btn-outline-warning w-100" onclick="showAdvancedSearch()">
                                        Rechercher <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-card p-3 text-center h-100">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="card-icon bg-success-subtle text-success">
                                            <i class="fas fa-file-export"></i>
                                        </div>
                                    </div>
                                    <h6>Exporter la bibliothèque</h6>
                                    <p class="text-muted small mb-3">Générer un rapport complet</p>
                                    <button class="btn btn-sm btn-outline-success w-100" onclick="exportLibrary()">
                                        Exporter <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card h-100">
                        <h6 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Répartition par Type</h6>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Mémoires de fin d'études</span>
                                <strong>45%</strong>
                            </div>
                            <div class="progress mb-3" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Rapports de stage</span>
                                <strong>35%</strong>
                            </div>
                            <div class="progress mb-3" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 35%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Projets de recherche</span>
                                <strong>20%</strong>
                            </div>
                            <div class="progress mb-3" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Management -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-archive me-2"></i>Bibliothèque des Rapports</h5>
                        <p class="text-muted mb-0">Consulter et gérer tous les rapports soumis</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="showStatistics()">
                            <i class="fas fa-chart-bar me-2"></i>Statistiques
                        </button>
                        <button class="btn btn-success" onclick="bulkExport()">
                            <i class="fas fa-download me-2"></i>Téléchargement groupé
                        </button>
                    </div>
                </div>

                <!-- Advanced Search Panel -->
                <div class="collapse" id="advancedSearchPanel">
                    <div class="card card-body mb-4">
                        <h6><i class="fas fa-filter me-2"></i>Recherche Avancée</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Période de soumission</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="date" class="form-control form-control-sm" id="dateFrom">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control form-control-sm" id="dateTo">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Encadrant</label>
                                <select class="form-select form-select-sm" id="supervisorFilter">
                                    <option value="">Tous les encadrants</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Note minimale</label>
                                <select class="form-select form-select-sm" id="gradeFilter">
                                    <option value="">Toutes les notes</option>
                                    <option value="16">Excellent (16+)</option>
                                    <option value="14">Très bien (14+)</option>
                                    <option value="12">Bien (12+)</option>
                                    <option value="10">Passable (10+)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Mots-clés</label>
                                <input type="text" class="form-control form-control-sm" id="keywordsFilter" placeholder="Mots-clés séparés par des virgules">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm" onclick="applyAdvancedSearch()">
                                <i class="fas fa-search me-1"></i>Rechercher
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="resetAdvancedSearch()">
                                <i class="fas fa-undo me-1"></i>Réinitialiser
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Standard Filters -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-4">
                        <div class="search-box">
                            <i class="fas fa-search text-muted"></i>
                            <input type="text" id="searchReport" placeholder="Rechercher un rapport..." onkeyup="filterReports()">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select class="custom-select" id="filterType" onchange="filterReports()">
                                    <option value="">Tous les types</option>
                                    <option value="Mémoire">Mémoire de fin d'études</option>
                                    <option value="Stage">Rapport de stage</option>
                                    <option value="Projet">Projet de recherche</option>
                                    <option value="TER">Travail d'études et de recherche</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterLevel" onchange="filterReports()">
                                    <option value="">Tous les niveaux</option>
                                    <option value="Licence 3">Licence 3</option>
                                    <option value="Master 1">Master 1</option>
                                    <option value="Master 2">Master 2</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterStatus" onchange="filterReports()">
                                    <option value="">Tous les statuts</option>
                                    <option value="Soumis">Soumis</option>
                                    <option value="En cours de révision">En cours de révision</option>
                                    <option value="Validé">Validé</option>
                                    <option value="Rejeté">Rejeté</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
                                    <i class="fas fa-undo me-1"></i>Réinitialiser
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="reportsTable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th>Étudiant</th>
                                <th>Titre du rapport</th>
                                <th>Type</th>
                                <th>Date de soumission</th>
                                <th>Encadrant</th>
                                <th>Statut</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="reportsTableBody">
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input report-checkbox" value="1">
                                </td>
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
                                        <div class="fw-bold">Développement d'une application mobile de gestion de stocks</div>
                                        <small class="text-muted">Application Android utilisant Firebase et Android Studio</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">Mémoire</span></td>
                                <td>24/05/2025</td>
                                <td>Dr. Diabaté Sekou</td>
                                <td><span class="badge status-pending">En cours de révision</span></td>
                                <td>-</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Consulter" onclick="viewReport(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Télécharger" onclick="downloadReport(1)">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Historique" onclick="viewHistory(1)">
                                            <i class="fas fa-history"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Commenter" onclick="addComment(1)">
                                            <i class="fas fa-comment"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input report-checkbox" value="2">
                                </td>
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
                                        <div class="fw-bold">Conception d'un système de gestion de bibliothèque universitaire</div>
                                        <small class="text-muted">Analyse UML et implémentation en Java</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning text-dark">Stage</span></td>
                                <td>23/05/2025</td>
                                <td>Prof. Kouamé Akissi</td>
                                <td><span class="badge status-active">Validé</span></td>
                                <td><span class="badge bg-success">16/20</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Consulter" onclick="viewReport(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Télécharger" onclick="downloadReport(2)">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Historique" onclick="viewHistory(2)">
                                            <i class="fas fa-history"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" title="Archiver" onclick="archiveReport(2)">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input report-checkbox" value="3">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2 bg-warning text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Bamba Issouf</div>
                                            <small class="text-muted">Licence 3 - Informatique</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Algorithmes de tri et optimisation des performances</div>
                                        <small class="text-muted">Étude comparative des algorithmes de tri</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Projet</span></td>
                                <td>20/05/2025</td>
                                <td>Dr. Traoré Fatou</td>
                                <td><span class="badge bg-danger">Rejeté</span></td>
                                <td><span class="badge bg-danger">8/20</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Consulter" onclick="viewReport(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Télécharger" onclick="downloadReport(3)">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Historique" onclick="viewHistory(3)">
                                            <i class="fas fa-history"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Réviser" onclick="requestRevision(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Navigation des pages">
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

                <!-- Selected Reports Actions -->
                <div class="row mt-3" id="bulkActionsPanel" style="display: none;">
                    <div class="col-12">
                        <div class="alert alert-info d-flex justify-content-between align-items-center">
                            <span id="selectedCount">0 rapport(s) sélectionné(s)</span>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary" onclick="bulkDownload()">
                                    <i class="fas fa-download me-1"></i>Télécharger
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="bulkAssign()">
                                    <i class="fas fa-user-tag me-1"></i>Assigner
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="bulkArchive()">
                                    <i class="fas fa-archive me-1"></i>Archiver
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Report Modal -->
    <div class="modal fade" id="submitReportModal" tabindex="-1" aria-labelledby="submitReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitReportModalLabel">
                        <i class="fas fa-upload me-2"></i>Soumettre un nouveau rapport
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submitReportForm" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="reportStudent" class="form-label">Étudiant <span class="text-danger">*</span></label>
                                <select class="form-select" id="reportStudent" name="num_etu" required>
                                    <option value="">Choisir un étudiant...</option>
                                    <option value="1">Koné Mamadou - Master 2</option>
                                    <option value="2">Yao Marie Ange - Master 1</option>
                                    <option value="3">Bamba Issouf - Licence 3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="reportType" class="form-label">Type de rapport <span class="text-danger">*</span></label>
                                <select class="form-select" id="reportType" name="type_rapport" required>
                                    <option value="">Choisir...</option>
                                    <option value="Mémoire">Mémoire de fin d'études</option>
                                    <option value="Stage">Rapport de stage</option>
                                    <option value="Projet">Projet de recherche</option>
                                    <option value="TER">Travail d'études et de recherche</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="reportTitle" class="form-label">Titre du rapport <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="reportTitle" name="nom_rapport" required>
                            </div>
                            <div class="col-12">
                                <label for="reportTheme" class="form-label">Thème/Sujet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="reportTheme" name="theme_mem" required>
                            </div>
                            <div class="col-md-6">
                                <label for="reportSupervisor" class="form-label">Encadrant</label>
                                <select class="form-select" id="reportSupervisor" name="id_encadrant">
                                    <option value="">Choisir un encadrant...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="reportCompany" class="form-label">Entreprise (si stage)</label>
                                <select class="form-select" id="reportCompany" name="id_entr">
                                    <option value="">Choisir une entreprise...</option>
                                    <option value="1">Orange Côte d'Ivoire</option>
                                    <option value="2">MTN CI</option>
                                    <option value="3">Société Générale</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="reportFile" class="form-label">Fichier du rapport <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="reportFile" name="fichier_rapport" accept=".pdf,.doc,.docx" required>
                                <div class="form-text">Formats acceptés: PDF, DOC, DOCX (max: 10 MB)</div>
                            </div>
                            <div class="col-12">
                                <label for="reportKeywords" class="form-label">Mots-clés</label>
                                <input type="text" class="form-control" id="reportKeywords" name="mots_cles" placeholder="Séparés par des virgules">
                            </div>
                            <div class="col-12">
                                <label for="reportAbstract" class="form-label">Résumé</label>
                                <textarea class="form-control" id="reportAbstract" name="resume" rows="4" placeholder="Résumé du rapport (optionnel)"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="submitReport()">
                        <i class="fas fa-upload me-2"></i>Soumettre
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Report Modal -->
    <div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReportModalLabel">
                        <i class="fas fa-file-alt me-2"></i>Détails du rapport
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reportDetailsContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="downloadFromModal()">
                        <i class="fas fa-download me-2"></i>Télécharger
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functions
        function filterReports() {
            const searchTerm = document.getElementById('searchReport').value.toLowerCase();
            const typeFilter = document.getElementById('filterType').value;
            const levelFilter = document.getElementById('filterLevel').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            const rows = document.querySelectorAll('#reportsTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesType = !typeFilter || text.includes(typeFilter.toLowerCase());
                const matchesLevel = !levelFilter || text.includes(levelFilter.toLowerCase());
                const matchesStatus = !statusFilter || text.includes(statusFilter.toLowerCase());
                
                row.style.display = (matchesSearch && matchesType && matchesLevel && matchesStatus) ? '' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('searchReport').value = '';
            document.getElementById('filterType').value = '';
            document.getElementById('filterLevel').value = '';
            document.getElementById('filterStatus').value = '';
            filterReports();
        }

        function showAdvancedSearch() {
            const panel = document.getElementById('advancedSearchPanel');
            const collapse = new bootstrap.Collapse(panel, { toggle: true });
        }

        function applyAdvancedSearch() {
            // Apply advanced search filters
            console.log('Applying advanced search...');
            filterReports();
        }

        function resetAdvancedSearch() {
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            document.getElementById('supervisorFilter').value = '';
            document.getElementById('gradeFilter').value = '';
            document.getElementById('keywordsFilter').value = '';
        }

        // Report management functions
        function viewReport(id) {
            console.log('Viewing report:', id);
            
            const reportData = {
                1: {
                    title: 'Développement d\'une application mobile de gestion de stocks',
                    student: 'Koné Mamadou',
                    type: 'Mémoire',
                    theme: 'Application Android utilisant Firebase et Android Studio',
                    supervisor: 'Dr. Diabaté Sekou',
                    submissionDate: '24/05/2025',
                    status: 'En cours de révision',
                    abstract: 'Ce mémoire présente le développement d\'une application mobile de gestion de stocks utilisant les technologies Android et Firebase...',
                    keywords: 'Android, Firebase, Gestion de stocks, Mobile'
                }
            };
            
            const report = reportData[id] || reportData[1];
            
            const detailsContent = `
                <div class="row">
                    <div class="col-md-8">
                        <h6>Informations générales</h6>
                        <p><strong>Titre:</strong> ${report.title}</p>
                        <p><strong>Étudiant:</strong> ${report.student}</p>
                        <p><strong>Type:</strong> <span class="badge bg-primary">${report.type}</span></p>
                        <p><strong>Thème:</strong> ${report.theme}</p>
                        <p><strong>Encadrant:</strong> ${report.supervisor}</p>
                        <p><strong>Date de soumission:</strong> ${report.submissionDate}</p>
                        <p><strong>Statut:</strong> <span class="badge status-pending">${report.status}</span></p>
                        
                        <h6 class="mt-4">Résumé</h6>
                        <p>${report.abstract}</p>
                        
                        <h6>Mots-clés</h6>
                        <p>${report.keywords.split(', ').map(keyword => `<span class="badge bg-light text-dark me-1">${keyword}</span>`).join('')}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Actions disponibles</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="downloadReport(${id})">
                                <i class="fas fa-download me-2"></i>Télécharger PDF
                            </button>
                            <button class="btn btn-outline-success" onclick="validateReport(${id})">
                                <i class="fas fa-check me-2"></i>Valider
                            </button>
                            <button class="btn btn-outline-warning" onclick="requestRevision(${id})">
                                <i class="fas fa-edit me-2"></i>Demander révision
                            </button>
                            <button class="btn btn-outline-danger" onclick="rejectReport(${id})">
                                <i class="fas fa-times me-2"></i>Rejeter
                            </button>
                        </div>
                        
                        <h6 class="mt-4">Historique</h6>
                        <div class="timeline-sm">
                            <div class="timeline-item-sm">
                                <strong>24/05/2025</strong><br>
                                <small>Rapport soumis</small>
                            </div>
                            <div class="timeline-item-sm">
                                <strong>25/05/2025</strong><br>
                                <small>Assigné à l'encadrant</small>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('reportDetailsContent').innerHTML = detailsContent;
            new bootstrap.Modal(document.getElementById('viewReportModal')).show();
        }

        function downloadReport(id) {
            console.log('Downloading report:', id);
            // Simulate download
            showNotification('Téléchargement du rapport en cours...', 'info');
        }

        function viewHistory(id) {
            console.log('Viewing history for report:', id);
            // Show history modal or navigate to history page
        }

        function addComment(id) {
            const comment = prompt('Ajouter un commentaire:');
            if (comment) {
                console.log('Adding comment to report:', id, comment);
                showNotification('Commentaire ajouté avec succès!', 'success');
            }
        }

        function requestRevision(id) {
            if (confirm('Demander une révision de ce rapport ?')) {
                console.log('Requesting revision for report:', id);
                showNotification('Demande de révision envoyée!', 'warning');
            }
        }

        function archiveReport(id) {
            if (confirm('Archiver ce rapport ?')) {
                console.log('Archiving report:', id);
                showNotification('Rapport archivé avec succès!', 'info');
            }
        }

        function submitReport() {
            const form = document.getElementById('submitReportForm');
            if (form.checkValidity()) {
                console.log('Submitting report...');
                
                // Validate file size
                const fileInput = document.getElementById('reportFile');
                if (fileInput.files[0] && fileInput.files[0].size > 10 * 1024 * 1024) {
                    alert('Le fichier est trop volumineux (max: 10 MB)');
                    return;
                }
                
                // Add submit logic here
                bootstrap.Modal.getInstance(document.getElementById('submitReportModal')).hide();
                showNotification('Rapport soumis avec succès!', 'success');
            } else {
                form.reportValidity();
            }
        }

        // Bulk operations
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.report-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            
            updateBulkActionsPanel();
        }

        function updateBulkActionsPanel() {
            const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
            const panel = document.getElementById('bulkActionsPanel');
            const countElement = document.getElementById('selectedCount');
            
            if (checkedBoxes.length > 0) {
                panel.style.display = 'block';
                countElement.textContent = `${checkedBoxes.length} rapport(s) sélectionné(s)`;
            } else {
                panel.style.display = 'none';
            }
        }

        function bulkDownload() {
            const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
            console.log('Bulk downloading reports:', Array.from(checkedBoxes).map(cb => cb.value));
            showNotification(`Téléchargement de ${checkedBoxes.length} rapport(s) en cours...`, 'info');
        }

        function bulkAssign() {
            const supervisor = prompt('Assigner à quel encadrant ?');
            if (supervisor) {
                const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
                console.log('Bulk assigning reports to:', supervisor);
                showNotification(`${checkedBoxes.length} rapport(s) assigné(s) à ${supervisor}`, 'success');
            }
        }

        function bulkArchive() {
            const checkedBoxes = document.querySelectorAll('.report-checkbox:checked');
            if (confirm(`Archiver ${checkedBoxes.length} rapport(s) ?`)) {
                console.log('Bulk archiving reports');
                showNotification(`${checkedBoxes.length} rapport(s) archivé(s)`, 'info');
            }
        }

        function exportLibrary() {
            console.log('Exporting library...');
            showNotification('Génération du rapport de bibliothèque en cours...', 'info');
        }

        function showStatistics() {
            console.log('Showing statistics...');
            // Navigate to statistics page or show modal
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
            // Add event listeners to checkboxes
            document.querySelectorAll('.report-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActionsPanel);
            });
            
            console.log('Reports management page loaded');
        });
    </script>
