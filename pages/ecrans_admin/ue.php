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
                                <form id="addUeForm" method="POST" action="../pages/ecrans_admin/traitement_ue_ecue.php" onsubmit="return handleUeSubmit(event)">
                                    <input type="hidden" name="mode_formulaire" value="ajout_ue">

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
                                            <select class="form-select" id="credit_ue" name="credit_ue">
                                                <option value="">--Sélectionnez le crédit--</option>
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="id_ens_responsable" class="form-label">Responsable UE</label>
                                            <select class="form-select" id="id_ens_responsable" name="id_ens_responsable">
                                                <option value="">-- Sélectionnez un enseignant disponible --</option>
                                                <?php
                                                $stmt = $pdo->prepare("
                                                    SELECT e.id_ens, CONCAT(e.prenoms_ens, ' ', e.nom_ens) AS nom_complet
                                                    FROM enseignant e
                                                    WHERE e.id_ens NOT IN (SELECT id_ens FROM ue WHERE id_ens IS NOT NULL)
                                                ");
                                                $stmt->execute();
                                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $ens) {
                                                    echo "<option value=\"{$ens['id_ens']}\">" . htmlspecialchars($ens['nom_complet']) . "</option>";
                                                }
                                                ?>
                                            </select>
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
                                <form id="addEcueForm" method="POST" action="../pages/ecrans_admin/traitement_ue_ecue.php" onsubmit="return handleEcueSubmit(event)">
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
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-plus me-2"></i>Ajouter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addUEModal">
                                    <i class="fas fa-book me-2"></i>Nouvelle UE
                                </a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addECUEModal">
                                    <i class="fas fa-bookmark me-2"></i>Nouvelle ECUE
                                </a></li>
                            </ul>
                        </div>
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum-tab-pane" type="button" role="tab" aria-controls="curriculum-tab-pane" aria-selected="false">
                            <i class="fas fa-sitemap me-2"></i>Structure Curriculaire
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
                                            <option value="L1">Licence 1</option>
                                            <option value="L2">Licence 2</option>
                                            <option value="L3">Licence 3</option>
                                            <option value="M1">Master 1</option>
                                            <option value="M2">Master 2</option>
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
                                    <tr>
                                        <td class="fw-bold">UE001</td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Programmation Orientée Objet</div>
                                                <small class="text-muted">Concepts avancés de la POO</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">6 crédits</span></td>
                                        <td><span class="badge bg-info">Licence 2</span></td>
                                        <td><span class="badge bg-secondary">S3</span></td>
                                        <td>Dr. Diabaté Sekou</td>
                                        <td>
                                            <span class="badge bg-success">3 ECUE</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewUE(1)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editUE(1)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Gérer ECUE" onclick="manageECUE(1)">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteUE(1)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">UE002</td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Base de Données Avancées</div>
                                                <small class="text-muted">Conception et optimisation BD</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">4 crédits</span></td>
                                        <td><span class="badge bg-warning">Master 1</span></td>
                                        <td><span class="badge bg-secondary">S1</span></td>
                                        <td>Prof. Kouamé Akissi</td>
                                        <td>
                                            <span class="badge bg-success">2 ECUE</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewUE(2)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editUE(2)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Gérer ECUE" onclick="manageECUE(2)">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteUE(2)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">UE003</td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Mathématiques Appliquées</div>
                                                <small class="text-muted">Algèbre et analyse pour l'informatique</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">5 crédits</span></td>
                                        <td><span class="badge bg-info">Licence 1</span></td>
                                        <td><span class="badge bg-secondary">S1</span></td>
                                        <td>Dr. Traoré Fatou</td>
                                        <td>
                                            <span class="badge bg-success">4 ECUE</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewUE(3)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editUE(3)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Gérer ECUE" onclick="manageECUE(3)">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteUE(3)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
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
                                            <option value="UE001">UE001 - Programmation Orientée Objet</option>
                                            <option value="UE002">UE002 - Base de Données Avancées</option>
                                            <option value="UE003">UE003 - Mathématiques Appliquées</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="custom-select" id="filterECUECredits" onchange="filterECUE()">
                                            <option value="">Tous les crédits</option>
                                            <option value="1">1 crédit</option>
                                            <option value="2">2 crédits</option>
                                            <option value="3">3 crédits</option>
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
                                        <th>Type</th>
                                        <th>Volume horaire</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">ECUE001</td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Cours POO</div>
                                                <small class="text-muted">Théorie et concepts</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">2 crédits</span></td>
                                        <td><span class="badge bg-primary">UE001</span></td>
                                        <td><span class="badge bg-success">Cours</span></td>
                                        <td>30h</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewECUE(1)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editECUE(1)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteECUE(1)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ECUE002</td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">TP POO</div>
                                                <small class="text-muted">Travaux pratiques</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">2 crédits</span></td>
                                        <td><span class="badge bg-primary">UE001</span></td>
                                        <td><span class="badge bg-warning text-dark">TP</span></td>
                                        <td>45h</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewECUE(2)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editECUE(2)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteECUE(2)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ECUE003</td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">Projet POO</div>
                                                <small class="text-muted">Projet d'application</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">2 crédits</span></td>
                                        <td><span class="badge bg-primary">UE001</span></td>
                                        <td><span class="badge bg-danger">Projet</span></td>
                                        <td>40h</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewECUE(3)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="editECUE(3)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteECUE(3)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Curriculum Tab -->
                    <div class="tab-pane fade" id="curriculum-tab-pane" role="tabpanel" aria-labelledby="curriculum-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6><i class="fas fa-graduation-cap me-2"></i>Structure par Niveau</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="accordion" id="levelAccordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingL1">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL1">
                                                        Licence 1 (30 crédits)
                                                    </button>
                                                </h2>
                                                <div id="collapseL1" class="accordion-collapse collapse show" data-bs-parent="#levelAccordion">
                                                    <div class="accordion-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>Mathématiques Appliquées</span>
                                                                <span class="badge bg-primary">5 crédits</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>Introduction à l'Informatique</span>
                                                                <span class="badge bg-primary">6 crédits</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>Algorithmique</span>
                                                                <span class="badge bg-primary">4 crédits</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingL2">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseL2">
                                                        Licence 2 (30 crédits)
                                                    </button>
                                                </h2>
                                                <div id="collapseL2" class="accordion-collapse collapse" data-bs-parent="#levelAccordion">
                                                    <div class="accordion-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>Programmation Orientée Objet</span>
                                                                <span class="badge bg-primary">6 crédits</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>Structures de Données</span>
                                                                <span class="badge bg-primary">4 crédits</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>Systèmes d'Exploitation</span>
                                                                <span class="badge bg-primary">5 crédits</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6><i class="fas fa-chart-pie me-2"></i>Répartition des Crédits</h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="creditsChart" width="400" height="200"></canvas>
                                        <div class="mt-3">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <h5 class="text-primary">180</h5>
                                                    <small>Licence</small>
                                                </div>
                                                <div class="col-4">
                                                    <h5 class="text-success">120</h5>
                                                    <small>Master</small>
                                                </div>
                                                <div class="col-4">
                                                    <h5 class="text-info">300</h5>
                                                    <small>Total</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add UE Modal -->
    <div class="modal fade" id="addUEModal" tabindex="-1" aria-labelledby="addUEModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUEModalLabel">
                        <i class="fas fa-book me-2"></i>Ajouter une nouvelle UE
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUEForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="ueCode" class="form-label">Code UE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ueCode" name="code_ue" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ueCredits" class="form-label">Crédits <span class="text-danger">*</span></label>
                                <select class="form-select" id="ueCredits" name="credit_UE" required>
                                    <option value="">Choisir...</option>
                                    <option value="3">3 crédits</option>
                                    <option value="4">4 crédits</option>
                                    <option value="5">5 crédits</option>
                                    <option value="6">6 crédits</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="ueTitle" class="form-label">Intitulé UE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ueTitle" name="lib_UE" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ueLevel" class="form-label">Niveau <span class="text-danger">*</span></label>
                                <select class="form-select" id="ueLevel" name="niveau" required>
                                    <option value="">Choisir...</option>
                                    <option value="L1">Licence 1</option>
                                    <option value="L2">Licence 2</option>
                                    <option value="L3">Licence 3</option>
                                    <option value="M1">Master 1</option>
                                    <option value="M2">Master 2</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ueSemester" class="form-label">Semestre <span class="text-danger">*</span></label>
                                <select class="form-select" id="ueSemester" name="semestre" required>
                                    <option value="">Choisir...</option>
                                    <option value="S1">Semestre 1</option>
                                    <option value="S2">Semestre 2</option>
                                    <option value="S3">Semestre 3</option>
                                    <option value="S4">Semestre 4</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="ueResponsible" class="form-label">Responsable UE</label>
                                <select class="form-select" id="ueResponsible" name="id_responsable">
                                    <option value="">Choisir...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="ueDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="ueDescription" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="saveUE()">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add ECUE Modal -->
    <div class="modal fade" id="addECUEModal" tabindex="-1" aria-labelledby="addECUEModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addECUEModalLabel">
                        <i class="fas fa-bookmark me-2"></i>Ajouter une nouvelle ECUE
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addECUEForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="ecueCode" class="form-label">Code ECUE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ecueCode" name="code_ecue" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ecueCredits" class="form-label">Crédits <span class="text-danger">*</span></label>
                                <select class="form-select" id="ecueCredits" name="credit_ECUE" required>
                                    <option value="">Choisir...</option>
                                    <option value="1">1 crédit</option>
                                    <option value="2">2 crédits</option>
                                    <option value="3">3 crédits</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="ecueTitle" class="form-label">Intitulé ECUE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ecueTitle" name="lib_ECUE" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ecueParentUE" class="form-label">UE Parente <span class="text-danger">*</span></label>
                                <select class="form-select" id="ecueParentUE" name="id_UE" required>
                                    <option value="">Choisir...</option>
                                    <option value="1">UE001 - Programmation Orientée Objet</option>
                                    <option value="2">UE002 - Base de Données Avancées</option>
                                    <option value="3">UE003 - Mathématiques Appliquées</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ecueType" class="form-label">Type d'enseignement <span class="text-danger">*</span></label>
                                <select class="form-select" id="ecueType" name="type_enseignement" required>
                                    <option value="">Choisir...</option>
                                    <option value="Cours">Cours</option>
                                    <option value="TD">Travaux Dirigés</option>
                                    <option value="TP">Travaux Pratiques</option>
                                    <option value="Projet">Projet</option>
                                    <option value="Stage">Stage</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ecueHours" class="form-label">Volume horaire</label>
                                <input type="number" class="form-control" id="ecueHours" name="volume_horaire" placeholder="Heures">
                            </div>
                            <div class="col-md-6">
                                <label for="ecueTeacher" class="form-label">Enseignant responsable</label>
                                <select class="form-select" id="ecueTeacher" name="id_enseignant">
                                    <option value="">Choisir...</option>
                                    <option value="1">Dr. Diabaté Sekou</option>
                                    <option value="2">Prof. Kouamé Akissi</option>
                                    <option value="3">Dr. Traoré Fatou</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="ecueDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="ecueDescription" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="saveECUE()">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
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

        // UE management functions
        function viewUE(id) {
            console.log('Viewing UE:', id);
            // Implement view UE details
        }

        function editUE(id) {
            console.log('Editing UE:', id);
            // Implement edit UE
        }

        function deleteUE(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette UE ? Toutes les ECUE associées seront également supprimées.')) {
                console.log('Deleting UE:', id);
                // Implement delete UE
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
            console.log('Viewing ECUE:', id);
            // Implement view ECUE details
        }

        function editECUE(id) {
            console.log('Editing ECUE:', id);
            // Implement edit ECUE
        }

        function deleteECUE(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette ECUE ?')) {
                console.log('Deleting ECUE:', id);
                // Implement delete ECUE
            }
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
