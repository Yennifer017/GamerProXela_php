<?php
include("../../../model/clients/Client.php");
include("../../../model/users/Worker.php");
include("../../../model/users/Salesperson.php");
include("../../../model/DB/SalespersonConnDB.php");
include("../../../model/DB/CredentialsDB.php");
include("../../../model/usersDB/ClientDB.php");
include("../../valitators/ClientValitator.php");
include("../../General/Session.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$session = new Session();
$worker = $session->get_session_data();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $worker != null && $worker->getRol() == Worker::SALESPERSON_ROL) {
    // Obtener los datos del formulario
    $nit = $_POST['nit'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $lastname = $_POST['lastname'] ??'';
    $client = new Client($nit, $name, $lastname, $email);
    try {
        $clientDB = new ClientDB();
        $clientDB->addInDB($client, SalespersonConnDB::getInstance()->getConnection());
        header('Location: ../../../view/salespersons/clientsOptions.php?e=200c');
        exit();
    } catch (InvalidDataEx $e) {
        header('Location: ../../../view/salespersons/clientsOptions.php?e=400c');
        exit();
    } catch (PDOException $e) {
        header('Location: ../../../view/salespersons/clientsOptions.php?e=503c');
        exit();
    }
} else {
    echo "Error";
}
?>