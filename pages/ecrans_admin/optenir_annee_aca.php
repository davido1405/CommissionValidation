<?php
require_once(__DIR__ . '/../../config/db.php');
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("
        SELECT id_ac, dte_deb, dte_fin,
               CONCAT(YEAR(dte_deb), '-', YEAR(dte_fin)) AS lib_ac,
               DATEDIFF(dte_fin, dte_deb) + 1 AS duree
        FROM annee_academique
        ORDER BY dte_deb DESC
    ");

    $years = [];
    $today = new DateTime();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $date_deb = new DateTime($row['dte_deb']);
        $date_fin = new DateTime($row['dte_fin']);

        $row['statut'] = ($today < $date_deb) ? 'à venir' :
                         (($today >= $date_deb && $today <= $date_fin) ? 'en cours' : 'clôturée');

        $interval_total = $date_deb->diff($date_fin)->days + 1;
        $interval_ecoule = max(0, $date_deb->diff($today)->days);
        $row['progress'] = min(100, round(($interval_ecoule / $interval_total) * 100));
        $row['jours_ecoules'] = $interval_ecoule;
        $row['jours_restants'] = max(0, $interval_total - $interval_ecoule);

        // Données simulées
        $row['inscrits'] = rand(350, 600); // à remplacer par une requête réelle
        $years[] = $row;
    }

    echo json_encode(['status' => 'success', 'years' => $years]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
