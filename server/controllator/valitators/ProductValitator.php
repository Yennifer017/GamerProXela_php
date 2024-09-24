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

    public function isIntegerPositive($number){
        return is_int($number) && $number > 0;
    }

    public function isValidToInsert(Product $product){
        return $product->getName() != ''
            && $product->getPrice() >= 0;
    }

}