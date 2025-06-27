<?php
/**
 * Fonctions utilitaires pour l'application
 */

/**
 * Échapper une chaîne pour éviter les injections XSS
 * @param string $str Chaîne à échapper
 * @return string Chaîne échappée
 */
function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Générer un jeton CSRF
 * @return string Jeton CSRF
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifier un jeton CSRF
 * @param string $token Jeton CSRF à vérifier
 * @return bool True si le jeton est valide, false sinon
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Rediriger vers une URL
 * @param string $url URL de redirection
 */
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

/**
 * Afficher un message flash
 * @param string $message Message à afficher
 * @param string $type Type de message (success, danger, warning, info)
 */
function set_flash_message($message, $type = 'info') {
    $_SESSION['flash_message'] = [
        'message' => $message,
        'type' => $type
    ];
}

/**
 * Récupérer le message flash et le supprimer de la session
 * @return array|null Message flash ou null s'il n'y en a pas
 */
function get_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $flash;
    }
    return null;
}

/**
 * Formater une date
 * @param string $date Date à formater (format MySQL)
 * @param string $format Format de sortie (par défaut : d/m/Y)
 * @return string Date formatée
 */
function format_date($date, $format = 'd/m/Y') {
    $dt = new DateTime($date);
    return $dt->format($format);
}

/**
 * Vérifier si une chaîne est un email valide
 * @param string $email Email à vérifier
 * @return bool True si l'email est valide, false sinon
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Générer un mot de passe aléatoire
 * @param int $length Longueur du mot de passe
 * @return string Mot de passe généré
 */
function generate_password($length = 12) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?';
    $password = '';
    $max = strlen($chars) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, $max)];
    }
    
    return $password;
}

/**
 * Vérifier si un fichier a une extension autorisée
 * @param string $filename Nom du fichier
 * @param array $allowedExtensions Extensions autorisées
 * @return bool True si l'extension est autorisée, false sinon
 */
function has_allowed_extension($filename, $allowedExtensions = ['pdf', 'doc', 'docx']) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $allowedExtensions);
}

/**
 * Tronquer un texte à une longueur donnée
 * @param string $text Texte à tronquer
 * @param int $length Longueur maximale
 * @param string $append Texte à ajouter à la fin si tronqué
 * @return string Texte tronqué
 */
function truncate($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    
    return $text . $append;
}

/**
 * Envoyer un email
 * @param string $to Adresse email du destinataire
 * @param string $subject Sujet de l'email
 * @param string $message Corps de l'email
 * @param array $headers En-têtes supplémentaires
 * @return bool True si l'email a été envoyé, false sinon
 */
function send_email($to, $subject, $message, $headers = []) {
    // Implémenter l'envoi d'email (PHPMailer ou mail() de PHP)
    // Cette implémentation dépendra de votre serveur
    
    // Exemple simple avec mail() (à améliorer avec PHPMailer en production)
    $defaultHeaders = [
        'From' => MAIL_FROM_NAME . ' <' . MAIL_FROM . '>',
        'Content-Type' => 'text/html; charset=UTF-8'
    ];
    
    $headers = array_merge($defaultHeaders, $headers);
    $headerStr = '';
    
    foreach ($headers as $key => $value) {
        $headerStr .= $key . ': ' . $value . "\r\n";
    }
    
    return mail($to, $subject, $message, $headerStr);
}
?>




