<?php
class Sold extends Product{
    private int $idSale;
    private int $quantity;
    private $priceWithDisc;

    private $totalWithoutDiscount;
    private $totalWithDiscount;

    public function getIdSale(){
        return $this->idSale;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getPriceWithDisc(){
        return $this->priceWithDisc; 
    }
    public function getTotalWithoutDiscount(){
        return $this->totalWithoutDiscount;
    }
    public function getTotalWithDiscount(){
        return $this->totalWithDiscount;
    }
    public function setTotalWithoutDiscount($totalWithoutDiscount){
        $this->totalWithoutDiscount = $totalWithoutDiscount;
    }
    public function setTotalWithDiscount($totalWithDiscount){
        $this->totalWithDiscount = $totalWithDiscount;
    }
    
    public function __construct(string $name, $price = 0, $priceWithDisc = 0, 
        int $quantity, int $id = -1, int $idSale = -1){
        parent::__construct($id, $name, $price);
        $this->idSale = $idSale;
        $this->quantity = $quantity;
        $this->priceWithDisc = $priceWithDisc;
    }
    
    
}