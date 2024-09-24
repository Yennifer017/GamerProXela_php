<?php
class SalesDB {

  
    public function createSale($idsProducts, $quantities, $nit, SalesPerson $worker, $conn) {
        $ids_products_pg = '{' . implode(',', $idsProducts) . '}';
        $quantities_pg = '{' . implode(',', $quantities) . '}';
        $stmt = $conn->prepare("SELECT business.save_sale(:id_client, :id_sucursal, :id_cajero, :ids_products, :quantities)");

        $stmt->bindParam(':id_client', $nit);
        $stmt->bindValue(':id_sucursal', $worker->getIdSucursal());
        $stmt->bindValue(':id_cajero', $worker->getId());
        $stmt->bindParam(':ids_products', $ids_products_pg);
        $stmt->bindParam(':quantities', $quantities_pg);
    
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['id_sale'];
        } else {
            throw new NoDataFoundEx();
        }
    }


}