<?php
class ClientDB {

    private ClientValitator $valitator;

    public function __construct() {
        $this->valitator = new ClientValitator();
    }
  

    public function addInDB(Client $client, $conn) {
        if($this->valitator->isValid($client)){
            $sql = 'INSERT INTO users.client(nit, firstname, lastname, email) 
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


}