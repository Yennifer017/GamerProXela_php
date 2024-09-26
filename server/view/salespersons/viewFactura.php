<?php
include("../../model/salesDB/SalesDB.php");
include("../../model/DB/SalespersonConnDB.php");
include("../../model/DB/CredentialsDB.php");
include('../../model/products/Product.php');
include('../../model/products/Sold.php');
include('../../model/sales/Sale.php');
include ('../../controllator/General/Session.php');
include ('../../controllator/exceptions/NoDataFoundEx.php');
include ('../../model/users/Worker.php');
include ('../../model/users/Salesperson.php');

$session = new Session();
$worker = $session->get_session_data();
if ($worker == null || $worker->getRol() != Worker::SALESPERSON_ROL) {
    header('Location: ../login.php?e=401');
    exit();
}
include './header.php';

$id = $_GET['id'] ?? -1;
$error = '';
$sale = [];
$details = [];
try {
    $saleDB = new SalesDB();
    $sale = $saleDB->getSale($id, SalespersonConnDB::getInstance()->getConnection());
    $details = $sale->getDetails();   
} catch (NoDataFoundEx $e) {
    $error = "Venta no encontrada";
} catch (Exception $e) {
    $error = $e->getMessage();
}
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
    <h1 class="gamer-title">FACTURA</h1>
    <?php if ($error === ''): ?>
        <div class="paragraph-gamer internal">
            <p><span class="white">Numero de factura: </span><?php echo $sale->getId()?></p>
            <p><span class="white">Nombre del cliente: </span><?php echo $sale->getNameClient()?></p>
            <p><span class="white">Cajero que atendio: </span><?php echo $sale->getCajeroUsername()?> </p>
        </div>
        <div>
            <table class="gamer-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Precio con descuento</th>
                        <th>Cantidad</th>
                        <th>Subtotal (sin desc)</th>
                        <th>Subtotal (con desc)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $product): ?>
                    <!--Add the products here-->
                        <tr>
                            <td><?= $product->getId() ?></td>
                            <td><?= $product->getName() ?></td>
                            <td><?= $product->getPrice() ?></td>
                            <td><?= $product->getPriceWithDisc() ?></td>
                            <td><?= $product->getQuantity()?></td>
                            <td><?= $product->getTotalWithoutDiscount() ?></td>
                            <td><?= $product->getTotalWithDiscount() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paragraph-gamer internal" style="margin-bottom: 2rem;">
            <p><span class="white">Subtotal: </span><?php echo $sale->getSubtotal() ?></p>
            <p><span class="white">Total: </span><?php echo $sale->getTotal() ?></p>
        </div>
    <?php else: ?>
        <div class="error-message ">
            <?php echo $error?>
        </div>
    <?php endif; ?>
</body>
</html>