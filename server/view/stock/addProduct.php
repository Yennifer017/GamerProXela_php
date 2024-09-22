<?php
if (isset($_GET['e'])) {
    $status = $_GET['e'];
    switch ($status) {
        case 200:
            echo '<div class="success-message"><p>Producto agregado a Stock</p></div>';
            break;
        case 400:
            echo '<div class="error-message"><p>Formato de datos invalido</p></div>';
            break;
        case 416:
            echo '<div class="error-message"><p>
                    Codigo de producto o pasillo incorrecto (debe ser el mismo que ya esta registrado), 
                    <br> intentalo de nuevo.
                </p></div>';
            break;
        case 500:
            echo '<div class="error-message"><p>Error del servidor :c contacta por ayuda</p></div>';
            break;
    }
}
?>
<h1 class="gamer-title">Ingreso de producto</h1>
<div class="gamer-form div-centrado">
    <form action="../../controllator/services/stockSer/addStockProdSer.php" method="POST">

        <label for="id">Codigo del producto: </label>
        <input type="number" name="id" id="id">

        <label for="hall">Pasillo: </label>
        <input type="number" name="hall" id="hall">

        <label for="existences">Total de ingresos: </label>
        <input type="number" name="existences" id="existences">
        
        <button type="submit">Ingresar producto</button>
    </form>
</div>