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
            <!-- 
            <div class="product-card">
                <div class="product-info">
                    <input type="hidden" name="id" id="id" value="10">
                    <h3>Nombre: lejad</h3>
                    <p>Precio Q.vfeafeas</p>
                    <p>Descuento Q. </p>
                    <p>Existencias </p>
                    <label for="quantity">Cantidad: </label>
                    <input type="number" name="quantity" id="quantity">
                </div>
            </div>
            -->
        </div>
        <br>
        <button type="button" id="addProductBtn">Agregar producto</button>
        <hr>
        <h2>Descuentos</h2>
        <button type="button" id="addCardDiscountBtn">Agregar descuento con tarjeta</button>
        <br><hr><br>
        <button type="submit">Confirmar Venta</button>
        <script></script>
    </form>
    <script src="../../assets/js/AddProduct.js"></script>
</div>