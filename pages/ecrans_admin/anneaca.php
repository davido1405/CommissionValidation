<!-- Début du fichier HTML dynamisé -->
<?php
require_once __DIR__ . '/../../config/db.php';

// Récupérer l'année actuelle
$today = date('Y-m-d');
$stmt = $pdo->prepare("SELECT * FROM annee_academique WHERE dte_deb <= ? AND dte_fin >= ? ORDER BY id_ac DESC LIMIT 1");
$stmt->execute([$today, $today]);
$anneeActuelle = $stmt->fetch();

// Calculs utiles
$todayDate = new DateTime();
$start = new DateTime($anneeActuelle['dte_deb']);
$end = new DateTime($anneeActuelle['dte_fin']);
$totalDays = $start->diff($end)->days;
$elapsed = $start->diff($todayDate)->days;
$remaining = $end->diff($todayDate)->invert === 1 ? $end->diff($todayDate)->days : 0;
$progress = min(100, round(($elapsed / $totalDays) * 100));

// Récupérer nombre d'étudiants inscrits
$stmtEtudiants = $pdo->prepare("SELECT COUNT(DISTINCT num_etu) FROM inscrire WHERE id_ac = ?");
$stmtEtudiants->execute([$anneeActuelle['id_ac']]);
$nbEtudiants = $stmtEtudiants->fetchColumn();

// Récupérer toutes les années académiques
$annees = $pdo->query("SELECT * FROM annee_academique ORDER BY dte_deb DESC")->fetchAll(PDO::FETCH_ASSOC);

// Si la colonne statut a été ajoutée, s'assurer qu'elle est bien renseignée (au cas où ce n'est pas encore fait)
foreach ($annees as &$ac) {
    $now = new DateTime();
    $deb = new DateTime($ac['dte_deb']);
    $fin = new DateTime($ac['dte_fin']);

    if ($now < $deb) {
        $ac['statut'] = 'a venir';
    } elseif ($now > $fin) {
        $ac['statut'] = 'cloturee';
    } else {
        $ac['statut'] = 'en cours';
    }

    // Eventuellement mettre à jour en base (optionnel)
    $update = $pdo->prepare("UPDATE annee_academique SET statut = ? WHERE id_ac = ?");
    $update->execute([$ac['statut'], $ac['id_ac']]);
}
unset($ac);

// Récupérer les événements liés à l'année actuelle
$evenements = $pdo->prepare("SELECT * FROM evenement WHERE id_ac = ? ORDER BY date_debut ASC");
$evenements->execute([$anneeActuelle['id_ac']]);
$evenements = $evenements->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-area">
  <!-- Année en cours -->
  <div class="row g-4 mb-4">
    <div class="col-md-8">
      <div class="dashboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h5 class="mb-1"><i class="fas fa-calendar-check me-2 text-success"></i>Année Académique Actuelle</h5>
            <h3 class="text-primary mb-0"><?= htmlspecialchars($anneeActuelle['lib_ac']) ?></h3>
          </div>
          <div class="text-end">
            <span class="badge bg-success fs-6 p-2">En cours</span>
            <div class="small text-muted mt-1">Débutée le <?= (new DateTime($anneeActuelle['dte_deb']))->format('d/m/Y') ?></div>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-3 text-center">
            <div class="border rounded p-3">
              <h4 class="text-success mb-1"><?= $elapsed ?></h4>
              <small class="text-muted">Jours écoulés</small>
            </div>
          </div>
          <div class="col-md-3 text-center">
            <div class="border rounded p-3">
              <h4 class="text-warning mb-1"><?= $remaining ?></h4>
              <small class="text-muted">Jours restants</small>
            </div>
          </div>
          <div class="col-md-3 text-center">
            <div class="border rounded p-3">
              <h4 class="text-info mb-1"><?= $nbEtudiants ?></h4>
              <small class="text-muted">Étudiants inscrits</small>
            </div>
          </div>
          <div class="col-md-3 text-center">
            <div class="border rounded p-3">
              <h4 class="text-primary mb-1"><?= $progress ?>%</h4>
              <small class="text-muted">Avancement</small>
            </div>
          </div>
        </div>
        <div class="progress mt-4" style="height: 10px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: <?= $progress ?>%"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="dashboard-card h-100">
        <h6 class="mb-3"><i class="fas fa-clock me-2"></i>Événements Importants</h6>
        <div class="timeline">
          <?php foreach ($evenements as $ev): ?>
          <div class="timeline-item">
            <div class="timeline-marker bg-info"></div>
            <div class="timeline-content">
              <h6 class="mb-1"><?= htmlspecialchars($ev['titre']) ?></h6>
              <p class="small text-muted mb-0">
                <?php
                  $d1 = (new DateTime($ev['date_debut']))->format('d/m/Y');
                  $d2 = $ev['date_fin'] ? (new DateTime($ev['date_fin']))->format('d/m/Y') : null;
                  echo $d2 ? "$d1 - $d2" : $d1;
                ?>
              </p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Gestion des années académiques -->
  <div class="dashboard-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h5 class="mb-1"><i class="fas fa-calendar me-2"></i>Gestion des Années Acades Acad\u00emiques</h5>
        <p class="text-muted mb-0">Configurer les périodes académiques et calendriers</p>
      </div>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAcademicYearModal">
        <i class="fas fa-plus me-2"></i>Nouvelle année académique
      </button>
    </div>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Année Académique</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($annees as $ac): ?>
          <tr class="<?= $ac['statut'] === 'en cours' ? 'table-success' : '' ?>">
            <td class="fw-bold"><?= htmlspecialchars($ac['lib_ac']) ?></td>
            <td><?= (new DateTime($ac['dte_deb']))->format('d/m/Y') ?></td>
            <td><?= (new DateTime($ac['dte_fin']))->format('d/m/Y') ?></td>
            <td><span class="badge bg-<?= $ac['statut'] === 'en cours' ? 'success' : 'secondary' ?>"><?= ucfirst($ac['statut']) ?></span></td>
            <td>
              <div class="btn-group">
                <button class="btn btn-sm btn-outline-primary" onclick="viewAcademicYear(<?= $ac['id_ac'] ?>)"><i class="fas fa-eye"></i></button>
                <button class="btn btn-sm btn-outline-warning" onclick="editAcademicYear(<?= $ac['id_ac'] ?>)"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-info" onclick="manageCalendar(<?= $ac['id_ac'] ?>)"><i class="fas fa-calendar-alt"></i></button>
                <button class="btn btn-sm btn-outline-success" onclick="closeAcademicYear(<?= $ac['id_ac'] ?>)" <?= $ac['statut'] !== 'en cours' ? 'disabled' : '' ?>><i class="fas fa-lock"></i></button>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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

        // Charger les années académiques depuis le serveur
        function loadAcademicYears() {
            fetch('get_academic_years.php')
            .then(r => r.json())
            .then(data => {
                if (data.status !== 'success') throw 'Erreur';
                const tbody = document.querySelector('#academicYearsTable tbody');
                tbody.innerHTML = '';
                data.years.forEach(y => {
                    const tr = document.createElement('tr');
                    if (y.statut === 'en cours') tr.classList.add('table-success');
                    tr.innerHTML = `
                        <td class="fw-bold">${y.lib_ac}</td>
                        <td>${new Date(y.dte_deb).toLocaleDateString()}</td>
                        <td>${new Date(y.dte_fin).toLocaleDateString()}</td>
                        <td>${y.duree} jours</td>
                        <td><span class="badge bg-info">${y.inscrits} étudiants</span></td>
                        <td><span class="badge bg-${y.statut==='en cours'?'success': y.statut==='à venir'? 'warning' : 'secondary'}">${y.statut}</span></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="viewAcademicYear(${y.id_ac})"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-outline-warning" onclick="editAcademicYear(${y.id_ac})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-info" onclick="manageCalendar(${y.id_ac})"><i class="fas fa-calendar-alt"></i></button>
                                <button ${y.statut !== 'en cours' ? 'disabled' : ''} class="btn btn-sm btn-outline-success" onclick="closeAcademicYear(${y.id_ac})"><i class="fas fa-lock"></i></button>
                            </div>
                        </td>`;
                    tbody.appendChild(tr);
                });
            })
            .catch(console.error);
        }

        // Appel au chargement
        document.addEventListener('DOMContentLoaded', loadAcademicYears);


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