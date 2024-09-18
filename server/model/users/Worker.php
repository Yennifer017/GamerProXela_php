<?php

class Worker {
    const ADMIN_ROL = 'admin';
    const SALESPERSON_ROL = 'cajero';
    const STOCK_ROL = 'bodega';
    const INVENTARY_ROL = 'inventario';


    protected $id;
    protected $rol;
    protected $username;
    protected $password;

    public function getId() {
        return $this->id;
    }
    
    public function getRol(){
        return $this->rol;
    }

    public function getUsername(){ 
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }
    
    public function __construct(string $username = null, string $password = null, int $id = -1, string $rol = null) {
        $this->id = $id;
        $this->rol = $rol;
        $this->username = $username;
        $this->password = $password;
    }
    
}

?>
