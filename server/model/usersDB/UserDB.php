<?php
include ("../../model/DB/Encryptator.php");
class UserDB {
    private $conn = null;
    private $encryptator;

    public function __construct($conn = null) {
        $this->conn = $conn;
        $this->encryptator = new Encryptator();
    }

    public function recoverRol(Worker $worker) {
        try {
            $sql = 'SELECT rol FROM administrative.worker WHERE username = :username AND password = :pass LIMIT 1';
            $username = $worker->getUsername();
            $encryptedPassword = $this->encryptator->encrypt($worker);

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $encryptedPassword);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['rol'];
            } else {
                return '';
            }
        } catch (PDOException $e) {
            return '';
        }
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
}