<?php
include("../../../model/users/Worker.php");
include("../../../model/users/Assigned.php");
include("../../../model/DB/CredentialsDB.php");
include("../../../model/usersDB/UserDB.php");
include("../../../model/DB/InventaryConnDB.php");
include("../../../model/products/Product.php");
include("../../../model/products/Stock.php");
include("../../../model/productsDB/ProductDB.php");
include("../../valitators/ProductValitator.php");
include("../../General/Session.php");
include("../../exceptions/InvalidDataEx.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$returnPath = '../../../view/inventary/dashboard.php';

$session = new Session();
$worker = $session->get_session_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::INVENTARY_ROL) {
    $idProduct = $_POST['id'] ?? -1;
    $hall = $_POST['hall'] ?? -1;
    $existences =  $_POST['existences'] ?? -1;

    try {
        $stockProduct = new Stock($idProduct, $worker->getIdSucursal(), $hall, $existences);
        $productDB = new ProductDB();
        $productDB->transferToInventary($stockProduct, InventaryConnDB::getInstance()->getConnection());
        header("Location: $returnPath?e=200");
    } catch (InvalidDataEx $e) {
        echo $e->getMessage();
        //header("Location: $returnPath?e=400");
    } catch (PDOException $e) {
        echo $e->getMessage();
        //header("Location: $returnPath?e=416");
    } catch (Exception $e) {
        //header("Location: $returnPath?e=500");
    }
    //exit();
} else {
    echo "Error";
}
?>