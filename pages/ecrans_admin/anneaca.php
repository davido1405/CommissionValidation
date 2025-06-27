
        <div class="header">
            <div class="d-flex align-items-center">
                <h2 class="page-title">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Gestion Année Académique
                </h2>
                <div class="ms-4 d-none d-md-block">
                    <span class="badge bg-success p-2">Année actuelle: 2024-2025</span>
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
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-0 fw-bold">Fin des inscriptions dans 5 jours</p>
                                    <small class="text-muted">31 mai 2025</small>
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
            <!-- Current Academic Year Card -->
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="mb-1"><i class="fas fa-calendar-check me-2 text-success"></i>Année Académique Actuelle</h5>
                                <h3 class="text-primary mb-0">2024 - 2025</h3>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success fs-6 p-2">En cours</span>
                                <div class="small text-muted mt-1">Débutée le 01/09/2024</div>
                            </div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-3 text-center">
                                <div class="border rounded p-3">
                                    <h4 class="text-success mb-1">268</h4>
                                    <small class="text-muted">Jours écoulés</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="border rounded p-3">
                                    <h4 class="text-warning mb-1">97</h4>
                                    <small class="text-muted">Jours restants</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="border rounded p-3">
                                    <h4 class="text-info mb-1">482</h4>
                                    <small class="text-muted">Étudiants inscrits</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="border rounded p-3">
                                    <h4 class="text-primary mb-1">73%</h4>
                                    <small class="text-muted">Avancement</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="progress mt-4" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 73%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card h-100">
                        <h6 class="mb-3"><i class="fas fa-clock me-2"></i>Événements Importants</h6>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Fin des inscriptions</h6>
                                    <p class="small text-muted mb-0">31 mai 2025</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Examens 1er semestre</h6>
                                    <p class="small text-muted mb-0">15 juin - 30 juin 2025</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Vacances</h6>
                                    <p class="small text-muted mb-0">01 juil - 31 août 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Years Management -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-calendar me-2"></i>Gestion des Années Académiques</h5>
                        <p class="text-muted mb-0">Configurer les périodes académiques et calendriers</p>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAcademicYearModal">
                        <i class="fas fa-plus me-2"></i>Nouvelle année académique
                    </button>
                </div>

                <!-- Academic Years Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Année Académique</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Durée</th>
                                <th>Inscriptions</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-success">
                                <td class="fw-bold">2024-2025</td>
                                <td>01/09/2024</td>
                                <td>31/08/2025</td>
                                <td>365 jours</td>
                                <td>
                                    <span class="badge bg-info">482 étudiants</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">En cours</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Voir détails" onclick="viewAcademicYear(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editAcademicYear(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Calendrier" onclick="manageCalendar(1)">
                                            <i class="fas fa-calendar-alt"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Clôturer" onclick="closeAcademicYear(1)" disabled>
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">2023-2024</td>
                                <td>01/09/2023</td>
                                <td>31/08/2024</td>
                                <td>366 jours</td>
                                <td>
                                    <span class="badge bg-secondary">456 étudiants</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Clôturée</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Voir détails" onclick="viewAcademicYear(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Archive" onclick="viewArchive(2)">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Rapport" onclick="generateReport(2)">
                                            <i class="fas fa-file-pdf"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">2022-2023</td>
                                <td>01/09/2022</td>
                                <td>31/08/2023</td>
                                <td>365 jours</td>
                                <td>
                                    <span class="badge bg-secondary">423 étudiants</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Clôturée</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" title="Voir détails" onclick="viewAcademicYear(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Archive" onclick="viewArchive(3)">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Rapport" onclick="generateReport(3)">
                                            <i class="fas fa-file-pdf"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Calendar Management Section -->
            <div class="dashboard-card mt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0"><i class="fas fa-calendar-week me-2"></i>Calendrier Académique 2024-2025</h5>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#calendarEventModal">
                        <i class="fas fa-plus me-2"></i>Ajouter un événement
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6>Semestres et Périodes</h6>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Semestre 1</strong>
                                    <br><small class="text-muted">01/09/2024 - 31/01/2025</small>
                                </div>
                                <span class="badge bg-success rounded-pill">Actuel</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Examens S1</strong>
                                    <br><small class="text-muted">15/12/2024 - 15/01/2025</small>
                                </div>
                                <span class="badge bg-warning rounded-pill">À venir</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Semestre 2</strong>
                                    <br><small class="text-muted">01/02/2025 - 30/06/2025</small>
                                </div>
                                <span class="badge bg-secondary rounded-pill">Futur</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Examens S2</strong>
                                    <br><small class="text-muted">15/06/2025 - 15/07/2025</small>
                                </div>
                                <span class="badge bg-secondary rounded-pill">Futur</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h6>Événements Spéciaux</h6>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Rentrée solennelle</strong>
                                    <br><small class="text-muted">05/09/2024</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">Terminé</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Soutenances Master</strong>
                                    <br><small class="text-muted">15/06 - 30/07/2025</small>
                                </div>
                                <span class="badge bg-info rounded-pill">Planifié</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Cérémonie de graduation</strong>
                                    <br><small class="text-muted">15/08/2025</small>
                                </div>
                                <span class="badge bg-success rounded-pill">Planifié</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Pré-inscription 2025-26</strong>
                                    <br><small class="text-muted">01/07 - 31/08/2025</small>
                                </div>
                                <span class="badge bg-warning rounded-pill">Futur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Academic Year Modal -->
    <div class="modal fade" id="addAcademicYearModal" tabindex="-1" aria-labelledby="addAcademicYearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAcademicYearModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Nouvelle Année Académique
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAcademicYearForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="startDate" name="dte_deb" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="endDate" name="dte_fin" required>
                            </div>
                            <div class="col-12">
                                <label for="yearLabel" class="form-label">Libellé <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="yearLabel" name="libelle" placeholder="Ex: 2025-2026" required>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description optionnelle de l'année académique"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="autoActivate" name="auto_activate">
                                    <label class="form-check-label" for="autoActivate">
                                        Activer automatiquement à la date de début
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="saveAcademicYear()">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Event Modal -->
    <div class="modal fade" id="calendarEventModal" tabindex="-1" aria-labelledby="calendarEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarEventModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Ajouter un Événement
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="calendarEventForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="eventTitle" class="form-label">Titre de l'événement <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="eventTitle" name="titre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="eventStartDate" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="eventStartDate" name="date_debut" required>
                            </div>
                            <div class="col-md-6">
                                <label for="eventEndDate" class="form-label">Date de fin</label>
                                <input type="date" class="form-control" id="eventEndDate" name="date_fin">
                            </div>
                            <div class="col-12">
                                <label for="eventType" class="form-label">Type d'événement <span class="text-danger">*</span></label>
                                <select class="form-select" id="eventType" name="type" required>
                                    <option value="">Choisir...</option>
                                    <option value="cours">Période de cours</option>
                                    <option value="examen">Examens</option>
                                    <option value="vacation">Vacances</option>
                                    <option value="inscription">Inscriptions</option>
                                    <option value="soutenance">Soutenances</option>
                                    <option value="ceremonie">Cérémonie</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="eventDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="eventDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sendNotification" name="notification">
                                    <label class="form-check-label" for="sendNotification">
                                        Envoyer une notification aux utilisateurs
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="saveCalendarEvent()">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Year Details Modal -->
    <div class="modal fade" id="academicYearDetailsModal" tabindex="-1" aria-labelledby="academicYearDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="academicYearDetailsModalLabel">
                        <i class="fas fa-calendar me-2"></i>Détails de l'Année Académique
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="academicYearDetailsContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Academic year management functions
        function viewAcademicYear(id) {
            console.log('Viewing academic year:', id);
            
            const detailsContent = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informations générales</h6>
                        <p><strong>Année:</strong> 2024-2025</p>
                        <p><strong>Début:</strong> 01 septembre 2024</p>
                        <p><strong>Fin:</strong> 31 août 2025</p>
                        <p><strong>Durée:</strong> 365 jours</p>
                        <p><strong>Statut:</strong> <span class="badge bg-success">En cours</span></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Statistiques</h6>
                        <p><strong>Étudiants inscrits:</strong> 482</p>
                        <p><strong>Nouveaux étudiants:</strong> 89</p>
                        <p><strong>Enseignants actifs:</strong> 56</p>
                        <p><strong>UE programmées:</strong> 45</p>
                        <p><strong>Rapports soumis:</strong> 124</p>
                    </div>
                </div>
                <hr>
                <h6>Calendrier des événements</h6>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <strong>Rentrée académique</strong> - 01/09/2024
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <strong>Examens 1er semestre</strong> - 15/12/2024 - 15/01/2025
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <strong>Soutenances</strong> - 15/06/2025 - 30/07/2025
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('academicYearDetailsContent').innerHTML = detailsContent;
            new bootstrap.Modal(document.getElementById('academicYearDetailsModal')).show();
        }

        function editAcademicYear(id) {
            console.log('Editing academic year:', id);
            // Open edit modal with pre-filled data
        }

        function manageCalendar(id) {
            console.log('Managing calendar for academic year:', id);
            // Redirect to calendar management or open calendar modal
        }

        function closeAcademicYear(id) {
            if (confirm('Êtes-vous sûr de vouloir clôturer cette année académique ? Cette action est irréversible.')) {
                console.log('Closing academic year:', id);
                // Implement close academic year logic
            }
        }

        function viewArchive(id) {
            console.log('Viewing archive for academic year:', id);
            // Redirect to archive page
        }

        function generateReport(id) {
            console.log('Generating report for academic year:', id);
            // Generate and download PDF report
        }

        function saveAcademicYear() {
            const form = document.getElementById('addAcademicYearForm');
            if (form.checkValidity()) {
                console.log('Saving academic year...');
                
                const formData = new FormData(form);
                const startDate = new Date(formData.get('dte_deb'));
                const endDate = new Date(formData.get('dte_fin'));
                
                // Validate dates
                if (endDate <= startDate) {
                    alert('La date de fin doit être postérieure à la date de début.');
                    return;
                }
                
                // Calculate academic year label if not provided
                if (!formData.get('libelle')) {
                    const startYear = startDate.getFullYear();
                    const endYear = endDate.getFullYear();
                    document.getElementById('yearLabel').value = `${startYear}-${endYear}`;
                }
                
                // Add save logic here
                bootstrap.Modal.getInstance(document.getElementById('addAcademicYearModal')).hide();
                
                // Show success message
                showNotification('Année académique créée avec succès!', 'success');
            } else {
                form.reportValidity();
            }
        }

        function saveCalendarEvent() {
            const form = document.getElementById('calendarEventForm');
            if (form.checkValidity()) {
                console.log('Saving calendar event...');
                
                const formData = new FormData(form);
                const startDate = new Date(formData.get('date_debut'));
                const endDate = formData.get('date_fin') ? new Date(formData.get('date_fin')) : null;
                
                // Validate dates if end date is provided
                if (endDate && endDate < startDate) {
                    alert('La date de fin doit être postérieure à la date de début.');
                    return;
                }
                
                // Add save logic here
                bootstrap.Modal.getInstance(document.getElementById('calendarEventModal')).hide();
                
                // Show success message
                showNotification('Événement ajouté au calendrier!', 'success');
            } else {
                form.reportValidity();
            }
        }

        // Auto-calculate year label based on dates
        document.getElementById('startDate').addEventListener('change', function() {
            updateYearLabel();
        });

        document.getElementById('endDate').addEventListener('change', function() {
            updateYearLabel();
        });

        function updateYearLabel() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            if (startDate && endDate) {
                const startYear = new Date(startDate).getFullYear();
                const endYear = new Date(endDate).getFullYear();
                document.getElementById('yearLabel').value = `${startYear}-${endYear}`;
            }
        }

        // Set default end date when start date is selected
        document.getElementById('eventStartDate').addEventListener('change', function() {
            const startDate = this.value;
            if (startDate && !document.getElementById('eventEndDate').value) {
                document.getElementById('eventEndDate').value = startDate;
            }
        });

        function showNotification(message, type) {
            // Create and show notification
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 5000);
        }

        // Initialize timeline styles
        document.addEventListener('DOMContentLoaded', function() {
            // Add CSS for timeline
            const style = document.createElement('style');
            style.textContent = `
                .timeline {
                    position: relative;
                    padding-left: 30px;
                }
                .timeline-item {
                    position: relative;
                    margin-bottom: 20px;
                }
                .timeline-marker {
                    position: absolute;
                    left: -37px;
                    top: 5px;
                    width: 12px;
                    height: 12px;
                    border-radius: 50%;
                }
                .timeline::before {
                    content: '';
                    position: absolute;
                    left: -31px;
                    top: 0;
                    bottom: 0;
                    width: 2px;
                    background-color: #dee2e6;
                }
            `;
            document.head.appendChild(style);
        });
    </script>