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
include("../../../model/salesDB/DiscountDB.php");
include("../../../model/sales/Discount.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$returnPath = '../../../view/admin/addDiscount.php';

$session = new Session();
$worker = $session->get_session_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::ADMIN_ROL) {
    $idProduct = $_POST['idProduct'];
    $dateInit = $_POST['dateInit'];
    $dateEnd = $_POST['dateEnd'];
    $percentaje = $_POST['percentaje'];

    try {
        $discountDB = new DiscountDB();
        $discount = new Discount(
            -1,
            $idProduct,
            $percentaje,
            $dateInit,
            $dateEnd
        );
        $discountDB->create($discount, AdminConnDB::getInstance()->getConnection());
        header("Location: $returnPath?e=200");
    } catch (InvalidDataEx $e) {
        header("Location: $returnPath?e=400");
    } catch (PDOException $e) {
        header("Location: $returnPath?e=503");
        echo $e->getMessage();
    } catch (Exception $e) {
        header("Location: $returnPath?e=500");
    }
    exit();
} else {
    echo "Error";
}
?>