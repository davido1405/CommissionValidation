
        <div class="header">
            <div class="d-flex align-items-center">
                <h2 class="page-title">
                    <i class="fas fa-history me-2"></i>
                    Journal d'Audit
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
                                    <div class="bg-primary text-white rounded-circle p-2">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-0 fw-bold">12 nouveaux rapports à valider</p>
                                    <small class="text-muted">Il y a 2 heures</small>
                                </div>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item py-3 border-bottom" href="#">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning text-white rounded-circle p-2">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-0 fw-bold">5 nouvelles inscriptions</p>
                                    <small class="text-muted">Il y a 5 heures</small>
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
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Filtrer les activités</h5>
                            <div>
                                <button class="btn btn-primary export-btn" data-bs-toggle="modal" data-bs-target="#exportModal">
                                    <i class="fas fa-file-export"></i> Exporter
                                </button>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="filter-label">Type d'utilisateur</div>
                                <select class="custom-select" id="userTypeFilter">
                                    <option value="" selected>Tous les utilisateurs</option>
                                    <option value="enseignant">Enseignants</option>
                                    <option value="etudiant">Étudiants</option>
                                    <option value="admin">Personnel Admin</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Utilisateur spécifique</div>
                                <select class="custom-select" id="specificUserFilter">
                                    <option value="" selected>Tous</option>
                                    <option value="1">Martin Dupont (Admin)</option>
                                    <option value="2">Jeanne Moreau (Enseignant)</option>
                                    <option value="3">Antoine Laurent (Étudiant)</option>
                                    <option value="4">Sophie Renard (Enseignant)</option>
                                    <option value="5">Paul Martin (Étudiant)</option>
                                    <option value="6">Thomas Bernard (Admin)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Type d'action</div>
                                <select class="custom-select" id="actionTypeFilter">
                                    <option value="" selected>Toutes les actions</option>
                                    <option value="connexion">Connexions</option>
                                    <option value="modification">Modifications</option>
                                    <option value="suppression">Suppressions</option>
                                    <option value="creation">Créations</option>
                                    <option value="acces">Accès aux données</option>
                                    <option value="validation">Validations</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Niveau de sévérité</div>
                                <select class="custom-select" id="severityFilter">
                                    <option value="" selected>Tous les niveaux</option>
                                    <option value="info">Information</option>
                                    <option value="warning">Avertissement</option>
                                    <option value="danger">Critique</option>
                                    <option value="success">Succès</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Date de début</div>
                                <input type="date" class="date-input" id="startDateFilter" value="2025-01-01">
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Date de fin</div>
                                <input type="date" class="date-input" id="endDateFilter" value="2025-04-28">
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Module</div>
                                <select class="custom-select" id="moduleFilter">
                                    <option value="" selected>Tous les modules</option>
                                    <option value="etudiant">Étudiants</option>
                                    <option value="enseignant">Enseignants</option>
                                    <option value="rapport">Rapports</option>
                                    <option value="jury">Jurys</option>
                                    <option value="annee">Année académique</option>
                                    <option value="utilisateur">Utilisateurs</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="filter-label">Comportement</div>
                                <select class="custom-select" id="behaviorFilter">
                                    <option value="" selected>Tous</option>
                                    <option value="normal">Normal</option>
                                    <option value="suspect">Suspect</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-end mt-3">
                                <button class="btn btn-outline-secondary me-2">Réinitialiser</button>
                                <button class="btn btn-accent" style="background-color:var(--accent-color); color:white;">Appliquer les filtres</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Journal des activités</h5>
                            <div class="d-flex">
                                <div class="me-3">
                                    <select class="custom-select">
                                        <option value="100">100 entrées</option>
                                        <option value="50">50 entrées</option>
                                        <option value="25" selected>25 entrées</option>
                                    </select>
                                </div>
                                <div class="search-box" style="width: 250px;">
                                    <i class="fas fa-search text-muted"></i>
                                    <input type="text" placeholder="Rechercher...">
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th>Utilisateur</th>
                                        <th>Action</th>
                                        <th>Date & Heure</th>
                                        <th>Module</th>
                                        <th>Détails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="audit-entry danger position-relative" data-bs-toggle="modal" data-bs-target="#auditDetailModal">
                                        <td>
                                            <div class="status-icon-wrapper danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </td>
                                        <td>Martin Dupont<br><small class="text-muted">Admin</small></td>
                                        <td>Suppression</td>
                                        <td>28/04/2025<br><small class="text-muted">10:15:43</small></td>
                                        <td>Rapports</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <div class="audit-flag suspicious"></div>
                                    </tr>
                                    <tr class="audit-entry info">
                                        <td>
                                            <div class="status-icon-wrapper info">
                                                <i class="fas fa-sign-in-alt"></i>
                                            </div>
                                        </td>
                                        <td>Thomas Bernard<br><small class="text-muted">Admin</small></td>
                                        <td>Connexion</td>
                                        <td>28/04/2025<br><small class="text-muted">09:45:12</small></td>
                                        <td>Utilisateurs</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="audit-entry success">
                                        <td>
                                            <div class="status-icon-wrapper success">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </td>
                                        <td>Jeanne Moreau<br><small class="text-muted">Enseignant</small></td>
                                        <td>Validation</td>
                                        <td>28/04/2025<br><small class="text-muted">09:32:27</small></td>
                                        <td>Rapports</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="audit-entry warning position-relative">
                                        <td>
                                            <div class="status-icon-wrapper warning">
                                                <i class="fas fa