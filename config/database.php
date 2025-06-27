<?php
/**
 * Classe de connexion à la base de données
 * Utilise le pattern Singleton pour assurer une seule connexion
 */
class Database {
    private static $instance = null;
    private $conn;
    
    /**
     * Constructeur privé - empêche l'instanciation directe
     */
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, DB_OPTIONS);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    
    /**
     * Méthode pour obtenir l'instance unique de la classe
     * @return Database L'instance unique de la classe
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Méthode pour obtenir l'objet PDO
     * @return PDO L'objet PDO
     */
    public function getConnection() {
        return $this->conn;
    }
    
    /**
     * Exécute une requête et retourne un tableau associatif
     * @param string $query Requête SQL
     * @param array $params Paramètres de la requête
     * @return array Résultats de la requête
     */
    public function select($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
    }
    
    /**
     * Exécute une requête qui modifie la base de données (INSERT, UPDATE, DELETE)
     * @param string $query Requête SQL
     * @param array $params Paramètres de la requête
     * @return int Nombre de lignes affectées
     */
    public function execute($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
    }
    
    /**
     * Retourne l'ID de la dernière ligne insérée
     * @return string ID de la dernière ligne insérée
     */
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
    
    /**
     * Démarre une transaction
     */
    public function beginTransaction() {
        $this->conn->beginTransaction();
    }
    
    /**
     * Valide une transaction
     */
    public function commit() {
        $this->conn->commit();
    }
    
    /**
     * Annule une transaction
     */
    public function rollback() {
        $this->conn->rollBack();
    }
}
?>
