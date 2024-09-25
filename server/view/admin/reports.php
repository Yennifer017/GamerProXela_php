<?php
include("../../model/reports/ReportsDB.php");
include("../../model/reports/SalesRepFormat.php");
include("../../model/DB/AdminConnDB.php");
include("../../model/DB/CredentialsDB.php");
include('../../model/sucursal/Sucursal.php');
include('../../model/products/Product.php');
include('../../model/clients/Client.php');
include('../../model/clients/ClientForRep.php');

$session = new Session();
$worker = $session->get_session_data();
if ($worker == null || $worker->getRol() != Worker::ADMIN_ROL) {
    header('Location: ../login.php?e=401');
    exit();
}

$reportsDB = new ReportsDB();

$sucursales = $reportsDB->getTopSucursals(AdminConnDB::getInstance()->getConnection());
$products = $reportsDB->getTopProducts(AdminConnDB::getInstance()->getConnection());
$clients = $reportsDB->getTopClients(AdminConnDB::getInstance()->getConnection());

?>
<h1 class="gamer-title">Ver Reportes</h1>
<div class="accordion div-centrado">

    <details>
        <summary class="accordion-title">
            Historial de Descuentos
        </summary>
        <div class="gamer-form div-centrado">
            <form action="#" method="post">
                <label for="init">Desde: </label>
                <input type="date" name="init" id="init" required>

                <label for="end">Hasta: </label>
                <input type="date" name="end" id="end" required>
                <p>No implementado aun :c espera una actualizacion</p>
            </form>
            
        </div>
    </details>

    <details>
        <summary class="accordion-title">
            Top 10 ventas mas grandes en un rango de tiempo
        </summary>
        <div class="gamer-form div-centrado">
            <form action="#" method="post" id="salesForm">
                <label for="init">Desde: </label>
                <input type="date" name="init" id="initSaleRep" required>

                <label for="end">Hasta: </label>
                <input type="date" name="end" id="endSaleRep" required>

                <button type="submit" id="topSalesBtn">Consultar</button>
            </form>
        </div>
        <div>
            <table class="gamer-table">
                <thead>
                    <th>Puesto</th>
                    <th>Numero de factura</th>
                    <th>Cliente</th>
                    <th>Cajero</th>
                    <th>Total</th>
                    <th>Fecha extendida</th>
                </thead>
                <tbody id="topSalesTB">
                    <!--Add report here-->
                </tbody>
            </table>
        </div>
        
    </details>

    <details>
        <summary class="accordion-title">
            Top 2 sucursales que mas dinero han ingresado
        </summary>
        <div>
            <table class="gamer-table">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Nombre de sucursal</th>
                        <th>Total ingresado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($sucursales as $sucursal): ?>
                        <tr>
                            <td><?php echo $index ?></td>
                            <td><?= $sucursal->getName() ?></td>
                            <td><?= $sucursal->getAccumulated() ?></td>
                        </tr>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </details>

    <details>
        <summary class="accordion-title">
            Top 10 articulos mas vendidos
        </summary>
        <div>
            <table class="gamer-table">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>total vendido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $index ?></td>
                            <td><?= $product->getId() ?></td>
                            <td><?= $product->getName() ?></td>
                            <td><?= $product->getPrice() ?></td>
                        </tr>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </details>

    <details>
        <summary class="accordion-title">
            Top 10 clientes que mas dinero han gastado
        </summary>
        <div>
            <table class="gamer-table">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Nit</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Total gastado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo $index ?></td>
                            <td><?= $client->getNit() ?></td>
                            <td><?= $client->getName() ?></td>
                            <td><?= $client->getLastname() ?></td>
                            <td><?= $client->getEmail() ?></td>
                            <td><?= $client->getGastado() ?></td>
                        </tr>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </details>
</div>
<script src="../../assets/js/GetSalesReport.js"></script>