<?php
include("../../model/salesDB/SalesDB.php");
include("../../model/DB/SalespersonConnDB.php");
include("../../model/DB/CredentialsDB.php");
include('../../model/products/Product.php');
include('../../model/products/Sold.php');
include('../../model/sales/Sale.php');
include ('../../controllator/General/Session.php');
include ('../../model/users/Worker.php');
include ('../../model/users/Salesperson.php');

error_reporting(E_ALL);
ini_set('display_errors', value: 1);
ini_set('display_startup_errors', 1);

$session = new Session();
$worker = $session->get_session_data();
if ($worker == null || $worker->getRol() != Worker::SALESPERSON_ROL) {
    header('Location: ../login.php?e=401');
    exit();
}
include './header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/tables.css">
</head>
<body>
    <h1 class="gamer-title">CONSULTAR FACTURA</h1>
    <div class="gamer-form div-centrado">
        <form action="./viewFactura.php" method="get">
            <label for="id">Numero de factura: </label>
            <input type="number" name="id" id="id" required>
            <button type="submit">Consultar</button>
        </form>
    </div>
</body>
</html>