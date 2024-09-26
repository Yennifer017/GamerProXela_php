<?php
class SalesDB {

    public function createSale($idsProducts, $quantities, $nit, SalesPerson $worker, $conn) {
        $ids_products_pg = '{' . implode(',', $idsProducts) . '}';
        $quantities_pg = '{' . implode(',', $quantities) . '}';
        $stmt = $conn->prepare("SELECT business.save_sale(:id_client, :id_sucursal, :id_cajero, :ids_products, :quantities)");
        if($nit == ''){
            $nit = NULL;
        }
        $stmt->bindParam(':id_client', $nit);
        $stmt->bindValue(':id_sucursal', $worker->getIdSucursal());
        $stmt->bindValue(':id_cajero', $worker->getId());
        $stmt->bindParam(':ids_products', $ids_products_pg);
        $stmt->bindParam(':quantities', $quantities_pg);
    
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $new_sale_id = $result['save_sale'];
            return $new_sale_id;
        } else {
            throw new NoDataFoundEx();
        }
    }

    public function getSale($id, $conn){
        $sql = 'SELECT * FROM business.get_general_factura(:id_factura);';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_factura', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $compleateClientName = 'c/f';
            if($result['client_name'] !=  null){
                $compleateClientName = $result['client_name'] . $result['client_lastname'];
            }
            $details = $this->getDetailsSale($id, $conn);
            $sale = new Sale(
                (int) $result['numero_factura'], 
                $compleateClientName, 
                $result['cajero_username'], 
                $result['subtotal'], 
                $result['total'], 
                $details
            );
            return $sale;
        } else {
            throw new NoDataFoundEx();
        }
    }

    private function getDetailsSale($id, $conn){
        $id = (int) $id;
        $sql = 'SELECT * FROM business.get_details_factura(:id_factura);';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_factura', $id);
        $stmt->execute();
        $details =[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $currentProduct = new Sold(
                $row['product_name'], 
                $row['current_price'],
                $row['price_with_discount'],
                (int) $row['quantity'],
                (int) $row['id_product'],
                $id
            );
            $currentProduct->setTotalWithDiscount($row['total_with_discount']);
            $currentProduct->setTotalWithoutDiscount($row['total_without_discount']);
            $details[] = $currentProduct;
        }
        return $details;
    }

}