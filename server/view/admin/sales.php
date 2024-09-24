<div class="gamer-form div-centrado">
    <h1 class="gamer-title">Venta</h1>
    <form action="../../controllator/services/salespersonSer/SalesService.php" method="post">
        <label for="nit">Nit del Cliente:</label>
        <input type="number" name="nit" id="nit">
        <label for="cf">o marcar para indicar que es consumidor Final</label>
        <input type="checkbox" name="cf" id="cf">
        <hr>
        <h2>Productos</h2>
        <div id="products">

        </div>
        <button type="button" id="addProductBtn">Agregar producto</button>
        <hr>
        <h2>Descuentos</h2>
        <button type="button" id="addCardDiscountBtn">Agregar descuento con tarjeta</button>
        <br><hr><br>
        <button type="submit">Confirmar Venta</button>
    </form>
</div>