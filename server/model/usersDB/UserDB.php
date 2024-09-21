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
                $worker->setPassword('Nothing here');
                return $worker;
            } else {
                $worker->setPassword($encryptedPassword);
                return $worker;
                //return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function recoverExtendData(Salesperson $salesPerson, $conn){
        try {
            $sql = 'SELECT id_sucursal, no_checkout FROM administrative.cajero WHERE id_worker = :id LIMIT 1;';
            $id = $salesPerson->getId();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $salesPerson->setIdSucursal($result['id_sucursal']);
                $salesPerson->setNoCheckout($result['no_checkout']);
                return $salesPerson;
                //return "si encontro lo que deberia";
            } else {
                return null;
                //return "NO encontro lo que deberia";
            }
        } catch (PDOException $e) {
            return null;
            //return $e->getMessage();
        }
    }

    public function recoverSucursalData(Assigned $assigned, $conn){
        try {
            $sql = 'SELECT id_sucursal FROM administrative.assigned WHERE id_worker = :id LIMIT 1;';
            $id = $assigned->getId();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $assigned->setIdSucursal($result['id_sucursal']);
                return $assigned;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

}