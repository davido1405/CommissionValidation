<?php
require_once '../../config/db.php';
header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;

$stmtGrades = $pdo->prepare("SELECT g.nom_grade, a.date_grade FROM avoir a JOIN grade g ON a.id_grade = g.id_grade WHERE a.id_ens = ? ORDER BY a.date_grade DESC");
$stmtGrades->execute([$id]);
$grades = $stmtGrades->fetchAll(PDO::FETCH_ASSOC);

$stmtFoncts = $pdo->prepare("SELECT f.nom_fonct, o.date_fonction FROM occuper o JOIN fonction f ON o.id_fonct = f.id_fonct WHERE o.id_ens = ? ORDER BY o.date_fonction DESC");
$stmtFoncts->execute([$id]);
$fonctions = $stmtFoncts->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'grades' => $grades,
    'fonctions' => $fonctions
]);
?>