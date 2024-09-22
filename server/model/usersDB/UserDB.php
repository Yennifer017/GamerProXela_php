<?php
class UserDB {
    private $encryptator;
    private WorkerValitator $workerValitator;

    public function __construct() {
        $this->encryptator = new Encryptator();
        $this->workerValitator = new WorkerValitator();
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
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
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

    /**********************************************
     * ************** CREATES *********************
     * ********************************************/
    public function insertSalesPerson(Salesperson $salesperson, $conn){
        if($this->workerValitator->isSalespersonValid($salesperson)){
            $sql = "SELECT create_salesperson(:username, :pass, :id_sucursal, :no_checkout);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $salesperson->getUsername());
            $stmt->bindValue(':pass', $this->encryptator->encrypt($salesperson));
            $stmt->bindValue(':id_sucursal', $salesperson->getIdSucursal());
            $stmt->bindValue(':no_checkout', $salesperson->getNoCheckout());
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            } 
        } else {
            throw new InvalidDataEx("Datos invalidos");
        }
    }

    public function insertAssignedWorker(Assigned $assigned, $conn){
        if($this->workerValitator->isAssignedValid($assigned)){
            $sql = "SELECT create_assigned(:username, :pass, :rol, :id_sucursal);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $assigned->getUsername());
            $stmt->bindValue(':pass', $this->encryptator->encrypt($assigned));
            $stmt->bindValue(':rol', $assigned->getRol());
            $stmt->bindValue(':id_sucursal', $assigned->getIdSucursal());
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            } 
        } else {
            throw new InvalidDataEx("Datos invalidos");
        }
    }

}