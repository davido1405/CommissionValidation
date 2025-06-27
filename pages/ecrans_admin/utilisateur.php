<h2>Gestion des Utilisateurs</h2>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
    <i class="fas fa-user-plus me-2"></i>Ajouter un utilisateur
</button>

<!-- Tableau -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jean Dupont</td>
            <td>jean@example.com</td>
            <td>Admin</td>
            <td>
                <button class="btn btn-sm btn-warning">Modifier</button>
                <button class="btn btn-sm btn-danger">Supprimer</button>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">
                    <i class="fas fa-user-plus me-2"></i>Ajouter un utilisateur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="motdepasse" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rôle</label>
                            <select class="form-select" name="role" required>
                                <option value="">Choisir...</option>
                                <option value="1">Admin 1</option>
                                <option value="2">Admin 2</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-primary" onclick="saveUser()">
                    <i class="fas fa-save me-2"></i>Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>
