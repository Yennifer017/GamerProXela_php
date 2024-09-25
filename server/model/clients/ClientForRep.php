<?php
class ClientForRep extends Client{

    private $gastado;

    public function getGastado(){
        return $this->gastado;
    }
    
    public function __construct(int $nit, string $name, string $lastname, string $email, $gastado) {
        $this->nit = $nit;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->gastado = $gastado;
    }

}
    