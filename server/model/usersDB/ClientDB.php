<?php
class ClientDB {

    private ClientValitator $valitator;

    public function __construct() {
        $this->valitator = new ClientValitator();
    }
  

    public function addInDB(Client $client, $conn) {
        if($this->valitator->isValid($client)){
            $sql = 'INSERT INTO users.client(id, firstname, lastname, email) 
                VALUES (:nit, :firstname, :lastname, :email );';
            $nit = $client->getNit();
            $name = $client->getName();
            $lastname = $client->getLastname();
            $email = $client->getEmail();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nit', $nit);
            $stmt->bindParam(':firstname', $name);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            } 
        } else {
            throw new InvalidDataEx("Datos invalidos");
        }   
    }

    public function addSolChange(int $idCajero, Client $client, $conn){
        $hasChange = $this->valitator->hasChange($client);
        $isValid = $this->valitator->isValidChange($client);
        if($hasChange && $isValid) {
            $sql = "INSERT INTO users.modification(id_cajero, id_cliente, firstname, lastname, email, status) 
                VALUES (:idCajero, :nit, :firstname, :lastname, :email, 'pendiente');";
            $nit = $client->getNit();
            $name = $client->getName();
            $lastname = $client->getLastname();
            $email = $client->getEmail();

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idCajero', $idCajero);
            $stmt->bindParam(':nit', $nit);
            $stmt->bindValue(':firstname', empty($name) ? '': $name);
            $stmt->bindValue(':lastname', empty($lastname) ? '': $lastname);
            $stmt->bindValue(':email', empty($email) ? '': $email);
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            } 
        } else if(!$hasChange){
            throw new NoChangeEx("No hay cambios presentes");
        } else {
            throw new InvalidDataEx("Datos invalidos");
        }
    }


}