<?php
/**
 * Fichier d'initialisation de l'application
 * À inclure au début de chaque page
 */

// Démarrer la session
session_start();

// Inclure la configuration
require_once __DIR__ . '/config.php';

// Inclure la classe Database
require_once __DIR__ . '/config/Database.php';

// Inclure les fonctions utilitaires
require_once __DIR__ . '/includes/functions.php';

// Vérifier si l'utilisateur est connecté
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Vérifier si l'utilisateur a un rôle spécifique
function has_role($role) {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role;
}

// Rediriger si l'utilisateur n'est pas connecté
function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . 'login.php');
        exit;
    }
}

// Rediriger si l'utilisateur n'a pas le rôle requis
function require_role($role) {
    require_login();
    if (!has_role($role)) {
        header('Location: ' . BASE_URL . 'access_denied.php');
        exit;
    }
}

// Obtenir l'objet PDO
function get_db() {
    return Database::getInstance()->getConnection();
}
?>
