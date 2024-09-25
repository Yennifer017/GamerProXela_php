<?php
class ReportsDB{

    public function getTopProducts($conn){
        $sql = "SELECT * FROM administrative.top_products;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $currentProduct = new Product(
                $row['id_product'], 
                $row['name'], 
                $row['total_vendido']
            );
            $products[] = $currentProduct;
        }
        return $products;
    }

    public function getTopClients($conn){
        $sql = "SELECT * FROM administrative.top_clients;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $clients =[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $currentClient = new ClientForRep(
                $row["id"], 
                $row['firstname'], 
                $row['lastname'], 
                $row['email'],
                $row['total_gastado'],
            );
            $clients[] = $currentClient;
        }
        return $clients;
    }

    public function getTopSucursals($conn){
        $sql = "SELECT * FROM administrative.top_sucursales";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sucursals =[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $currentSucursal = new Sucursal(
                $row['id'], 
                $row['name'], 
                $row['total_ingresado']
            );
            $sucursals[] = $currentSucursal;
        }
        return $sucursals;
    }

    public function getTopSales($init, $end, $conn){
        //ajuste de fechas
        $initDate = new DateTime($init);
        $endDate = new DateTime($end);
        $initDate->setTime(0, 0, 0);
        $endDate->setTime(23, 59, 59);

        $sql = "SELECT * FROM administrative.top_sales(:init_date, :end_date);";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':init_date', $initDate->format('Y-m-d H:i:s'));
        $stmt->bindValue(':end_date', $endDate->format('Y-m-d H:i:s'));

        $stmt->execute();
        $sales =[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $compleateClientName = 'c/f';
            if($row['client_name'] !=  null){
                $compleateClientName = $row['client_name'] . $row['client_lastname'];
            }
            $currentSale = new SalesRepFormat(
                $row['numero_factura'], 
                $compleateClientName,
                $row['cajero_username'], 
                $row['total'], 
                $row['date_extended']
            );
            $sales[] = $currentSale->getArray();
        }
        return $sales;
    }
    
}