<?php
require_once(__DIR__ . '/../../config/db.php');

$isJson = isset($_GET['json']) && $_GET['json'] == '1';

// Vérifie l'ID
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

// 🔍 Fonction utilitaire pour récupérer une seule valeur
function fetchColumnById($pdo, $sql, $id) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchColumn() ?: null;
}

// 🔹 Récupère les infos de l'enseignant
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

if ($isJson) {
    // 🔒 Facultatif : Ne pas renvoyer le mot de passe si tu veux plus de sécurité
    // Supprime la ligne suivante si tu ne veux pas le transmettre au JS :
    // unset($enseignant['mdp_ens']);

    // Ajout des données secondaires
    $enseignant['id_grade'] = fetchColumnById($pdo, "SELECT id_grade FROM avoir WHERE id_ens = ? ORDER BY dte_grd DESC LIMIT 1", $id_ens);
    $enseignant['id_fonct'] = fetchColumnById($pdo, "SELECT id_fonct FROM occuper WHERE id_ens = ? ORDER BY dte_occup DESC LIMIT 1", $id_ens);
    $enseignant['lib_spe']  = fetchColumnById($pdo, "
        SELECT s.lib_spe FROM enseigner e
        JOIN specialite s ON e.id_spe = s.id_spe
        WHERE e.id_ens = ?
        ORDER BY e.id_spe DESC LIMIT 1", $id_ens);

    header('Content-Type: application/json');
    echo json_encode($enseignant);
    exit;
}

// --- Mode HTML (vue modale) ---

function fetchColumnList($pdo, $sql, $id) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

$specialites = fetchColumnList($pdo, "
    SELECT s.lib_spe FROM enseigner e
    JOIN specialite s ON e.id_spe = s.id_spe
    WHERE e.id_ens = ?", $id_ens);

$grades = fetchColumnList($pdo, "
    SELECT g.nom_grade FROM avoir a
    JOIN grade g ON a.id_grade = g.id_grade
    WHERE a.id_ens = ?", $id_ens);

$fonctions = fetchColumnList($pdo, "
    SELECT f.nom_fonct FROM occuper o
    JOIN fonction f ON o.id_fonct = f.id_fonct
    WHERE o.id_ens = ?", $id_ens);
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
