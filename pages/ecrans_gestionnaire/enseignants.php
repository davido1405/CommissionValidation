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

//Gérer la pagination
$parPage = 10; // nombre d’étudiants par page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $parPage;

$stmt = $pdo->prepare("
    SELECT DISTINCT e.id_ens, e.nom_ens, e.prenoms_ens, e.login_ens,e.statut_ens
    FROM enseignant e
    ORDER BY e.id_ens DESC
    LIMIT :offset, :parpage
");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$stmt->execute();

// ✅ Ne pas oublier ça !
$ensiegnants = $stmt->fetchAll(PDO::FETCH_ASSOC);


    //$stmt->bindValue(':id_ens', $id_ens, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':parpage', $parPage, PDO::PARAM_INT);
    $stmt->execute();
    $ensiegnants=$stmt->fetchall(PDO::FETCH_ASSOC);                   


    // Total des étudiants
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM enseignant");
    $totalEnseignants = $totalStmt->fetchColumn();
    $totalPages = ceil($totalEnseignants / $parPage);

    // Générer un login unique (ex: etu168493@example.com)
    $prefix = "defaultP";
    $randomNumber = rand(1000, 9999);
    $loginAuto = $prefix . $randomNumber . '@prof-uni.ci';

    // Générer un mot de passe aléatoire simple (ex: Ab12XZ)
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $mdpAuto = substr(str_shuffle($chars), 0, 8);

?>
        <div class="content-area">
            
            <!-- Main Content Card -->
            <div class="dashboard-card">

                <?php if (!empty($_SESSION['flash_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['flash_message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>

                <div class="addTeacherForm">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="modal-title" id="addTeacherModalLabel">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    <span id="formTitle">Ajouter un nouvel enseignant</span>
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <form id="addTeacherForm" method="POST" action="../pages/ecrans_gestionnaire/traitement_enseignant.php" onsubmit="return handleTeacherSubmit(event)">
                                    <input type="hidden" id="mode_formulaire" name="mode_formulaire" value="ajout">
                                    <input type="hidden" id="id_ens" name="id_ens" value="">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nom_ens" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nom_ens" name="nom_ens" required placeholder="Nom de l'enseignant">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="prenom_ens" class="form-label">Prénom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenom_ens" name="prenom_ens" required placeholder="Prenoms de l'enseignant">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="login_ens" class="form-label">Login <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="login_ens" name="login_ens" required value="<?= $loginAuto ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mdp_ens" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mdp_ens" name="mdp_ens" required value="<?= $mdpAuto ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="statut_ens" class="form-label">Statut</label>
                                            <select class="form-select" id="statut_ens" name="statut_ens">
                                                <option value="Actif">Actif</option>
                                                <option value="Inactif">Inactif</option>
                                                <option value="Suspendu">Suspendu</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="id_grade" class="form-label">Grade</label>
                                            <select class="form-select" id="id_grade" name="id_grade">
                                                <option value="">Sélectionner un grade</option>
                                                <?php
                                                $grades = $pdo->query("SELECT id_grade, nom_grade FROM grade");
                                                while ($row = $grades->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['id_grade']}\">" . htmlspecialchars($row['nom_grade']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="id_fonct" class="form-label">Fonction</label>
                                            <select class="form-select" id="id_fonct" name="id_fonct">
                                                <option value="">Sélectionner une fonction</option>
                                                <?php
                                                $fonctions = $pdo->query("SELECT id_fonct, nom_fonct FROM fonction");
                                                while ($row = $fonctions->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['id_fonct']}\">" . htmlspecialchars($row['nom_fonct']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="spe_ens" class="form-label">Spécialité<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="spe_ens" name="spe_ens" required placeholder="Précisez la spécialité de l'enseignant">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Ajouter l'enseignant
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-users-cog me-2"></i>Corps Enseignant</h5>
                        <p class="text-muted mb-0">Gérer les enseignants, leurs grades et fonctions</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="fas fa-file-import me-2"></i>Importer
                        </button>
                        <button class="btn btn-success" onclick="exportToExcel()">
                            <i class="fas fa-file-excel me-2"></i>Exporter
                        </button>
                    </div>
                </div>

                <!-- Filters Row -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-4">
                        <div class="search-box">
                            <i class="fas fa-search text-muted"></i>
                            <input type="text" id="searchTeacher" placeholder="Rechercher un enseignant..." onkeyup="filterTeachers()">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select class="custom-select" id="filterGrade" onchange="filterTeachers()">
                                    <option value="">Tous les grades</option>
                                    <?php
                                        $grades = $pdo->query("SELECT id_grade, nom_grade FROM grade");
                                                while ($row = $grades->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['id_grade']}\">" . htmlspecialchars($row['nom_grade']) . "</option>";
                                                }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterFunction" onchange="filterTeachers()">
                                    <option value="">Toutes les fonctions</option>
                                    <?php
                                                $fonctions = $pdo->query("SELECT id_fonct, nom_fonct FROM fonction");
                                                while ($row = $fonctions->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"{$row['id_fonct']}\">" . htmlspecialchars($row['nom_fonct']) . "</option>";
                                                }
                                                ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterStatus" onchange="filterTeachers()">
                                    <option value="">Tous les statuts</option>
                                    <option value="Actif">Actif</option>
                                    <option value="En congé">En congé</option>
                                    <option value="Retraité">Retraité</option>
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

                <!-- Teachers Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="teachersTable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th>ID</th>
                                <th>Nom complet</th>
                                <th>Login</th>
                                <th>Grade</th>
                                <th>Fonction</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="teachersTableBody">
                            <?php
                                // Chargement des données associées
                                $specialites = $pdo->query("
                                    SELECT e.id_ens, s.lib_spe 
                                    FROM enseigner e 
                                    JOIN specialite s ON e.id_spe = s.id_spe
                                ")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);

                                $grades = $pdo->query("
                                    SELECT a.id_ens, g.nom_grade 
                                    FROM avoir a 
                                    JOIN grade g ON a.id_grade = g.id_grade
                                ")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);

                                $fonctions = $pdo->query("
                                    SELECT o.id_ens, f.nom_fonct 
                                    FROM occuper o 
                                    JOIN fonction f ON o.id_fonct = f.id_fonct
                                ")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);
                            ?>

                            <?php foreach($ensiegnants as $ensiegnant): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input teacher-checkbox" value="<?= $ensiegnant['id_ens'] ?>">
                                    </td>
                                    <td class="fw-bold">#ENS<?= str_pad($ensiegnant['id_ens'], 3, '0', STR_PAD_LEFT) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2 bg-success text-white">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">Prof. <?= htmlspecialchars($ensiegnant['prenoms_ens'] . ' ' . $ensiegnant['nom_ens']) ?></div>
                                                <small class="text-muted">
                                                    <?= !empty($specialites[$ensiegnant['id_ens']]) ? htmlspecialchars(implode(', ', $specialites[$ensiegnant['id_ens']])) : 'Aucune spécialité' ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($ensiegnant['login_ens']) ?></td>
                                    <td><span class="badge bg-info">
                                        <small class="text-muted">
                                            <?= !empty($grades[$ensiegnant['id_ens']]) ? htmlspecialchars(implode(', ', $grades[$ensiegnant['id_ens']])) : 'Aucun grade' ?>
                                        </small>
                                    </span></td>
                                    <td><span class="badge bg-secondary">
                                        <small class="text-muted">
                                            <?= !empty($fonctions[$ensiegnant['id_ens']]) ? htmlspecialchars(implode(', ', $fonctions[$ensiegnant['id_ens']])) : 'Aucune fonction' ?>
                                        </small>
                                    </span></td>
                                    <td><span class="badge 
                                            <?= 
                                                $ensiegnant['statut_ens'] === 'Actif' ? 'bg-success' : 
                                                ($ensiegnant['statut_ens'] === 'Inactif' ? 'bg-warning text-dark' : 'bg-danger') 
                                            ?>">
                                            <small class="text-white">
                                                <?= htmlspecialchars($ensiegnant['statut_ens']) ?>
                                            </small>
                                        </span>
                                    </td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" title="Voir" onclick="viewTeacher(<?= $ensiegnant['id_ens'] ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" title="Modifier" onclick="loadTeacherToForm(<?= $ensiegnant['id_ens'] ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Suspendre" onclick="suspendTeacher(<?= $ensiegnant['id_ens'] ?>)">
                                                <i class="fas fa-user-times"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" title="Réactiver" onclick="reactivateTeacher(<?= $ensiegnant['id_ens'] ?>)">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>


                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Navigation des pages">
                    <ul class="pagination justify-content-center">

                        <!-- Lien "Précédent" -->
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1">Précédent</a>
                        </li>

                        <!-- Liens des pages -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Lien "Suivant" -->
                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">Suivant</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>

    <!-- View Teacher Modal -->
    <div class="modal fade" id="viewTeacherModal" tabindex="-1" aria-labelledby="viewTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewTeacherModalLabel">
                        <i class="fas fa-user me-2"></i>Détails de l'enseignant
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body" id="teacherDetailsContent">
                    <!-- Contenu injecté dynamiquement ici -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Grade/Function Management Modal -->
    <div class="modal fade" id="gradeFunctionModal" tabindex="-1" aria-labelledby="gradeFunctionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gradeFunctionModalLabel">
                        <i class="fas fa-award me-2"></i>Gérer Grade et Fonction
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="gradeFunctionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="grade-tab" data-bs-toggle="tab" data-bs-target="#grade-tab-pane" type="button" role="tab">
                                <i class="fas fa-graduation-cap me-2"></i>Grades
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="function-tab" data-bs-toggle="tab" data-bs-target="#function-tab-pane" type="button" role="tab">
                                <i class="fas fa-briefcase me-2"></i>Fonctions
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-3" id="gradeFunctionTabsContent">
                        <div class="tab-pane fade show active" id="grade-tab-pane" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>Historique des grades</h6>
                                <button class="btn btn-sm btn-primary" onclick="addGrade()">
                                    <i class="fas fa-plus me-1"></i>Nouveau grade
                                </button>
                            </div>
                            <div id="gradeHistory">
                                <!-- Grade history will be loaded here -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="function-tab-pane" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>Historique des fonctions</h6>
                                <button class="btn btn-sm btn-primary" onclick="addFunction()">
                                    <i class="fas fa-plus me-1"></i>Nouvelle fonction
                                </button>
                            </div>
                            <div id="functionHistory">
                                <!-- Function history will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal message d'erreur-->
    <!-- Modal de message -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="messageModalContent">
                <!-- Le message s'affichera ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Bootstrap pour saisir la raison de suspension -->
    <div class="modal fade" id="raisonSuspensionModal" tabindex="-1" aria-labelledby="raisonSuspensionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="raisonSuspensionForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="raisonSuspensionLabel">Raison de la suspension</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idEnsInput" name="id_ens" />
                <div class="mb-3">
                <label for="raisonInput" class="form-label">Raison</label>
                <textarea id="raisonInput" name="raison" class="form-control" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Suspendre</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const raisonModal = new bootstrap.Modal(document.getElementById('raisonSuspensionModal'));

        window.suspendTeacher = function(id_ens) {
            console.log("Appel suspendTeacher id_ens =", id_ens);
            document.getElementById('idEnsInput').value = id_ens;
            document.getElementById('raisonInput').value = '';
            raisonModal.show();
        };

        document.getElementById('raisonSuspensionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const raison = document.getElementById('raisonInput').value.trim();
            const id_ens = document.getElementById('idEnsInput').value;

            if (!raison) {
            alert("La raison de la suspension ne peut pas être vide.");
            return;
            }

            fetch('../pages/ecrans_gestionnaire/suspension_activer_enseignant.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id_ens=${encodeURIComponent(id_ens)}&action=suspendre&raison=${encodeURIComponent(raison)}`
            })
            .then(response => {
            if (!response.ok) throw new Error(`Erreur réseau (status ${response.status})`);
            return response.json();
            })
            .then(data => {
            alert(data.message || "Réponse reçue");
            if (data.status === 'success') {
                raisonModal.hide();
                location.reload();
            }
            })
            .catch(error => {
            alert("Erreur lors de la suspension. Voir console pour détails.");
            console.error("Erreur suspendTeacher:", error);
            });
        });

        window.reactivateTeacher = function(id_ens) {
            if (!confirm("Confirmez-vous la réactivation de cet enseignant ?")) return;

            fetch('../pages/ecrans_gestionnaire/suspension_activer_enseignant.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id_ens=${encodeURIComponent(id_ens)}&action=reactiver`
            })
            .then(response => {
            if (!response.ok) throw new Error(`Erreur réseau (status ${response.status})`);
            return response.json();
            })
            .then(data => {
            alert(data.message || "Réponse reçue");
            if (data.status === 'success') {
                location.reload();
            }
            })
            .catch(error => {
            alert("Erreur lors de la réactivation. Voir console pour détails.");
            console.error("Erreur reactivateTeacher:", error);
            });
        };
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functions
        function filterTeachers() {
            const searchTerm = document.getElementById('searchTeacher').value.toLowerCase();
            const gradeFilter = document.getElementById('filterGrade').value;
            const functionFilter = document.getElementById('filterFunction').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            const rows = document.querySelectorAll('#teachersTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                
                const matchesSearch = text.includes(searchTerm);
                const matchesGrade = !gradeFilter || text.includes(gradeFilter.toLowerCase());
                const matchesFunction = !functionFilter || text.includes(functionFilter.toLowerCase());
                const matchesStatus = !statusFilter || text.includes(statusFilter.toLowerCase());
                
                row.style.display = (matchesSearch && matchesGrade && matchesFunction && matchesStatus) ? '' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('searchTeacher').value = '';
            document.getElementById('filterGrade').value = '';
            document.getElementById('filterFunction').value = '';
            document.getElementById('filterStatus').value = '';
            filterTeachers();
        }

        //Gérer grade et fonction
        function loadGradeAndFunctionHistory(enseignantId) {
            fetch(`../pages/ecrans_gestionnaire/voir_grade_fonction.php?id=${enseignantId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById('gradeHistory').innerHTML = '<div class="alert alert-danger">' + data.error + '</div>';
                        document.getElementById('functionHistory').innerHTML = '<div class="alert alert-danger">' + data.error + '</div>';
                        return;
                    }

                    // Historique des grades
                    let gradesHtml = '<ul class="list-group">';
                    data.grades.forEach(g => {
                        gradesHtml += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-graduation-cap me-2 text-primary"></i>${g.nom_grade}</span>
                            <span class="badge bg-secondary">${g.date_grade}</span>
                        </li>`;
                    });
                    gradesHtml += '</ul>';
                    document.getElementById('gradeHistory').innerHTML = gradesHtml;

                    // Historique des fonctions
                    let fonctionsHtml = '<ul class="list-group">';
                    data.fonctions.forEach(f => {
                        fonctionsHtml += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-briefcase me-2 text-warning"></i>${f.nom_fonct}</span>
                            <span class="badge bg-secondary">${f.date_fonction}</span>
                        </li>`;
                    });
                    fonctionsHtml += '</ul>';
                    document.getElementById('functionHistory').innerHTML = fonctionsHtml;
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('gradeHistory').innerHTML = '<div class="alert alert-danger">Erreur de chargement.</div>';
                    document.getElementById('functionHistory').innerHTML = '<div class="alert alert-danger">Erreur de chargement.</div>';
                });
        }

        function addGrade() {
            const gradeForm = `
                <form onsubmit="submitNewGrade(event)">
                    <div class="mb-3">
                        <label for="gradeSelect" class="form-label">Grade</label>
                        <select class="form-select" id="gradeSelect" name="id_grade" required>
                            <!-- Option dynamique via PHP -->
                            <?php
                            $stmt = $pdo->query("SELECT id_grade, nom_grade FROM grade");
                            while ($g = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$g['id_grade'].'">'.htmlspecialchars($g['nom_grade']).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dateGrade" class="form-label">Date d'attribution</label>
                        <input type="date" class="form-control" name="date_grade" id="dateGrade" required>
                    </div>
                    <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-check me-1"></i>Enregistrer</button>
                </form>
            `;
            document.getElementById('gradeHistory').innerHTML = gradeForm;
        }

        function addFunction() {
            const functionForm = `
                <form onsubmit="submitNewFunction(event)">
                    <div class="mb-3">
                        <label for="functionSelect" class="form-label">Fonction</label>
                        <select class="form-select" id="functionSelect" name="id_fonct" required>
                            <?php
                            $stmt = $pdo->query("SELECT id_fonct, nom_fonct FROM fonction");
                            while ($f = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$f['id_fonct'].'">'.htmlspecialchars($f['nom_fonct']).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dateFonct" class="form-label">Date d'attribution</label>
                        <input type="date" class="form-control" name="date_fonction" id="dateFonct" required>
                    </div>
                    <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-check me-1"></i>Enregistrer</button>
                </form>
            `;
            document.getElementById('functionHistory').innerHTML = functionForm;
        }

        function submitNewGrade(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            formData.append('id_ens', window.currentTeacherId);

            fetch('../pages/ecrans_gestionnaire/ajouter_grade.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json())
            .then(data => {
                if (data.success) {
                    loadGradeAndFunctionHistory(window.currentTeacherId);
                } else {
                    alert(data.error || "Erreur.");
                }
            });
        }

        function submitNewFunction(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            formData.append('id_ens', window.currentTeacherId);

            fetch('../pages/ecrans_gestionnaire/ajouter_fonction.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json())
            .then(data => {
                if (data.success) {
                    loadGradeAndFunctionHistory(window.currentTeacherId);
                } else {
                    alert(data.error || "Erreur.");
                }
            });
        }

        // Teacher management functions
        function viewTeacher(id) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../pages/ecrans_gestionnaire/voir_enseignant.php?id=" + id, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById("teacherDetailsContent").innerHTML = xhr.responseText;
                    new bootstrap.Modal(document.getElementById("viewTeacherModal")).show();
                } else {
                    alert("Erreur lors du chargement des données.");
                }
            };
            xhr.onerror = function () {
                alert("Erreur réseau.");
            };
            xhr.send();
        }


        //Remplir formulaire pour modification
        function loadTeacherToForm(id) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../pages/ecrans_gestionnaire/voir_enseignant.php?id=" + id + "&json=1", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);

                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        // Injection des valeurs dans le formulaire
                        document.getElementById("mode_formulaire").value = "modification";
                        document.getElementById("id_ens").value = data.id_ens;
                        document.getElementById("nom_ens").value = data.nom_ens;
                        document.getElementById("prenom_ens").value = data.prenoms_ens;
                        document.getElementById("login_ens").value = data.login_ens;
                        document.getElementById("mdp_ens").value = data.mdp_ens;
                        document.getElementById("statut_ens").value = data.statut_ens;

                        // Champs dropdowns s’ils existent
                        if (data.id_grade)
                            document.getElementById("id_grade").value = data.id_grade;

                        if (data.id_fonct)
                            document.getElementById("id_fonct").value = data.id_fonct;

                        if (data.lib_spe)
                            document.getElementById("spe_ens").value = data.lib_spe;

                        // Scroll vers le formulaire
                        document.getElementById("addTeacherForm").scrollIntoView({ behavior: "smooth" });

                    } catch (e) {
                        console.error("Erreur JSON :", e);
                        console.log("Réponse brute :", xhr.responseText);
                        alert("Erreur de traitement des données JSON.");
                    }
                } else {
                    alert("Erreur serveur.");
                }
            };
            xhr.onerror = function () {
                alert("Erreur réseau.");
            };
            xhr.send();
        }

        //Gestion des messages d'erreur
        function handleTeacherSubmit(event) {
            event.preventDefault(); // Empêche le rechargement

            const form = document.getElementById('addTeacherForm');
            const formData = new FormData(form);

            fetch('../pages/ecrans_gestionnaire/traitement_enseignant.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const modalContent = document.getElementById('messageModalContent');
                const modalTitle = document.getElementById('messageModalLabel');
                const modal = new bootstrap.Modal(document.getElementById('messageModal'));

                if (data.status === 'success') {
                    modalTitle.textContent = "Succès";
                    modalContent.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

                    // Réinitialise les champs si en mode ajout
                    if (form.mode_formulaire.value === 'ajout') {
                        form.reset();

                        // ✅ Regénère un login et mot de passe automatiques (optionnel)
                        const newLogin = 'defaultP' + Math.floor(Math.random() * 9000 + 1000) + '@prof-uni.ci';
                        const newPassword = Math.random().toString(36).slice(-8);

                        document.getElementById('login_ens').value = newLogin;
                        document.getElementById('mdp_ens').value = newPassword;
                    }
                } else {
                    modalTitle.textContent = "Erreur";
                    modalContent.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                }

                modal.show();
            })
            .catch(error => {
                console.error('Erreur:', error);
                const modalContent = document.getElementById('messageModalContent');
                modalContent.innerHTML = `<div class="alert alert-danger">❌ Une erreur est survenue.</div>`;
                new bootstrap.Modal(document.getElementById('messageModal')).show();
            });

            return false; // Empêche la soumission classique
        }
   




        function manageGradeFunction(id) {
            console.log('Managing grade/function for teacher:', id);
            // Load grade and function history
            document.getElementById('gradeHistory').innerHTML = `
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>Professeur</strong>
                            <small>01/09/2015 - Actuel</small>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Maître de Conférence</span>
                            <small>01/09/2010 - 31/08/2015</small>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('functionHistory').innerHTML = `
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>Chef de département</strong>
                            <small>01/09/2020 - Actuel</small>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Responsable UE</span>
                            <small>01/09/2015 - 31/08/2020</small>
                        </div>
                    </div>
                </div>
            `;
            new bootstrap.Modal(document.getElementById('gradeFunctionModal')).show();
        }

        function viewReports(id) {
            console.log('Viewing reports for teacher:', id);
            // Redirect to reports page with teacher filter
            window.location.href = `rapports.html?teacher=${id}`;
        }

        function suspendTeacher(id) {
            if (confirm('Êtes-vous sûr de vouloir suspendre cet enseignant ?')) {
                console.log('Suspending teacher:', id);
                // Add suspend logic here
            }
        }

        function saveTeacher() {
            const form = document.getElementById('addTeacherForm');
            if (form.checkValidity()) {
                console.log('Saving teacher...');
                // Add save logic here
                bootstrap.Modal.getInstance(document.getElementById('addTeacherModal')).hide();
            } else {
                form.reportValidity();
            }
        }

        function exportToExcel() {
            console.log('Exporting teachers to Excel...');
            // Add export logic here
        }

        function addGrade() {
            // Add form to assign new grade
            console.log('Adding new grade...');
        }

        function addFunction() {
            // Add form to assign new function
            console.log('Adding new function...');
        }

        // Select all functionality
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.teacher-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }
    </script>
</body>
</html>