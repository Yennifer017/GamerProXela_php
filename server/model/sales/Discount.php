<?php
class Discount {
    private $id;
    private $idProduct;
    private $percentaje;
    private $dateInit;
    private $dateEnd;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getIdProduct(){
        return $this->idProduct;
    }
    public function setIdProduct($idProduct){
        $this->idProduct = $idProduct;
    }
    public function getPercentaje(){
        return $this->percentaje;
    }
    public function setPercentaje($percentaje){
        $this->percentaje = $percentaje;
    }
    public function getDateInit(){
        return $this->dateInit;
    }
    public function setDateInit($dateInit){
        $this->dateInit = $dateInit;
    }
    public function getDateEnd(){
        return $this->dateEnd;
    }
    public function setDateEnd($dateEnd){
        $this->dateEnd = $dateEnd;
    }
    
    public function __construct($id, $idProduct, $percentaje, $dateInit, $dateEnd) {
        $this->id = $id;
        $this->idProduct = $idProduct;
        $this->percentaje = $percentaje;
        $this->dateInit = $dateInit;
        $this->dateEnd = $dateEnd;
    }

}