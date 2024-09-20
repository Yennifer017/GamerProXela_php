<?php
include ("../../model/DB/Encryptator.php");
class UserDB {
    private $encryptator;

    public function __construct() {
        $this->encryptator = new Encryptator();
    }

    public function recoverBasic(Worker $worker, $guestConn) {
        try {
            $sql = 'SELECT id, rol FROM administrative.worker WHERE username = :username AND password = :pass LIMIT 1';
            $username = $worker->getUsername();
            $encryptedPassword = $this->encryptator->encrypt($worker);

            $stmt = $guestConn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $encryptedPassword);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $worker->setRol($result['rol']);
                $worker->setId($result['id']);
                $worker->setPassword('');
                return $worker;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function recoverExtendData(){
        
    }

    public function recoverSucursalData(){
        
    }

}