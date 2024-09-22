<?php
include("../../../model/clients/Client.php");
include("../../../model/users/Worker.php");
include("../../../model/users/Salesperson.php");
include("../../../model/users/Assigned.php");
include("../../../model/DB/AdminConnDB.php");
include("../../../model/DB/CredentialsDB.php");
include("../../../model/usersDB/UserDB.php");
include("../../valitators/WorkerValitator.php");
include("../../General/Session.php");
include ("../../../model/DB/Encryptator.php");

$returnPath = '../../../view/admin/workersView.php';

$session = new Session();
$worker = $session->get_session_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::ADMIN_ROL) {
    // Obtener los datos del formulario
    $type = $_POST['type'];
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $sucursal = $_POST['sucursal'] ?? -1;
    $checkout = $_POST['checkout'] ?? -1;
    try {
        $userDB = new UserDB();
        switch ($type) {
            case Worker::SALESPERSON_ROL:
                $salesperson = new Salesperson($username, $password, -1, $sucursal, $checkout);
                $userDB->insertSalesPerson($salesperson, AdminConnDB::getInstance()->getConnection());
                break;
            case Worker::STOCK_ROL:
            case Worker::INVENTARY_ROL:
                $assigned = new Assigned($username, $password, -1, $type, $sucursal);
                $userDB->insertAssignedWorker($assigned, AdminConnDB::getInstance()->getConnection());
                break;
            default:
                header("Location: $returnPath?e=400");
                break;
        }
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