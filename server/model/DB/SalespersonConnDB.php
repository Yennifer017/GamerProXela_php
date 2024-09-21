<?php
    class SalespersonConnDB {
        private static $instance = null;
        private $conn = null;
        private $host = CredentialsDB::DB_HOST;
        private $dbname = CredentialsDB::DB_NAME;
        private $username = CredentialsDB::CREDENTIALS['SALESPERSON']['username'];
        private $password = CredentialsDB::CREDENTIALS['SALESPERSON']['password'];
    
        private function __construct() {
            try {
                $dsn = "pgsql:host=$this->host;dbname=$this->dbname";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error en la conexión: " . $e->getMessage();
            }
        }
    
        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new SalespersonConnDB();
            }
            return self::$instance;
        }
    
        public function getConnection() {
            return $this->conn;
        }
    }
?>