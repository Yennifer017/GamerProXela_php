<?php
include("../../../model/clients/Client.php");
include("../../../model/users/Worker.php");
include("../../../model/users/Salesperson.php");
include("../../../model/DB/SalespersonConnDB.php");
include("../../../model/DB/CredentialsDB.php");
include("../../../model/salesDB/SalesDB.php");
include("../../../model/sales/Sale.php");
include("../../../model/products/Product.php");
include("../../../model/products/Sold.php");
include("../../../model/usersDB/ClientDB.php");
include("../../valitators/ClientValitator.php");
include("../../General/Session.php");
include("../../exceptions/InvalidDataEx.php");
include("../../exceptions/NoDataFoundEx.php");

error_reporting(E_ALL);
ini_set('display_errors', value: 1);
ini_set('display_startup_errors', 1);

$session = new Session();
$worker = $session->get_session_data();
$returnPath = '../../../view/salespersons/dashboard.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::SALESPERSON_ROL) {
    if (isset($_POST['id']) && isset($_POST['quantity'])) {
        
        $nit = $_POST['nit'];
        $ids = $_POST['id']; // Array de IDs
        $quantities = $_POST['quantity']; // Array de cantidades
        try {
            $salesDB = new SalesDB();
            $factura = $salesDB->createSale(
                $ids, 
                $quantities, 
                $nit, $worker, 
                SalespersonConnDB::getInstance()->getConnection()
            );
            echo "exito";
            header("Location: ../../../view/salespersons/viewFactura.php?id=$factura");
            exit();
        } catch (InvalidDataEx $e) {
            header("Location: $returnPath?e=400");
            exit();
        } catch (NoDataFoundEx $e) {
            header("Location: $returnPath?e=417");
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            header("Location: $returnPath?e=400");
            exit();
        }
    } else {
        header("Location: $returnPath?e=406");
        exit();
    }
} else {
    echo "Error";
    header("Location: $returnPath?e=500");
    exit();
}
?>