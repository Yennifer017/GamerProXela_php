<?php
class SalesRepFormat{

    private $numberFactura;
    private $clientCompletName;
    private $cajeroUsername;
    private $total;
    private $dateExtended;

    public function getNumberFactura(){
        return $this->numberFactura;
    }
    public function getClientCompletName(){
        return $this->clientCompletName;
    }
    public function getCajeroUsername(){
        return $this->cajeroUsername;
    }
    public function getTotal(){
        return $this->total;
    }
    public function getDateExtended(){
        return $this->dateExtended;
    }

    public function __construct(
        $numberFactura, $clientCompletName, $cajeroUsername, $total, $dateExtended
    ){
        $this->numberFactura = $numberFactura;
        $this->clientCompletName = $clientCompletName;
        $this->cajeroUsername = $cajeroUsername;
        $this->total = $total;
        $this->dateExtended = $dateExtended;
    }

    public function getArray(){
        $array = [
            'numberFactura' => $this->numberFactura,
            'clientCompletName'=> $this->clientCompletName,
            'cajeroUsername'=> $this->cajeroUsername,
            'total'=> $this->total,
            'dataExtended'=> $this->dateExtended
        ];
        return $array;
    }
    
}