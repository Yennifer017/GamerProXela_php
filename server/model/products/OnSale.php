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

    public function __construct(int $id = -1, string $name = '', $price = 0, $discount = 0, int $existences = 0){
        $this->existences = $existences;
        $this->name = $name;
        $this->price = $price;
        $this->discount = $discount;
        $this->id = $id;
        $this->idSucursal = -1;
    }

    public function toJSON(){
        $simpleProduct = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'idSucursal' => $this->idSucursal,
            'existences'=> $this->existences
        ];
        return json_encode($simpleProduct);
    }
    
    
}