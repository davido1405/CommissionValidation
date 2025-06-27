<?php
require_once(__DIR__ . '/../../config/db.php');

// Vérifie si JSON attendu (AJAX)
$isJson = isset($_GET['json']) && $_GET['json'] == '1';

// Vérifie ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    if ($isJson) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'ID invalide']);
    } else {
        echo "<div class='text-danger'>ID invalide</div>";
    }
    exit;
}

$id_ens = (int) $_GET['id'];

// Récupère infos principales de l'enseignant
$stmt = $pdo->prepare("SELECT * FROM enseignant WHERE id_ens = ?");
$stmt->execute([$id_ens]);
$enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$enseignant) {
    if ($isJson) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Enseignant introuvable']);
    } else {
        echo "<div class='text-danger'>Enseignant introuvable</div>";
    }
    exit;
}

// --- Si JSON : retour pour formulaire de modification ---
if ($isJson) {
    // Charger id_grade
    $stmt = $pdo->prepare("SELECT id_grade FROM avoir WHERE id_ens = ? ORDER BY dte_grd DESC LIMIT 1");
    $stmt->execute([$id_ens]);
    $enseignant['id_grade'] = $stmt->fetchColumn();

    // Charger id_fonct
    $stmt = $pdo->prepare("SELECT id_fonct FROM occuper WHERE id_ens = ? ORDER BY dte_occup DESC LIMIT 1");
    $stmt->execute([$id_ens]);
    $enseignant['id_fonct'] = $stmt->fetchColumn();

    // Charger spécialité texte (lib_spe)
    $stmt = $pdo->prepare("
        SELECT s.lib_spe FROM enseigner e
        JOIN specialite s ON e.id_spe = s.id_spe
        WHERE e.id_ens = ?
        ORDER BY e.id_spe DESC LIMIT 1
    ");
    $stmt->execute([$id_ens]);
    $enseignant['lib_spe'] = $stmt->fetchColumn();

    // Envoi JSON
    header('Content-Type: application/json');
    echo json_encode($enseignant);
    exit;
}

// --- Sinon : mode HTML pour affichage dans une modale ---

// Spécialités
$stmt = $pdo->prepare("
    SELECT s.lib_spe FROM enseigner e
    JOIN specialite s ON e.id_spe = s.id_spe
    WHERE e.id_ens = ?
");
$stmt->execute([$id_ens]);
$specialites = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Grades
$stmt = $pdo->prepare("
    SELECT g.nom_grade FROM avoir a
    JOIN grade g ON a.id_grade = g.id_grade
    WHERE a.id_ens = ?
");
$stmt->execute([$id_ens]);
$grades = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Fonctions
$stmt = $pdo->prepare("
    SELECT f.nom_fonct FROM occuper o
    JOIN fonction f ON o.id_fonct = f.id_fonct
    WHERE o.id_ens = ?
");
$stmt->execute([$id_ens]);
$fonctions = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="row">
    <div class="col-md-4 text-center">
        <div class="user-avatar mx-auto mb-3 bg-success text-white" style="width: 100px; height: 100px; font-size: 2.5rem;">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <h5>Prof. <?= htmlspecialchars($enseignant['prenoms_ens'] . ' ' . $enseignant['nom_ens']) ?></h5>
        <p class="text-muted"><?= htmlspecialchars($enseignant['login_ens']) ?></p>
    </div>
    <div class="col-md-8">
        <h6>Informations professionnelles</h6>
        <p><strong>Spécialité(s):</strong>
            <?= !empty($specialites) ? htmlspecialchars(implode(', ', $specialites)) : 'Aucune' ?>
        </p>
        <p><strong>Grade(s):</strong>
            <?= !empty($grades) ? htmlspecialchars(implode(', ', $grades)) : 'Aucun' ?>
        </p>
        <p><strong>Fonction(s):</strong>
            <?= !empty($fonctions) ? htmlspecialchars(implode(', ', $fonctions)) : 'Aucune' ?>
        </p>
        <p><strong>Statut:</strong>
            <span class="badge <?= strtolower($enseignant['statut_ens']) === 'actif' ? 'bg-success' : 'bg-secondary' ?>">
                <?= htmlspecialchars($enseignant['statut_ens'] ?? 'Non défini') ?>
            </span>
        </p>
    </div>
</div>
