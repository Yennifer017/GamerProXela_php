<?php
class UserDB {
    private $conn = null;

    public function __construct($conn = null) {
        $this->conn = $conn;
    }

    public function recoverRol(Worker $worker) {
        $sql = 'SELECT rol FROM administrative.worker WHERE username = ? AND password = ? LIMIT 1';
        $result = pg_query($this->conn, $sql);
        if (!$result) {
            echo "no se obtuvo nada";
            return null;
        } else {
            $row = pg_fetch_assoc($result);
            return $row['rol'];
        }
    }

    public function setConn($conn){
        $this->conn = $conn;
    }
}