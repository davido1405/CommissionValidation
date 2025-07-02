
        <div class="content-area">
            <!-- Statistics Cards Row -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-primary">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stats-title">Entreprises Partenaires</div>
                            <div class="stats-number">85</div>
                            <div class="stats-trend">
                                <i class="fas fa-plus"></i> +12 cette année
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-success">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="stats-title">Conventions Actives</div>
                            <div class="stats-number">67</div>
                            <div class="stats-trend">
                                <i class="fas fa-check"></i> 78% du total
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-warning">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stats-title">Stagiaires Placés</div>
                            <div class="stats-number">156</div>
                            <div class="stats-trend">
                                <i class="fas fa-arrow-up"></i> +23% par rapport à 2023
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card h-100">
                        <div class="stats-card-content">
                            <div class="stats-icon bg-info">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stats-title">Stages en Cours</div>
                            <div class="stats-number">42</div>
                            <div class="stats-trend">
                                <i class="fas fa-clock"></i> Mai - Juillet 2025
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partnership Overview -->
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Répartition par Secteur d'Activité</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="sectorChart" width="300" height="200"></canvas>
                            </div>
                            <div class="col-md-6">
                                <div class="sector-stats">
                                    <div class="sector-item mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><i class="fas fa-mobile-alt text-primary me-2"></i>Technologies</span>
                                            <strong>35%</strong>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-primary" style="width: 35%"></div>
                                        </div>
                                    </div>
                                    <div class="sector-item mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><i class="fas fa-university text-success me-2"></i>Banque/Finance</span>
                                            <strong>25%</strong>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 25%"></div>
                                        </div>
                                    </div>
                                    <div class="sector-item mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><i class="fas fa-industry text-warning me-2"></i>Industrie</span>
                                            <strong>20%</strong>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-warning" style="width: 20%"></div>
                                        </div>
                                    </div>
                                    <div class="sector-item mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><i class="fas fa-briefcase text-info me-2"></i>Services</span>
                                            <strong>12%</strong>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-info" style="width: 12%"></div>
                                        </div>
                                    </div>
                                    <div class="sector-item">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span><i class="fas fa-ellipsis-h text-secondary me-2"></i>Autres</span>
                                            <strong>8%</strong>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-secondary" style="width: 8%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card h-100">
                        <h6 class="mb-3"><i class="fas fa-star me-2"></i>Top Partenaires</h6>
                        <div class="top-partners">
                            <div class="partner-item mb-3 p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Orange CI</h6>
                                        <small class="text-muted">Télécommunications</small>
                                    </div>
                                    <span class="badge bg-success">24 stages</span>
                                </div>
                            </div>
                            <div class="partner-item mb-3 p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Société Générale</h6>
                                        <small class="text-muted">Banque</small>
                                    </div>
                                    <span class="badge bg-primary">18 stages</span>
                                </div>
                            </div>
                            <div class="partner-item mb-3 p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">MTN CI</h6>
                                        <small class="text-muted">Télécommunications</small>
                                    </div>
                                    <span class="badge bg-warning text-dark">15 stages</span>
                                </div>
                            </div>
                            <div class="partner-item p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">NSIA Banque</h6>
                                        <small class="text-muted">Banque</small>
                                    </div>
                                    <span class="badge bg-info">12 stages</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-primary btn-sm" onclick="showPartnershipReport()">
                                <i class="fas fa-chart-line me-1"></i>Rapport complet
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Management -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-handshake me-2"></i>Répertoire des Entreprises Partenaires</h5>
                        <p class="text-muted mb-0">Gérer les partenariats et conventions de stage</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="exportCompanies()">
                            <i class="fas fa-file-excel me-2"></i>Exporter
                        </button>
                        <button class="btn btn-outline-info" onclick="generateConventions()">
                            <i class="fas fa-file-contract me-2"></i>Conventions
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                            <i class="fas fa-plus me-2"></i>Ajouter entreprise
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-4">
                        <div class="search-box">
                            <i class="fas fa-search text-muted"></i>
                            <input type="text" id="searchCompany" placeholder="Rechercher une entreprise..." onkeyup="filterCompanies()">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select class="custom-select" id="filterSector" onchange="filterCompanies()">
                                    <option value="">Tous les secteurs</option>
                                    <option value="Technologies">Technologies</option>
                                    <option value="Banque">Banque/Finance</option>
                                    <option value="Industrie">Industrie</option>
                                    <option value="Services">Services</option>
                                    <option value="Télécommunications">Télécommunications</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterStatus" onchange="filterCompanies()">
                                    <option value="">Tous les statuts</option>
                                    <option value="Actif">Partenariat actif</option>
                                    <option value="En négociation">En négociation</option>
                                    <option value="Suspendu">Suspendu</option>
                                    <option value="Expiré">Convention expirée</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterSize" onchange="filterCompanies()">
                                    <option value="">Toutes les tailles</option>
                                    <option value="Startup">Startup (< 50)</option>
                                    <option value="PME">PME (50-250)</option>
                                    <option value="Grande">Grande entreprise (> 250)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-secondary w-100" onclick="resetCompanyFilters()">
                                    <i class="fas fa-undo me-1"></i>Réinitialiser
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Companies Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="companiesTable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAllCompanies" onchange="toggleSelectAllCompanies()">
                                </th>
                                <th>Entreprise</th>
                                <th>Secteur d'activité</th>
                                <th>Contact</th>
                                <th>Convention</th>
                                <th>Stages actifs</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="companiesTableBody">
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input company-checkbox" value="1">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="company-logo me-3 bg-orange text-white rounded" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Orange Côte d'Ivoire</div>
                                            <small class="text-muted">Opérateur mobile leader</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">Télécommunications</span></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Marie Koffi</div>
                                        <small class="text-muted">marie.koffi@orange.ci</small><br>
                                        <small class="text-muted"><i class="fas fa-phone me-1"></i>+225 07 07 07 07</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge bg-success">Active</span><br>
                                        <small class="text-muted">Expire: 31/12/2025</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">8 stages</span>
                                </td>
                                <td><span class="badge status-active">Partenaire actif</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewCompany(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editCompany(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Convention" onclick="manageConvention(1)">
                                            <i class="fas fa-file-contract"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Stages" onclick="viewInternships(1)">
                                            <i class="fas fa-user-tie"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input company-checkbox" value="2">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="company-logo me-3 bg-danger text-white rounded" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Société Générale</div>
                                            <small class="text-muted">Banque internationale</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Banque/Finance</span></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Jean Kouassi</div>
                                        <small class="text-muted">j.kouassi@socgen.com</small><br>
                                        <small class="text-muted"><i class="fas fa-phone me-1"></i>+225 27 20 30 40</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge bg-success">Active</span><br>
                                        <small class="text-muted">Expire: 15/08/2025</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">6 stages</span>
                                </td>
                                <td><span class="badge status-active">Partenaire actif</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewCompany(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editCompany(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Convention" onclick="manageConvention(2)">
                                            <i class="fas fa-file-contract"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Stages" onclick="viewInternships(2)">
                                            <i class="fas fa-user-tie"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input company-checkbox" value="3">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="company-logo me-3 bg-warning text-white rounded" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-satellite-dish"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">MTN Côte d'Ivoire</div>
                                            <small class="text-muted">Réseau mobile</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">Télécommunications</span></td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Aminata Touré</div>
                                        <small class="text-muted">a.toure@mtn.ci</small><br>
                                        <small class="text-muted"><i class="fas fa-phone me-1"></i>+225 05 05 05 05</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge bg-warning">En renouvellement</span><br>
                                        <small class="text-muted">Expire: 30/06/2025</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">4 stages</span>
                                </td>
                                <td><span class="badge bg-warning">En négociation</span></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewCompany(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editCompany(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Convention" onclick="manageConvention(3)">
                                            <i class="fas fa-file-contract"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Stages" onclick="viewInternships(3)">
                                            <i class="fas fa-user-tie"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Navigation des entreprises">
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
                <div class="row mt-3" id="bulkCompanyPanel" style="display: none;">
                    <div class="col-12">
                        <div class="alert alert-primary d-flex justify-content-between align-items-center">
                            <span id="selectedCompanyCount">0 entreprise(s) sélectionnée(s)</span>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary" onclick="bulkExport()">
                                    <i class="fas fa-download me-1"></i>Exporter
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="bulkSendConventions()">
                                    <i class="fas fa-file-contract me-1"></i>Envoyer conventions
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="bulkUpdateStatus()">
                                    <i class="fas fa-edit me-1"></i>Modifier statut
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Company Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyModalLabel">
                        <i class="fas fa-building me-2"></i>Ajouter une nouvelle entreprise
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCompanyForm">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="companyName" class="form-label">Nom de l'entreprise <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="companyName" name="lib_entr" required>
                            </div>
                            <div class="col-md-4">
                                <label for="companySector" class="form-label">Secteur <span class="text-danger">*</span></label>
                                <select class="form-select" id="companySector" name="secteur" required>
                                    <option value="">Choisir...</option>
                                    <option value="Technologies">Technologies</option>
                                    <option value="Banque">Banque/Finance</option>
                                    <option value="Industrie">Industrie</option>
                                    <option value="Services">Services</option>
                                    <option value="Télécommunications">Télécommunications</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Santé">Santé</option>
                                    <option value="Éducation">Éducation</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="companyAddress" class="form-label">Adresse</label>
                                <textarea class="form-control" id="companyAddress" name="adresse" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="companyCity" class="form-label">Ville</label>
                                <input type="text" class="form-control" id="companyCity" name="ville" value="Abidjan">
                            </div>
                            <div class="col-md-6">
                                <label for="companyWebsite" class="form-label">Site web</label>
                                <input type="url" class="form-control" id="companyWebsite" name="site_web" placeholder="https://...">
                            </div>
                            <div class="col-md-6">
                                <label for="companySize" class="form-label">Taille de l'entreprise</label>
                                <select class="form-select" id="companySize" name="taille">
                                    <option value="">Choisir...</option>
                                    <option value="Startup">Startup (< 50 employés)</option>
                                    <option value="PME">PME (50-250 employés)</option>
                                    <option value="Grande">Grande entreprise (> 250 employés)</option>
                                </select>
                            </div>
                            
                            <div class="col-12"><hr></div>
                            <h6><i class="fas fa-user-tie me-2"></i>Contact Principal</h6>
                            
                            <div class="col-md-6">
                                <label for="contactName" class="form-label">Nom du contact <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contactName" name="contact_nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contactTitle" class="form-label">Fonction</label>
                                <input type="text" class="form-control" id="contactTitle" name="contact_fonction" placeholder="Ex: DRH, Responsable stages">
                            </div>
                            <div class="col-md-6">
                                <label for="contactEmail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="contactEmail" name="contact_email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="contactPhone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="contactPhone" name="contact_telephone" placeholder="+225 XX XX XX XX">
                            </div>
                            
                            <div class="col-12"><hr></div>
                            <h6><i class="fas fa-handshake me-2"></i>Partenariat</h6>
                            
                            <div class="col-md-6">
                                <label for="partnershipType" class="form-label">Type de partenariat</label>
                                <select class="form-select" id="partnershipType" name="type_partenariat">
                                    <option value="">Choisir...</option>
                                    <option value="Stage">Stages uniquement</option>
                                    <option value="Projet">Projets étudiants</option>
                                    <option value="Complet">Stage + Projets + Recrutement</option>
                                    <option value="Recherche">Partenariat recherche</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="maxInterns" class="form-label">Nombre max de stagiaires/an</label>
                                <input type="number" class="form-control" id="maxInterns" name="max_stagiaires" min="1" placeholder="Ex: 10">
                            </div>
                            <div class="col-12">
                                <label for="companyDescription" class="form-label">Description de l'entreprise</label>
                                <textarea class="form-control" id="companyDescription" name="description" rows="3" placeholder="Activités principales, domaines d'intervention..."></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="activePartnership" name="actif" checked>
                                    <label class="form-check-label" for="activePartnership">
                                        Partenariat actif (ouvert aux nouveaux stages)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="saveCompany()">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Company Modal -->
    <div class="modal fade" id="viewCompanyModal" tabindex="-1" aria-labelledby="viewCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCompanyModalLabel">
                        <i class="fas fa-building me-2"></i>Détails de l'entreprise
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="companyDetailsContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="editCompanyFromModal()">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Convention Management Modal -->
    <div class="modal fade" id="conventionModal" tabindex="-1" aria-labelledby="conventionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="conventionModalLabel">
                        <i class="fas fa-file-contract me-2"></i>Gestion de la Convention
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="conventionForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="conventionStart" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="conventionStart" name="date_debut" required>
                            </div>
                            <div class="col-md-6">
                                <label for="conventionEnd" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="conventionEnd" name="date_fin" required>
                            </div>
                            <div class="col-md-6">
                                <label for="conventionType" class="form-label">Type de convention</label>
                                <select class="form-select" id="conventionType" name="type">
                                    <option value="Standard">Convention standard</option>
                                    <option value="Cadre">Convention cadre</option>
                                    <option value="Spécifique">Convention spécifique</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="conventionStatus" class="form-label">Statut</label>
                                <select class="form-select" id="conventionStatus" name="statut">
                                    <option value="En cours">En cours de signature</option>
                                    <option value="Active">Active</option>
                                    <option value="Expirée">Expirée</option>
                                    <option value="Suspendue">Suspendue</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="conventionTerms" class="form-label">Conditions particulières</label>
                                <textarea class="form-control" id="conventionTerms" name="conditions" rows="4" placeholder="Conditions spéciales, clauses particulières..."></textarea>
                            </div>
                            <div class="col-12">
                                <label for="conventionFile" class="form-label">Document de convention</label>
                                <input type="file" class="form-control" id="conventionFile" name="fichier" accept=".pdf,.doc,.docx">
                                <div class="form-text">Formats acceptés: PDF, DOC, DOCX</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" onclick="generateConvention()">
                        <i class="fas fa-file-pdf me-2"></i>Générer modèle
                    </button>
                    <button type="button" class="btn btn-primary" onclick="saveConvention()">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functions
        function filterCompanies() {
            const searchTerm = document.getElementById('searchCompany').value.toLowerCase();
            const sectorFilter = document.getElementById('filterSector').value;
            const statusFilter = document.getElementById('filterStatus').value;
            const sizeFilter = document.getElementById('filterSize').value;
            
            const rows = document.querySelectorAll('#companiesTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesSector = !sectorFilter || text.includes(sectorFilter.toLowerCase());
                const matchesStatus = !statusFilter || text.includes(statusFilter.toLowerCase());
                const matchesSize = !sizeFilter || text.includes(sizeFilter.toLowerCase());
                
                row.style.display = (matchesSearch && matchesSector && matchesStatus && matchesSize) ? '' : 'none';
            });
        }

        function resetCompanyFilters() {
            document.getElementById('searchCompany').value = '';
            document.getElementById('filterSector').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterSize').value = '';
            filterCompanies();
        }

        // Company management functions
        function saveCompany() {
            const form = document.getElementById('addCompanyForm');
            if (form.checkValidity()) {
                console.log('Saving company...');
                
                const formData = new FormData(form);
                
                // Add save logic here
                bootstrap.Modal.getInstance(document.getElementById('addCompanyModal')).hide();
                showNotification('Entreprise ajoutée avec succès!', 'success');
            } else {
                form.reportValidity();
            }
        }

        function viewCompany(id) {
            console.log('Viewing company:', id);
            
            const companyData = {
                1: {
                    name: 'Orange Côte d\'Ivoire',
                    sector: 'Télécommunications',
                    contact: 'Marie Koffi',
                    email: 'marie.koffi@orange.ci',
                    phone: '+225 07 07 07 07',
                    address: 'Plateau, Abidjan',
                    website: 'https://orange.ci',
                    description: 'Premier opérateur mobile en Côte d\'Ivoire',
                    internships: 24,
                    convention: 'Active jusqu\'au 31/12/2025'
                }
            };
            
            const company = companyData[id] || companyData[1];
            
            const detailsContent = `
                <div class="row">
                    <div class="col-md-8">
                        <h6>Informations générales</h6>
                        <p><strong>Nom:</strong> ${company.name}</p>
                        <p><strong>Secteur:</strong> <span class="badge bg-primary">${company.sector}</span></p>
                        <p><strong>Site web:</strong> <a href="${company.website}" target="_blank">${company.website}</a></p>
                        <p><strong>Adresse:</strong> ${company.address}</p>
                        <p><strong>Description:</strong> ${company.description}</p>
                        
                        <h6 class="mt-4">Contact principal</h6>
                        <p><strong>Nom:</strong> ${company.contact}</p>
                        <p><strong>Email:</strong> <a href="mailto:${company.email}">${company.email}</a></p>
                        <p><strong>Téléphone:</strong> ${company.phone}</p>
                        
                        <h6 class="mt-4">Convention</h6>
                        <p>${company.convention}</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Statistiques</h6>
                        <div class="text-center mb-3">
                            <h3 class="text-primary">${company.internships}</h3>
                            <small>Stages cette année</small>
                        </div>
                        <div class="text-center mb-3">
                            <h3 class="text-success">8</h3>
                            <small>Stages en cours</small>
                        </div>
                        <div class="text-center mb-3">
                            <h3 class="text-info">95%</h3>
                            <small>Taux de satisfaction</small>
                        </div>
                        
                        <h6>Actions rapides</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="viewInternships(${id})">
                                <i class="fas fa-user-tie me-2"></i>Voir stages
                            </button>
                            <button class="btn btn-outline-success" onclick="manageConvention(${id})">
                                <i class="fas fa-file-contract me-2"></i>Convention
                            </button>
                            <button class="btn btn-outline-info" onclick="sendMessage(${id})">
                                <i class="fas fa-envelope me-2"></i>Contacter
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('companyDetailsContent').innerHTML = detailsContent;
            new bootstrap.Modal(document.getElementById('viewCompanyModal')).show();
        }

        function editCompany(id) {
            console.log('Editing company:', id);
            // Open edit modal with pre-filled data
        }

        function manageConvention(id) {
            console.log('Managing convention for company:', id);
            
            // Set default dates
            const startDate = new Date();
            const endDate = new Date();
            endDate.setFullYear(endDate.getFullYear() + 1);
            
            document.getElementById('conventionStart').value = startDate.toISOString().split('T')[0];
            document.getElementById('conventionEnd').value = endDate.toISOString().split('T')[0];
            
            new bootstrap.Modal(document.getElementById('conventionModal')).show();
        }

        function saveConvention() {
            const form = document.getElementById('conventionForm');
            if (form.checkValidity()) {
                console.log('Saving convention...');
                bootstrap.Modal.getInstance(document.getElementById('conventionModal')).hide();
                showNotification('Convention mise à jour!', 'success');
            } else {
                form.reportValidity();
            }
        }

        function generateConvention() {
            console.log('Generating convention template...');
            showNotification('Génération du modèle de convention...', 'info');
        }

        function viewInternships(id) {
            console.log('Viewing internships for company:', id);
            // Navigate to internships page with company filter
        }

        function sendMessage(id) {
            const message = prompt('Message à envoyer:');
            if (message) {
                console.log('Sending message to company:', id, message);
                showNotification('Message envoyé!', 'success');
            }
        }

        // Bulk operations
        function toggleSelectAllCompanies() {
            const selectAll = document.getElementById('selectAllCompanies');
            const checkboxes = document.querySelectorAll('.company-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            
            updateBulkCompanyPanel();
        }

        function updateBulkCompanyPanel() {
            const checkedBoxes = document.querySelectorAll('.company-checkbox:checked');
            const panel = document.getElementById('bulkCompanyPanel');
            const countElement = document.getElementById('selectedCompanyCount');
            
            if (checkedBoxes.length > 0) {
                panel.style.display = 'block';
                countElement.textContent = `${checkedBoxes.length} entreprise(s) sélectionnée(s)`;
            } else {
                panel.style.display = 'none';
            }
        }

        function bulkExport() {
            const checkedBoxes = document.querySelectorAll('.company-checkbox:checked');
            console.log('Bulk exporting companies:', Array.from(checkedBoxes).map(cb => cb.value));
            showNotification(`Export de ${checkedBoxes.length} entreprise(s) en cours...`, 'info');
        }

        function bulkSendConventions() {
            const checkedBoxes = document.querySelectorAll('.company-checkbox:checked');
            if (confirm(`Envoyer les conventions à ${checkedBoxes.length} entreprise(s) ?`)) {
                console.log('Bulk sending conventions...');
                showNotification(`Conventions envoyées à ${checkedBoxes.length} entreprise(s)!`, 'success');
            }
        }

        function bulkUpdateStatus() {
            const newStatus = prompt('Nouveau statut:');
            if (newStatus) {
                const checkedBoxes = document.querySelectorAll('.company-checkbox:checked');
                console.log('Bulk updating status to:', newStatus);
                showNotification(`Statut mis à jour pour ${checkedBoxes.length} entreprise(s)!`, 'success');
            }
        }

        // Utility functions
        function exportCompanies() {
            console.log('Exporting all companies...');
            showNotification('Export des entreprises en cours...', 'info');
        }

        function generateConventions() {
            console.log('Generating convention templates...');
            showNotification('Génération des modèles de convention...', 'info');
        }

        function showPartnershipReport() {
            console.log('Showing partnership report...');
            // Navigate to partnership report or open modal
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
            document.querySelectorAll('.company-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkCompanyPanel);
            });
            
            // Add CSS for company logos
            const style = document.createElement('style');
            style.textContent = `
                .bg-orange {
                    background-color: #ff6600 !important;
                }
                .company-logo {
                    font-size: 1.2rem;
                }
            `;
            document.head.appendChild(style);
            
            console.log('Companies management page loaded');
        });

        // Validate convention dates
        document.getElementById('conventionStart').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('conventionEnd');
            
            if (startDate) {
                // Set minimum end date to start date + 1 day
                const minEndDate = new Date(startDate);
                minEndDate.setDate(minEndDate.getDate() + 1);
                endDateInput.min = minEndDate.toISOString().split('T')[0];
                
                // If end date is before start date, update it
                if (endDateInput.value && endDateInput.value <= startDate) {
                    const defaultEndDate = new Date(startDate);
                    defaultEndDate.setFullYear(defaultEndDate.getFullYear() + 1);
                    endDateInput.value = defaultEndDate.toISOString().split('T')[0];
                }
            }
        });
    </script>