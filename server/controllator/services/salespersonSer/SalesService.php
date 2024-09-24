<?php
include("../../../model/clients/Client.php");
include("../../../model/users/Worker.php");
include("../../../model/users/Salesperson.php");
include("../../../model/DB/SalespersonConnDB.php");
include("../../../model/DB/CredentialsDB.php");
include("../../../model/salesDB/SalesDB.php");
include("../../../model/usersDB/ClientDB.php");
include("../../valitators/ClientValitator.php");
include("../../General/Session.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$session = new Session();
$worker = $session->get_session_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::SALESPERSON_ROL) {
    if (isset($_POST['id']) && isset($_POST['quantity'])) {
        $nit = $_POST['nit'];
        $ids = $_POST['id']; // Array de IDs
        $quantities = $_POST['quantity']; // Array de cantidades
        try {
            $salesDB = new SalesDB();
            $salesDB->createSale(
                $ids, 
                $quantities, 
                $nit, $worker, 
                SalespersonConnDB::getInstance()->getConnection()
            );
            echo "exito";
            //header('Location: ../../../view/salespersons/clientsOptions.php?e=200m');
            //exit();
        } catch (InvalidDataEx $e) {
            //header('Location: ../../../view/salespersons/clientsOptions.php?e=400m');
            //exit();
        } catch (NoChangeEx $e) {
            //header('Location: ../../../view/salespersons/clientsOptions.php?e=400m');
            //exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            //header('Location: ../../../view/salespersons/clientsOptions.php?e=503m');
            //exit();
        }
    } else {
        echo "No se han recibido productos.";
    }
} else {
    echo "Error";
}
?>