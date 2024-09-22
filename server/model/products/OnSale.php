<?php
class OnSale extends Product{
    private int $idSucursal;
    private int $existences;

    public function getIdSucursal(): int{
        return $this->idSucursal;
    }
    public function getExistences(): int{
        return $this->existences;
    }

    public function setIdSucursal(int $idSucursal){
        $this->idSucursal = $idSucursal;
    }
    public function setExistences(int $existences){
        $this->existences = $existences;
    }

    public function __construct(int $id = -1, string $name, $price = 0, $discount = 0, int $existences = 0){
        $this->existences = $existences;
        $this->idSucursal = $id;
        $this->name = $name;
        $this->price = $price;
        $this->discount = $discount;
    }
    
    
}