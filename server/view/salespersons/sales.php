<div class="gamer-form div-centrado">
    <h1 class="gamer-title">Venta</h1>
    <form action="../../controllator/services/salespersonSer/SalesService.php" method="post">
        <label for="nit">Nit del Cliente:</label>
        <input type="number" name="nit" id="nit">
        <label for="cf">Consumidor Final?</label>
        <input type="checkbox" name="cf" id="cf">
        <hr>
        <h2>Productos</h2>
        <div class="gamer-form">
            <label for="producto">Codigo de Producto:</label>
            <input type="number" name="producto" id="producto">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad">
        </div>
        <button type="button">Agregar producto</button>
        <button type="button">Aplicar descuento</button>
        <br><hr><br>
        <button type="submit">Confirmar Venta</button>
    </form>
</div>