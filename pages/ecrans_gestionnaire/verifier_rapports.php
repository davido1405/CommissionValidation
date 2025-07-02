<?php
require_once (__DIR__ . '/../../config/db.php');
if (session_status() === PHP_SESSION_NONE) session_start();
header('Content-Type: application/json');

try {
    // Requêtes des rapports non encore approuvés et déposés il y a plus de 7 jours
    $stmt = $pdo->query("
        SELECT r.id_rapport, r.num_etu, r.titre, r.date_rapport, e.nom, e.prenoms
        FROM rapport_etudiant r
        JOIN etudiant e ON r.num_etu = e.num_etu
        LEFT JOIN approuver a ON r.id_rapport = a.id_rapport
        WHERE a.id_rapport IS NULL
        AND r.date_rapport <= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    ");
    $rapports = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rapports);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur : ' . $e->getMessage()]);
}


// Connecte à la BD déjà fait plus haut

// Rapport en attente
$req = $pdo->query("SELECT COUNT(*) FROM rapport_etudiant WHERE etat_validation = 'en_attente'");
$nbEnAttente = (int) $req->fetchColumn();

// Rapport urgents (> 7 jours sans validation)
$req = $pdo->query("SELECT COUNT(*) FROM rapport_etudiant WHERE etat_validation = 'en_attente' AND DATEDIFF(NOW(), date_depot) > 7");
$nbUrgents = (int) $req->fetchColumn();

// En cours d'examen
$req = $pdo->query("SELECT COUNT(*) FROM rapport_etudiant WHERE etat_validation = 'en_cours'");
$nbEnCours = (int) $req->fetchColumn();

// Validés aujourd'hui
$req = $pdo->query("SELECT COUNT(*) FROM rapport_etudiant WHERE etat_validation = 'valide' AND DATE(date_validation) = CURDATE()");
$nbValidesToday = (int) $req->fetchColumn();

// Validés hier (pour la tendance)
$req = $pdo->query("SELECT COUNT(*) FROM rapport_etudiant WHERE etat_validation = 'valide' AND DATE(date_validation) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
$nbValidesHier = (int) $req->fetchColumn();

$diffValides = $nbValidesToday - $nbValidesHier;
$trendIcon = $diffValides >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
$trendColor = $diffValides >= 0 ? 'text-success' : 'text-danger';

// Nécessitent révision (état personnalisé, à adapter si autre champ existe)
$req = $pdo->query("SELECT COUNT(*) FROM rapport_etudiant WHERE etat_validation = 'a_reviser'");
$nbAReviser = (int) $req->fetchColumn();


// Pour l'alerte
$nb_rapports_urgents = $pdo->query("
    SELECT COUNT(*) 
    FROM rapport_etudiant r
    JOIN valider v ON r.id_rapport = v.id_rapport
    WHERE v.etat_valide = 'en attente'
    AND DATEDIFF(CURDATE(), r.dte_rapport) > 7
")->fetchColumn();

?>
