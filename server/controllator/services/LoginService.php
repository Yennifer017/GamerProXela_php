<?php 
include ("../../model/usersDB/UserDB.php");
include ("../../model/users/Worker.php");
include ("../../model/users/Assigned.php");
include ("../../model/users/Salesperson.php");
include ("../../model/DB/UserInDB.php");
include ("../../model/DB/CredentialsDB.php");
include ("../../model/DB/GuestConnDB.php");
include ("../../controllator/General/Session.php"); 
include ("../../model/DB/Encryptator.php");
include ("../valitators/WorkerValitator.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $guestConnDB = GuestConnDB::getInstance();
    $guestConn = $guestConnDB->getConnection();
    $session = new Session();

    if ($guestConn != null) {
        $userDB = new UserDB();
        $worker = new Worker($username, $password);
        $worker = $userDB->recoverBasic($worker, $guestConn);
        if ($worker != null) {
            $session->set_cookie(Session::USERNAME_COOKIE_NAME, $worker->getUsername());
            switch ($worker->getRol()) {
                case  Worker::ADMIN_ROL:
                    $session->setSimpleSessionCookie($worker);
                    header('Location: ../../view/admin/dashboard.php');
                    break;
                case  Worker::INVENTARY_ROL:
                    $assigned = new Assigned($worker->getUsername(), null, 
                        $worker->getId(), $worker->getRol());
                    $assigned = $userDB->recoverSucursalData($assigned, $guestConn);
                    $session->setSessionCookie($assigned);
                    header('Location: ../../view/inventary/dashboard.php');
                    break;
                case  Worker::SALESPERSON_ROL:
                    $salesperson = new Salesperson($worker->getUsername(), null, $worker->getId());
                    $salesperson = $userDB->recoverExtendData($salesperson, $guestConn);
                    $session->setAllSessionCookie($salesperson);
                    header('Location: ../../view/salespersons/dashboard.php');
                    break;
                case  Worker::STOCK_ROL:
                    $assigned = new Assigned($worker->getUsername(), null, 
                        $worker->getId(), $worker->getRol());
                    $assigned = $userDB->recoverSucursalData($assigned, $guestConn);
                    $session->setSessionCookie($assigned);
                    header('Location: ../../view/stock/dashboard.php');
                    break;
                default:
                    header('Location: ../../view/login.php?e=400');
                    break;
            }
        } else {
            header('Location: ../../view/login.php?e=401');
        }
        exit();
    } else {
        header('Location: ../../view/login.php?e=503');
        exit();
    }

} else {
    echo "Error";
}
?>