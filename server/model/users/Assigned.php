<?php
class Assigned extends Worker{

    private $idSucursal;

    public function getIdSucursal(){
        return $this->idSucursal;
    }
    
    public function __construct(string $username = null, string $password = null, 
            int $id = -1, string $rol = null, int $idSucursal = -1) {
        $this->id = $id;
        $this->rol = $rol;
        $this->username = $username;
        $this->password = $password;
        $this->idSucursal = $idSucursal;
    }
    
}