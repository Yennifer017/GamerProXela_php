<?php
include("../../../model/products/Product.php");
include("../../../model/users/Worker.php");
include("../../../model/users/Salesperson.php");
include("../../../model/users/Assigned.php");
include("../../../model/DB/AdminConnDB.php");
include("../../../model/DB/CredentialsDB.php");
include("../../../model/usersDB/UserDB.php");
include("../../../model/productsDB/ProductDB.php");
include("../../valitators/ProductValitator.php");
include("../../General/Session.php");
include ("../../../model/DB/Encryptator.php");
include("../../exceptions/InvalidDataEx.php");

$returnPath = '../../../view/admin/createProduct.php';

$session = new Session();
$worker = $session->get_session_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::ADMIN_ROL) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    try {
        $productDB = new ProductDB();
        $product = new Product(-1, $name, $price);
        $productDB->createNew($product, AdminConnDB::getInstance()->getConnection());
        header("Location: $returnPath?e=200");
    } catch (InvalidDataEx $e) {
        header("Location: $returnPath?e=400");
    } catch (PDOException $e) {
        header("Location: $returnPath?e=503");
    } catch (Exception $e) {
        header("Location: $returnPath?e=500");
    }
    exit();
} else {
    echo "Error";
}
?>