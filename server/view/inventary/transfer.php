<?php
if (isset($_GET['e'])) {
    $status = $_GET['e'];
    switch ($status) {
        case 200:
            echo '<div class="success-message"><p>Producto transferido correctamente</p></div>';
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
<h1 class="gamer-title">Transferencia de productos</h1>
<div class="gamer-form div-centrado">
    <form action="../../controllator/services/inventarySer/TransferService.php" method="POST">

        <label for="searchId">Codigo del producto: </label>
        <input type="number" name="id" id="id">
        <button type="button" id="searchBtn">Buscar</button>
        <hr>
        <div>
            <p>Nombre: <span id="name"></span> </p>
            <p>Pasillo: <span id="hall"></span> <br></p>
            <p>Existencias: <span id="currentExistences"></span></p>
        </div>  
        <hr>
        <label for="existences">Cantidad a tranferir: </label>
        <input type="number" name="existences" id="existences">
        
        <button type="submit">Transferir producto</button>
        <script src="../../assets/js/SearchExistence.js"></script>
    </form>
</div>