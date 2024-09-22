<?php
class Product{
    protected int $id;
    protected string $name;
    protected $price;
    protected $discount;

    public function getId(): int{
        return $this->id;
    }
    public function getName(): string{
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getDiscount(){
        return $this->discount;
    }
    public function setId(int $id){
        $this->id = $id;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setDiscount(int $discount){
        $this->discount = $discount;
    }
    
    public function __construct($id = -1, string $name =  null, $price = 0, $discount = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->discount = $discount;
    }
    
}