<?php 
include ("../../model/usersDB/UserDB.php");
include ("../../model/users/Worker.php");
include ("../../model/DB/UserInDB.php");
include ("../../model/DB/GuestConnDB.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $guestConn = GuestConnDB::getInstance();
    $conn = $guestConn->getConnection();

    if ($conn != null) {
        $userDB = new UserDB($conn);
        $worker = new Worker($username, $password);
        $rol =  $userDB->recoverRol($worker);
        echo $rol;
        switch ($rol) {
            case  Worker::ADMIN_ROL:
                header('Location: ../../view/admin/dashboard.php');
                break;
            case  Worker::INVENTARY_ROL:
                header('Location: ../../view/inventary/dashboard.php');
                break;
            case  Worker::SALESPERSON_ROL:
                header('Location: ../../view/salesperson/dashboard.php');
                break;
            case  Worker::STOCK_ROL:
                header('Location: ../../view/stock/dashboard.php');
                break;
            default:
                header('Location: ../../view/login.php');
                break;
        }
        exit();
    } else {
        header('Location: ../../view/login.php');
        exit();
    }


} else {
    echo "Error";
}
?>