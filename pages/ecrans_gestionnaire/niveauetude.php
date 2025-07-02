<?php
require_once (__DIR__ . '/../../config/db.php');
if (session_status() === PHP_SESSION_NONE) session_start();

// Vérifier la connexion
if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Charger les niveaux d'études actifs, groupés par cycle
$sql = "SELECT cycle, code, lib_niv_etu, credits, duree 
        FROM niveau_etude 
        WHERE actif = 1 
        ORDER BY id_niv_etu -- ou une autre colonne existante qui a du sens
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$niveaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Grouper les niveaux par cycle
$cycles = [];
foreach ($niveaux as $niv) {
    $cycles[$niv['cycle']][] = $niv;
}

// Icônes et couleurs associées
$styles = [
    'Licence' => ['icon' => 'fas fa-certificate', 'color' => 'success'],
    'Master' => ['icon' => 'fas fa-award', 'color' => 'warning'],
    'Doctorat' => ['icon' => 'fas fa-trophy', 'color' => 'info'],
];



// Requête pour récupérer les niveaux avec nombre d'étudiants inscrits
$sql = "
    SELECT 
        ne.id_niv_etu, ne.code, ne.lib_niv_etu, ne.cycle, ne.duree, ne.credits, ne.actif,
        (SELECT COUNT(DISTINCT i.num_etu) FROM inscrire i WHERE i.id_niv_etu = ne.id_niv_etu) AS nb_etudiants
    FROM niveau_etude ne
    WHERE ne.actif = 1
    ORDER BY FIELD(ne.cycle, 'Licence', 'Master', 'Doctorat'), ne.code
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$niveaux = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Fonction pour traduire statut actif
function statutLabel(int $actif): array {
    if ($actif === 1) return ['label' => 'Actif', 'class' => 'status-active badge bg-success'];
    if ($actif === 0) return ['label' => 'Inactif', 'class' => 'badge bg-secondary'];
    return ['label' => 'Archivé', 'class' => 'badge bg-dark'];
}

?>



        <div class="content-area">
            <!-- LMD Structure Overview -->
            <div class="row g-4 mb-4">
                <div class="col-md-12">
                    <div class="dashboard-card">
                        <h5 class="mb-4"><i class="fas fa-sitemap me-2"></i>Structure du Système LMD</h5>
                        <div class="row">
                            <?php 
                            // Styles pour les cycles et niveaux avec icones et couleurs par niveau
                            $styles = [
                                'Licence' => [
                                    'icon' => 'fas fa-certificate', 
                                    'color' => 'success', 
                                    'levels' => [
                                        'L1' => ['color' => 'success', 'icon' => 'fas fa-book-reader'],
                                        'L2' => ['color' => 'info', 'icon' => 'fas fa-book'],
                                        'L3' => ['color' => 'primary', 'icon' => 'fas fa-graduation-cap'],
                                    ]
                                ],
                                'Master' => [
                                    'icon' => 'fas fa-award', 
                                    'color' => 'warning', 
                                    'levels' => [
                                        'M1' => ['color' => 'warning', 'icon' => 'fas fa-chalkboard-teacher'],
                                        'M2' => ['color' => 'danger', 'icon' => 'fas fa-flask'],
                                    ],
                                    'badge_recherche' => 'bg-info', 
                                    'badge_pro' => 'bg-success'
                                ],
                                'Doctorat' => [
                                    'icon' => 'fas fa-trophy', 
                                    'color' => 'info', 
                                    'levels' => [
                                        'D' => ['color' => 'info', 'icon' => 'fas fa-flask'], // On peut juste dire "D" pour doctorat
                                    ],
                                    'badge_recherche' => 'bg-purple',
                                ],
                            ];
                            
                            foreach ($cycles as $cycle => $niveauxCycle): 
                                foreach ($niveauxCycle as $niv):
                                    // Sécurisation de l'accès à 'code'
                                    $nivCode = !empty($niv['code']) ? $niv['code'] : null;

                                    // Définit le style du niveau (ou fallback sur cycle)
                                    if ($nivCode && isset($styles[$cycle]['levels'][$nivCode])) {
                                        $levelStyle = $styles[$cycle]['levels'][$nivCode];
                                    } else {
                                        $levelStyle = ['color' => $styles[$cycle]['color'], 'icon' => $styles[$cycle]['icon']];
                                    }

                                    // Valeurs sécurisées pour durée et crédits
                                    $duree = isset($niv['duree']) ? $niv['duree'] : '?';
                                    $credits = isset($niv['credits']) ? $niv['credits'] : '?';
                            ?>
                                <div class="col-md-4">
                                    <div class="text-center p-4 border rounded h-100 shadow-sm" style="background-color: #f9f9f9;">
                                        <div class="mb-3">
                                            <i class="<?= $levelStyle['icon'] ?> fa-3x text-<?= $levelStyle['color'] ?>"></i>
                                        </div>
                                        <h4 class="text-<?= $levelStyle['color'] ?>"><?= strtoupper($nivCode ?? 'N/A') ?></h4>
                                        <p class="text-muted">
                                            <?php
                                                if ($cycle === 'Doctorat') {
                                                    echo $duree . " années minimum";
                                                } else {
                                                    echo $duree . " années • " . $credits . " crédits ECTS";
                                                }
                                            ?>
                                        </p>

                                        <?php if ($cycle === 'Doctorat'): ?>
                                            <div class="mt-3">
                                                <span class="badge <?= $styles[$cycle]['badge_recherche'] ?? 'bg-primary' ?>">Recherche avancée</span>
                                            </div>
                                        <?php elseif ($cycle === 'Master'): ?>
                                            <div class="mt-3">
                                                <span class="badge <?= $styles[$cycle]['badge_recherche'] ?>">Recherche</span>
                                                <span class="badge <?= $styles[$cycle]['badge_pro'] ?>">Professionnel</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php 
                                endforeach;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Gestion niveaux d'étude -->
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-cogs me-2"></i>Configuration des Niveaux d'Étude</h5>
                        <p class="text-muted mb-0">Gérer les niveaux, spécialisations et filières</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="exportLevels()">
                            <i class="fas fa-file-export me-2"></i>Exporter
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLevelModal">
                            <i class="fas fa-plus me-2"></i>Nouveau niveau
                        </button>
                    </div>
                </div>

                <!-- Search and Filters -->
                <?php
                    // Exemples dynamiques de cycles et statuts (tu peux adapter selon ta source de données)
                    $cyclesOptions = ['Licence', 'Master', 'Doctorat'];
                    $statusOptions = ['Actif', 'Inactif', 'Archivé'];
                ?>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-4">
                        <div class="search-box position-relative">
                            <i class="fas fa-search text-muted position-absolute" style="top: 10px; left: 10px;"></i>
                            <input type="text" id="searchLevel" placeholder="Rechercher un niveau..."
                                onkeyup="filterLevels()" style="padding-left: 30px;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select class="form-select" id="filterCycle" onchange="filterLevels()">
                                    <option value="">Tous les cycles</option>
                                    <?php foreach ($cyclesOptions as $cycle): ?>
                                        <option value="<?= htmlspecialchars($cycle) ?>"><?= htmlspecialchars($cycle) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" id="filterStatus" onchange="filterLevels()">
                                    <option value="">Tous les statuts</option>
                                    <?php foreach ($statusOptions as $status): ?>
                                        <option value="<?= htmlspecialchars($status) ?>"><?= htmlspecialchars($status) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
                                    <i class="fas fa-undo me-1"></i>Réinitialiser
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Levels Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="levelsTable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Niveau d'étude</th>
                                <th>Cycle</th>
                                <th>Durée</th>
                                <th>Crédits requis</th>
                                <th>Étudiants inscrits</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!function_exists('statutLabel')) {
                                function statutLabel(int $actif): array {
                                    if ($actif === 1) return ['label' => 'Actif', 'class' => 'status-active badge bg-success'];
                                    if ($actif === 0) return ['label' => 'Inactif', 'class' => 'badge bg-secondary'];
                                    return ['label' => 'Archivé', 'class' => 'badge bg-dark'];
                                }
                            }

                            $maxStudents = 120; // valeur max pour barre de progression

                            foreach ($niveaux as $niv):
                                $nbEtudiants = isset($niv['nb_etudiants']) ? (int)$niv['nb_etudiants'] : 0;
                                $progress = min(100, round(($nbEtudiants / $maxStudents) * 100));

                                $badgeCycleClass = match ($niv['cycle']) {
                                    'Licence' => 'bg-success',
                                    'Master' => 'bg-warning text-dark',
                                    'Doctorat' => 'bg-info text-white',
                                    default => 'bg-secondary',
                                };

                                $statut = statutLabel((int)($niv['actif'] ?? 0));
                            ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($niv['code'] ?? '') ?></td>
                                    <td>
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($niv['lib_niv_etu'] ?? '') ?></div>
                                        </div>
                                    </td>
                                    <td><span class="badge <?= $badgeCycleClass ?>"><?= htmlspecialchars($niv['cycle'] ?? '') ?></span></td>
                                    <td><?= htmlspecialchars($niv['duree'] ?? '') ?> an<?= (isset($niv['duree']) && $niv['duree'] > 1) ? 's' : '' ?></td>
                                    <td><span class="badge bg-primary"><?= htmlspecialchars($niv['credits'] ?? '') ?> crédits</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2"><?= $nbEtudiants ?></span>
                                            <div class="progress flex-grow-1" style="height: 6px; max-width: 60px;">
                                                <div class="progress-bar <?= $badgeCycleClass ?>" style="width: <?= $progress ?>%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="<?= $statut['class'] ?>"><?= $statut['label'] ?></span></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewLevel(<?= (int)$niv['id_niv_etu'] ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editLevel(<?= (int)$niv['id_niv_etu'] ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Level Modal -->
    <div class="modal fade" id="addLevelModal" tabindex="-1" aria-labelledby="addLevelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLevelModalLabel">
                <i class="fas fa-plus me-2"></i>Ajouter un nouveau niveau d'étude
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLevelForm" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                    <label for="levelCode" class="form-label">Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="levelCode" name="code" required>
                    <div class="form-text">Ex: L1, L2, M1, M2, D1...</div>
                    <div class="invalid-feedback">Le code est obligatoire.</div>
                    </div>
                    <div class="col-md-6">
                    <label for="levelName" class="form-label">Nom du niveau <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="levelName" name="lib_niv_etu" required>
                    <div class="invalid-feedback">Le nom du niveau est obligatoire.</div>
                    </div>
                    <div class="col-md-6">
                    <label for="levelCycle" class="form-label">Cycle <span class="text-danger">*</span></label>
                    <select class="form-select" id="levelCycle" name="cycle" required>
                        <option value="">Choisir...</option>
                        <option value="Licence">Licence (L)</option>
                        <option value="Master">Master (M)</option>
                        <option value="Doctorat">Doctorat (D)</option>
                    </select>
                    <div class="invalid-feedback">Le cycle est obligatoire.</div>
                    </div>
                    <div class="col-md-6">
                    <label for="levelDuration" class="form-label">Durée (années) <span class="text-danger">*</span></label>
                    <select class="form-select" id="levelDuration" name="duree" required>
                        <option value="">Choisir...</option>
                        <option value="1">1 an</option>
                        <option value="2">2 ans</option>
                        <option value="3">3 ans</option>
                        <option value="4">4 ans</option>
                    </select>
                    <div class="invalid-feedback">La durée est obligatoire.</div>
                    </div>
                    <div class="col-md-6">
                    <label for="levelCredits" class="form-label">Crédits requis <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="levelCredits" name="credits" min="30" max="180" required>
                    <div class="form-text">Crédits ECTS nécessaires pour valider le niveau</div>
                    <div class="invalid-feedback">Veuillez saisir un nombre entre 30 et 180.</div>
                    </div>
                    <div class="col-md-6">
                    <label for="levelOrder" class="form-label">Ordre d'affichage</label>
                    <input type="number" class="form-control" id="levelOrder" name="ordre" min="1" placeholder="1">
                    </div>
                    <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="levelActive" name="actif" checked>
                        <label class="form-check-label" for="levelActive">
                        Niveau actif (ouvert aux inscriptions)
                        </label>
                    </div>
                    </div>
                </div>
                </form>
                <div id="addLevelAlert" class="alert d-none mt-3" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveLevel()">
                <i class="fas fa-save me-2"></i>Enregistrer
                </button>
            </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="viewLevelModal" tabindex="-1" aria-labelledby="viewLevelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLevelModalLabel">Détails du niveau d'étude</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="levelDetailsContent">
                <!-- Contenu chargé dynamiquement ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
    </div>



    <!-- Specializations Modal -->
    <div class="modal fade" id="specializationsModal" tabindex="-1" aria-labelledby="specializationsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="specializationsModalLabel">
                        <i class="fas fa-tags me-2"></i>Gestion des Spécialisations
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6>Spécialisations disponibles</h6>
                        <button class="btn btn-sm btn-primary" onclick="addSpecialization()">
                            <i class="fas fa-plus me-1"></i>Nouvelle spécialisation
                        </button>
                    </div>
                    <div id="specializationsContent">
                        <!-- Content will be loaded dynamically -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functions
        function filterLevels() {
            const searchTerm = document.getElementById('searchLevel').value.toLowerCase();
            const cycleFilter = document.getElementById('filterCycle').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            const rows = document.querySelectorAll('#levelsTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesCycle = !cycleFilter || text.includes(cycleFilter.toLowerCase());
                const matchesStatus = !statusFilter || text.includes(statusFilter.toLowerCase());
                
                row.style.display = (matchesSearch && matchesCycle && matchesStatus) ? '' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('searchLevel').value = '';
            document.getElementById('filterCycle').value = '';
            document.getElementById('filterStatus').value = '';
            filterLevels();
        }

        function viewLevel(id) {
            fetch(`../pages/ecrans_gestionnaire/voir_niveau.php?id=${id}`)
                .then(response => response.text())
                .then(text => {
                    // Essayer de parser manuellement le JSON
                    let level;
                    try {
                        level = JSON.parse(text);
                    } catch (e) {
                        console.error("Erreur JSON :", e);
                        console.error("Réponse brute :", text);
                        alert("Erreur de format : la réponse du serveur n'est pas du JSON valide.");
                        return;
                    }

                    // Gérer les erreurs renvoyées par PHP
                    if (level.error) {
                        alert("Erreur : " + level.error);
                        return;
                    }

                    // Construction du contenu HTML
                    const detailsContent = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations générales</h6>
                            <p><strong>Code:</strong> ${level.code}</p>
                            <p><strong>Nom:</strong> ${level.lib_niv_etu}</p>
                            <p><strong>Cycle:</strong> <span class="badge bg-success">${level.cycle}</span></p>
                            <p><strong>Durée:</strong> ${level.duree}</p>
                            <p><strong>Crédits requis:</strong> <span class="badge bg-primary">${level.credits} crédits</span></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Statistiques</h6>
                            <p><strong>Étudiants inscrits:</strong> ${level.nb_etudiants}</p>
                            <p><strong>Taux de réussite:</strong> ${level.success_rate}%</p>
                            <p><strong>Spécialisations:</strong> ${level.nb_specialites ? level.nb_specialites : 'Non renseigné'}</p>
                            <p><strong>UE disponibles:</strong> ${level.nb_ue}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h6>Description</h6>
                            <p>${level.description || 'Non renseignée'}</p>
                        </div>
                        <div class="col-12">
                            <h6>Prérequis</h6>
                            <p>${level.prerequisites || 'Non renseignés'}</p>
                        </div>
                    </div>
                `;


                    // Injecter et afficher le modal
                    document.getElementById('levelDetailsContent').innerHTML = detailsContent;
                    new bootstrap.Modal(document.getElementById('viewLevelModal')).show();
                })
                .catch(error => {
                    alert("Erreur lors de la récupération des données.");
                    console.error("Erreur fetch :", error);
                });
        }




        function editLevel(id) {
            console.log('Editing level:', id);
            // Open edit modal with pre-filled data
        }

        function archiveLevel(id) {
            if (confirm('Êtes-vous sûr de vouloir archiver ce niveau d\'étude ? Les étudiants actuels pourront terminer mais aucune nouvelle inscription ne sera possible.')) {
                console.log('Archiving level:', id);
                // Implement archive logic
            }
        }

        function saveLevel() {
            const form = document.getElementById('addLevelForm');
            const alertBox = document.getElementById('addLevelAlert');

            // Reset alert
            alertBox.classList.add('d-none');
            alertBox.textContent = '';

            // Validation bootstrap custom
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            // Préparer les données
            const formData = new FormData(form);
            // Checkbox non cochée n'envoie pas de valeur, donc forçons
            if (!formData.has('actif')) {
                formData.append('actif', 0);
            } else {
                formData.set('actif', 1);
            }

            fetch('../pages/ecrans_gestionnaire/ajout_niveau_etude.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                // Succès : fermer modal, reset form, refresh liste
                const modalEl = document.getElementById('addLevelModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                form.reset();
                form.classList.remove('was-validated');

                if (typeof refreshLevels === 'function') {
                    refreshLevels();
                }
                } else {
                alertBox.classList.remove('d-none');
                alertBox.classList.add('alert-danger');
                alertBox.textContent = data.message || 'Erreur lors de l\'enregistrement';
                }
            })
            .catch(() => {
                alertBox.classList.remove('d-none');
                alertBox.classList.add('alert-danger');
                alertBox.textContent = 'Erreur réseau ou serveur';
            });
        }

        function refreshLevels() {
            fetch('pages/ecrans_gestionnaire/niveauetude.php')
                .then(response => response.text())
                .then(html => {
                    const tbody = document.querySelector('#levelsTable tbody');
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    console.error('Erreur lors du rafraîchissement des niveaux :', error);
                });
        }



        function addSpecialization() {
            const code = prompt('Code de la spécialisation:');
            const name = prompt('Nom de la spécialisation:');
            
            if (code && name) {
                console.log('Adding specialization:', {code, name});
                // Add specialization logic
                showNotification('Spécialisation ajoutée avec succès!', 'success');
            }
        }

        function editSpecialization(id) {
            console.log('Editing specialization:', id);
            // Open edit specialization modal
        }

        function deleteSpecialization(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette spécialisation ?')) {
                console.log('Deleting specialization:', id);
                // Delete specialization logic
            }
        }

        function exportLevels() {
            console.log('Exporting levels...');
            // Implement export functionality
        }

        // Auto-calculate credits based on cycle
        document.getElementById('levelCycle').addEventListener('change', function() {
            const cycle = this.value;
            const creditsField = document.getElementById('levelCredits');
            
            if (cycle === 'Licence' || cycle === 'Master') {
                creditsField.value = 60;
            } else if (cycle === 'Doctorat') {
                creditsField.value = 180;
            }
        });

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

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Study levels management page loaded');
        });
    </script>