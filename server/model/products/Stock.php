<?php
class Stock extends Product{
    private int $idSucursal;
    private int $hall;
    private int $existences;

    public function getIdSucursal(): int{
        return $this->idSucursal;
    }
    public function getHall(): int{
        return $this->hall;
    }
    public function getExistences(): int{
        return $this->existences;
    }

    public function setIdSucursal(int $idSucursal){
        $this->idSucursal = $idSucursal;
    }
    public function setHall(int $hall){
        $this->hall = $hall;
    }
    public function setExistences(int $existences){
        $this->existences = $existences;
    }

    public function __construct(int $id, int $idSucursal, int $hall, int $existences){
        $this->id = $id;
        $this->idSucursal = $idSucursal;
        $this->hall = $hall;
        $this->existences = $existences;
    }
    
}