<?php
if (isset($_GET['e'])) {
    $status = $_GET['e'];
    switch ($status) {
        case 200:
            $factura = $_GET['n'];
            echo "<div class=\"success-message\"><p>Venta registrada correctamente, <br>
                    Factura No. $factura
                 </p></div>";
            break;
        case 400:
            echo '<div class="error-message"><p>
                Inexistencia de productos, nit no encontrado u otro error de datos, intentalo de nuevo
                </p></div>';
            break;
        case 417:
            echo '<div class="error-message"><p>
                Error de conexion, no se pudo obtener el numero de factura, consulte con 
                el administrador de TI, pues la factura se pudo haber registrado.
                </p></div>';
            break;
        case 406:
            echo '<div class="error-message"><p>
                No se especificaron productos, no se realizo la venta.
                </p></div>';
            break;
    }
}
?>
<div class="gamer-form div-centrado">
    <h1 class="gamer-title">Venta</h1>
    <form action="../../controllator/services/salespersonSer/SalesService.php" method="post">
        <label for="nit">Nit del Cliente:</label>
        <input type="number" name="nit" id="nit">
        <p>Nota: Dejar en blanco para indicar que es consumidor final</p>
        <hr>
        <h2>Productos</h2>
        <div id="products">
            <!--Add more products-->
        </div>
        <br>
        <button type="button" id="addProductBtn">Agregar producto</button>
        <hr>
        <h2>Descuentos</h2>
        <button type="button" id="addCardDiscountBtn">Agregar descuento con tarjeta</button>
        <hr>
        <h2>Calcular Totales</h2>
        <button type="button" id="calcTotalBtn">Calcular</button>
        <div class="gamer-form" style="margin-top: 2rem;">
            <p>Subtotal sin descuentos: <span id="subtotal"></span></p>
            <p>Subtotal con descuentos: <span id="subtotalWD"></span></p>
            <br>
            <p>Total de articulos: <span id="totalArt"></span></p>
            <br>
            <p>Total con puntos cajeados: <span id="total"></span></p>
        </div>
        <br><hr><br>
        <button type="submit">Confirmar Venta</button>
        <script></script>
    </form>
    <script src="../../assets/js/AddProduct.js"></script>
    <script src="../../assets/js/CalculateTotals.js"></script>
</div>