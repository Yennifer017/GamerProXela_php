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

    public function getOnSaleProduct(OnSale $product, $conn ){
        if($this->valitator->isIntegerPositive($product->getId())
        && $this->valitator->isIntegerPositive($product->getIdSucursal())
        ){
            $sql = "SELECT * FROM storage.find_on_sale_product(:id_product, :id_sucursal);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id_product", $product->getId());
            $stmt->bindValue(":id_sucursal", $product->getIdSucursal());
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $product->setName($result["name"]);
                $product->setPrice($result["price"]);
                $product->setExistences($result["existences"]);
                $discount = $result["discount"] ?? 0;
                $product->setDiscount($discount);
                return $product;
            } else {
                throw new NoDataFoundEx();
            }
        } else {
            throw new InvalidDataEx();
        }
    }

    public function createNew(Product $product, $conn){
        if($this->valitator->isValidToInsert($product)){
            $sql = "INSERT INTO business.product(name, price) 
                VALUES (:name_product , :price );";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":name_product", $product->getName());
            $stmt->bindValue(":price", $product->getPrice());
            if (!$stmt->execute()) {
                throw new InvalidDataEx("Datos invalidos");
            }
        } else {
            throw new InvalidDataEx();
        }
    }

    public function searchProduct($name, $conn){
        $sql = "SELECT * FROM business.find_product(:name_param)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":name_param",$name);
        $stmt->execute();
        $products =[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $currentProduct = new OnSale(
                $row['id'], 
                $row['name'], 
                $row['price'], 
                0, 
                $row['existences']
            );
            $currentProduct->setIdSucursal((int) $row['sucursal']);
            $products[] = $currentProduct->toSimpleData();
        }
        return $products;
    }

}