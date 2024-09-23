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

    public function __construct(int $id = -1, int $idSucursal = -1, int $hall = -1, int $existences = -1){
        $this->id = $id;
        $this->idSucursal = $idSucursal;
        $this->hall = $hall;
        $this->existences = $existences;
    }
    
    public function toJSON(){
        $simpleProduct = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'existences' => $this->existences,
            'hall' => $this->hall,
            'sucursal' => $this->idSucursal
        ];
        return json_encode($simpleProduct);
    }
}