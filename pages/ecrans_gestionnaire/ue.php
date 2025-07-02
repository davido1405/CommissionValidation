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

?>
        <div class="content-area">
            <!-- Main Content Card -->
            <div class="dashboard-card">
                <!-- Formulaire ajout d'une UE -->
                <div class="addUeForm">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Ajouter une UE
                                </h5>
                            </div>
                            <div class="modal-body">
                                <form id="addUeForm" method="POST" action="../pages/ecrans_gestionnaire/traitement_ue_ecue.php" onsubmit="return handleUeSubmit(event)">
                                    <input type="hidden" name="mode_formulaire" id="mode_formulaire" value="ajout_ue">
                                    <input type="hidden" name="id_ue" id="id_ue" value="">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="code_ue" class="form-label">Code UE <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="code_ue" name="code_ue" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lib_ue" class="form-label">Libellé UE <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lib_ue" name="lib_ue" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="credit_ue" class="form-label">Crédit UE</label>
                                            <select class="form-select" id="credit_ue" name="credit_ue" required>
                                                <option value="">--Sélectionnez le crédit--</option>
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="id_niv_etu" class="form-label">NIVEAU</label>
                                            <select class="form-select" id="id_niv_etu" name="id_niv_etu" required>
                                                <option value="">--Sélectionnez le niveau--</option>
                                                <?php
                                                    $niveau = $pdo->query("SELECT id_niv_etu, lib_niv_etu FROM niveau_etude");
                                                    while ($row = $niveau->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value=\"{$row['id_niv_etu']}\">" . htmlspecialchars($row['lib_niv_etu']) . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="id_ens_responsable" class="form-label">Responsable UE</label>
                                            <select class="form-select" id="id_ens_responsable" name="id_ens_responsable" required>
                                                <option value="">-- Sélectionnez un enseignant disponible --</option>
                                                <?php
                                                    // Si une UE est en cours d'édition, inclure son responsable
                                                    $idUEEnCours = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                                                    $stmt = $pdo->prepare("
                                                        SELECT e.id_ens, CONCAT(e.prenoms_ens, ' ', e.nom_ens) AS nom_complet
                                                        FROM enseignant e
                                                        WHERE e.id_ens NOT IN (
                                                            SELECT id_ens FROM ue WHERE id_ens IS NOT NULL AND id_ue != :id_ue
                                                        ) OR e.id_ens = (
                                                            SELECT id_ens FROM ue WHERE id_ue = :id_ue
                                                        )
                                                    ");
                                                    $stmt->execute(['id_ue' => $idUEEnCours]);
                                                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $ens) {
                                                        echo "<option value=\"{$ens['id_ens']}\">" . htmlspecialchars($ens['nom_complet']) . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="semestre" class="form-label">Semestre</label>
                                            <input type="text" class="form-control" id="semestre" name="semestre" placeholder="Ex: S1" required>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary mt-3">
                                            <i class="fas fa-save me-2"></i>Ajouter l'UE
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire ajout d'une ECUE -->
                <div class="addEcueForm">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fas fa-book-open me-2"></i>Ajouter une ECUE
                                </h5>
                            </div>
                            <div class="modal-body">
                                <form id="addEcueForm" method="POST" action="../pages/ecrans_gestionnaire/traitement_ue_ecue.php" onsubmit="return handleEcueSubmit(event)">
                                    <input type="hidden" name="mode_formulaire" value="ajout_ecue">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="id_ue" class="form-label">UE</label>
                                            <select class="form-select" id="id_ue" name="id_ue" required>
                                                <option value="">Sélectionner une UE</option>
                                                <?php
                                                $ue = $pdo->query("SELECT id_ue, lib_ue FROM ue");
                                                while ($row = $ue->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['id_ue']}\">" . htmlspecialchars($row['lib_ue']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="code_ecue" class="form-label">Code ECUE <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="code_ecue" name="code_ecue" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lib_ecue" class="form-label">Libellé ECUE <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lib_ecue" name="lib_ecue" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="credit_ecue" class="form-label">Crédit ECUE</label>
                                            <select class="form-select" id="credit_ecue" name="credit_ecue">
                                                <option value="">--Sélectionnez le crédit--</option>
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="semestre" class="form-label">Semestre <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="semestre" name="semestre" required placeholder="Ex: S1">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="annee_aca" class="form-label">Année académique <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="annee_aca" name="annee_aca" required placeholder="Ex: 2024-2025">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="spe_ens" class="form-label">Spécialité <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="spe_ens" name="spe_ens" required placeholder="Ex: Mathématique, Informatique...">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary mt-3">
                                            <i class="fas fa-save me-2"></i>Ajouter l'ECUE
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-graduation-cap me-2"></i>Unités d'Enseignement et ECUE</h5>
                        <p class="text-muted mb-0">Gérer le programme académique et les contenus pédagogiques</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" onclick="exportCurriculum()">
                            <i class="fas fa-file-export me-2"></i>Exporter Programme
                        </button>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="courseManagementTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ue-tab" data-bs-toggle="tab" data-bs-target="#ue-tab-pane" type="button" role="tab" aria-controls="ue-tab-pane" aria-selected="true">
                            <i class="fas fa-book me-2"></i>Unités d'Enseignement (UE)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ecue-tab" data-bs-toggle="tab" data-bs-target="#ecue-tab-pane" type="button" role="tab" aria-controls="ecue-tab-pane" aria-selected="false">
                            <i class="fas fa-bookmark me-2"></i>Éléments Constitutifs (ECUE)
                        </button>
                    </li>
                </ul>

                <div class="tab-content p-3" id="courseManagementTabsContent">
                    <!-- UE Tab -->
                    <div class="tab-pane fade show active" id="ue-tab-pane" role="tabpanel" aria-labelledby="ue-tab" tabindex="0">
                        <!-- UE Filters -->
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-4">
                                <div class="search-box">
                                    <i class="fas fa-search text-muted"></i>
                                    <input type="text" id="searchUE" placeholder="Rechercher une UE..." onkeyup="filterUE()">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <select class="custom-select" id="filterLevel" onchange="filterUE()">
                                            <option value="">Tous les niveaux</option>
                                            <?php
                                                $niveau = $pdo->query("SELECT id_niv_etu, lib_niv_etu FROM niveau_etude");
                                                while ($row = $niveau->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['id_niv_etu']}\">" . htmlspecialchars($row['lib_niv_etu']) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="custom-select" id="filterCredits" onchange="filterUE()">
                                            <option value="">Tous les crédits</option>
                                            <option value="3">3 crédits</option>
                                            <option value="4">4 crédits</option>
                                            <option value="5">5 crédits</option>
                                            <option value="6">6 crédits</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="custom-select" id="filterSemester" onchange="filterUE()">
                                            <option value="">Tous les semestres</option>
                                            <option value="S1">Semestre 1</option>
                                            <option value="S2">Semestre 2</option>
                                            <option value="S3">Semestre 3</option>
                                            <option value="S4">Semestre 4</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-outline-secondary w-100" onclick="resetUEFilters()">
                                            <i class="fas fa-undo me-1"></i>Réinitialiser
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- UE Table -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="ueTable">
                                <thead>
                                    <tr>
                                        <th>Code UE</th>
                                        <th>Intitulé</th>
                                        <th>Crédits</th>
                                        <th>Niveau</th>
                                        <th>Semestre</th>
                                        <th>Responsable</th>
                                        <th>ECUE</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $pdo->prepare("
                                        SELECT 
                                            ue.id_ue,
                                            ue.code_ue,
                                            ue.lib_ue,
                                            ue.credit_ue,
                                            ue.id_ens,
                                            ue.id_niv_etu,
                                            ue.semestre,
                                            CONCAT(e.prenoms_ens, ' ', e.nom_ens) AS responsable,
                                            n.lib_niv_etu,              -- Ajout ici pour récupérer le libellé du niveau
                                            COUNT(ec.id_ecue) AS nb_ecue
                                        FROM ue
                                        LEFT JOIN enseignant e ON ue.id_ens = e.id_ens
                                        LEFT JOIN ecue ec ON ue.id_ue = ec.id_ue
                                        LEFT JOIN niveau_etude n ON ue.id_niv_etu = n.id_niv_etu
                                        GROUP BY ue.id_ue
                                        ORDER BY ue.id_ue ASC
                                    ");
                                    $stmt->execute();
                                    $ues = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($ues as $ue):
                                    ?>
                                    <tr>
                                        <td class="fw-bold"><?= htmlspecialchars($ue['code_ue']) ?></td>
                                        <td>
                                            <div>
                                                <div class="fw-bold"><?= htmlspecialchars($ue['lib_ue']) ?></div>
                                                <small class="text-muted">Description optionnelle ici</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary"><?= (int)$ue['credit_ue'] ?> crédits</span></td>
                                        <td><span class="badge bg-info"><?= $ue['lib_niv_etu'] ?? 'N/A' ?></span></td> <!-- Si tu as une colonne ou jointure niveau -->
                                        <td><span class="badge bg-secondary"><?= htmlspecialchars($ue['semestre'] ?? 'N/A') ?></span></td>
                                        <td><?= htmlspecialchars($ue['responsable'] ?? 'Non assigné') ?></td>
                                        <td>
                                            <span class="badge bg-success"><?= (int)$ue['nb_ecue'] ?> ECUE</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewUE(<?= $ue['id_ue'] ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editUE(<?= $ue['id_ue'] ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteUE(<?= $ue['id_ue'] ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- ECUE Tab -->
                    <div class="tab-pane fade" id="ecue-tab-pane" role="tabpanel" aria-labelledby="ecue-tab" tabindex="0">
                        <!-- ECUE Filters -->
                        <div class="row mb-4 align-items-center">
                            <div class="col-md-4">
                                <div class="search-box">
                                    <i class="fas fa-search text-muted"></i>
                                    <input type="text" id="searchECUE" placeholder="Rechercher une ECUE..." onkeyup="filterECUE()">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select class="custom-select" id="filterUEParent" onchange="filterECUE()">
                                            <option value="">Toutes les UE</option>
                                            <?php
                                                $ue = $pdo->query("SELECT * FROM ue");
                                                while ($row = $ue->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['code_ue']}\">" . htmlspecialchars($row['lib_ue']) . "</option>";
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" id="filterECUECredits" onchange="filterECUE()">
                                            <option value="">Tous les crédits</option>
                                            <?php
                                                $credit = $pdo->query("SELECT * FROM ue");
                                                while ($row = $credit->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['credit_ue']}\"> Credit " . htmlspecialchars($row['credit_ue']) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-outline-secondary w-100" onclick="resetECUEFilters()">
                                            <i class="fas fa-undo me-1"></i>Réinitialiser
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ECUE Table -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="ecueTable">
                                <thead>
                                    <tr>
                                        <th>Code ECUE</th>
                                        <th>Intitulé</th>
                                        <th>Crédits</th>
                                        <th>UE Parente</th>
                                        <th>Semestre</th>
                                        <th>Enseignant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $pdo->prepare("
                                            SELECT 
                                                ec.id_ecue,
                                                ec.code_ecue,
                                                ec.lib_ecue,
                                                ec.id_ac,

                                                ue.id_ue,
                                                ue.code_ue,
                                                ue.lib_ue,
                                                ue.credit_ue,
                                                ue.semestre AS semestre_ue,
                                                ue.id_niv_etu,

                                                CONCAT(e.prenoms_ens, ' ', e.nom_ens) AS enseignant,
                                                n.lib_niv_etu

                                            FROM ecue ec
                                            LEFT JOIN ue ON ec.id_ue = ue.id_ue
                                            LEFT JOIN niveau_etude n ON ue.id_niv_etu = n.id_niv_etu
                                            LEFT JOIN enseigner_ecue ee ON ec.id_ecue = ee.id_ecue
                                            LEFT JOIN enseignant e ON ee.id_ens = e.id_ens
                                            ORDER BY ec.id_ecue ASC, ee.date_affectation DESC
                                        ");
                                        $stmt->execute();
                                        $ecues = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                    ?>
                                    <?php
                                        // Regrouper les ECUEs par ID pour éviter les doublons si plusieurs enseignants
                                        $groupedEcues = [];
                                        foreach ($ecues as $row) {
                                            $id = $row['id_ecue'];
                                            if (!isset($groupedEcues[$id])) {
                                                $groupedEcues[$id] = $row;
                                                $groupedEcues[$id]['enseignants'] = [];
                                            }
                                            if (!empty($row['enseignant'])) {
                                                $groupedEcues[$id]['enseignants'][] = $row['enseignant'];
                                            }
                                        }

                                        foreach ($groupedEcues as $ecue):
                                        ?>
                                        <tr>
                                            <td class="fw-bold"><?= htmlspecialchars($ecue['code_ecue'] ?? '') ?></td>
                                            <td>
                                                <div>
                                                    <div class="fw-bold"><?= htmlspecialchars($ecue['lib_ecue'] ?? '') ?></div>
                                                    <small class="text-muted">
                                                        <?= htmlspecialchars($ecue['lib_ue'] ?? '') ?> – <?= htmlspecialchars($ecue['lib_niv_etu'] ?? '') ?>
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?= htmlspecialchars($ecue['credit_ue'] ?? '0') ?> crédits
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?= htmlspecialchars($ecue['code_ue'] ?? '') ?></span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    Semestre <?= htmlspecialchars($ecue['semestre_ue'] ?? '-') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($ecue['enseignants'])) {
                                                    echo implode(', ', array_map('htmlspecialchars', $ecue['enseignants']));
                                                } else {
                                                    echo '<span class="text-muted">Non assigné</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewECUE(<?= (int)$ecue['id_ecue'] ?>)">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editECUE(<?= (int)$ecue['id_ecue'] ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteECUE(<?= (int)$ecue['id_ecue'] ?>)">
                                                        <i class="fas fa-trash"></i>
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
        </div>
    </div>

    <!-- Modal Détails UE -->
    <div class="modal fade" id="viewUEModal" tabindex="-1" aria-labelledby="viewUEModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUEModalLabel">Détails de l'UE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body" id="ueDetailContent">
                    <!-- Contenu dynamique injecté ici -->
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ MODAL DE VISUALISATION ECUE -->
    <div class="modal fade" id="viewECUEModal" tabindex="-1" aria-labelledby="viewECUEModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewECUEModalLabel">Détails de l'ECUE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body" id="ecueDetailContent">
                    <!-- Le contenu sera injecté dynamiquement -->
                </div>
            </div>
        </div>
    </div>

    <!-- Toast de notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="toastNotification" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">Action réussie.</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functions for UE
        function filterUE() {
            const searchTerm = document.getElementById('searchUE').value.toLowerCase();
            const levelFilter = document.getElementById('filterLevel').value;
            const creditsFilter = document.getElementById('filterCredits').value;
            const semesterFilter = document.getElementById('filterSemester').value;
            
            const rows = document.querySelectorAll('#ueTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesLevel = !levelFilter || text.includes(levelFilter.toLowerCase());
                const matchesCredits = !creditsFilter || text.includes(`${creditsFilter} crédits`);
                const matchesSemester = !semesterFilter || text.includes(semesterFilter.toLowerCase());
                
                row.style.display = (matchesSearch && matchesLevel && matchesCredits && matchesSemester) ? '' : 'none';
            });
        }

        function resetUEFilters() {
            document.getElementById('searchUE').value = '';
            document.getElementById('filterLevel').value = '';
            document.getElementById('filterCredits').value = '';
            document.getElementById('filterSemester').value = '';
            filterUE();
        }

        // Filter functions for ECUE
        function filterECUE() {
            const searchTerm = document.getElementById('searchECUE').value.toLowerCase();
            const ueFilter = document.getElementById('filterUEParent').value;
            const creditsFilter = document.getElementById('filterECUECredits').value;
            
            const rows = document.querySelectorAll('#ecueTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesUE = !ueFilter || text.includes(ueFilter.toLowerCase());
                const matchesCredits = !creditsFilter || text.includes(`${creditsFilter} crédit`);
                
                row.style.display = (matchesSearch && matchesUE && matchesCredits) ? '' : 'none';
            });
        }

        function resetECUEFilters() {
            document.getElementById('searchECUE').value = '';
            document.getElementById('filterUEParent').value = '';
            document.getElementById('filterECUECredits').value = '';
            filterECUE();
        }

        function viewUE(id) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../pages/ecrans_gestionnaire/voir_ue.php?id=" + id, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById("ueDetailContent").innerHTML = xhr.responseText;
                    new bootstrap.Modal(document.getElementById("viewUEModal")).show();
                } else {
                    alert("Erreur lors du chargement des données.");
                }
            };
            xhr.onerror = function () {
                alert("Erreur réseau.");
            };
            xhr.send();
        }





        function editUE(id) {
            fetch(`../pages/ecrans_gestionnaire/voir_ue.php?id=${id}&json=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const ue = data.ue;

                        document.getElementById("mode_formulaire").value = "modification_ue";
                        document.getElementById("id_ue").value = ue.id_ue;
                        document.getElementById("code_ue").value = ue.code_ue;
                        document.getElementById("lib_ue").value = ue.lib_ue;
                        document.getElementById("credit_ue").value = ue.credit_ue;
                        document.getElementById("semestre").value = ue.semestre;
                        document.getElementById("id_niv_etu").value = ue.id_niv_etu;

                        // ✅ Sélection du responsable
                        if (ue.id_ens) {
                            document.getElementById("id_ens_responsable").value = ue.id_ens;
                        }

                        console.log("Responsable ID UE:", ue.id_ens);

                        document.getElementById("addUeForm").scrollIntoView({ behavior: "smooth" });

                    } else {
                        alert("Erreur : " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur :", error);
                    alert("Une erreur s'est produite.");
                });
    }




        function deleteUE(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette UE ? Toutes les ECUE associées seront également supprimées.')) {
                fetch(`../pages/ecrans_gestionnaire/supprimer_UE_ECUE.php?id=${id}`, { method: 'GET' })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status === 'success' ? 'success' : 'error');
                        if (data.status === 'success') {
                            setTimeout(() => location.reload(), 1200);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        showToast("Une erreur s'est produite.", 'error');
                    });
            }
        }


        function manageECUE(id) {
            console.log('Managing ECUE for UE:', id);
            // Switch to ECUE tab and filter by UE
            document.getElementById('ecue-tab').click();
            document.getElementById('filterUEParent').value = `UE00${id}`;
            filterECUE();
        }

        function saveUE() {
            const form = document.getElementById('addUEForm');
            if (form.checkValidity()) {
                console.log('Saving UE...');
                // Implement save UE logic
                bootstrap.Modal.getInstance(document.getElementById('addUEModal')).hide();
            } else {
                form.reportValidity();
            }
        }

        // ECUE management functions

        function viewECUE(id) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../pages/ecrans_gestionnaire/voir_ecue.php?id=" + id, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById("ecueDetailContent").innerHTML = xhr.responseText;
                    new bootstrap.Modal(document.getElementById("viewECUEModal")).show();
                } else {
                    alert("Erreur lors du chargement des données.");
                }
            };
            xhr.onerror = function () {
                alert("Erreur réseau.");
            };
            xhr.send();
        }

        function editECUE(id) {
            fetch(`../pages/ecrans_gestionnaire/voir_ecue.php?id=${id}&json=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const ecue = data.ecue;

                        document.querySelector("#addEcueForm input[name='mode_formulaire']").value = "modification_ecue";
                        document.querySelector("#addEcueForm input[name='id_ecue']")?.remove();
                        
                        const hidden = document.createElement("input");
                        hidden.type = "hidden";
                        hidden.name = "id_ecue";
                        hidden.id = "id_ecue";
                        hidden.value = ecue.id_ecue;
                        document.getElementById("addEcueForm").prepend(hidden);

                        document.getElementById("id_ue").value = ecue.id_ue;
                        document.getElementById("code_ecue").value = ecue.code_ecue;
                        document.getElementById("lib_ecue").value = ecue.lib_ecue;
                        document.getElementById("credit_ecue").value = ecue.credit_ecue ?? "";
                        document.getElementById("semestre").value = ecue.semestre ?? "";
                        document.getElementById("annee_aca").value = ecue.annee_aca ?? "";
                        document.getElementById("spe_ens").value = ecue.specialite ?? "";

                        document.getElementById("addEcueForm").scrollIntoView({ behavior: "smooth" });

                    } else {
                        alert("Erreur : " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur :", error);
                    alert("Une erreur s'est produite.");
                });
        }

        function deleteECUE(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette ECUE ?')) {
                fetch(`../pages/ecrans_gestionnaire/supprimer_ecue.php?id=${id}`, { method: 'GET' })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status === 'success' ? 'success' : 'error');
                        if (data.status === 'success') {
                            setTimeout(() => location.reload(), 1200);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        showToast("Une erreur s'est produite.", 'error');
                    });
            }
        }

        //Gérer notif
        function showToast(message, type = 'success') {
            const toastEl = document.getElementById('toastNotification');
            const toastBody = document.getElementById('toastMessage');

            toastBody.innerText = message;

            // Appliquer les couleurs en fonction du type
            toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
            if (type === 'error') {
                toastEl.classList.add('bg-danger');
            } else if (type === 'warning') {
                toastEl.classList.add('bg-warning');
            } else {
                toastEl.classList.add('bg-success');
            }

            const bsToast = new bootstrap.Toast(toastEl);
            bsToast.show();
        }


        function saveECUE() {
            const form = document.getElementById('addECUEForm');
            if (form.checkValidity()) {
                console.log('Saving ECUE...');
                // Implement save ECUE logic
                bootstrap.Modal.getInstance(document.getElementById('addECUEModal')).hide();
            } else {
                form.reportValidity();
            }
        }

        function handleUeSubmit(event) {
            event.preventDefault();

            const form = document.getElementById('addUeForm');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                showToast(data.message, data.status === 'success' ? 'success' : 'error');
                if (data.status === 'success') {
                    setTimeout(() => location.reload(), 1200);
                }
            })
            .catch(err => {
                console.error(err);
                showToast("Erreur lors de l'envoi du formulaire.", 'error');
            });

            return false;
        }

        function handleEcueSubmit(event) {
            event.preventDefault();

            const form = document.getElementById('addEcueForm');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                showToast(data.message, data.status === 'success' ? 'success' : 'error');
                if (data.status === 'success') {
                    setTimeout(() => location.reload(), 1200);
                }
            })
            .catch(err => {
                console.error(err);
                showToast("Erreur lors de l'envoi du formulaire.", 'error');
            });

            return false;
        }


        function exportCurriculum() {
            console.log('Exporting curriculum...');
            // Implement export functionality
        }

        // Update ECUE credits when UE changes
        document.getElementById('ecueParentUE').addEventListener('change', function() {
            const selectedUE = this.value;
            // You could load available credits based on parent UE
            console.log('Parent UE changed to:', selectedUE);
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize any charts or additional functionality
            console.log('UE/ECUE management page loaded');
        });
    </script>
