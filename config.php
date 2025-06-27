<?php
/**
 * Configuration de la base de données
 * Système de gestion des soutenances universitaires
 */

// Informations de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'comvalidation');
define('DB_USER', 'root');         // À modifier selon votre configuration
define('DB_PASS', '');             // À modifier selon votre configuration

// Options de connexion PDO
define('DB_CHARSET', 'utf8mb4');
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

// URL de base de l'application
define('BASE_URL', 'http://localhost/commission2/'); // À ajuster selon votre installation

// Constantes pour les rôles d'utilisateurs
define('ROLE_ADMIN', 1);
define('ROLE_ENSEIGNANT', 2);
define('ROLE_ETUDIANT', 3);
define('ROLE_COMMISSION', 4);

// Configuration des dossiers
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('RAPPORTS_DIR', UPLOAD_DIR . 'rapports/');
define('MAX_FILE_SIZE', 20 * 1024 * 1024); // 20 MB

// Configuration email (à compléter selon votre serveur mail)
define('MAIL_HOST', 'smtp.example.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'commission@example.com');
define('MAIL_PASSWORD', 'votre_mot_de_passe');
define('MAIL_FROM', 'commission@example.com');
define('MAIL_FROM_NAME', 'Commission de validation');

// Fuseau horaire
date_default_timezone_set('Africa/Abidjan');
?>
