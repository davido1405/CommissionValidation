<?php
require_once '../../config/db.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';
switch ($action) {
    case 'list':
        $res = $pdo->query("SELECT * FROM niveau_etude ORDER BY ordre ASC")->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($res);
        break;

    case 'get':
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM niveau_etude WHERE id_niveau = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        break;

    case 'create':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO niveau_etude (code, lib_niv_etu, cycle, duree, credits, ordre, description, prerequis, actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['code'], $data['lib_niv_etu'], $data['cycle'], $data['duree'], $data['credits'],
            $data['ordre'], $data['description'], $data['prerequis'], $data['actif']
        ]);
        echo json_encode(['success' => true]);
        break;

    case 'delete':
        $id = $_GET['id'] ?? 0;
        $pdo->prepare("DELETE FROM niveau_etude WHERE id_niveau = ?")->execute([$id]);
        echo json_encode(['success' => true]);
        break;

    // ... autres cas: update, specializations, etc.

    default:
        echo json_encode(['error' => 'Invalid action']);
}
