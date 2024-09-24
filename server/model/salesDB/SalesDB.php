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


}