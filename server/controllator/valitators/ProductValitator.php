<?php
class ProductValitator {
  
    public function isValidInStock(Stock $stockProd) {
        return $this->isIntegerPositive($stockProd->getIdSucursal())
            && $this->isIntegerPositive($stockProd->getId())
            && $this->isIntegerPositive($stockProd->getHall())
            && $this->isIntegerPositive($stockProd->getExistences());
    }

    public function isValidToTransfer(Stock $stockProd){
        return $this->isIntegerPositive($stockProd->getIdSucursal())
            && $this->isIntegerPositive($stockProd->getId())
            && $this->isIntegerPositive($stockProd->getExistences());
    }

    private function isIntegerPositive($number){
        return is_int($number) && $number > 0;
    }

}