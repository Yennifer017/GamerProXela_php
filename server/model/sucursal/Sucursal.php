<?php
class Sucursal{

    private $id;
    private $name;
    private $accumulated;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
    public function setAccumulated($accumulated){
        $this->accumulated = $accumulated;
    }
    public function getAccumulated(){
        return $this->accumulated;
    }

    public function __construct($id, $name, $accumulated){
        $this->id = $id;
        $this->name = $name;
        $this->accumulated = $accumulated;
    }
    
}