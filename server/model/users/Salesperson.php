<?php
class Salesperson extends Worker{

    private $idSucursal;
    private $noCheckout;

    public function getIdSucursal(){
        return $this->idSucursal;
    }

    public function getNoCheckout(){
        return $this->noCheckout;
    }
    
    public function __construct(string $username = null, string $password = null, 
            int $id = -1, int $idSucursal = -1, int $noCheckout) {
        $this->id = $id;
        $this->rol = Worker::SALESPERSON_ROL;
        $this->username = $username;
        $this->password = $password;
        $this->idSucursal = $idSucursal;
        $this->noCheckout = $noCheckout;
    }
    
}