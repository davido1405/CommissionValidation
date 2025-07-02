<?php
// Toujours en haut de fichier :
ob_start(); // Empêche tout contenu non contrôlé
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion
require_once '../../config/db.php';

// Vérification de l’ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID invalide']);
    exit;
}

$num_etu = (int) $_GET['id'];

// ✅ Mode JSON pour modification
if (isset($_GET['json']) && $_GET['json'] == 1) {
    ob_clean(); // Efface toute sortie précédente
    header('Content-Type: application/json');

    $stmt = $pdo->prepare("
        SELECT 
            e.num_etu, e.nom_etu, e.prenom_etu, e.dte_nais_etu, e.login_etu, e.statut_etu,
            u.mdp_util,
            i.id_ac,
            i.id_niv_etu
        FROM etudiant e
        JOIN utilisateur u ON u.login_util = e.login_etu
        JOIN inscrire i ON i.num_etu = e.num_etu
        WHERE e.num_etu = ?
        ORDER BY i.dte_insc DESC
        LIMIT 1
    ");
    $stmt->execute([$num_etu]);
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($etudiant ?: ['error' => 'Aucun étudiant trouvé']);
    exit;
}

// ✅ Mode HTML (affichage pour la vue)
$stmt = $pdo->prepare("
    SELECT e.nom_etu, e.prenom_etu, e.dte_nais_etu, e.login_etu, ne.lib_niv_etu
    FROM etudiant e
    JOIN inscrire i ON i.num_etu = e.num_etu
    JOIN niveau_etude ne ON ne.id_niv_etu = i.id_niv_etu
    WHERE e.num_etu = ?
    ORDER BY i.dte_insc DESC
    LIMIT 1
");
$stmt->execute([$num_etu]);
$etu = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?php if ($etu): ?>
<ul class="list-group">
    <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($etu['nom_etu']) ?></li>
    <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($etu['prenom_etu']) ?></li>
    <li class="list-group-item"><strong>Date de naissance :</strong> <?= htmlspecialchars($etu['dte_nais_etu']) ?></li>
    <li class="list-group-item"><strong>Login :</strong> <?= htmlspecialchars($etu['login_etu']) ?></li>
    <li class="list-group-item"><strong>Niveau :</strong> <?= htmlspecialchars($etu['lib_niv_etu']) ?></li>
</ul>
<?php else: ?>
<p class='text-muted'>Aucune information trouvée pour cet étudiant.</p>
<?php endif; ?>
