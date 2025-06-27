<?php
/**
 * Script de test de connexion à la base de données
 * À exécuter pour vérifier que tout fonctionne correctement
 */

// Inclure le fichier d'initialisation
require_once __DIR__ . '/init.php';

echo '<h1>Test de connexion à la base de données</h1>';

try {
    // Obtenir une connexion à la base de données
    $db = get_db();
    
    // Tester la connexion avec une requête simple
    $query = "SELECT 'Connexion réussie !' AS message";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Afficher le résultat
    echo '<div style="color: green; font-weight: bold;">' . $result['message'] . '</div>';
    
    // Tester avec une table de la base de données
    $query = "SHOW TABLES";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Afficher les tables
    echo '<h2>Tables de la base de données</h2>';
    echo '<ul>';
    foreach ($tables as $table) {
        echo '<li>' . $table . '</li>';
    }
    echo '</ul>';
    
    // Tester avec une requête sur une table spécifique
    $query = "SELECT COUNT(*) AS total FROM etudiant";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo '<p>Nombre d\'étudiants dans la base de données : ' . $count['total'] . '</p>';
    
} catch (PDOException $e) {
    // Afficher l'erreur
    echo '<div style="color: red; font-weight: bold;">Erreur de connexion à la base de données : ' . $e->getMessage() . '</div>';
    
    // Afficher des instructions pour résoudre l'erreur
    echo '<h2>Solutions possibles :</h2>';
    echo '<ul>';
    echo '<li>Vérifiez que le serveur MySQL est en cours d\'exécution</li>';
    echo '<li>Vérifiez les informations de connexion dans le fichier config.php</li>';
    echo '<li>Vérifiez que la base de données "bdcov" existe</li>';
    echo '<li>Vérifiez que l\'utilisateur a les droits d\'accès à la base de données</li>';
    echo '</ul>';
}
?>
