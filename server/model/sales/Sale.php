<?php
class Sale {
    private $id;
    private $nameClient;
    private $cajeroUsername;
    private $subtotal;
    private $total;
    private $details;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNameClient(){
        return $this->nameClient;
    }
    public function setNameClient($nameClient){
        $this->nameClient = $nameClient;
    }
    public function getCajeroUsername(){
        return $this->cajeroUsername;
    }
    public function setCajeroUsername($cajeroUsername){
        $this->cajeroUsername = $cajeroUsername;
    }
    public function getTotal(){
        return $this->total;
    }
    public function setTotal($total){
        $this->total = $total;
    }
    public function getSubtotal(){
        return $this->subtotal;
    }
    public function setSubtotal($subtotal){
        $this->subtotal = $subtotal;
    }
    public function getDetails(){
        return $this->details;
    }
    public function setDetails($details){
        $this->details = $details;
    }

    public function __construct($id, $nameClient, $cajeroUsername, $subtotal, $total, $details){
        $this->id = $id;
        $this->nameClient = $nameClient;
        $this->cajeroUsername = $cajeroUsername;
        $this->subtotal = $subtotal;
        $this->total = $total;
        $this->details = $details;
    }

}