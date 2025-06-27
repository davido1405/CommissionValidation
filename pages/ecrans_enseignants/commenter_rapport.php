<?php
require_once '../config/db.php'
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_util'])) {
    header("Location: ../login.php");
    exit;
}
;

$idRapport = $_GET['id'] ?? null;
$idEns = $_SESSION['id_ens'] ?? null;

if (!$idRapport || !$idEns) {
    $_SESSION['error'] = "Paramètres manquants.";
    header("Location: enseignant.php");
    exit;
}
?>

<!-- Formulaire HTML -->
<form action="traiter_commentaire.php" method="post">
    <input type="hidden" name="id_rapport" value="<?= htmlspecialchars($idRapport) ?>">
    <label for="commentaire">Commentaire :</label><br>
    <textarea name="commentaire" id="commentaire" rows="5" required></textarea><br>
    <button type="submit">Envoyer</button>
</form>
