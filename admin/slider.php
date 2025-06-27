<?php
// Inclure les fichiers nécessaires
require_once '../init.php';

// Vérifier que l'utilisateur est connecté et est un administrateur
require_role(ROLE_ADMIN);

// Initialiser les variables
$message = '';
$messageType = '';
$images = [];

// Fonction pour récupérer toutes les images du slider
function getAllSliderImages() {
    try {
        $db = get_db();
        $query = "SELECT * FROM slider_images ORDER BY ordre ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

// Récupérer les images existantes
$images = getAllSliderImages();

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Action d'ajout d'image
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        // Vérifier si un fichier a été uploadé
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed = ['jpg', 'jpeg', 'png'];
            $filename = $_FILES['image']['name'];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            // Vérifier l'extension
            if (in_array($extension, $allowed)) {
                // Créer le dossier s'il n'existe pas
                $uploadDir = '../assets/img/slider/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                // Générer un nom de fichier unique
                $newFilename = uniqid() . '.' . $extension;
                $destination = $uploadDir . $newFilename;
                
                // Déplacer le fichier uploadé
                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    try {
                        // Insérer dans la base de données
                        $db = get_db();
                        $query = "INSERT INTO slider_images (nom_image, chemin_image, description, actif, ordre) 
                                  VALUES (:nom, :chemin, :description, :actif, :ordre)";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            'nom' => $_POST['nom'],
                            'chemin' => 'assets/img/slider/' . $newFilename,
                            'description' => $_POST['description'],
                            'actif' => isset($_POST['actif']) ? 1 : 0,
                            'ordre' => intval($_POST['ordre'])
                        ]);
                        
                        $message = "Image ajoutée avec succès.";
                        $messageType = "success";
                        // Recharger les images
                        $images = getAllSliderImages();
                    } catch (PDOException $e) {
                        $message = "Erreur lors de l'ajout de l'image : " . $e->getMessage();
                        $messageType = "danger";
                    }
                } else {
                    $message = "Erreur lors du déplacement du fichier.";
                    $messageType = "danger";
                }
            } else {
                $message = "Extension de fichier non autorisée. Seules les images JPG, JPEG et PNG sont acceptées.";
                $messageType = "danger";
            }
        } else {
            $message = "Erreur lors de l'upload du fichier.";
            $messageType = "danger";
        }
    }
    
    // Action de modification d'image
    else if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        try {
            $db = get_db();
            $query = "UPDATE slider_images 
                      SET nom_image = :nom, description = :description, actif = :actif, ordre = :ordre 
                      WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'actif' => isset($_POST['actif']) ? 1 : 0,
                'ordre' => intval($_POST['ordre']),
                'id' => $id
            ]);
            
            // Vérifier si un nouveau fichier a été uploadé
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $allowed = ['jpg', 'jpeg', 'png'];
                $filename = $_FILES['image']['name'];
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                // Vérifier l'extension
                if (in_array($extension, $allowed)) {
                    // Récupérer l'ancien fichier
                    $query = "SELECT chemin_image FROM slider_images WHERE id = :id";
                    $stmt = $db->prepare($query);
                    $stmt->execute(['id' => $id]);
                    $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Supprimer l'ancien fichier
                    if ($oldImage && file_exists('../' . $oldImage['chemin_image'])) {
                        unlink('../' . $oldImage['chemin_image']);
                    }
                    
                    // Créer le dossier s'il n'existe pas
                    $uploadDir = '../assets/img/slider/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    
                    // Générer un nom de fichier unique
                    $newFilename = uniqid() . '.' . $extension;
                    $destination = $uploadDir . $newFilename;
                    
                    // Déplacer le fichier uploadé
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                        // Mettre à jour le chemin dans la base de données
                        $query = "UPDATE slider_images SET chemin_image = :chemin WHERE id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            'chemin' => 'assets/img/slider/' . $newFilename,
                            'id' => $id
                        ]);
                    } else {
                        $message = "Erreur lors du déplacement du fichier.";
                        $messageType = "danger";
                    }
                } else {
                    $message = "Extension de fichier non autorisée. Seules les images JPG, JPEG et PNG sont acceptées.";
                    $messageType = "danger";
                }
            }
            
            $message = "Image mise à jour avec succès.";
            $messageType = "success";
            // Recharger les images
            $images = getAllSliderImages();
        } catch (PDOException $e) {
            $message = "Erreur lors de la mise à jour de l'image : " . $e->getMessage();
            $messageType = "danger";
        }
    }
    
    // Action de suppression d'image
    else if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        try {
            $db = get_db();
            
            // Récupérer le chemin de l'image
            $query = "SELECT chemin_image FROM slider_images WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute(['id' => $id]);
            $image = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Supprimer le fichier
            if ($image && file_exists('../' . $image['chemin_image'])) {
                unlink('../' . $image['chemin_image']);
            }
            
            // Supprimer l'entrée de la base de données
            $query = "DELETE FROM slider_images WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute(['id' => $id]);
            
            $message = "Image supprimée avec succès.";
            $messageType = "success";
            // Recharger les images
            $images = getAllSliderImages();
        } catch (PDOException $e) {
            $message = "Erreur lors de la suppression de l'image : " . $e->getMessage();
            $messageType = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Slider - Administration BDCOV</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #004d40;
            --secondary-color: #ffb74d;
            --text-color: #333;
            --light-bg: #e3f2fd;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 10px 20px;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .admin-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 30px;
        }
        
        .admin-title {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .main-content {
            padding: 30px;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            height: 3px;
            width: 50px;
            background-color: var(--secondary-color);
            bottom: -10px;
            left: 0;
        }
        
        .img-preview {
            max-width: 150px;
            max-height: 100px;
            object-fit: cover;
        }
        
        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-4 text-white min-vh-100">
                    <a href="index.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">BDCOV Admin</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
                        <li class="nav-item w-100">
                            <a href="index.php" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i> <span class="d-none d-sm-inline">Tableau de bord</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="users.php" class="nav-link">
                                <i class="fas fa-users"></i> <span class="d-none d-sm-inline">Utilisateurs</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="reports.php" class="nav-link">
                                <i class="fas fa-file-alt"></i> <span class="d-none d-sm-inline">Rapports</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="juries.php" class="nav-link">
                                <i class="fas fa-gavel"></i> <span class="d-none d-sm-inline">Jurys</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="planning.php" class="nav-link">
                                <i class="fas fa-calendar-alt"></i> <span class="d-none d-sm-inline">Planification</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="slider.php" class="nav-link active">
                                <i class="fas fa-images"></i> <span class="d-none d-sm-inline">Slider</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="settings.php" class="nav-link">
                                <i class="fas fa-cog"></i> <span class="d-none d-sm-inline">Paramètres</span>
                            </a>
                        </li>
                        <li class="nav-item w-100 mt-3">
                            <a href="../logout.php" class="nav-link text-danger">
                                <i class="fas fa-sign-out-alt"></i> <span class="d-none d-sm-inline">Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Contenu principal -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
                <!-- En-tête -->
                <div class="admin-header d-flex justify-content-between align-items-center mb-4">
                    <h1 class="admin-title h3">Gestion du Slider</h1>
                    <div>
                        <span>Bienvenue, <strong><?php echo $_SESSION['user_login']; ?></strong></span>
                    </div>
                </div>
                
                <!-- Messages d'alerte -->
                <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
                <?php endif; ?>
                
                <!-- Contenu principal -->
                <div class="main-content">
                    <div class="row">
                        <!-- Formulaire d'ajout d'image -->
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">Ajouter une image</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="add">
                                        
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" required>
                                            <small class="form-text text-muted">Formats acceptés : JPG, JPEG, PNG</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="ordre" class="form-label">Ordre</label>
                                            <input type="number" class="form-control" id="ordre" name="ordre" value="0" min="0">
                                        </div>
                                        
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="actif" name="actif" checked>
                                            <label class="form-check-label" for="actif">Actif</label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle me-2"></i>Ajouter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Liste des images -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">Images du slider</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($images)): ?>
                                    <div class="alert alert-info">
                                        Aucune image n'a été ajoutée au slider.
                                    </div>
                                    <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Nom</th>
                                                    <th>Description</th>
                                                    <th>Ordre</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($images as $image): ?>
                                                <tr>
                                                    <td>
                                                        <img src="../<?php echo $image['chemin_image']; ?>" alt="<?php echo $image['nom_image']; ?>" class="img-preview">
                                                    </td>
                                                    <td><?php echo $image['nom_image']; ?></td>
                                                    <td><?php echo $image['description']; ?></td>
                                                    <td><?php echo $image['ordre']; ?></td>
                                                    <td>
                                                        <?php if ($image['actif']): ?>
                                                        <span class="badge bg-success">Actif</span>
                                                        <?php else: ?>
                                                        <span class="badge bg-secondary">Inactif</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="action-buttons">
                                                        <button type="button" class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" 
                                                                data-id="<?php echo $image['id']; ?>"
                                                                data-nom="<?php echo $image['nom_image']; ?>"
                                                                data-description="<?php echo $image['description']; ?>"
                                                                data-ordre="<?php echo $image['ordre']; ?>"
                                                                data-actif="<?php echo $image['actif']; ?>"
                                                                data-chemin="<?php echo $image['chemin_image']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $image['id']; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal d'édition -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier l'image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit-id">
                        
                        <div class="mb-3 text-center">
                            <img id="edit-preview" src="" alt="Aperçu" class="img-thumbnail mb-2" style="max-height: 200px;">
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-image" class="form-label">Nouvelle image (optionnel)</label>
                            <input type="file" class="form-control" id="edit-image" name="image">
                            <small class="form-text text-muted">Laissez vide pour conserver l'image actuelle</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit-nom" name="nom" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit-ordre" class="form-label">Ordre</label>
                            <input type="number" class="form-control" id="edit-ordre" name="ordre" min="0">
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="edit-actif" name="actif">
                            <label class="form-check-label" for="edit-actif">Actif</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette image ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" id="delete-id">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du modal d'édition
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var nom = button.getAttribute('data-nom');
                var description = button.getAttribute('data-description');
                var ordre = button.getAttribute('data-ordre');
                var actif = button.getAttribute('data-actif') === '1';
                var chemin = button.getAttribute('data-chemin');
                
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nom').value = nom;
                document.getElementById('edit-description').value = description;
                document.getElementById('edit-ordre').value = ordre;
                document.getElementById('edit-actif').checked = actif;
                document.getElementById('edit-preview').src = '../' + chemin;
            });
            
            // Gestion du modal de suppression
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                document.getElementById('delete-id').value = id;
            });
        });
    </script>
</body>
</html>
