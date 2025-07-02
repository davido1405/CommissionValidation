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
    WITH inscriptions AS (
        SELECT *,
               ROW_NUMBER() OVER (PARTITION BY num_etu ORDER BY dte_insc DESC, id_ac DESC) AS rn
        FROM inscrire
    )
    SELECT 
        e.num_etu, e.nom_etu, e.prenom_etu, e.dte_nais_etu, e.login_etu, e.statut_etu,
        ne.lib_niv_etu, aa.dte_deb, aa.dte_fin, i.montant_insc
    FROM inscriptions i
    JOIN etudiant e ON e.num_etu = i.num_etu
    JOIN niveau_etude ne ON ne.id_niv_etu = i.id_niv_etu
    JOIN annee_academique aa ON aa.id_ac = i.id_ac
    WHERE i.rn = 1
    ORDER BY e.num_etu DESC
    LIMIT :offset, :parpage
");

$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$stmt->execute();
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Total des étudiants
$totalStmt = $pdo->query("SELECT COUNT(DISTINCT num_etu) FROM inscrire");
$totalEtudiants = $totalStmt->fetchColumn();
$totalPages = ceil($totalEtudiants / $parPage);


// Générer un login unique (ex: etu168493@example.com)
$prefix = "default";
$randomNumber = rand(1000, 9999);
$loginAuto = $prefix . $randomNumber . '@university.ci';

// Générer un mot de passe aléatoire simple (ex: Ab12XZ)
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$mdpAuto = substr(str_shuffle($chars), 0, 8);

?>
        <div class="content-area">
            <!-- Main Content Card -->
            <div class="dashboard-card">
                
                <div class="addStudentForm">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="modal-title" id="addStudentModalLabel">
                                    <i class="fas fa-user-plus me-2"></i>Ajouter un nouvel étudiant
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <form id="addStudentForm" method="POST" action="../pages/ecrans_gestionnaire/traitement_etudiant.php" onsubmit="return handleSubmit(event)">
                                    <input type="hidden" id="mode_formulaire" name="mode_formulaire" value="ajout">
                                    <input type="hidden" id="num_etu" name="num_etu" value="">
                                    <input type="hidden" id="ancien_login" name="ancien_login" value="">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="prenom_etu" class="form-label">Prénom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="prenom_etu" name="prenom_etu" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nom_etu" class="form-label">Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nom_etu" name="nom_etu" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dte_nais_etu" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="dte_nais_etu" name="dte_nais_etu" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="login_etu" class="form-label">Login <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="login_etu" name="login_etu" required value="<?= $loginAuto ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mdp_etu" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mdp_etu" name="mdp_etu" required value="<?= $mdpAuto ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="id_niv_etu" class="form-label">Niveau d'étude <span class="text-danger">*</span></label>
                                            <select class="form-select" id="id_niv_etu" name="id_niv_etu" required>
                                                <option value="">Sélectionner le niveau de l'étudiant</option>
                                                <?php
                                                $nivStmt = $pdo->query("SELECT id_niv_etu, lib_niv_etu FROM niveau_etude");
                                                while ($row = $nivStmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value=\"" . htmlspecialchars($row['id_niv_etu']) . "\">" . htmlspecialchars($row['lib_niv_etu']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="id_ac" class="form-label">Année académique <span class="text-danger">*</span></label>
                                            <select class="form-select" id="id_ac" name="id_ac" required>
                                                <option value="">Choisir...</option>
                                                <?php
                                                $acStmt = $pdo->query("SELECT id_ac, dte_deb, dte_fin FROM annee_academique ORDER BY dte_deb DESC");
                                                while ($row = $acStmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $annee = date('Y', strtotime($row['dte_deb'])) . '-' . date('Y', strtotime($row['dte_fin']));
                                                    echo "<option value=\"" . htmlspecialchars($row['id_ac']) . "\">" . $annee . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="montant_insc" class="form-label">Montant inscription</label>
                                            <input type="number" class="form-control" id="montant_insc" name="montant_insc" placeholder="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="statut_etu" class="form-label">Statut</label>
                                            <select class="form-select" id="statut_etu" name="statut_etu">
                                                <option value="Actif">Actif</option>
                                                <option value="Inactif">Inactif</option>
                                                <option value="Suspendu">Suspendu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!--<input type="hidden" id="num_etu" name="num_etu" value="">-->
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save me-2"></i><span id="submitText">Ajouter l'étudiant</span>
                                        </button>
                                    </div>
                                </form>

                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-users me-2"></i>Liste des Étudiants</h5>
                        <p class="text-muted mb-0">Gérer les comptes étudiants et leurs informations</p>
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
                            <input type="text" id="searchStudent" placeholder="Rechercher un étudiant..." onkeyup="filterStudents()">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select class="custom-select" id="filterLevel" onchange="filterStudents()">
                                    <option value="">Tous les niveaux</option>
                                    <?php
                                    $nivStmt = $pdo->query("SELECT lib_niv_etu FROM niveau_etude");
                                    while ($row = $nivStmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value=\"" . htmlspecialchars($row['lib_niv_etu']) . "\">" . htmlspecialchars($row['lib_niv_etu']) . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterYear" onchange="filterStudents()">
                                    <option value="">Toutes les années</option>
                                    <?php
                                    $acStmt = $pdo->query("SELECT dte_deb, dte_fin FROM annee_academique ORDER BY dte_deb DESC");
                                    while ($row = $acStmt->fetch(PDO::FETCH_ASSOC)) {
                                        $annee = date('Y', strtotime($row['dte_deb'])) . '-' . date('Y', strtotime($row['dte_fin']));
                                        echo "<option value=\"$annee\">$annee</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-md-3">
                                <select class="custom-select" id="filterStatus" onchange="filterStudents()">
                                    <option value="">Tous les statuts</option>
                                    <option value="Actif">Actif</option>
                                    <option value="Inactif">Inactif</option>
                                    <option value="Suspendu">Suspendu</option>
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

                <!-- Students Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="studentsTable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th>Matricule</th>
                                <th>Nom complet</th>
                                <th>Date de naissance</th>
                                <th>Niveau</th>
                                <th>Année d'inscription</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentsTableBody">
                            <?php foreach ($etudiants as $etu): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input student-checkbox" value="<?= $etu['num_etu'] ?>">
                                    </td>
                                    <td class="fw-bold">#ET<?= str_pad($etu['num_etu'], 3, '0', STR_PAD_LEFT) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2 bg-primary text-white">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?= htmlspecialchars($etu['prenom_etu'] . ' ' . $etu['nom_etu']) ?></div>
                                                <small class="text-muted"><?= htmlspecialchars($etu['login_etu']) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($etu['dte_nais_etu'])) ?></td>
                                    <td><span class="badge bg-info"><?= htmlspecialchars($etu['lib_niv_etu']) ?></span></td>
                                    <td><?= date('Y', strtotime($etu['dte_deb'])) . '-' . date('Y', strtotime($etu['dte_fin'])) ?></td>
                                    <td>
                                        <span class="badge <?= strtolower($etu['statut_etu']) === 'actif' ? 'status-active' : 'bg-secondary' ?>">
                                            <?= ucfirst($etu['statut_etu']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- Voir les détails -->
                                            <!-- Bouton Voir (ouvre la modale avec JS) -->
                                            <button
                                                class="btn btn-sm btn-outline-primary" 
                                                title="Voir"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalVoirEtudiant"
                                                onclick="loadEtudiantDetails(<?= $etu['num_etu'] ?>)">
                                                <i class="fas fa-eye"></i>
                                            </button>


                                            <!-- Modifier l'étudiant -->
                                            <button 
                                                class="btn btn-sm btn-outline-warning" 
                                                title="Modifier"
                                                onclick="loadEtudiantToForm(<?= $etu['num_etu'] ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Supprimer l'étudiant -->
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="deleteStudent(<?= $etu['num_etu'] ?>)" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
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
    <!-- Modal à la fin de la page -->
        <!-- MODAL POUR VOIR L'ÉTUDIANT -->
        <div class="modal fade" id="modalVoirEtudiant" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Détails de l'étudiant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body" id="contenuEtudiant">
                <div class="text-center text-muted">Chargement...</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
        </div>




    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">
                        <i class="fas fa-file-import me-2"></i>Importer des étudiants
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="importFile" class="form-label">Fichier Excel/CSV</label>
                        <input type="file" class="form-control" id="importFile" accept=".xlsx,.xls,.csv">
                        <div class="form-text">Formats acceptés: .xlsx, .xls, .csv</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Format attendu:</strong> Nom, Prénom, Date de naissance, Login, Niveau
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="importStudents()">
                        <i class="fas fa-upload me-2"></i>Importer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!--Voir détail étudiant-->
    <script>
        function loadEtudiantDetails(id) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "../pages/ecrans_gestionnaire/voir_etudiant.php?id=" + id, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById("contenuEtudiant").innerHTML = xhr.responseText;
                } else {
                    document.getElementById("contenuEtudiant").innerHTML = "<div class='text-danger'>Erreur lors du chargement.</div>";
                }
            };
            xhr.onerror = function () {
                document.getElementById("contenuEtudiant").innerHTML = "<div class='text-danger'>Erreur réseau.</div>";
            };
            xhr.send();
        }
    </script>

    <!--Modifier informations de l'étudiant-->
    <script>
        function loadEtudiantToForm(num_etu) {
            fetch(`../pages/ecrans_gestionnaire/voir_etudiant.php?id=${num_etu}&json=1`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        alert("Erreur : " + data.error);
                        return;
                    }

                    document.getElementById('mode_formulaire').value = 'modification';
                    document.getElementById('num_etu').value = data.num_etu ?? '';
                    document.getElementById('ancien_login').value = data.login_etu ?? '';
                    document.getElementById('prenom_etu').value = data.prenom_etu ?? '';
                    document.getElementById('nom_etu').value = data.nom_etu ?? '';
                    document.getElementById('dte_nais_etu').value = data.dte_nais_etu ?? '';
                    document.getElementById('login_etu').value = data.login_etu ?? '';
                    document.getElementById('statut_etu').value = data.statut_etu ?? '';
                    document.getElementById('id_niv_etu').value = data.id_niv_etu ?? '';
                    document.getElementById('id_ac').value = data.id_ac ?? '';
                    document.getElementById('montant_insc').value = data.montant_insc ?? '';

                    // Changement du texte du bouton si id submitText existe
                    const submitBtn = document.getElementById('submitText');
                    if (submitBtn) submitBtn.innerText = "Modifier l'étudiant";

                    // Ouvrir la modale
                    const modalElement = document.querySelector('.addStudentForm .modal');
                    if (modalElement) {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();

                        // Scroll smooth vers la modale
                        modalElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        console.warn("Modal non trouvé !");
                    }
                })
                .catch(err => {
                    console.error("Erreur lors du chargement de l'étudiant :", err);
                    alert("Erreur lors du chargement.");
                });
        }

    </script>
        
    <script>
        // Filter functions
        function filterStudents() {
            const searchTerm = document.getElementById('searchStudent').value.toLowerCase();
            const levelFilter = document.getElementById('filterLevel').value;
            const yearFilter = document.getElementById('filterYear').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            const rows = document.querySelectorAll('#studentsTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const level = row.querySelector('.badge').textContent;
                
                const matchesSearch = text.includes(searchTerm);
                const matchesLevel = !levelFilter || level.includes(levelFilter);
                // Add other filter logic here
                
                row.style.display = (matchesSearch && matchesLevel) ? '' : 'none';
            });
        }

        function resetFilters() {
            document.getElementById('searchStudent').value = '';
            document.getElementById('filterLevel').value = '';
            document.getElementById('filterYear').value = '';
            document.getElementById('filterStatus').value = '';
            filterStudents();
        }

        // Student management functions
        function viewStudent(id) {
            // Load student details and show modal
            console.log('Viewing student:', id);
            document.getElementById('viewStudentModal').querySelector('.modal-body').innerHTML = `
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="user-avatar mx-auto mb-3 bg-primary text-white" style="width: 80px; height: 80px; font-size: 2rem;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6>Informations personnelles</h6>
                        <p><strong>Nom:</strong> Koné Mamadou</p>
                        <p><strong>Date de naissance:</strong> 15/03/2001</p>
                        <p><strong>Login:</strong> kone.mamadou</p>
                        <p><strong>Niveau:</strong> Master 2</p>
                        <p><strong>Statut:</strong> <span class="badge status-active">Actif</span></p>
                    </div>
                </div>
            `;
            new bootstrap.Modal(document.getElementById('viewStudentModal')).show();
        }


        //Script pour notifications ajouter un étudiant
        function handleSubmit(event) {
            event.preventDefault(); // Bloque la soumission normale

            const form = document.getElementById('addStudentForm');
            const formData = new FormData(form);

            fetch('../pages/ecrans_gestionnaire/traitement_etudiant.php', {
                method: 'POST',
                body: formData
            })
            .then(async response => {
                const text = await response.text();
                try {
                    const data = JSON.parse(text);
                    if (data.status === 'success') {
                        showNotification(data.message, 'success');

                        // Si c'était une modification, recharge la liste ou la ligne correspondante
                        if (formData.get("mode_formulaire") === "modification") {
                            setTimeout(() => location.reload(), 1500); // ou remplacer dynamiquement si tu veux
                        } else {
                            form.reset(); // Remise à zéro du formulaire si ajout
                        }

                    } else {
                        showNotification(data.message || 'Erreur lors du traitement.', 'danger');
                    }
                } catch (e) {
                    console.error("Réponse invalide :", text);
                    showNotification("Erreur de parsing de la réponse.", 'danger');
                }
            })
            .catch(error => {
                console.error("Erreur réseau :", error);
                showNotification("Erreur réseau lors de l'enregistrement.", 'danger');
            });

            return false; // Toujours bloquer le submit
        }

        function deleteStudent(id) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) return;

            fetch('../pages/ecrans_gestionnaire/supprimer_etudiant.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + encodeURIComponent(id)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.success, 'success');

                    // Supprimer la ligne du tableau sans recharger
                    const row = document.querySelector(`.student-checkbox[value="${id}"]`)?.closest('tr');
                    if (row) row.remove();
                } else {
                    showNotification(data.error || "Erreur inconnue.", 'danger');
                }
            })
            .catch(() => {
                showNotification("Erreur réseau.", 'danger');
            });
        }

        function showNotification(message, type = 'success') {
            const modalHTML = `
            <div class="modal fade" id="notifModalAjax" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-${type}">
                        <div class="modal-header bg-${type} text-white">
                            <h5 class="modal-title">${type === 'success' ? 'Succès' : 'Erreur'}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">${message}</div>
                    </div>
                </div>
            </div>
            `;
            // Supprime ancienne modale s'il y en a
            document.getElementById('notifModalAjax')?.remove();

            document.body.insertAdjacentHTML('beforeend', modalHTML);
            const notif = new bootstrap.Modal(document.getElementById('notifModalAjax'));
            notif.show();

            setTimeout(() => notif.hide(), 4000);
        }

        function saveStudent() {
            const form = document.getElementById('addStudentForm');

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);

            // ✅ Un seul fetch bien structuré
            fetch('../pages/ecrans_gestionnaire/traitement_etudiant.php', {
                method: 'POST',
                body: formData
            })
            .then(async response => {
                const text = await response.text();
                console.log("Réponse brute : ", text); // 👀 vérifie bien dans ta console ce que ça dit

                try {
                    const data = JSON.parse(text);
                    console.log("Réponse JSON parsée :", data);

                    if (data.status === 'success') {
                        alert(data.message);
                        window.location.href = 'etudiants.php';
                    } else {
                        alert("Erreur : " + data.message);
                    }
                } catch (e) {
                    console.error("Erreur de parsing JSON :", e);
                    alert("Erreur lors de l'enregistrement (réponse non valide).");
                }
            })
            .catch(error => {
                console.error("Erreur AJAX :", error);
                alert("Erreur réseau lors de l'enregistrement.");
            });
        }




        function exportToExcel() {
            const table = document.getElementById("studentsTable");
            const tableClone = table.cloneNode(true);
            // Supprime la colonne "Actions" et les cases à cocher
            tableClone.querySelectorAll('th:last-child, td:last-child, th:first-child, td:first-child').forEach(el => el.remove());

            // Convertit le tableau en chaîne HTML
            const html = `
                <html>
                    <head>
                        <meta charset="UTF-8">
                    </head>
                    <body>
                        ${tableClone.outerHTML}
                    </body>
                </html>`;

            const blob = new Blob([html], { type: "application/vnd.ms-excel" });
            const url = URL.createObjectURL(blob);

            const a = document.createElement("a");
            a.href = url;
            a.download = "etudiants.xls";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }


        function importStudents() {
            const fileInput = document.getElementById('importFile');
            const file = fileInput.files[0];

            if (!file) {
                alert('Veuillez sélectionner un fichier à importer.');
                return;
            }

            const formData = new FormData();
            formData.append('file', file);

            fetch('../pages/ecrans_gestionnaire/import_etudiants.php', {
                method: 'POST',
                body: formData
            })
            .then(async res => {
                const data = await res.json();
                if (data.status === 'success') {
                    showNotification(data.message, 'success');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    showNotification(data.message || 'Erreur lors de l\'importation.', 'danger');
                }
            })
            .catch(err => {
                console.error(err);
                showNotification("Erreur réseau.", 'danger');
            });

            // Fermer la modale
            bootstrap.Modal.getInstance(document.getElementById('importModal')).hide();
        }


        // Select all functionality
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.student-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }
    </script>