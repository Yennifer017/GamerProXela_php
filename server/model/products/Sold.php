<?php
class Sold extends Product{
    private int $idSale;
    private int $quantity;
    private int $priceWithDisc;

    public function getIdSale(){
        return $this->idSale;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getPriceWithDisc(): int{
        return $this->priceWithDisc; 
    }


    public function __construct(string $name, $price = 0, int $priceWithDisc = 0, 
        int $quantity, int $id = -1, int $idSale = -1){
        parent::__construct($name, $price, $idSale);
        $this->idSale = $idSale;
        $this->quantity = $quantity;
        $this->priceWithDisc = $priceWithDisc;
    }
    
    
}