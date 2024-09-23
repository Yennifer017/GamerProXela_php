<?php
class ProductDB {

    private ProductValitator $valitator;

    public function __construct() {
        $this->valitator = new ProductValitator();
    }
  
    public function addInStock(Stock $stockProduct,  $conn) {
        if($this->valitator->isValidInStock($stockProduct)) {
            $sql = "SELECT storage.add_product_stock(:id_sucursal, :id_product, :hall, :existences);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id_sucursal", $stockProduct->getIdSucursal());
            $stmt->bindValue(":id_product", $stockProduct->getId());
            $stmt->bindValue(":hall", $stockProduct->getHall());
            $stmt->bindValue(":existences", $stockProduct->getExistences());
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            } 
        } else {
            throw new InvalidDataEx();
        }
    }

    public function transferToInventary(Stock $stockProduct,  $conn){
        if($this->valitator->isValidToTransfer($stockProduct)) {
            $sql = "SELECT storage.transfer_to_inventary(:id_sucursal, :id_product, :existences);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id_sucursal", $stockProduct->getIdSucursal());
            $stmt->bindValue(":id_product", $stockProduct->getId());
            $stmt->bindValue(":existences", $stockProduct->getExistences());
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            } 
        } else {
            throw new InvalidDataEx();
        }
    }

    public function getProduct(Stock $stockProduct, $conn){
        if($this->valitator->isIntegerPositive($stockProduct->getId())
            && $this->valitator->isIntegerPositive($stockProduct->getIdSucursal())
        ) {
            $sql = "SELECT * FROM storage.find_stock_product(:id_product, :id_sucursal);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id_product", $stockProduct->getId());
            $stmt->bindValue(":id_sucursal", $stockProduct->getIdSucursal());
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $stockProduct->setName($result["product_name"]);
                $stockProduct->setHall($result["hall"]);
                $stockProduct->setExistences($result["existences"]);
                return $stockProduct;
            } else {
                throw new NoDataFoundEx();
            }
        } else {
            throw new InvalidDataEx();
        }
    }

}